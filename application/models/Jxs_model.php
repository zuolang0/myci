<?php
class Jxs_model extends CI_Model{
	/**
	 * [get_area_jxs 获取地区经销商]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-28
	 * @param    [arr]     $where [查询条件]
	 * @return   [type]                [description]
	 */
	public function get_area_jxs($where){
		$this->db->select('dealerId,dealerCode,dealerName')->where($where);
		$query=$this->db->get('fittle_cyc_jc');
		return $query->result_array();
	}
	/**
	 * [get_name_by_dealerid 根据dealerid 获取公司名]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-02
	 * @param    [type]     $dealerid [description]
	 * @return   [type]               [description]
	 */
	public function get_name_by_dealerid($dealerId){
		$this->db->select('dealerName')->where(array('dealerId'=>$dealerId));
		$query=$this->db->get('fittle_cyc_jc');
		$result = $query->row();
    	return $result->dealerName; 
	}
	/**
	 * [get_code_by_dealerid 获取经销商code]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-03
	 * @param    [type]     $dealerId [description]
	 * @return   [type]               [description]
	 */
	public function get_code_by_dealerid($dealerId){
		$this->db->select('dealerCode')->where(array('dealerId'=>$dealerId));
		$query=$this->db->get('fittle_cyc_jc');
		$result = $query->row();
    	return $result->dealerCode; 
	}

	/**
	 * [get_area 获取经销商地区编码]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-03
	 * @param    [type]     $seach [description]
	 * @return   [type]            [description]
	 */
	public function get_area($seach){
		$this->db->select($seach)->where("$seach != ''")->group_by($seach);
		$query=$this->db->get('fittle_cyc_jc');
		return $query->result_array();
	}
}