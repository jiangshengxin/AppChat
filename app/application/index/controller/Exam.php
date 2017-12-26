<?php
namespace app\index\controller;

use think\Cookie;
use think\Request;

/*
 * 检查类
 * */

class Exam
{
    public $data;
    public $user;
    public $return;
    /*
     * 构造函数
     * */
    public function __construct()
    {
        //接值
        $this->data = Request::instance()->get();
        //调用验证登录方法
        $this->login_state();
    }

    //析构
    public function __destruct()
    {
        if(isset($this->data['callback'])&&$this->return)
        {
            echo $this->data['callback'].'('.json_encode($this->return).')';die;
        }
    }

    /*
     * 判断登录状态
     * */
    public function login_state()
    {
        $reg = Cookie::get('user');
        if($reg['end_time']<time()&&$reg)
        {
            $this->return = ['error'=>'007','msg'=>'账户已过期,联系QQ:1348550820激活账户'];die;
        }elseif ($reg == null)
        {
            $this->return = ['error'=>'010','msg'=>'请登录'];die;
        }else
        {
            $this->user = $reg;
        }
    }


}







/******
 * User: 降省心
 * @QQ:1348550820
 * @Website: http://www.hanfu8.top
 * @Date: 2017/9/14
 * @Time: 10:23
 ******/
