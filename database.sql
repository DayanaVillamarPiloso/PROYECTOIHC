-- Database: villamar

-- DROP DATABASE villamar;

/*CREATE DATABASE villamar
    WITH 
    OWNER = openpg
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'Spanish_Ecuador.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
    DROP SCHEME public CASCADE;
    CREATE SCHEME public;*/
/*---------------------PG---------------------------*/
	CREATE TABLE tipo_usuarios(
		id_tipo SERIAL PRIMARY KEY,
		nombre_tipo VARCHAR(250) NULL DEFAULT NULL,
		descrip_tipo TEXT NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE usuarios(
		id_user SERIAL PRIMARY KEY,
		id_tipo INT2 NOT NULL,
		nombre_u VARCHAR(250) NULL DEFAULT NULL,
		usuario_u VARCHAR(250) NULL DEFAULT NULL,
		correo_u VARCHAR(250) NULL DEFAULT NULL,
		contra_u VARCHAR(250) NULL DEFAULT NULL,
		foto_u VARCHAR(250) NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE productos(
		id_prod SERIAL PRIMARY KEY,
		codigo_p VARCHAR(20) NULL DEFAULT NULL,
		nombre_p VARCHAR(250) NULL DEFAULT NULL,
		tipo_p VARCHAR(100) NULL DEFAULT NULL,
		fechav_p VARCHAR(50) NULL DEFAULT NULL,
		costo_p FLOAT NULL DEFAULT NULL,
		descrip_corta_p text NULL DEFAULT NULL,
		descripcion_p text NULL DEFAULT NULL,
		especificacion_p text NULL DEFAULT NULL,
		marca_p VARCHAR(50) NULL DEFAULT NULL,
		modelo_p VARCHAR(100) NULL DEFAULT NULL, 
		peso FLOAT NULL DEFAULT NULL,
		unimedida_p VARCHAR(200) NULL DEFAULT NULL,
		cantidad_p INT2 NULL DEFAULT NULL,
		foto1_p TEXT NULL DEFAULT NULL,
		foto2_p TEXT NULL DEFAULT NULL,
		foto3_p TEXT NULL DEFAULT NULL,
		foto4_p TEXT NULL DEFAULT NULL,
		foto5_p TEXT NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE proveedor(
		id_prov SERIAL PRIMARY KEY,
		nombre_prove VARCHAR(250) NULL DEFAULT NULL,
		ruta_prove TEXT NULL DEFAULT NULL,
		tel_prove TEXT NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE entrada(
		id_entrada SERIAL PRIMARY KEY,
		id_prod SERIAL,
		cant_entrada INT NULL DEFAULT NULL,
		fecha_entrada VARCHAR(250) NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE salida(
		id_salida SERIAL PRIMARY KEY,
		id_prod SERIAL,
		cant_salida INT NULL DEFAULT NULL,
		fecha_salida VARCHAR(250) NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1'
	);
	CREATE TABLE STOCK(
		id_stock serial PRIMARY KEY,
		id_prod int,
		id_entrada int,
		id_salida int,
		cant_total integer NULL DEFAULT NULL,
		created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT2 NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT2 NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT2 NULL DEFAULT '0',
		status INT2 NULL DEFAULT '1',
		CONSTRAINT id_prod_FK FOREIGN KEY (id_prod) REFERENCES productos (id_prod)
		ON DELETE RESTRICT ON UPDATE CASCADE,
		CONSTRAINT id_entrada_FK FOREIGN KEY (id_entrada) REFERENCES entrada (id_entrada)
		ON DELETE RESTRICT ON UPDATE CASCADE,
		CONSTRAINT id_salida_FK FOREIGN KEY (id_salida) REFERENCES salida (id_salida)
		ON DELETE RESTRICT ON UPDATE CASCADE
	);
/*---------------------MY---------------------------*/
	CREATE TABLE tipo_usuarios(
		id_tipo INT PRIMARY KEY AUTO_INCREMENT,
		nombre_tipo VARCHAR(250) NULL DEFAULT NULL,
		descrip_tipo TEXT NULL DEFAULT NULL,
		created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT NULL DEFAULT '0',
		status INT(1) NULL DEFAULT '1'
	);
	CREATE TABLE usuarios(
		id_user INT PRIMARY KEY AUTO_INCREMENT,
		id_tipo INT NOT NULL,
		nombre_u VARCHAR(250) NULL DEFAULT NULL,
		usuario_u VARCHAR(250) NULL DEFAULT NULL,
		correo_u VARCHAR(250) NULL DEFAULT NULL,
		contra_u VARCHAR(250) NULL DEFAULT NULL,
		foto_u VARCHAR(250) NULL DEFAULT NULL,
		created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT NULL DEFAULT '0',
		status INT(1) NULL DEFAULT '1'
	);
	CREATE TABLE productos(
		id_prod int PRIMARY KEY AUTO_INCREMENT,
		nombre_p VARCHAR(250) NULL DEFAULT NULL,
		tipo_p VARCHAR(100) NULL DEFAULT NULL,
		fechav_p VARCHAR(50) NULL DEFAULT NULL,
		costo_p FLOAT NULL DEFAULT NULL,
		descripcion_p text NULL DEFAULT NULL,
		marca_p VARCHAR(50) NULL DEFAULT NULL,
		modelo_p VARCHAR(100) NULL DEFAULT NULL, 
		peso FLOAT NULL DEFAULT NULL,
		unimedida_p VARCHAR(200) NULL DEFAULT NULL,
		foto1_p TEXT NULL DEFAULT NULL,
		foto2_p TEXT NULL DEFAULT NULL,
		foto3_p TEXT NULL DEFAULT NULL,
		foto4_p TEXT NULL DEFAULT NULL,
		foto5_p TEXT NULL DEFAULT NULL,
		created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT NULL DEFAULT '0',
		status INT(1) NULL DEFAULT '1'
	);
	CREATE TABLE proveedor(
	    id_prov int PRIMARY KEY AUTO_INCREMENT,
		nombre_prove VARCHAR(250) NULL DEFAULT NULL,
		ruta_prove TEXT NULL DEFAULT NULL,
		tel_prove TEXT NULL DEFAULT NULL,
		created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
		id_created INT NULL DEFAULT '1',
		updated_at VARCHAR(50) NULL DEFAULT NULL,
		id_updated INT NULL DEFAULT '0',
		drop_at VARCHAR(50) NULL DEFAULT NULL,
		id_drop INT NULL DEFAULT '0',
		status INT(1) NULL DEFAULT '1'
	);
/*------------------INSERTS-------------------------*/
INSERT INTO tipo_usuarios (nombre_tipo,descrip_tipo) VALUES 
	('Super Administrador', ''),
	('Administrador', ''),
	('Empleado', '')
;
INSERT INTO usuarios (id_tipo,nombre_u,usuario_u,correo_u,contra_u,foto_u) VALUES
	(1, 'Frank Moreno', 'fmoreno_admin', 'admin@frankmorenoalburqueque.com', '$2y$10$VYDACkDdJoCrKtnOvNHvF.BZ9M3eGq/lCyd4LNrFLtM7R275ipc4u', 'user.png'),
	(1, 'Dayana Villamar', 'dvillamar', 'dayilisvv2017@gmail.com', '$2y$10$hs09n8S8U/M3OLNz/A2I8OWYZNi8xpNOxf9vRZmG6i6RAysvyiH2C', 'user.png'),
	(2, 'Josselyn Macias', 'jmacias', 'jmacias@gmail.com', '$2y$10$vMkYvutl74R4uYnsSxT.ReEOR8nXPpSOh7xqSiCyxkcaytYNUXekG', 'user.png'),
	(3, 'Rosa Rivera', 'rrivera', 'rrivera@gmail.com', '$2y$10$edll7hHQ0G9pMSbpKF2bPOPkazcg8L/kxkZYwi8QcrW4m09B0OPvC', 'user.png'),
	(3, 'Carlos Castro', 'scastro', 'scastro@gmail.com', '$2y$10$E3jpoPYax5SUGlXQFDl9BeNQD/qlDX0AR6zkwZq2LUEt3qvzHkyGK', 'user.png')
;
INSERT INTO proveedor (id_prov,nombre_prove,ruta_prove,tel_prove) VALUES
	(1, 'Bryan', 'ciudalela las cumbres', 0968949048)
;

TRUNCATE TABLE public.entrada RESTART IDENTITY;