<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Area extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('yongyou_model','yongyou');
	}
	public function get_car_jc(){
		#复制后修改方法名，表名
		#
		$webserver="http://202.98.63.70:8000/jcwbs/services/dealerBusinessArea?wsdl";
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>md5('CAWBS666PASS2015!'),
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		#连接
		$client = new SoapClient($webserver,array('encoding'=>'UTF-8'));
		#取数据
		$result=$client->getVhclMaterialGroup($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='car_pz_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getVhclMaterialGroup($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}
	public function get_car_vc(){
		set_time_limit(0);
		#复制后修改方法名，表名
		#
		$webserver="http://202.98.63.70:8000/vcwbs/services/dealerBusinessArea?wsdl";
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>md5('CAWBS666PASS2015!'),
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		#连接
		$client = new SoapClient($webserver,array('encoding'=>'UTF-8'));
		#取数据
		$result=$client->getVhclMaterialGroup($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='car_pz_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getVhclMaterialGroup($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}

	/**
	 * [get_area_jc 地区轿车]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function get_area_jc(){
		#复制后修改方法名，表名
		#
		$webserver="http://202.98.63.70:8000/jcwbs/services/dealerBusinessArea?wsdl";
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>md5('CAWBS666PASS2015!'),
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		#连接
		$client = new SoapClient($webserver,array('encoding'=>'UTF-8'));
		#取数据
		$result=$client->getRegionInfo($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='area_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getRegionInfo($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}
	/**
	 * [get_area_vc 地区微车]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function get_area_vc(){
		#复制后修改方法名，表名
		#
		$webserver="http://202.98.63.70:8000/vcwbs/services/dealerBusinessArea?wsdl";
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>md5('CAWBS666PASS2015!'),
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		#连接
		$client = new SoapClient($webserver,array('encoding'=>'UTF-8'));
		#取数据
		$result=$client->getRegionInfo($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='area_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getRegionInfo($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}
}