-- CREACIÓN DE LA BASE DE DATOS --
CREATE DATABASE appstore;
USE appstore;

-- CREACIÓN DE TABLAS --

CREATE TABLE categorias (
	idcategoria INT PRIMARY KEY 	AUTO_INCREMENT,
	categoria 	VARCHAR(30)	NOT NULL,
	create_at 	DATETIME	DEFAULT NOW(),
	update_at	DATETIME	NULL,
	inactive_at	CHAR(1)		NULL
)ENGINE = INNODB;


CREATE TABLE productos(
	idproducto	INT PRIMARY KEY 	AUTO_INCREMENT,
	idcategoria 	INT 			NOT NULL,
	descripcion 	VARCHAR(150)		NOT NULL,
	precio		FLOAT(7,2)		NOT NULL,
	garantia	TINYINT			NOT NULL,
	fotografia	VARCHAR(200)		NULL,
	create_at 	DATETIME		DEFAULT NOW(),
	update_at	DATETIME		NULL,
	inactive_at	DATETIME		NULL,
	CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
)ENGINE = INNODB;


-- USUARIOS : 

CREATE TABLE roles(
	idrol 		INT PRIMARY KEY 	AUTO_INCREMENT,
	rol 		VARCHAR(30)		NOT NULL,
	create_at 	DATETIME		DEFAULT NOW(),
	update_at	DATETIME		NULL,
	inactive_at	DATETIME		NULL
)ENGINE = INNODB;


CREATE TABLE nacionalidades (
	idnacionalidad 	INT PRIMARY KEY 	AUTO_INCREMENT,
	nombre_pais 	VARCHAR(50)		NOT NULL,
	nombre_corto 	VARCHAR(10)		NOT NULL,
	create_at 	DATETIME		DEFAULT NOW(),
	update_at	DATETIME		NULL,
	inactive_at	DATETIME		NULL
)ENGINE = INNODB;


CREATE TABLE usuarios (
	idusuario       INT PRIMARY KEY 	AUTO_INCREMENT, -- pk
	idrol 		INT			NOT NULL,	-- fk
	idnacionalidad 	INT			NOT NULL,   -- fk
	apellidos	VARCHAR(30)		NOT NULL,
	nombres		VARCHAR(40)		NOT NULL,
	avatar 		VARCHAR(200)		NULL,	-- fk
	email		VARCHAR(30)		NOT NULL,
	clave_acceso	VARCHAR(60)		NOT NULL,
	nivelacceso 	CHAR(3) 		NOT NULL,
	create_at 	DATETIME		DEFAULT NOW(),
	update_at	DATETIME		NULL,
	inactive_at	DATETIME		NULL,
CONSTRAINT fk_idrol FOREIGN KEY (idrol) REFERENCES roles(idrol),
CONSTRAINT fk_idnacionalidad FOREIGN KEY (idnacionalidad) REFERENCES nacionalidades(idnacionalidad)
)ENGINE = INNODB;


-- DataSheet

CREATE TABLE especificaciones (
	idespecificaciones  		INT PRIMARY KEY AUTO_INCREMENT,
	idproducto 			INT		NOT NULL,
	clave				VARCHAR(30)	NOT NULL,
	valor				VARCHAR(300) 	NOT NULL,
	create_at 			DATETIME	DEFAULT NOW(),
	update_at			DATETIME	NULL,
	inactive_at			DATETIME	NULL,
)ENGINE = INNODB;


CREATE TABLE galerias (
	idgaleria		INT PRIMARY KEY 	AUTO_INCREMENT,
	idproducto 		INT			NOT NULL,
	clave			VARCHAR(30)		NOT NULL,
	valor			VARCHAR(300) 		NOT NULL,
	create_at 		DATETIME		DEFAULT NOW(),
	update_at		DATETIME		NULL,
	inactive_at		DATETIME		NULL,
)ENGINE = INNODB;