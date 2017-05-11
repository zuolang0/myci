<?php
class Api_model extends CI_Model{
	public function set_api($table,$data){
		if (empty($table)||empty($data)) {
			return false;
		}else{
			if ($this->db->insert($table,$data)) {
				return true;
			}else{
				return false;
			}
		}
	}
	/**
	 * [check_apiname 检测接口名是否已存在]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @param    [type]     $apiname [description]
	 * @return   [type]              [description]
	 */
	public function get_api_id($apiname){
		$query=$this->db->select('id')->where(array('apiname'=>$apiname))->limit(1)->get('api');
		return $query->row_array();
	}
	/**
	 * [get_api_page 分页]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @param    [type]     $num    []
	 * @param    [type]     $offset []
	 * @return   [type]             []
	 */
	public function get_api_page($num,$offset){
		$query=$this->db->get('api',$num,$offset);
		return $query->result_array();

	}
	/**
	 * [get_api_info_by_aid 获取接口参数详情]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @param    [type]     $aid [description]
	 * @return   [type]          [description]
	 */
	public function get_api_info_by_aid($aid){
		$query=$this->db->select("id,key,def_value,is_fixed")->where(array('apiid'=>$aid))->get('api_parme');
		return $query->result_array();
	}
	/**
	 * [check_key description]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-09
	 * @param    [type]     $key   [description]
	 * @param    [type]     $apiid [description]
	 * @return   [type]            [description]
	 */
	public function check_key($key,$apiid){
		$query=$this->db->select('id')->where(array("key"=>$key,"apiid"=>$apiid))->limit(1)->get('api_parme');
		return $query->row_array();
	}
	/**
	 * [delprame 删除操作]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-05-10
	 * @param    [type]     $id [description]
	 * @return   [type]         [description]
	 */
	public function delprame($id){
		$this->db->delete('api_parme' , array('id' => $id) );//删除table1表中id为$id的记录
	}
}