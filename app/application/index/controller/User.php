<?php


namespace app\index\controller;


use think\Db;
use think\request;

/*
 * 用户信息
 * */

class User extends Exam
{

    /*
     * 查询用户信息
     * */
    public function user_find()
    {
        $uid = (int) $this->data['uid'];
        $username = $this->data['username'];
        $reg = Db::table('user')->alias('a')
            ->where('u_id',$uid)
            ->whereOr('username',"$username")
            ->join('user_data b','a.u_id=b.p_uid')
            ->field('username,b.*')
            ->find();
        if($reg)
        {
            $this->return = ['error'=>'038','msg'=>$reg];
        }else
        {
            $this->return = ['error'=>'037','msg'=>'没有相关信息'];
        }
    }

    /*
     * 修改用户信息
     * */
    public function user_update()
    {

        // 接收该用户所有修改信息
        // $user_data = [
        //     'user'=>$this->data['user'],
        //     'email'=>$this->data['email'],
        //     'qq'=>$this->data['qq'],
        //     'tel'=>$this->data['tel'],
        //     'age'=>$this->data['age'],
        //     'sign'=>$this->data['sign'],
        //     'address'=>$this->data['address']
        // ];

        // 修改指定项
        $user_data = Request::instance()->except(['callback','_']);

        if($user_data)
        {
            $reg = Db::table('user_data')->where(['p_uid'=>$this->user['u_id']])->update($user_data);
            if($reg)
            {
                $this->return = ['error'=>'039','msg'=>'修改成功'];
            }else
            {
                $this->return = ['error'=>'040','msg'=>'修改失败'];
            }
        }else
        {
            $this->return = ['error'=>'036','msg'=>'参数有误'];
        }
    }

}











/******
 * User: 降省心
 * QQ:1348550820
 * Website: http://www.hanfu8.top
 * Date: 2017/9/15
 * Time: 11:43
 ******/