<?php
class News_model extends CI_Model{
/*	public function __construct(){
		parent::__construct();
	}*/
	public function get_news($flag=FALSE){
		if ($flag===FALSE) {
			$query=$this->db->get('news');
			return $query->result_array();
		}
		$query=$this->db->get_where('news',array('slug'=>$flag));
		return $query->row_array();
	}
	/**
	 * CI分页
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-26
	 * @param    integer    $page     [description]
	 * @param    [type]     $pagesize [description]
	 * @return   [type]               [description]
	 */
	public function get_new_page($num,$offset){
		$query=$this->db->get('news',$num,$offset);
		return $query->result_array();

	}
	public function set_news(){
		$this->load->helper('url');
		$slug=url_title($this->input->post('title','dash',TRUE));
		$data=array(
			'title'=>$this->input->post('title'),
			'slug'=>$slug,
			'text'=>$this->input->post('text')
			);
		return $this->db->insert('news',$data);
	}
	/*public function add($news){
		if (empty($news)) {
			return 0;
		}

	}*/

}