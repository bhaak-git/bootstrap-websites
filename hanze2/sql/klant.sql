DROP TABLE IF EXISTS `klanten`;
CREATE TABLE `klanten` (
  `klantnummer` int(4) NOT NULL AUTO_INCREMENT,
  `naam` varchar(90) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefoonnummer` decimal(15,0) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `plaats` varchar(45) NOT NULL,
  `huisnummer` decimal(4,0) NOT NULL,
  `password` varchar(15) NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'CUSTOMER',
  PRIMARY KEY (`klantnummer`)
) ENGINE=Innod;

INSERT INTO `klanten` (`naam`, `email`, `telefoonnummer`, `adres`, `plaats`, `huisnummer`, `password`, `role`) VALUES
('admin', 'admin@bastiaanhaaksema.nl', '0000000000', 'Grote Markt', 'Groningen', 1, 'Welcome01!', 'BACKEND'),
('customer', 'customer@bastiaanhaaksema.nl', '0000000000', 'Grote Markt', 'Groningen', 2, 'Welcome01!', 'CUSTOMER');