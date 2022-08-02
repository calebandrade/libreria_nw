CREATE TABLE `libreria_nw`.`editoriales` (
  `editid` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `editnom` VARCHAR(45) NULL,
  `editest` CHAR(3) NULL DEFAULT 'ACT',
  PRIMARY KEY (`editid`));