<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 用友数据拉取
 */
class Jxsjc extends CI_Controller{
	public function __construct(){
		parent::__construct();
		#加载数据库操作
		$this->load->model('yongyou_model','yongyou');
	}

	/**
	 * [get_yw_jc 业务数据轿车]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function  get_yw_jc(){
		set_time_limit(0);
		#webserver
		$jc_webserver='http://202.98.63.70:8000/jcwbs/services/dealerBusinessArea?wsdl';
		$jc_client = new SoapClient($jc_webserver,array('encoding'=>'UTF-8'));
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>md5('CAWBS666PASS2015!'),
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		#连接
		
		#取数据
		$result=$jc_client->getBusinessArea($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='yw_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$jc_client->getBusinessArea($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
	}
/**
	 * [get_yw_jc 业务数据轿车]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function  get_yw_vc(){
		set_time_limit(0);
		#webserver
		$webserver='http://202.98.63.70:8000/vcwbs/services/dealerBusinessArea?wsdl';
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
		$result=$client->getBusinessArea($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='yw_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getBusinessArea($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
	}
	/**
	 * [getjc 经销商轿车数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function getjc(){
		set_time_limit(0);
		#webserver
		$jc_webserver='http://202.98.63.70:8000/jcwbs/services/dealerBusinessArea?wsdl';
		#连接
		$jc_client = new SoapClient($jc_webserver,array('encoding'=>'UTF-8'));
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>'7f51fdf03f67be1d1ba5580cbeebf90c',
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		$result=$jc_client->getDealerInfo($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);
		#表名
		$table='jxs_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$jc_client->getDealerInfo($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
	}

	/**
	 * [getjc 经销商微车数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function getvc(){
		set_time_limit(0);
		#webserver
		$jc_webserver='http://202.98.63.70:8000/vcwbs/services/dealerBusinessArea?wsdl';
		#连接
		$jc_client = new SoapClient($jc_webserver,array('encoding'=>'UTF-8'));
		#参数
		$params=array(
		 	'acnt'=>'CAWBS666',
		 	'password'=>'7f51fdf03f67be1d1ba5580cbeebf90c',
		 	'pageSize'=>1,
		 	'curPage'=>1,
		 	'reqType'=>'90001001',
		 	);
		$result=$jc_client->getDealerInfo($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);
		#表名
		$table='jxs_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$jc_client->getDealerInfo($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			#插入数据
			$this->yongyou->adddata($table,$respone);
		}
	}

}