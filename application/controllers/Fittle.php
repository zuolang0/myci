<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fittle extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('yongyou_model','yongyou');
	}

	public function fitle_swc_qj(){
		set_time_limit(0);
		$dealerType="10771001";
		$dealerClass="11451012";
		$status='10011001';
		$dealerCode ="HB,NJ";//notlike
		$sql="SELECT * FROM jxs_vc WHERE dealerType='$dealerType' AND dealerClass='$dealerClass' and status='$status' and dealerCode NOT LIKE ('HB|NJ|%')";
		$result=$this->db->query($sql);

		$data=$result->result_array();
		#var_dump($data);
		$this->yongyou->adddata('syc_qj_fittle',$data);
		echo "OK";
	}

	public function fitle_swc_jc(){
		set_time_limit(0);
		$dealerType="10771001";#经销商类型：10771001
		$dealerClass="11451001";#经销商评级：
		$status='10011001';
		#$dealerCode ="HB,NJ";//notlike排除“JCC” “Z” “JZC” “JCXN” “JZBC”开头的数据以及特殊代码“JC83179”。

		$sql="SELECT * FROM jxs_jc WHERE dealerType='$dealerType' AND dealerClass='$dealerClass' and status='$status' and dealerCode NOT LIKE ('JCC|Z|JZC|JCXN|JZBC|JC83179|%')";

		$result=$this->db->query($sql);

		$data=$result->result_array();
		#var_dump($data);
		$this->yongyou->adddata('cyc_jc_fittle',$data);
		echo "OK";
	}

	public function fit_car_jc(){
		$table='car_pz_jc';
		$sql="SELECT * FROM car_pz_jc WHERE groupShortName !=''";#groupLevel != '2' AND 
		$table='fittle_car_jc_notnull';
		$result=$this->db->query($sql);

		$data=$result->result_array();
		#var_dump($data);
		$this->yongyou->adddata($table,$data);
		echo "OK";
	}
	public function fit_car_vc(){
		$table='car_pz_vc';
		$sql="SELECT * FROM car_pz_vc WHERE groupShortName !=''";
		$table='fittle_car_vc_notnull';
		$result=$this->db->query($sql);

		$data=$result->result_array();
		#var_dump($data);
		$this->yongyou->adddata($table,$data);
		echo "OK";
	}
}