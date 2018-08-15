/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : arg_c

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-08-15 13:50:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accesos
-- ----------------------------
DROP TABLE IF EXISTS `accesos`;
CREATE TABLE `accesos` (
  `id_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_acceso`),
  KEY `id_perfil` (`id_perfil`),
  KEY `id_persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of accesos
-- ----------------------------
INSERT INTO `accesos` VALUES ('1', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '1', '1', '1');
INSERT INTO `accesos` VALUES ('2', 'lguerrero', 'c4ca4238a0b923820dcc509a6f75849b', '3', '2', '0');
INSERT INTO `accesos` VALUES ('3', 'hprueba', '202cb962ac59075b964b07152d234b70', '2', '6', '0');

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfiles
-- ----------------------------
INSERT INTO `perfiles` VALUES ('1', 'Administrador', '1');
INSERT INTO `perfiles` VALUES ('2', 'usuario', '1');
INSERT INTO `perfiles` VALUES ('3', 'Tecnico', '1');

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `estatus_per` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', 'admin', 'admin', 'admin@admin.com', '555555', '12345678', 'V', '1');
INSERT INTO `personas` VALUES ('2', 'laynerker', 'guerrero', 'laynerker.gdl@gmail.com', '0414-8412521', '20308878', 'V', '1');
INSERT INTO `personas` VALUES ('3', 'lay', 'gue', 'lay@gmai.com', '0414-8412521', '20308877', 'V', '1');
INSERT INTO `personas` VALUES ('4', 'laysssf', 'gueeee', 'lay@gmai.com', '0414-8412521', '20308871', 'V', '1');
INSERT INTO `personas` VALUES ('5', 'layn 2', 'gue 2', 'yis@gma.com', '0212-4175212', '20308875', 'V', '1');
INSERT INTO `personas` VALUES ('6', 'hola2', 'prueba2', '', '', null, null, '1');
