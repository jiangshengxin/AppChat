<?php


namespace app\index\controller;

use think\Db;
use think\Request;

/*
 * 激活码
 * */

class Cdk
{
    public $data;
    public $return;
    public function __construct()
    {
        //接值
        $this->data = Request::instance()->get();
    }
    
    public function __destruct()
    {
        if(isset($this->data['callback'])&&$this->return)
        {
            echo $this->data['callback'].'('.json_encode($this->return).')';die;
        }
    }

    /*
     * 用户使用cdk
     * */
    public function cdk_update()
    {
        $num = (int) isset($this->data['c_num'])?$this->data['c_num']:0;
        if($num)
        {
            $reg = Db::table('cdk')->where(['c_num'=>$num])->update(['start'=>2]);
            if($reg)
            {
                $user = Db::table('user')
                    ->where(['username'=>$this->data['username']])
                    ->update(['end_time'=>time()+3600*24*30]);
                if($user)
                {
                    $this->return = ['error'=>'052','msg'=>'激活成功'];
                }else
                {
                    $this->return = ['error'=>'051','msg'=>"系统错误,cdk已作废\n请截图为证,联系管理员\nQQ:1348550820"];
                }
            }else
            {
                $this->return = ['error'=>'050','msg'=>'cdk激活码错误'];
            }
        }else
        {
            // $this->return = ['error'=>'036','msg'=>'参数有误'];
            $this->return = ['error'=>'036','msg'=>'参数有误'];
        }
    }

    /*
     * 创建cdk
     * */
    public function cdk_add()
    {
        $str = '000111222333';
        $all = [];
        for ($i=0;$i<$this->data['num'];$i++)
        {
            $all[$i]['c_num'] = str_shuffle($str);
            $all[$i]['add_time'] = time();
        }
        $reg = Db::table('cdk')->insertAll($all);
        if($reg)
        {
            $this->return = ['error'=>'045','msg'=>"创建成功,数量:$reg"];
        }else
        {
            $this->return = ['error'=>'046','msg'=>'创建激活码失败'];
        }
    }

    /*
     * 查询cdk
     * */
    public function cdk_find()
    {
        $start = (int) isset($this->data['start'])?$this->data['start']:1;
        $reg = Db::table('cdk')->where(['start'=>$start])->limit(10)->field('c_num,add_time')->select();
        $sum = Db::table('cdk')->where(['start'=>$start])->count();
        if($reg||$sum)
        {
            $this->return = ['error'=>'046','msg'=>['reg'=>$reg,'sum'=>$sum]];
        }else
        {
            $this->return = ['error'=>'047','msg'=>'获取cdk失败'];
        }
    }
}











/**
 * Cdk.php
 *
 * 激活码管理
 *
 * Copyright (c)2017 http://note.hanfu8.top
 *
 * 修改历史
 * ----------------------------------------
 * 2017/9/15, 作者: 降省心(QQ:1348550820), 操作:创建
 **/