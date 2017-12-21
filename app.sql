/*
Navicat MySQL Data Transfer

Source Server         : Mysql
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : app

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-23 11:28:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cdk
-- ----------------------------
DROP TABLE IF EXISTS `cdk`;
CREATE TABLE `cdk` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[CDKEY激活码表] 自增id',
  `c_num` char(12) DEFAULT NULL COMMENT '兑换码',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `start` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cdk
-- ----------------------------
INSERT INTO `cdk` VALUES ('1', '230112303102', '1505479437', '1');
INSERT INTO `cdk` VALUES ('2', '231311232000', '1505479437', '1');
INSERT INTO `cdk` VALUES ('3', '030023213211', '1505479437', '1');
INSERT INTO `cdk` VALUES ('4', '033212012130', '1505479477', '1');
INSERT INTO `cdk` VALUES ('5', '332121100230', '1505479477', '2');
INSERT INTO `cdk` VALUES ('6', '313320110202', '1505479477', '2');

-- ----------------------------
-- Table structure for chat_log_2017_09
-- ----------------------------
DROP TABLE IF EXISTS `chat_log_2017_09`;
CREATE TABLE `chat_log_2017_09` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[聊天记录表]',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `fid` int(11) DEFAULT NULL COMMENT '接受者id',
  `gid` int(11) NOT NULL DEFAULT '0' COMMENT '群id',
  `ltime` int(11) DEFAULT NULL COMMENT '添加时间',
  `lcontent` varchar(255) DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (`l_id`),
  KEY `l_id` (`l_id`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chat_log_2017_09
-- ----------------------------
INSERT INTO `chat_log_2017_09` VALUES ('1', '1', '1', '1', '1505467043', '内容');
INSERT INTO `chat_log_2017_09` VALUES ('2', '1', '1', '0', '1505467576', '内容');
INSERT INTO `chat_log_2017_09` VALUES ('3', '4', '1', '1', '1505467588', '内容测测');
INSERT INTO `chat_log_2017_09` VALUES ('4', '4', '1', '1', '1505467588', '内容测测');

-- ----------------------------
-- Table structure for sign
-- ----------------------------
DROP TABLE IF EXISTS `sign`;
CREATE TABLE `sign` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[标记客户表]',
  `describe` varchar(100) DEFAULT NULL COMMENT '原因',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sign
-- ----------------------------
INSERT INTO `sign` VALUES ('1', '拒绝条款', '1505654039', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户账号表]用户id',
  `username` varchar(60) DEFAULT NULL COMMENT '用户名',
  `password` varchar(80) DEFAULT NULL COMMENT '密码',
  `start` smallint(6) NOT NULL DEFAULT '0' COMMENT '账号状态',
  `login_time` int(11) DEFAULT NULL COMMENT '上次登录时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '账号有效期至-',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_id` (`u_id`) USING BTREE,
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'root', '$2y$10$Rtxgv/n9pEtslu.8SXHLle1kqD0GUTOzEw8fLc0E8oOLaBzI90OAi', '1', '1505654073', '1507961916');
INSERT INTO `user` VALUES ('4', '小明', '$2y$10$FQ8EPTJLTkrnpe2m/blteOW1FcDAbE70b7hXklTw7hYZ24.8G2GuO', '1', '1505718128', '1508073299');
INSERT INTO `user` VALUES ('5', '小小', '$2y$10$CjDxPvvmdVhDdQSOJLMa3eX4bf/N3XlvCyM/FIHhRd6vRynD2Fh/C', '0', null, '0');

-- ----------------------------
-- Table structure for user_data
-- ----------------------------
DROP TABLE IF EXISTS `user_data`;
CREATE TABLE `user_data` (
  `p_uid` int(11) NOT NULL DEFAULT '0' COMMENT '[用户信息表]关联用户表的用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '账号创建时间',
  `user` varchar(60) DEFAULT '-' COMMENT '用户真实姓名',
  `sex` char(1) NOT NULL DEFAULT '男' COMMENT '性别',
  `email` varchar(30) DEFAULT '-' COMMENT '邮箱地址',
  `qq` varchar(30) DEFAULT '-' COMMENT 'qq号',
  `tel` char(13) DEFAULT '0' COMMENT '手机号',
  `age` smallint(6) DEFAULT '20' COMMENT '年龄',
  `sign` varchar(255) DEFAULT '-' COMMENT '签名',
  `address` varchar(200) DEFAULT '-' COMMENT '地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_data
-- ----------------------------
INSERT INTO `user_data` VALUES ('1', '1505361184', '测试人', '男', '1348550820@qq.com', '1348550820', '17600409525', '26', '测试签名', '测试地址');
INSERT INTO `user_data` VALUES ('4', '1505361322', null, '男', null, null, null, null, null, null);
INSERT INTO `user_data` VALUES ('5', '1505697568', null, '男', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for user_friend
-- ----------------------------
DROP TABLE IF EXISTS `user_friend`;
CREATE TABLE `user_friend` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户好友表]数据自增id',
  `fid` int(11) NOT NULL COMMENT '好友id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `fname` varchar(60) DEFAULT NULL COMMENT '好友备注',
  `ftime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_friend
-- ----------------------------
INSERT INTO `user_friend` VALUES ('1', '1', '1', '测试修改', '1505372865');
INSERT INTO `user_friend` VALUES ('2', '4', '1', '小明', '1505458406');
INSERT INTO `user_friend` VALUES ('3', '1', '4', 'root', '1505964699');
INSERT INTO `user_friend` VALUES ('4', '5', '4', '小小', '1505967533');

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户群表]',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `gname` varchar(60) DEFAULT NULL COMMENT '群名',
  `gtime` int(11) DEFAULT NULL COMMENT '群创建时间',
  `gresume` varchar(255) DEFAULT NULL COMMENT '群介绍',
  `gadmin` varchar(60) DEFAULT NULL COMMENT '管理员用户id用逗号分割',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES ('1', '1', '测试群', '1505442182', '测试群介绍', null);

-- ----------------------------
-- Table structure for u_g
-- ----------------------------
DROP TABLE IF EXISTS `u_g`;
CREATE TABLE `u_g` (
  `ug_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户群组关系表]',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `gid` int(11) DEFAULT NULL COMMENT '群id',
  `add_time` int(11) DEFAULT NULL COMMENT '加群时间',
  PRIMARY KEY (`ug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of u_g
-- ----------------------------
INSERT INTO `u_g` VALUES ('1', '1', '1', '1505443566');
