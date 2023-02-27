CREATE DATABASE IF NOT EXISTS `teste_elofy`;
USE `teste_elofy`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `date_create` datetime DEFAULT current_timestamp(),
  `date_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
);
INSERT INTO users (name) VALUES ('João Fulano');