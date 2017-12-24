-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: app
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cdk`
--

DROP TABLE IF EXISTS `cdk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdk` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[CDKEY激活码表] 自增id',
  `c_num` char(12) DEFAULT NULL COMMENT '兑换码',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `start` tinyint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdk`
--

LOCK TABLES `cdk` WRITE;
/*!40000 ALTER TABLE `cdk` DISABLE KEYS */;
INSERT INTO `cdk` VALUES (1,'230112303102',1505479437,1),(2,'231311232000',1505479437,1),(3,'030023213211',1505479437,1),(4,'033212012130',1505479477,1),(5,'332121100230',1505479477,2),(6,'313320110202',1505479477,2),(7,'313320110203',1505479477,1),(8,'233022131010',1514037599,1),(9,'311223023100',1514037599,1),(10,'131023012230',1514037599,2),(11,'200013221331',1514037599,1),(12,'013320022311',1514037599,1),(13,'113003231022',1514037599,2),(14,'323213102010',1514037599,1),(15,'031032130212',1514037599,1),(16,'121223103300',1514037599,2),(17,'010201323312',1514037599,1),(23,'003232201113',1514037607,1),(24,'131030212320',1514037607,2),(25,'031100123322',1514037607,2),(26,'123103321200',1514037607,1),(27,'322131010230',1514037607,1),(28,'000332232111',1514037607,1),(29,'021001323231',1514037607,1),(30,'332101102302',1514037607,1),(31,'132232103001',1514037607,1),(32,'101133232020',1514037607,1);
/*!40000 ALTER TABLE `cdk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_log_2017_09`
--

DROP TABLE IF EXISTS `chat_log_2017_09`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_log_2017_09`
--

LOCK TABLES `chat_log_2017_09` WRITE;
/*!40000 ALTER TABLE `chat_log_2017_09` DISABLE KEYS */;
INSERT INTO `chat_log_2017_09` VALUES (1,1,1,1,1505467043,'内容'),(2,1,1,0,1505467576,'内容'),(3,4,1,1,1505467588,'内容测测'),(4,4,1,1,1505467588,'内容测测');
/*!40000 ALTER TABLE `chat_log_2017_09` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign`
--

DROP TABLE IF EXISTS `sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sign` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[标记客户表]',
  `describe` varchar(100) DEFAULT NULL COMMENT '原因',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign`
--

LOCK TABLES `sign` WRITE;
/*!40000 ALTER TABLE `sign` DISABLE KEYS */;
INSERT INTO `sign` VALUES (1,'拒绝条款',1505654039,1);
/*!40000 ALTER TABLE `sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `u_g`
--

DROP TABLE IF EXISTS `u_g`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u_g` (
  `ug_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户群组关系表]',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `gid` int(11) DEFAULT NULL COMMENT '群id',
  `add_time` int(11) DEFAULT NULL COMMENT '加群时间',
  PRIMARY KEY (`ug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `u_g`
--

LOCK TABLES `u_g` WRITE;
/*!40000 ALTER TABLE `u_g` DISABLE KEYS */;
INSERT INTO `u_g` VALUES (1,1,1,1505443566);
/*!40000 ALTER TABLE `u_g` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户账号表]用户id',
  `username` varchar(60) DEFAULT NULL COMMENT '用户名',
  `password` varchar(80) DEFAULT NULL COMMENT '密码',
  `start` tinyint(6) NOT NULL DEFAULT '0' COMMENT '账号状态',
  `login_time` int(11) DEFAULT NULL COMMENT '上次登录时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '账号有效期至-',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_id` (`u_id`) USING BTREE,
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'root','$2y$10$Rtxgv/n9pEtslu.8SXHLle1kqD0GUTOzEw8fLc0E8oOLaBzI90OAi',1,1514105775,1516630828),(4,'小明','$2y$10$FQ8EPTJLTkrnpe2m/blteOW1FcDAbE70b7hXklTw7hYZ24.8G2GuO',1,1505718128,1508073299),(5,'小小','$2y$10$CjDxPvvmdVhDdQSOJLMa3eX4bf/N3XlvCyM/FIHhRd6vRynD2Fh/C',0,NULL,0),(6,'123','$2y$10$1BjZYA/eSkdowdgMd.zNq.CeIcfeA5LiL8FG3DD61rppMEzoA0sCO',0,NULL,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data` (
  `p_uid` int(11) NOT NULL DEFAULT '0' COMMENT '[用户信息表]关联用户表的用户id',
  `create_time` int(11) DEFAULT NULL COMMENT '账号创建时间',
  `user` varchar(60) DEFAULT '-' COMMENT '用户真实姓名',
  `sex` enum('保密','女','男') NOT NULL DEFAULT '保密' COMMENT '性别',
  `email` varchar(30) DEFAULT '-' COMMENT '邮箱地址',
  `qq` varchar(30) DEFAULT '-' COMMENT 'qq号',
  `tel` char(13) DEFAULT '0' COMMENT '手机号',
  `age` smallint(6) DEFAULT '20' COMMENT '年龄',
  `sign` varchar(255) DEFAULT '-' COMMENT '签名',
  `address` varchar(200) DEFAULT '-' COMMENT '地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES (1,1505361184,'测试人','男','1348550820@qq.com','1348550820','17600409525',26,'测试签名','测试地址'),(4,1505361322,NULL,'男',NULL,NULL,NULL,NULL,NULL,NULL),(5,1505697568,NULL,'男',NULL,NULL,NULL,NULL,NULL,NULL),(6,1513952530,'-','男','-','-','0',20,'-','-');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_friend`
--

DROP TABLE IF EXISTS `user_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_friend` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户好友表]数据自增id',
  `fid` int(11) NOT NULL COMMENT '好友id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `fname` varchar(60) DEFAULT NULL COMMENT '好友备注',
  `ftime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_friend`
--

LOCK TABLES `user_friend` WRITE;
/*!40000 ALTER TABLE `user_friend` DISABLE KEYS */;
INSERT INTO `user_friend` VALUES (1,1,1,'测试修改',1505372865),(2,4,1,'小明',1505458406),(3,1,4,'root',1505964699),(4,5,4,'小小',1505967533);
/*!40000 ALTER TABLE `user_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '[用户群表]',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `gname` varchar(60) DEFAULT NULL COMMENT '群名',
  `gtime` int(11) DEFAULT NULL COMMENT '群创建时间',
  `gresume` varchar(255) DEFAULT NULL COMMENT '群介绍',
  `gadmin` varchar(60) DEFAULT NULL COMMENT '管理员用户id用逗号分割',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,1,'测试群',1505442182,'测试群介绍',NULL);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-24 19:00:37
