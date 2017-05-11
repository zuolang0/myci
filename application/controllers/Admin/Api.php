<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('api_model','api');
		$this->load->helper('url');
	}
	public function index(){

		
	}
	/**
	 * [infoedit 参数编辑]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-11
	 * @return   [type]     [description]
	 */
	public function infoedit(){
		//加载表单类
		$this->load->helper('form');
		//加载表单验证类
		$this->load->library('form_validation');
		$this->form_validation->set_rules('key','key','required|callback_check_key');
		$this->form_validation->set_rules('def_value','def_value','required');
		$this->form_validation->set_rules('key','key','required');
		$id=$this->uri->segment(4);
		$data['title']='参数编辑';
		$data['del']=site_url()."/admin/api/delprame/";
		$data['up']=site_url()."/admin/api/upprame/";
		if (empty($id)) {
			redirect('admin/api/list');
		}else{
			$_SESSION['apiid']=$id;
			$this->id=$id;
			if ($this->form_validation->run()===FALSE) {
				$data['hid']=$id;
				$data['info']=$this->api->get_api_info_by_aid($id);
				$this->load->view('template/header',$data);
				$this->load->view('admin/api_info',$data);
				$this->load->view('template/footer');
			}else{
				$data['key']=$this->input->post('key');
				$data['apiid']=$this->input->post('apiid');
				$data['def_value']=$this->input->post('def_value');
				$data['is_fixed']=$this->input->post('is_fixed');
				$this->api->set_api('api_parme',$data);
				redirect('admin/api/infoedit/'.$_SESSION['id']);
			}
		}
	}
	/**
	 * [delprame 参数删除]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-11
	 * @return   [type]     [description]
	 */
	public function delprame(){
		$id=$this->uri->segment(4);
		$this->api->delprame($id);

	}
	/**
	 * [upprame description]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-10
	 * @return   [type]     [description]
	 */
	public function upprame(){
		$id=$this->uri->segment(4);

	}
	/**
	 * [check_key 检测key是否已存在]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-10
	 * @param    [type]     $str [description]
	 * @return   [type]          [description]
	 */
	public function check_key($str){
		$result=$this->api->check_key($str,$_SESSION['id']);
		if ($result['id']) {
			return false;
		}else{
			return true;
		}
	}
	/**
	 * [apiinfo api详情]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @return   [type]     [description]
	 */
	public function apiinfo(){
		$id=$this->uri->segment(4);
	}
	/**
	 * [list 接口列表]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @return   [type]     [description]
	 */
	public function list(){
		$this->load->library('pagination');
		$config['base_url']=site_url('admin/api/list');
		$config['total_rows']=$this->db->count_all('api');
		$config['per_page']=5;
		$config['uri_segment']=3;
		$config['full_tag_open']='<p>';
		$config['full_tag_close']='</p>';
		$this->pagination->initialize($config);
		$data['result']=$this->api->get_api_page($config['per_page'],$this->uri->segment(3,1));
		$this->load->library('table');
		$this->table->set_heading('ID','名字','创建时间','是否有效','操作');
		$this->load->view('admin/api_list',$data);
	}
	/**
	 * [edit 接口添加]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @return   [type]     [description]
	 */
	public function edit(){
		
		//加载表单类
		$this->load->helper('form');
		//加载表单验证类
		$this->load->library('form_validation');
		//callback_check_apiname_exist   方法名前面要加callback..已经第二次了
		$this->form_validation->set_rules('apiname','apiname','required|callback_check_apiname_exist');
		if ($this->form_validation->run()===FALSE) {
			$this->load->view('admin/api_edit');
		}else{
			$data['apiname']=$this->input->post('apiname');
			$data['create_time']=date("Y-m-d H:i:s");
			$result=$this->api->set_api('api',$data);
			if ($result) {
				$id=$this->api->get_api_id($data['apiname']);
				redirect('admin/api/infoedit/'.$id['id']);
			}else{
				$this->load->view('admin/api_edit');
			}
			
		}
		
	}
	public function check_apiname_exist($str){
		$check=$this->api->get_api_id($str);
		if (empty($check)) {
			return true;
		}else{
			$this->form_validation->set_message('check_apiname_exist', "接口名 已存在");
			return false;
		}

	}
}