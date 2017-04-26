<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('news_model','news');
		$this->load->helper('url_helper');
	}
	public function index(){
		$data['news']=$this->news->get_news();
		$data['title']="New list";

		$this->load->view('template/header',$data);
		$this->load->view('news/index',$data);
		$this->load->view('template/footer');
	}
	/**
	 * [view 详情页]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-25
	 * @param    [type]     $slug [description]
	 * @return   [type]           [description]
	 */
	public function view($slug=NULL){
		$data['news_item']=$this->news->get_news($slug);
		$data['title']="New info";
		$this->load->view('template/header',$data);
		$this->load->view('news/info',$data);
		$this->load->view('template/footer');
	}
	/**
	 * [create 表单验证]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-25
	 * @return   [type]     [description]
	 */
	public function create(){
		//表单
		$this->load->helper('form');
		//表单验证
		$this->load->library('form_validation');
		$data['title']='create a news';
		/*隐藏域*/
		$data['hid']='GAOSHA';
		/**/
		#验证规则
		/*$this->form_validation->set_rules('title','Title','required|callback_check_title');
		$this->form_validation->set_rules('text','Text','required');*/
		#验证
		if ($this->form_validation->run()===FALSE) {
			$this->load->view('template/header',$data);
			$this->load->view('news/create',$data);
			$this->load->view('template/footer');
		}else{

			$this->news->set_news();
			$this->load->view('news/success');
		}
	}
	public function check_title($str){
		if ($str=='test') {
			 $this->form_validation->set_message('check_title', 'The {field} field can not be the word "test"');
			 return false;
		}else{
			return true;
		}
	}
	/**
	 * [redis_use redis缓存使用]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-26
	 * @return   [type]     [description]
	 */
	public function redis_use(){
		#加载缓存类
		$this->load->driver('cache');
		#存缓存
		$this->cache->redis->save('foo', 'bar');
		#取缓存
		$tmp=$this->cache->redis->get('foo');
		var_dump($tmp);
		#删除
		$this->cache->redis->delete('foo');
		$tmp=$this->cache->redis->get('foo');
		var_dump($tmp);

	}

	public function memcache_use(){
		$this->load->driver('cache');
		$this->cache->memcached->save(1, 'boss', 10);
		$tmp=$this->cache->memcached->get(1);
		var_dump($tmp);
		#删除
		$this->cache->memcached->delete(1);
		$tmp=$this->cache->memcached->get(1);
		var_dump($tmp);


	}

}