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

    // 允许跨源访问的域
    const allow_origin =  array(
        'http://app.hanfu8.top',
    	'http://localhost'
    );

    // 允许跨域的源访问的方法
    const cross_domain = array(
	'update_pic'	
    );


    /*
     * 构造函数
     * */
    public function __construct()
    {      
        //接值
        $this->data = Request::instance()->get();
        //调用验证登录方法
        $this->login_state();

	//跨域检测
	$this->origin_check();
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

    // 跨域检测
    private function origin_check(){
        if( in_array(request()->action(),self::cross_domain) ){
                $origin = $_SERVER['HTTP_ORIGIN'];
                if(in_array($origin,self::allow_origin)){
                        header("Access-Control-Allow-Origin: ".$origin);
                        header('Access-Control-Allow-Methods: GET,POST');
                }
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
