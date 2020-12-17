/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : lisans

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 23/11/2020 20:05:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hash
-- ----------------------------
DROP TABLE IF EXISTS `hash`;
CREATE TABLE `hash`  (
  `hash_id` int NOT NULL AUTO_INCREMENT,
  `eposta` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `gonderilen` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`hash_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of hash
-- ----------------------------
INSERT INTO `hash` VALUES (1, 'ulascannacaksz11@gmail.com', 'AA7IHSVG');
INSERT INTO `hash` VALUES (3, 'ulascannacaksiz@gmail.com', 'M5SZNW31');

-- ----------------------------
-- Table structure for kullanici
-- ----------------------------
DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE `kullanici`  (
  `kullanici_id` int NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `soyisim` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `eposta` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sifre` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `uyelik_tarihi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `kayit_ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `kullanici_tur` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT 'uye',
  PRIMARY KEY (`kullanici_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kullanici
-- ----------------------------
INSERT INTO `kullanici` VALUES (1, 'Ulas', 'Nacaksiz', 'ulascannacaksz11@gmail.com', '82b0aea8d6e33847aa10a9a9ccfd9168e57b6d54d9deb2c5888e4b1af578944d', NULL, NULL, 'admin');
INSERT INTO `kullanici` VALUES (2, '$isim', '$soyisim', '$eposta', '$ulas', '$tarih', NULL, 'uye');
INSERT INTO `kullanici` VALUES (3, '$isim', '$soyisim', '$eposta', '$ulas', '$tarih', NULL, 'uye');
INSERT INTO `kullanici` VALUES (4, '$isim', '$soyisim', '$eposta', '$ulas', '$tarih', NULL, 'uye');
INSERT INTO `kullanici` VALUES (5, '$isim', '$soyisim', '$eposta', '$ulas', '$tarih', NULL, 'uye');
INSERT INTO `kullanici` VALUES (6, '$isim', '$soyisim', '$eposta', '$ulas', '$tarih', NULL, 'uye');
INSERT INTO `kullanici` VALUES (7, 'UlaÅŸ Test', 'Asat', 'ulascan@gggg', '82b0aea8d6e33847aa10a9a9ccfd9168e57b6d54d9deb2c5888e4b1af578944d', '2019-05-01 20:04:27', NULL, 'uye');
INSERT INTO `kullanici` VALUES (8, 'ass', 'fdfd', 'qqq@qqq.cxom', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2019-05-02 19:44:35', NULL, 'uye');
INSERT INTO `kullanici` VALUES (9, 'ass', 'fdfd', 'qqq@qqq.cxom', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2019-05-02 19:49:54', NULL, 'uye');
INSERT INTO `kullanici` VALUES (10, 'Åžerefsiz ', 'Emre', 'ulascannacaksiz@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2019-05-29 20:38:54', NULL, 'uye');
INSERT INTO `kullanici` VALUES (11, 'ewrwer', 'fsderre', '3445@gmail.com', 'de56bdcfa411546639015230cfd73de35539282029d1269933d935da7c8431e7', '2019-05-29 20:39:41', NULL, 'uye');
INSERT INTO `kullanici` VALUES (12, 'Ã¶bÃ¼r', 'bartu', 'oburbartu@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2019-06-12 20:18:11', NULL, 'uye');

-- ----------------------------
-- Table structure for lisans
-- ----------------------------
DROP TABLE IF EXISTS `lisans`;
CREATE TABLE `lisans`  (
  `lisans_id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `lisans_anahtari` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `hwid` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `lisans_baslangic` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `lisans_bitis` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `lisans_durum` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`lisans_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of lisans
-- ----------------------------
INSERT INTO `lisans` VALUES (1, 1, 1, '54ZIE-GGCCR-1B59K-ECPC3-1720', '000000000000000000000000', '2019-06-30', '2020-06-14', '0');
INSERT INTO `lisans` VALUES (2, 12, 1, 'ZY2R7-2D1LC-X8TZW-QQLL0-SBV22', '1595', '2019-06-06', '2019-06-27', '0');
INSERT INTO `lisans` VALUES (3, 1, 2, 'N4920-MNXVY-JAL6D-4ZGYK-IWDGD', '554554545', '2019-06-28', '2021-05-05', '1');
INSERT INTO `lisans` VALUES (4, 1, 2, 'N4920-MNXVY-JAL6D-4ZGYK-IWDGD', '554554545', '2019-06-28', '2021-05-05', '1');
INSERT INTO `lisans` VALUES (5, 1, 2, 'N4920-MNXVY-JAL6D-4ZGYK-IWDGD', '554554545', '2019-06-28', '2021-05-05', '1');
INSERT INTO `lisans` VALUES (6, 0, 0, 'LOYJ6-JBVT9-GKTG6-Q29CZ-0SD5G', '', '', '', 'SeÃ§iniz');
INSERT INTO `lisans` VALUES (7, 0, 0, 'LOYJ6-JBVT9-GKTG6-Q29CZ-0SD5G', '', '', '', 'SeÃ§iniz');
INSERT INTO `lisans` VALUES (8, 1, 1, 'ML7SY-D3KDX-AP22D-73JQF-MELEE', '54654', '2030-03-31', '2035-10-20', '1');
INSERT INTO `lisans` VALUES (9, 1, 1, 'ML7SY-D3KDX-AP22D-73JQF-MELEE', '54654', '2030-03-31', '2035-10-20', '1');
INSERT INTO `lisans` VALUES (10, 1, 1, 'ML7SY-D3KDX-AP22D-73JQF-MELEE', '54654', '2030-03-31', '2035-10-20', '1');
INSERT INTO `lisans` VALUES (11, 1, 1, 'ML7SY-D3KDX-AP22D-73JQF-MELEE', '54654', '2030-03-31', '2035-10-20', '1');
INSERT INTO `lisans` VALUES (12, 1, 1, 'IHF26-YB1P0-4XAUU-9SEWO-ADM11', '55454544', '2019-06-13', '2019-06-30', '0');
INSERT INTO `lisans` VALUES (13, 1, 1, 'IHF26-YB1P0-4XAUU-9SEWO-ADM11', '55454544', '2019-06-13', '2019-06-30', '0');
INSERT INTO `lisans` VALUES (14, 1, 1, 'YDWW2-NBOIL-GROZN-UPO0C-MG42L', '32432423', '2019-06-30', '2019-07-28', '0');
INSERT INTO `lisans` VALUES (15, 1, 1, 'YDWW2-NBOIL-GROZN-UPO0C-MG42L', '32432423', '2019-06-30', '2019-07-28', '0');
INSERT INTO `lisans` VALUES (16, 10, 2, 'V77O5-DLMR6-3E8R5-JWTFD-JPWI5', '555545', '2019-07-13', '2019-08-31', '0');
INSERT INTO `lisans` VALUES (17, 1, 2, 'E7JO1-2M1WW-GYQN4-Q7FGU-4CXUR', '32432423', '2019-08-02', '2019-09-23', '0');
INSERT INTO `lisans` VALUES (18, 10, 1, 'I0L3Q-P4140-UM54I-7FT3L-ZC18B', '1595', '2019-06-30', '2019-06-30', '0');
INSERT INTO `lisans` VALUES (19, 10, 2, '3SR5G-0RIVO-6KTTR-2XAK0-WF7M1', '', '2100-06-10', '2020-06-10', '0');
INSERT INTO `lisans` VALUES (20, 1, 3, '6H0GL-1ZDY1-78Y4G-FZXW8-MWV8Z', '116554rgteretrre', '2020-10-15', '2020-10-30', '1');
INSERT INTO `lisans` VALUES (21, 1, 1, 'UY5BJ-RH1D3-Y8NI1-4PYXC-IIGWG', '', '2020-10-22', '2020-10-23', '0');

-- ----------------------------
-- Table structure for program
-- ----------------------------
DROP TABLE IF EXISTS `program`;
CREATE TABLE `program`  (
  `program_id` int NOT NULL AUTO_INCREMENT,
  `program_isim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `gelisitirici_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`program_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of program
-- ----------------------------
INSERT INTO `program` VALUES (1, 'Test', 4);
INSERT INTO `program` VALUES (2, 'Hastane Otomasyon', 1);
INSERT INTO `program` VALUES (3, 'TEst', 1);
INSERT INTO `program` VALUES (4, 'Test122', 1);

SET FOREIGN_KEY_CHECKS = 1;
