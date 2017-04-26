<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * @author Greedywolf 1154505909@qq.com
	 * @DateTime 2017-04-24
	 * @return   [type]
	 */
	public function index()
	{

		$method="Apido-index";
		$parme=explode('-', $method);
        if(count($parme) != 2) {
           echo json_encode(array('status'=>'4002','message'=>'错误的请求'));exit;
         }
         $classname = $parme[0];
         $methodname = $parme[1];
         $classname = ucfirst($classname);

         $file = APPPATH.'controllers\Api\\'.$classname.'.php';
         include $file;
         if(!is_file($file)){
              echo json_encode(array('status'=>'3001','message'=>'类不存在')) ;exit;
         }
         $Object = new $classname;
         if(!method_exists($Object,$methodname)){
              echo json_encode(array('status'=>'3002','message'=>'方法不存在'));exit;
         }
         $result=$Object->$methodname();
         echo json_encode($result);exit;
	}

}