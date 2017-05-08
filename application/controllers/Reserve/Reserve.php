<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reserve extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('car_model','car');

		$this->load->model('area_model','area');
	}
	/**
	 * [index 预约试驾]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @return   [type]     [description]
	 */
	public function index(){
		$this->load->model('unit_model','unit');
		//加载表单类
		$this->load->helper('form');
		//加载表单验证类
		$this->load->library('form_validation');
		$this->load->helper('url_helper');
		$data['car']=$this->car->get_car();

		#设置验证规则
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('mobile','Mobile','required|exact_length[11]');

		if ($this->form_validation->run()===FALSE) {
			$this->load->view('reserve/index.html',$data);
		}else{
			$result= self::reser();
			$mobile=$this->session->userdata('mobile');
			$where=array('mobile'=>$mobile);
			$this->unit->add_result($where,$result);
			var_dump(json_decode($result,true));
			$this->load->view('news/success');
		}
	}
	/**
	 * [get_jxs 根据地区获取经销商]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-02
	 * @return   [type]     [description]
	 */
	public function get_jxs(){
		$code= $this->input->post('code');
		$level= $this->input->post('level');
		$levelarr=array(2=>'provinceId',3=>'cityId',4=>'town');
		$where=array($levelarr[$level]=>$code);
		$this->load->model('jxs_model','jxs');
		$result=$this->jxs->get_area_jxs($where);
		echo json_encode($result);
	}
	/**
	 * [reser 预约提交]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-02
	 * @return   [type]     [description]
	 */
	public function reser(){
		$this->load->model('unit_model','unit');
		$this->load->library('session');
		#固定参数
	/*	$param['op']='try';
		$param['aid']='10';*/
		$param['trail_channel_from']='2-848007966';
		#用户信息
		$name=$this->input->post('name');
		$mobile=$this->input->post('mobile');
		$param['name']=($name);
		$param['mobile']=($mobile);
		#车型
		$car_series=$this->input->post('car_series');
		if (!empty($car_series)) {
			$car_series_name=$this->car->get_name_by_groupId($car_series);
			$param['car_series']=($car_series);
			$param['car_series_name']=($car_series_name);
		}
		$province=$this->input->post('province');
		#省份相关参数处理
		if (!empty($province)) {
			$province_name=$this->area->get_name_by_regionId($province);
			$param['region_id_1']=($province);
			$param['region_id_1_name']=($province_name);
			$city=$this->input->post('city');
			if (!empty($city)) {
				$city_name=$this->area->get_name_by_regionId($city);
				$county=$this->input->post('county');
				$param['region_id_2']=($city);
				$param['region_id_2_name']=($city_name);
				if (!empty($county)) {
					$county_name=$this->area->get_name_by_regionId($county);
					$param['region_id_3']=($county);
					$param['region_id_3_name']=($county_name);
				}
			}
		}
		#经销商数据处理
		$dealer_id=$this->input->post('dealer_id');
		$this->load->model('jxs_model','jxs');
		if (!empty($dealer_id)) {
			$dealer_code=$this->jxs->get_code_by_dealerid($dealer_id);
			$dealer_code_name=$this->jxs->get_name_by_dealerid($dealer_id);
			$param['dealer_id']=($dealer_id);
			$param['dealer_code_name']=($dealer_code_name);
			$param['dealer_code']=($dealer_code);
		}
		$param['dealer_brand']=2;
		#时间相关
		$visit_time=$this->input->post('visit_time');
		$order_time=$this->input->post('order_time');
		if (strtotime($visit_time)) {
			$param['visit_time']=($visit_time);
		}
		if (strtotime($order_time)) {
			$param['order_time']=($order_time);
		}
		$url='http://www.changan.com.cn/api.php?op=try&aid=2';
		#记录写入数据库
		$this->unit->adddata($param);
		$this->session->set_userdata('mobile', $mobile);
		#参数进行编码
		foreach ($param as $key => $value) {
			$param[$key]=urlencode($value);
		}
		return self::curl_post($url,$param);
	}
	/**
	 * [curl_post 提交数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-02
	 * @param    [type]     $url   [description]
	 * @param    [type]     $param [description]
	 * @return   [type]            [description]
	 */
	public function curl_post($url,$param){
		$param=$param;
        $curl = curl_init();
        //设置提交的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data = $param;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
      //获得数据并返回
        return $data;
	}
	/**
	 * [create_where 组装条件]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-03
	 * @param    [type]     $arr [description]
	 * @param    [type]     $key [description]
	 * @return   [type]          [description]
	 */
	public function create_where($arr,$key){
		$where='regionCode in ( ';
		foreach ($arr as $value) {
			$where.=$value[$key].",";
		}
		$where=rtrim($where,",");
		$where.=" )";
		return $where;
	}
	/**
	 * [area_file 地区文件缓存]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @return   [type]     [description]
	 */
	public function area_file(){
		$this->load->helper('file');
		#获取经销商数据省市区id
		$seach='provinceId';
		$province=self::jxs_area($seach);
		#市
		$seach='cityId';
		$city=self::jxs_area($seach);
		#区
		$seach='town';
		$town=self::jxs_area($seach);
		#地区数组转json
		$Json="var provinceJson =".json_encode($province)."\n\nvar cityJson =".json_encode($city)."\n\nvar countyJson =".json_encode($town);
		#var_dump($Json);die;
		#写入文件
		if ( ! write_file('./public/js/area.js', $Json)){
		    	echo 'Unable to write the file';
			}else{
		    	echo 'File written!';
		}
	}
	/**
	 * [jxs_area 获取经销商所在省市区数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-03
	 * @param    [type]     $seach [description]
	 * @return   [type]            [description]
	 */
	public function jxs_area($seach){
		$this->load->model('jxs_model','jxs');
		#获取经销商数据省市区id
		#$seach='provinceId';
		$list=$this->jxs->get_area($seach);
		$where=self::create_where($list,$seach);
		$area=$this->area->get_city_by_id($where);
		return $area;
	}
	/**
	 * [area 获取下级城市]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @return   [type]     [description]
	 */
	public function area(){
		$city_code=$this->input->post('code');
		$data['city']=$this->area->get_city($city_code);
		$this->response_data($data);
	}
	/**
	 * [response_data 返回数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @param    [type]     $data [description]
	 * @return   [type]           [description]
	 */
	public function response_data($data){
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
	}
}