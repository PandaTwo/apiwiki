/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50533
Source Host           : localhost:3306
Source Database       : api_wiki

Target Server Type    : MYSQL
Target Server Version : 50533
File Encoding         : 65001

Date: 2015-04-29 17:40:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_categories
-- ----------------------------
DROP TABLE IF EXISTS `api_categories`;
CREATE TABLE `api_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryDesc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_categories
-- ----------------------------
INSERT INTO `api_categories` VALUES ('1', '注册', '注册API相关的信息');
INSERT INTO `api_categories` VALUES ('4', '获取用户信息', 'API主要获取用户信息');

-- ----------------------------
-- Table structure for api_description
-- ----------------------------
DROP TABLE IF EXISTS `api_description`;
CREATE TABLE `api_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `apiname` varchar(255) NOT NULL,
  `apiurl` varchar(255) NOT NULL,
  `apidesc` text NOT NULL,
  `response` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_description
-- ----------------------------
INSERT INTO `api_description` VALUES ('1', '1', '用户注册', '/v1/register', '用户注册', '{\r\n    \"success\": {\r\n        \"message\": \"\\u767b\\u5f55\\u6210\\u529f\",\r\n        \"tokenKey\": \"3a496261bae571fa7916fa8c31622e39\",\r\n        \"customer\": [{\r\n            \"fuserid\": \"0\",\r\n            \"fusercode\": \"TBtest\",\r\n            \"fpassword\": \"123qwe\",\r\n            \"fbirthday\": \"1989-02-17\",\r\n            \"fsex\": \"1\",\r\n            \"femail\": \"1276563794@qq.com\",\r\n            \"fusername\": \"\\u8983\\u529f\\u5bbe\",\r\n            \"fstatus\": \"2\",\r\n            \"flastlogintime\": \"2015-02-27 17:13:45\",\r\n            \"flastloginip\": \"122.49.213.50\",\r\n            \"fregistedtime\": \"2013-05-09 13:04:16\",\r\n            \"fquestion\": null,\r\n            \"fremark\": null,\r\n            \"ftransfer\": null,\r\n            \"fadjustamount\": null,\r\n            \"flosewin\": null,\r\n            \"fisdeposit\": null,\r\n            \"fisfreeze\": \"1\",\r\n            \"fanswer\": null,\r\n            \"fphone\": \"13948753834\",\r\n            \"fqq\": \"1060246744\",\r\n            \"fregistedip\": \"122.49.213.50\",\r\n            \"fusertype\": \"0\",\r\n            \"fparentid\": \"188\",\r\n            \"fuppername\": \"dtb515\",\r\n            \"fisverify\": \"0\",\r\n            \"fweburl\": null,\r\n            \"fagentregurl\": null,\r\n            \"fwfusercode\": null,\r\n            \"fsuncitycode\": \"\",\r\n            \"fsuncitypwd\": \"\",\r\n            \"fmguserid\": \"72431610\",\r\n            \"fdepositpro\": \"0.10\",\r\n            \"fusergroup\": \"3\",\r\n            \"fagentlevel\": \"1\",\r\n            \"ferrormsg\": \"\"\r\n        }]\r\n    }\r\n}');
INSERT INTO `api_description` VALUES ('6', '4', '获取用户信息', '/v1/customer', 'GET请求 获取用户基本账户信息', '{\r\n//假装这里是json类型的用户基本账户信息\r\n}');

-- ----------------------------
-- Table structure for api_params
-- ----------------------------
DROP TABLE IF EXISTS `api_params`;
CREATE TABLE `api_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paramname` varchar(255) NOT NULL,
  `isNull` varchar(255) NOT NULL,
  `defaultvalue` varchar(255) NOT NULL,
  `sourcetype` varchar(255) NOT NULL,
  `description` text NOT NULL COMMENT '参数说明',
  `paramtype` int(11) NOT NULL COMMENT '1为请求参数 2为返回参数',
  `descid` int(11) NOT NULL COMMENT '对应api基本信息表id',
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_params
-- ----------------------------
INSERT INTO `api_params` VALUES ('28', 'test', 'Y', '1', 'string', '测试数据', '1', '1', '1');
INSERT INTO `api_params` VALUES ('27', 'customer', 'Y', '', 'string', 'json数据结构', '2', '6', '4');
INSERT INTO `api_params` VALUES ('26', 'customerid', 'Y', '', 'int', '用户Id', '1', '6', '4');
INSERT INTO `api_params` VALUES ('16', '2', '2', '', 'string', '2', '1', '1', '1');
INSERT INTO `api_params` VALUES ('25', 'istrue', 'Y', '', 'string', 'false or true', '2', '1', '1');
