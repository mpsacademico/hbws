-- -----------------------------------------------------
-- Schema hummm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hummm` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `hummm` ;

-- -----------------------------------------------------
-- Table `lanche`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lanche` (
  `id_lanche` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(50) NOT NULL COMMENT '',
  `preco_unitario` DECIMAL(5,2) NOT NULL COMMENT '',
  PRIMARY KEY (`id_lanche`)  COMMENT '',
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `apelido_cliente` VARCHAR(50) NOT NULL COMMENT '',
  `ts_abertura` TIMESTAMP  NOT NULL ,
  `ts_fechamento` TIMESTAMP  NULL ,
  PRIMARY KEY (`id_pedido`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ingrediente` (
  `id_ingrediente` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `nome` VARCHAR(50) NOT NULL COMMENT '',
  PRIMARY KEY (`id_ingrediente`)  COMMENT '',
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lanche_tem_ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lanche_tem_ingrediente` (
  `id_lanche` INT UNSIGNED NOT NULL COMMENT '',
  `id_ingrediente` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id_lanche`, `id_ingrediente`)  COMMENT '',
  INDEX `fk_lanche_has_ingrediente_ingrediente1_idx` (`id_ingrediente` ASC)  COMMENT '',
  INDEX `fk_lanche_has_ingrediente_lanche_idx` (`id_lanche` ASC)  COMMENT '',
  CONSTRAINT `fk_lanche_has_ingrediente_lanche`
    FOREIGN KEY (`id_lanche`)
    REFERENCES `lanche` (`id_lanche`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lanche_has_ingrediente_ingrediente`
    FOREIGN KEY (`id_ingrediente`)
    REFERENCES `ingrediente` (`id_ingrediente`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedido_tem_lanche`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedido_tem_lanche` (
  `id_pedido` INT UNSIGNED NOT NULL COMMENT '',
  `id_lanche` INT UNSIGNED NOT NULL COMMENT '',
  `quantidade` TINYINT NOT NULL COMMENT '',
  PRIMARY KEY (`id_pedido`, `id_lanche`)  COMMENT '',
  INDEX `fk_pedido_has_lanche_lanche1_idx` (`id_lanche` ASC)  COMMENT '',
  INDEX `fk_pedido_has_lanche_pedido1_idx` (`id_pedido` ASC)  COMMENT '',
  CONSTRAINT `fk_pedido_has_lanche_pedido1`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `pedido` (`id_pedido`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_has_lanche_lanche1`
    FOREIGN KEY (`id_lanche`)
    REFERENCES `lanche` (`id_lanche`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `rstat`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `rstat` (
  `id_rstat` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `operacao` INT UNSIGNED NOT NULL ,
  `status` VARCHAR(5) NOT NULL ,
  `request_method` VARCHAR(10) NOT NULL ,
  `request_time` TIMESTAMP NOT NULL ,
  `remote_addr` VARCHAR(128) NOT NULL ,
  PRIMARY KEY (`id_rstat`) )
ENGINE = InnoDB;