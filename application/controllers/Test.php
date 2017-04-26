<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-24
	 * @return   [type]
	 */
	public function index()
	{
		$this->load->view('test');
	}
}