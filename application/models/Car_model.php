<?php
class Car_model extends CI_Model{
	/**
	 * [get_car 获取车型]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @return   [arr]     [车型数组]
	 */
	public function get_car(){
		$result= $this->db->select('groupId,groupName')->get('fittle_car_jc_notnull');
		return $result->result_array();
	}
	public function get_name_by_groupId($groupId){
		$this->db->select('groupName')->where(array('groupId'=>$groupId));
		$query=$this->db->get('fittle_car_jc_notnull');
		$result=$query->row();
		return $result->groupName;
	}
}