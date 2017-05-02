<?php
class Area_model extends CI_Model{

	/**
	 * [get_city_by_type 根据分类查询省市区]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @param    string     $parentCode [description]
	 * @return   [type]                 [description]
	 */
	public function get_city_by_type($regionType='10541002'){
		$this->db->select('regionName,regionId,regionCode,parentCode')->where(array('regionType'=>$regionType,'status'=>'10011001'));#10011002
		$query = $this->db->get('area_jc');
		return $query->result_array();
	}
	/**
	 * [get_city_by_parent 根据父级查询地区]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @param    [type]     $parent [description]
	 * @return   [type]             [description]
	 */
	public function get_city_by_parent($parent){
		$this->db->select('regionName,regionId,regionCode,parentCode')->where(array('parentCode'=>$parent,'status'=>'10011001'));#10011002
		$query = $this->db->get('area_jc');
		return $query->result_array();
	}
	/**
	 * [get_name_by_regionId 根据regionId条件查询地区名字]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-02
	 * @param    [type]     $where [description]
	 * @return   [type]            [description]
	 */
	public function get_name_by_regionId($regionId){
		$this->db->select('regionName')->where(array('regionId'=>$regionId));
		$query=$this->db->get('area_jc');
		$result = $query->row();
    	return $result->regionName;  
	}
}