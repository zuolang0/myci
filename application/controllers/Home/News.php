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
		#输出的数据必须放在数组内,在页面是直接使用关联的下标取数据
		$this->load->view('template/header',$data);
		$this->load->view('news/index',$data);
		$this->load->view('template/footer');
	}
	public function pages(){
		$this->load->library('pagination');
		$config['base_url']=site_url('news/pages');
		$config['total_rows']=$this->db->count_all('news');
		$config['per_page']=2;
		$config['uri_segment']=3;
		$config['full_tag_open']='<p>';
		$config['full_tag_close']='</p>';
		$this->pagination->initialize($config);
		$data['result']=$this->news->get_new_page($config['per_page'],$this->uri->segment(3));
		$this->load->library('table');
		$this->table->set_heading('ID','Title','text');
		$this->load->view('news/page',$data);
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
		//加载表单类
		$this->load->helper('form');
		//加载表单验证类
		$this->load->library('form_validation');
		$data['title']='create a news';

		/*隐藏域*/
		$data['hid']='GAOSHA';		
		#运行方式1
		#这种是在运行config下自己定义的那个规则组 
		#$this->form_validation->run('news')
		#在页面或者在定义规则组时使用的是路由就可以直接使用run
		#设置验证规则
		#$this->form_validation->set_rules('title','Title','required|callback_check_title');
		#$this->form_validation->set_rules('text','Text','required');
		#
		#$this->form_validation->run()
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
	/**
	 * [check_title 自定义数据验证]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-26
	 * @param    [type]     $str [description]
	 * @return   [type]          [description]
	 */
	public function check_title($str){
		if ($str=='test') {
			#set_message内的第一个参数需要与函数名一致
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
	/**
	 * [memcache_use memcache使用]
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-26
	 * @return   [type]     [description]
	 */
	public function memcache_use(){
		$this->load->driver('cache');
		$this->cache->memcached->save('qwe', 'boss', 10);
		$tmp=$this->cache->memcached->get('qwe');
		var_dump($tmp);
		#删除
		$this->cache->memcached->delete('qwe');
		$tmp=$this->cache->memcached->get('qwe');
		var_dump($tmp);
	}

}