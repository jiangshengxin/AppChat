<?php


namespace app\index\controller;

/*
 * 聊天处理
 * */

use think\Db;

class Chat extends Exam
{


    /*
     * 读取聊天记录
     * */
    public function chat_log()
    {
        $fid = (int) isset($this->data['fid'])?$this->data['fid']:0;
        if($fid){ $where['fid'] = $fid; }
        $gid = (int) isset($this->data['gid'])?$this->data['gid']:0;
        if($gid){ $where['gid'] = $gid; }
        $where['uid'] = $this->user['u_id'];
        //从多少条开始获取
        $l_id = (int) isset($this->data['lid'])?$this->data['lid']:0;
        $table = 'chat_log_'.date('Y_m',time());
        if($gid)
        {
            unset($where['fid']);
            unset($where['uid']);
            //查询群聊天
            $reg = Db::table($table)
                ->alias('a')
                ->where($where)
                ->where('l_id','>',$l_id)
                ->order('l_id desc')
                ->join('user b','a.uid=b.u_id')
                ->limit(10)->column('l_id,uid,gid,ltime,lcontent,username');
        }else
        {
            //查询单对单聊天
            $reg = Db::table($table)
                ->alias('a')
                ->where($where)
                ->where('l_id','>',$l_id)
                ->order('l_id desc')
                ->join('user b','a.fid=b.u_id')
                ->limit(10)->column('l_id,fid,gid,ltime,lcontent,username');
        }
        if($reg)
        {
            $this->return = ['error'=>'043','msg'=>$reg];
        }else
        {
            $this->return = ['error'=>'044','msg'=>'获取记录失败'];
        }
    }

    /*
     * 添加一条记录
     * */
    public function chat_add()
    {
        $add['fid'] = (int) isset($this->data['fid'])?$this->data['fid']:0;
        $add['gid'] = (int) isset($this->data['gid'])?$this->data['gid']:0;
        $add['ltime'] = time();
        $add['uid'] = $this->user['u_id'];
        $add['lcontent'] = $this->data['lcontent'];
        $table = 'chat_log_'.date('Y_m',time());
        //判断表是否存在,不存在则创建表
        $exist = Db::query("show tables like '$table'");
        if(!$exist)
        {
            $carate_table_ = "CREATE TABLE `$table` (
                              `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[聊天记录表]',
                              `uid` int(11) NOT NULL COMMENT '用户id',
                              `fid` int(11) DEFAULT NULL COMMENT '接受者id',
                              `gid` int(11) NOT NULL DEFAULT '0' COMMENT '群id',
                              `ltime` int(11) DEFAULT NULL COMMENT '添加时间',
                              `lcontent` varchar(255) DEFAULT NULL COMMENT '内容',
                              PRIMARY KEY (`l_id`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;";
            Db::query($carate_table_);
        }
        //向表中添加数据
        $reg = Db::table($table)->insert($add);
        if($reg)
        {
            $this->return = ['error'=>'041','msg'=>'ok'];
        }else
        {
            $this->return = ['error'=>'042','msg'=>'发送失败'];
        }
    }
}











/******
 * User: 降省心
 * QQ:1348550820
 * Website: http://www.hanfu8.top
 * Date: 2017/9/15
 * Time: 14:56
 ******/