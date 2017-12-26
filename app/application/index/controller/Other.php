<?php


namespace app\index\controller;


use think\Cookie;
use think\Request;

class Other
{
    //接值
    public $data;
    //返回值
    public $return;
    //构造
    public function __construct()
    {
        //接值
        $this->data = Request::instance()->get();
    }
    //析构
    public function __destruct()
    {
        if(isset($this->data['callback']))
        {
            echo $this->data['callback'].'('.json_encode($this->return).')';die;
        }
    }

    /*
     * 标记一个需要关注的客户端
     * */
    public function sign()
    {
        Cookie::set('sign','拒绝条款',time()+3600*24*7);
        $this->return = ['error'=>'058','msg'=>'ok'];
    }

    /*
     * 修改服务条款
     * */
    public function treaty_update()
    {
        $reg = file_put_contents('public/treaty.txt',json_encode($this->data['treaty']));
        if($reg)
        {
            $this->return = ['error'=>'053','msg'=>'服务条款更新成功'];
        }else
        {
            $this->return = ['error'=>'054','msg'=>'服务条款更新失败'];
        }
    }

    /*
     * 获取服务条款
     * */
    public function treaty_find()
    {
        $reg = file_get_contents('public/treaty.txt');
        if($reg)
        {
            $this->return = ['error'=>'055','msg'=>json_decode($reg,true)];
        }else
        {
            $this->return = ['error'=>'056','msg'=>'获取服务条款失败'];
        }
    }
}











/**
 * Other.php
 *
 * ...
 *
 * Copyright (c)2017 http://note.hanfu8.top
 *
 * 修改历史
 * ----------------------------------------
 * 2017/9/17, 作者: 降省心(QQ:1348550820), 操作:创建
 **/