<?php


namespace app\index\controller;

use think\Db;

/*
 * 用户好友信息
 * */

class Friend extends Exam
{
    /*
     * 修改好友备注
     * */
    public function friend_update()
    {
        $fname = isset($this->data['fname'])?$this->data['fname']:false;
        if($fname)
        {
            $reg = Db::table('user_friend')
                ->where(['uid'=>$this->user['u_id'],'fid'=>$this->data['fid']])
                ->update(['fname'=>$fname]);
            if($reg)
            {
                $this->return = ['error'=>'042','msg'=>'修改备注成功'];
            }else
            {
                $this->return = ['error'=>'041','msg'=>'修改备注失败'];
            }
        }else
        {
            $this->return = ['error'=>'036','msg'=>'参数有误'];
        }
    }

    /*
     * 删除好友
     * */
    public function friend_delete()
    {

        $where = ['fid'=>$this->data['fid'],'uid'=>$this->user['u_id']];
        $reg = Db::table('user_friend')->where($where)->delete();
        if($reg)
        {
            $this->return = ['error'=>'016','msg'=>'删除好友成功'];
        }else
        {
            $friend = Db::table('user_friend')->where($where)->find();
            if($friend)
            {
                $this->return = ['error'=>'017','msg'=>'删除好友失败'];
            }else
            {
                $this->return = ['error'=>'018','msg'=>'你们还不是好友'];
            }
        }
    }

    /*
     * 添加好友
     * */
    public function friend_add()
    {
        $friend = Db::table('user_friend')->where(['uid'=>$this->user['u_id'],'fid'=>$this->data['fid']])->find();
        if($friend)
        {
            $this->return = ['error'=>'015','msg'=>'已经是好友了'];
        }else
        {
            $add = [
                'fid'=>$this->data['fid'],
                'uid'=>$this->user['u_id'],
                'fname'=>$this->data['fname'],
                'ftime'=>time()
            ];
            $reg = Db::table('user_friend')->insert($add);
            if($reg)
            {
                $this->return = ['error'=>'011','msg'=>'添加成功'];
            }else
            {
                $this->return = ['error'=>'012','msg'=>'添加失败'];
            }
        }
    }

    /*
     * 用户好友列表获取
     * */
    public function friend_list()
    {
        $reg = Db::table('user_friend')
            ->where('uid',$this->user['u_id'])
            ->alias('a')
            ->join('user b','a.fid=b.u_id')
            ->order('start desc')
            ->column('fid,fname,username,start');
        if($reg)
        {
            $this->return = ['error'=>'013','msg'=>$reg];
        }else
        {
            $this->return = ['error'=>'014','msg'=>'获取好友列表出错'];
        }
    }
}











/******
 * User: 降省心
 * QQ:1348550820
 * Website: http://www.hanfu8.top
 * Date: 2017/9/14
 * Time: 14:32
 ******/