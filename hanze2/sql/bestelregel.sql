-- ----------------------------
--  Table structure for `bestelregel`
-- ----------------------------
DROP TABLE IF EXISTS `bestelregel`;
CREATE TABLE IF NOT EXISTS `bestelregel` (
  `bestelnummer` int(11) NOT NULL AUTO_INCREMENT,
  `artikelnummer` int(11) NOT NULL,
  `maat` varchar(3) NOT NULL,
  `aantal` decimal(10,0) NOT NULL,
  PRIMARY KEY (`bestelnummer`,`artikelnummer`)
) ENGINE=Innodb;