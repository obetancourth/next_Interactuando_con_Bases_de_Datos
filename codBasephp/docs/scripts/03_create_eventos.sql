CREATE TABLE `eventos` (
  `eventocod` BIGINT(18) UNSIGNED NOT NULL AUTO_INCREMENT,
  `eventotitulo` VARCHAR(128) NOT NULL,
  `eventofchini` DATE NOT NULL,
  `eventohorini` TIME NULL,
  `eventofchfin` DATE NULL,
  `eventohorfin` TIME NULL,
  `eventotododia` TINYINT NULL DEFAULT 0,
  `usuariocod` BIGINT(18) NOT NULL,
  PRIMARY KEY (`eventocod`));

ALTER TABLE `next`.`eventos`
ADD CONSTRAINT `FKEU`
  FOREIGN KEY (`usuariocod`)
  REFERENCES `next`.`usuarios` (`usuariocod`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
