/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : dbspatial

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2018-01-11 17:18:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for _kabupaten
-- ----------------------------
DROP TABLE IF EXISTS `_kabupaten`;
CREATE TABLE `_kabupaten` (
  `id_kabupaten` varchar(5) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `nama_bupati` varchar(30) DEFAULT NULL,
  `jumlah_penduduk` int(4) DEFAULT NULL,
  `tanggal_berdiri` date DEFAULT NULL,
  `pusat_kota` point DEFAULT NULL,
  `wilayah` geometry DEFAULT NULL,
  `luas_wilayah` double DEFAULT NULL,
  `jarak_wilayah` double DEFAULT NULL,
  PRIMARY KEY (`id_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _kabupaten
-- ----------------------------
INSERT INTO `_kabupaten` VALUES ('123', '123', '123', '123', '2018-01-01', GeomFromText('POINT(-7.06273386769044 112.241821289063)'), GeomFromText('POLYGON((-6.92097374155414 111.417846679688, -6.27707832423912 112.538452148438, -7.30253620536733 113.307495117188, -8.14080505218137 112.208862304688, -6.92097374155414 111.417846679688))'), '22427177085.417698', '438436.57232155243');
INSERT INTO `_kabupaten` VALUES ('321', '321', '321', '321', '2018-01-01', GeomFromText('POINT(-7.36791470674776 110.904235839844)'), GeomFromText('POLYGON((-7.24259751094934 110.816345214844, -7.20445055181173 113.941955566406, -8.07554603328031 113.985900878906, -8.3582578713087 111.563415527344, -7.24259751094934 110.816345214844))'), '34592881757.89369', '711046.0688903027');
SET FOREIGN_KEY_CHECKS=1;
