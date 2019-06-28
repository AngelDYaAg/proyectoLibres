-- USUARIO CAROL
INSERT INTO `proyectolibres`.`usuario` (`CEDULAUSUARIO`, `NOMBRESUSUARIO`, `APELLIDOSUSUARIO`, `TIPOUSUARIO`, `USER`, `PASSWORD`, `ESTADOUSUARIO`) VALUES ('1725056459', 'Carol Lizeth', 'Oña Hinostroza', 'estudiante', 'carol', 'carol', 'activo');


-- TABLA FORO RELACION USUARIO
ALTER TABLE `proyectolibres`.`foro` 
ADD COLUMN `IDAUTORFORO` INT(11) NULL AFTER `DESCRIPCIONFORO`,
ADD COLUMN `NOMBREAUTORFORO` VARCHAR(60) NULL AFTER `IDAUTORFORO`,
ADD INDEX `fk_foro_usuario_idx` (`IDAUTORFORO`) ;
;
ALTER TABLE `proyectolibres`.`foro` 
ADD CONSTRAINT `fk_foro_usuario`
  FOREIGN KEY (`IDAUTORFORO`)
  REFERENCES `proyectolibres`.`usuario` (`IDUSUARIO`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `proyectolibres`.`foro` 
ADD COLUMN `FECHA` DATETIME NULL AFTER `NOMBREAUTORFORO`;


-- TABLA COMENTARIO DE FORO

CREATE TABLE `proyectolibres`.`comentario_foro` (
  `IDCOMENTARIO` INT NOT NULL AUTO_INCREMENT,
  `IDFORO` INT NULL,
  `IDUSUARIO` INT NULL,
  `NOMBREAUTORCOMENTARIO` VARCHAR(45) NULL,
  `CONTENIDO` VARCHAR(256) NULL,
  `FECHA` DATETIME NULL,
  PRIMARY KEY (`IDCOMENTARIO`));

  
-- ALTER FORO PARA TEXTOS LARGOS
ALTER TABLE `proyectolibres`.`foro` 
CHANGE COLUMN `DESCRIPCIONFORO` `DESCRIPCIONFORO` TEXT(1000) NOT NULL ;

-- ALTER FORO PARA ARCHIVOS
ALTER TABLE `proyectolibres`.`foro` 
ADD COLUMN `ARCHIVORUTA` VARCHAR(256) NULL AFTER `FECHA`,
ADD COLUMN `TIPOARCHIVO` VARCHAR(256) NULL AFTER `ARCHIVORUTA`;

-- ALTER COMENTARIOS_FORO PARA ARCHIVOS
ALTER TABLE `proyectolibres`.`comentario_foro` 
ADD COLUMN `ARCHIVORUTA` VARCHAR(256) NULL AFTER `FECHA`,
ADD COLUMN `TIPOARCHIVO` VARCHAR(256) NULL AFTER `ARCHIVORUTA`;


