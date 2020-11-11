-- ----------------------------
--  Table structure for `bestelling`
-- ----------------------------
DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE `bestelling` (
  `bestelnummer` int(6) NOT NULL AUTO_INCREMENT,
  `klantnummer` int(4) NOT NULL,
  `besteldatum` date NOT NULL,
  PRIMARY KEY (`bestelnummer`),
  FOREIGN KEY (`klantnummer`) REFERENCES `klanten` (`klantnummer`)
) ENGINE=Innodb;
