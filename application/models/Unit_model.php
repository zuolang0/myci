<?php
class Unit_model extends CI_Model{
	public function adddata($data){
		if (empty($data)) {
			return false;
		}else{
			$this->db->insert('unit_data', $data);
			return true;
		}
	}
}