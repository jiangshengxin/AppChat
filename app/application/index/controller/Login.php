<?php
namespace app\index\controller;
use think\Cookie;
use think\Db;
use think\Request;

/*
 * 用户接口
 * 创建/登录
 * */

class Login
{
    //接值
    public $data;
    //返回值
    public $return = ['error'=>'001','msg'=>'ok'];
    //构造
    public function __construct()
    {
        //接值
        $this->data = Request::instance()->get();
    }
    //析构
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        if(isset($this->data['callback']))
        {
            echo $this->data['callback'].'('.json_encode($this->return).')';die;
        }
    }

    /*
     * 用户注销
     * */
    public function user_out()
    {
        Cookie::delete('user');
        $this->return = ['error'=>'009','msg'=>'退出成功'];
    }

    /*
     * 用户登录
     * */
    public function user_login()
    {
        $reg = Db::table('user')->where('username',$this->data['username'])->find();
        if(count($reg)>1)
        {
            if(password_verify($this->data['password'],$reg['password']))
            {
                if($reg['end_time']<time())
                {
                    $this->return = ['error'=>'007','msg'=>'账户已过期,联系QQ:1348550820激活账户'];
                }else
                {
                    unset($reg['password']);
                    Cookie::set('user',$reg,3600*24*7);
                    Db::table('user')->where(['u_id'=>$reg['u_id']])->update(['login_time'=>time()]);
                    //判断是否是标记用户
                    $sign = Cookie::get('sign');
                    if($sign)
                    {
                        Db::table('sign')->insert(['describe'=>$sign,'add_time'=>time(),'uid'=>$reg['u_id']]);
                        Cookie::delete('sign');
                    }
                    $this->return = ['error'=>'006','msg'=>'验证完成,登录成功'];
                }
            }else
            {
                $this->return = ['error'=>'005','msg'=>'密码验证失败'];
            }
        }else
        {
            $this->return = ['error'=>'004','msg'=>'用户不存在'];
        }
    }

    /*
     * 接值添加用户
     * */
    public function user_add()
    {
        if(Db::table('user')->where(['username'=>$this->data['username']])->find())
        {
            $this->return = ['error'=>'058','msg'=>'用户已存在'];
        }else
        {
            $user = [
                'username'=>$this->data['username'],
                'password'=>password_hash($this->data['password'],PASSWORD_DEFAULT),
            ];
            $reg = Db::table('user')->insert($user);
            if($reg==1)
            {
                $user_data = [
                    'p_uid'=>Db::name('user')->getLastInsID(),
                    'create_time'=>time(),
                ];
                Db::table('user_data')->insert($user_data);
                $this->return = ['error'=>'008','msg'=>'账户创建成功'];
            }else
            {
                $this->return = ['error'=>'002','msg'=>'创建用户失败'];
            }
        }
    }

    /*
     * 判断用户是否存在
     * */
    public function user__find()
    {
        $reg = Db::table('user')->where('username',$this->data['username'])->column('u_id');
        if(count($reg))
        {
            $this->return = ['error'=>'003','msg'=>'用户已存在'];
        }else
        {
            $this->return = ['error'=>'023','msg'=>'用户不存在'];
        }
    }

    //首页
    public function index()
    {
        return "<center style='margin-top: 200px;'>聊天app,下载地址:<a href='http://jiangshengxin-1253330363.cosgz.myqcloud.com/aaa.jpg'>http://jiangshengxin-1253330363.cosgz.myqcloud.com/aaa.jpg</a></center>";
    }

}
