<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jxsyw extends CI_Controller{
	public function __construct(){
		parent::__construct();
		#加载数据库操作
		$this->load->model('yongyou_model','yongyou');
	}

	public function wl_jc(){

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
		$result=$client->getAreaGroup($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='yw_wl_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getAreaGroup($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}

	public function wl_vc(){
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
		$result=$client->getAreaGroup($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='yw_wl_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getAreaGroup($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}
	/**
	 * [jxsyw_jc 经销商业务轿车范围]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function jxsyw_jc(){
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
		$result=$client->getDealerBusinessArea($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='jxsyw_jc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getDealerBusinessArea($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo "OK";
	}
	/**
	 * [jxsyw_vc 经销商业务微车范围]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @return   [type]     [description]
	 */
	public function jxsyw_vc(){
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
		$result=$client->getDealerBusinessArea($params);
		#对象转数组
		$array = json_decode(json_encode($result), true);
		#获取总条数
		$count=$array['return']['totalPage'];
		#开始正式获取数据
		$params['pageSize']=400;
		$pagecount=ceil($count/400);

		$table='jxsyw_vc';
		for ($i=1; $i <= $pagecount; $i++) {
			$params['curPage']=$i;
			$rel_result=$client->getDealerBusinessArea($params);
			#对象转数组
			$rel_array = json_decode(json_encode($rel_result), true);
			$respone=$rel_array['return'];
			$this->yongyou->adddata($table,$respone);
		}
		echo 'vc—— ok';
	}
}