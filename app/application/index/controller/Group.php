<?php


namespace app\index\controller;

use think\Db;


/*
 * 群组处理类
 * */

class Group extends Exam
{

    /*
     * 获取群成员
     * */
    public function group_user()
    {
        $gid = isset($this->data['gid'])?$this->data['gid']:false;
        if($gid)
        {
            $reg = Db::table('u_g')
                ->alias('a')
                ->where(['gid'=>$gid])
                ->join('user b','a.uid=b.u_id')
                ->column('u_id,username,add_time');
            if($reg)
            {
                $this->return = ['error'=>'033','msg'=>$reg];
            }else
            {
                $this->return = ['error'=>'034','msg'=>'获取群成员失败'];
            }
        }else
        {
            $this->return = ['error'=>'035','msg'=>'参数错误'];
        }
    }

    /*
     * 用户退出该群
     * */
    public function group_quit()
    {
        $gid = isset($this->data['gid'])?$this->data['gid']:false;
        $group = Db::table('u_g')
            ->where(['gid'=>$gid,'uid'=>$this->user['u_id']])
            ->find();
        if($group)
        {
            $reg = Db::table('u_g')->where(['ug_id'=>$group['ug_id']])->delete();
            if($reg)
            {
                $this->return = ['error'=>'031','msg'=>'退群成功'];
            }else
            {
                $this->return = ['error'=>'032','msg'=>'退群失败'];
            }
        }else
        {
            $this->return = ['error'=>'030','msg'=>'你还不是该群成员'];
        }
    }

    /*
     * 用户加入群
     * */
    public function group_join()
    {
        $gid = isset($this->data['gid'])?$this->data['gid']:false;
        $group = Db::table('u_g')
            ->where(['gid'=>$gid,'uid'=>$this->user['u_id']])
            ->find();
        //p($group);die;
        if(!$group)
        {
            if($gid)
            {
                $reg = Db::table('u_g')->insert(['gid'=>$gid,'uid'=>$this->user['u_id'],'add_time'=>time()]);
                if($reg)
                {
                    $this->return = ['error'=>'028','msg'=>'加群成功'];
                }else
                {
                    $this->return = ['error'=>'027','msg'=>'加群失败'];
                }
            }else
            {
                $this->return = ['error'=>'026','msg'=>'参数错误'];
            }
        }else
        {
            $this->return = ['error'=>'029','msg'=>'已经加入该群'];
        }
    }

    /*
     * 创建群组
     * */
    public function group_add()
    {
        $gname = Db::table('user_group')->where('gname',$this->data['gname'])->find();
        if($gname)
        {
            $this->return = ['error'=>'023','msg'=>'群组已经存在'];
        }else
        {
            if(isset($this->data['gname'])&&$this->data['gresume'])
            {
                $add = [
                    'uid'=>$this->user['u_id'],
                    'gname'=>$this->data['gname'],
                    'gtime'=>time(),
                    'gresume'=>$this->data['gresume'],
                ];
                $reg = Db::table('user_group')->insert($add);
                if($reg)
                {
                    $gid = Db::name('user_group')->getLastInsID();
                    Db::table('u_g')->insert(['gid'=>$gid,'uid'=>$this->user['u_id'],'add_time'=>time()]);
                    $this->return = ['error'=>'022','msg'=>'成功创建群组'];
                }else
                {
                    $this->return = ['error'=>'021','msg'=>'创建群组失败'];
                }
            }else
            {
                $this->return = ['error'=>'024','msg'=>'创建群组参数错误'];
            }
        }
    }

    /*
     * 查询群信息
     * */
    public function group_find()
    {
        $reg = Db::table('user_group')->where('gname','like',"%{$this->data['gname']}%")->select();
        if($reg)
        {
            $this->return = ['error'=>'020','msg'=>$reg];
        }else
        {
            $this->return = ['error'=>'019','msg'=>'没有相关群组'];
        }
    }
}











/******
 * User: 降省心
 * QQ:1348550820
 * Website: http://www.hanfu8.top
 * Date: 2017/9/14
 * Time: 16:57
 ******/