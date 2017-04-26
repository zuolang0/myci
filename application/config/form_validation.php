<?php
/**
 * [$config 自定义表单验证规则]
 * @var array
 */
$config = array(
    #分组定义验证规则
    #当分组名字与控制区路由一致时将被自动调用
    'news/create'=>array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required|callback_check_title|min_length[5]|max_length[12]'
        ),
        array(
            'field' => 'text',
            'label' => 'Text',
            'rules' => 'required'
        ),
       
    ),
    #调用时 使用
    #$this->form_validation->run(signup);即可
    'signup' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required'
        )
    ),
    'email' => array(
        array(
            'field' => 'emailaddress',
            'label' => 'EmailAddress',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'message',
            'label' => 'MessageBody',
            'rules' => 'required'
        )
    )
);