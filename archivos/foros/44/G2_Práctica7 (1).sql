--1. Crear rol de base de datos

--Crear Stores Procedured

CREATE PROCEDURE sp_listarProveedores     
AS     
    SELECT codprov, nomprov 
    FROM catalogo.Proveedor;
GO 

--Crear rol
CREATE ROLE rol1; 
GO  

--Asignar permisos al rol

GRANT EXECUTE TO rol1;
GRANT insert on catalogo.Proveedor TO rol1;
GO

--2. Crear 3 logind y 3 usuarios

--LOG IN

CREATE LOGIN login1 WITH PASSWORD = 'P@ssw0rd1';  
GO 
CREATE LOGIN login2 WITH PASSWORD = 'P@ssw0rd2';  
GO 
CREATE LOGIN login3 WITH PASSWORD = 'P@ssw0rd3';  
GO 

--Usuarios

CREATE USER usuario1 FOR LOGIN login1;  
GO  
CREATE USER usuario2 FOR LOGIN login2;  
GO  
CREATE USER usuario3 FOR LOGIN login3;  
GO  