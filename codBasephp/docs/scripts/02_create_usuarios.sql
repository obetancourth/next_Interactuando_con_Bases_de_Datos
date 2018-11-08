CREATE TABLE `usuarios` (
  `usuariocod` bigint(18) unsigned NOT NULL AUTO_INCREMENT,
  `usuarioemail` varchar(128) NOT NULL,
  `usuarioname` varchar(128) NOT NULL,
  `usuariopswd` varchar(60) NOT NULL,
  `usuarioestado` char(3) NOT NULL DEFAULT 'ACT',
  `usuariofechanac` datetime NOT NULL,
  PRIMARY KEY (`usuariocod`),
  UNIQUE KEY `usuarioemail_UNIQUE` (`usuarioemail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
