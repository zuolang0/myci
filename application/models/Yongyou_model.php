<?php
class Yongyou_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * [adddata 插入数据]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-27
	 * @param    [str]     $table [表名]
	 * @param    [arr]     $data  [数据]
	 * @return   []            [description]
	 */
	public function adddata($table,$data){
		if (empty($table)||empty($data)) {
			return false;
		}else{
			$this->db->insert_batch( $table , $data);
			return true;
		}
	}
}
