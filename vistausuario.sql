/*
 Navicat Premium Data Transfer

 Source Server         : Xammp
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : vistausuario

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 22/07/2021 06:40:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menu_objetos
-- ----------------------------
DROP TABLE IF EXISTS `menu_objetos`;
CREATE TABLE `menu_objetos`  (
  `Cve_Menu` int NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Menu_Padre` int NULL DEFAULT NULL,
  PRIMARY KEY (`Cve_Menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_objetos
-- ----------------------------
INSERT INTO `menu_objetos` VALUES (1, 'Archivo', 0);
INSERT INTO `menu_objetos` VALUES (2, 'Nuevo', 1);
INSERT INTO `menu_objetos` VALUES (3, 'Abrir', 1);
INSERT INTO `menu_objetos` VALUES (4, 'Renombrar', 1);
INSERT INTO `menu_objetos` VALUES (5, 'Documento', 2);
INSERT INTO `menu_objetos` VALUES (6, 'Hoja de Calculo', 2);
INSERT INTO `menu_objetos` VALUES (7, 'Presentacion', 2);
INSERT INTO `menu_objetos` VALUES (8, 'Editar', 0);
INSERT INTO `menu_objetos` VALUES (9, 'Cortar', 8);
INSERT INTO `menu_objetos` VALUES (10, 'Copiar', 8);
INSERT INTO `menu_objetos` VALUES (11, 'Pegar', 8);
INSERT INTO `menu_objetos` VALUES (12, 'Ayuda', 0);
INSERT INTO `menu_objetos` VALUES (13, 'Capacitación', 12);
INSERT INTO `menu_objetos` VALUES (14, 'Acerca De', 12);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `Cve_Usuario` int NOT NULL AUTO_INCREMENT,
  `Usuario_Nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Usuario_Correo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Usuario_Contrasena` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Cve_Usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Juan Requena', 'samus1454@gmail.com', 'Spartan1454');

SET FOREIGN_KEY_CHECKS = 1;
