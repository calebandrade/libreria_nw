CREATE TABLE `libreria_nw`.`libros` (
  `libId` BIGINT NOT NULL AUTO_INCREMENT,
  `libDsc` VARCHAR(45) NULL DEFAULT NULL,
  `catid` BIGINT NULL DEFAULT NULL,
  `editid` BIGINT NULL DEFAULT NULL,
  `libprice` FLOAT(9,2) NULL DEFAULT NULL,
  `libest` CHAR(3) NULL DEFAULT 'ACT',
  PRIMARY KEY (`libId`),
  INDEX `editid_idx` (`editid` ASC) VISIBLE,
  INDEX `catid_idx` (`catid` ASC) VISIBLE,
  CONSTRAINT `catid`
    FOREIGN KEY (`catid`)
    REFERENCES `libreria_nw`.`categorias` (`catid`),
  CONSTRAINT `editid`
    FOREIGN KEY (`editid`)
    REFERENCES `libreria_nw`.`editoriales` (`editid`));