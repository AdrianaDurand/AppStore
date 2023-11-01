-- 1°
USE appstore;

-- -------------------------------------------------------------------------------------
-- ------------------Procedimientos Alamacenados PRODUCTOS------------------------------
-- -------------------------------------------------------------------------------------
-- En cualquier proceso de consulta/listado/búsqueda, debemos recuperar PK


DELIMITER $$
CREATE PROCEDURE spu_productos_listar ()
BEGIN 
	SELECT pro.idproducto, 
	cat.categoria, 
	pro.descripcion, 
	pro.precio, 
	pro.garantia, 
	pro.fotografia
	FROM productos pro
	INNER JOIN categorias cat ON cat.idcategoria = pro.idcategoria
	WHERE pro.inactive_at IS NULL;
END $$


DELIMITER $$
CREATE PROCEDURE spu_productos_buscar (IN idproducto INT)
BEGIN 
	SELECT pro.idproducto, 
	cat.categoria, 
	pro.descripcion, 
	pro.precio, 
	pro.garantia, 
	pro.fotografia
	FROM productos pro
	INNER JOIN categorias cat ON pro.idcategoria = cat.idcategoria
	WHERE pro.idproducto = idproducto;
END $$


DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
	IN _idcategoria	INT,
	IN _descripcion 	VARCHAR(150),
	IN _precio			FLOAT(7,2),
	IN _garantia		TINYINT,
	IN _fotografia		VARCHAR(200)
)
BEGIN
	INSERT INTO productos
		(idcategoria, descripcion, precio, garantia, fotografia)
		VALUES
		(_idcategoria, _descripcion, _precio, _garantia, NULLIF(_fotografia, ''));
        
	SELECT @@last_insert_id 'idproducto';
END $$


DELIMITER $$
CREATE PROCEDURE spu_productos_eliminar(IN _idproducto INT)
BEGIN
    -- Eliminación lógica =>UPDATE
    -- Eliminación física => DELETE
    UPDATE productos
		SET inactive_at = NOW()
        WHERE idproducto = _idproducto;
END $$


-- -------------------------------------------------------------------------------------
-- ----------------Procedimientos Alamacenados CATEGORIAS-------------------------------
-- -------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_categorias_listar()
BEGIN
	SELECT idcategoria, categoria 
    FROM categorias
	WHERE inactive_at IS NULL;
END $$


DELIMITER $$
CREATE PROCEDURE spu_categorias_registrar(
	IN _categoria 	VARCHAR(30)
)
BEGIN
	INSERT INTO categorias (categoria) VALUES (_categoria);
END $$

-- -------------------------------------------------------------------------------------
-- -----------------Procedimientos Alamacenados USUARIOS--------------------------------
-- -------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN 
	SELECT USU.idusuario,
		USU.nombres,
		USU.apellidos,
		NAC.nombre_pais,
        ROL.rol,
		USU.avatar
		FROM usuarios USU
        INNER JOIN roles ROL ON ROL.idrol = USU.idrol
        INNER JOIN nacionalidades NAC ON NAC.idnacionalidad = USU.idnacionalidad
        WHERE USU.inactive_at IS NULL;
END$$


DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar
(
	IN _nombres			VARCHAR(40),
	IN _apellidos			VARCHAR(30),	
	IN _idrol			INT,
	IN _idnacionalidad 		INT,
	IN _email			VARCHAR(30),
	IN _clave_acceso		VARCHAR(60),
	IN _avatar			VARCHAR(200)
)
BEGIN
	INSERT INTO usuarios
		(idrol, idnacionalidad, apellidos, nombres, email, clave_acceso, avatar)
		VALUES
		(_idrol, _idnacionalidad, _apellidos, _nombres, _email, _clave_acceso, NULLIF(_avatar, ''));
        
	SELECT @@last_insert_id 'idusuario';
END $$


DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN _idusuario INT)
BEGIN
    UPDATE usuarios
		SET inactive_at = NOW()
        WHERE idusuario = _idusuario;
END $$


-- -------------------------------------------------------------------------------------
-- ------------Procedimientos Alamacenados ROL / NACIONALIDADES-------------------------
-- -------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_rol_listar()
BEGIN
	SELECT idrol, rol 
    FROM roles
	WHERE inactive_at IS NULL;
END $$


DELIMITER $$
CREATE PROCEDURE spu_nacionalidad_listar()
BEGIN
	SELECT idnacionalidad, nombre_pais 
    FROM nacionalidades
	WHERE inactive_at IS NULL;
END $$


-- --------------------------------------------
-- ------------ LOGIN -------------------------
-- --------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(60))
BEGIN
    SELECT
        USU.idusuario,
        USU.apellidos,
        USU.nombres,
        USU.email,
        USU.clave_acceso,
        ROL.rol
    FROM usuarios AS USU
    INNER JOIN roles AS ROL ON USU.idrol = ROL.idrol
    WHERE USU.email = _email AND USU.inactive_at IS NULL;
END $$



-- ---------------------------------
-- ---------------------------------
-- ---------------------------------


/* DELIMITER $$
CREATE PROCEDURE buscarCP (IN categoriaId INT)
BEGIN
    SELECT
        productos.idproducto,
        categorias.categoria,
        productos.descripcion,
        productos.precio,
        productos.garantia,
        productos.fotografia
    FROM
        productos
    JOIN
        categorias ON productos.idcategoria = categorias.idcategoria
    WHERE
        categorias.idcategoria = categoriaId;
END$$ */


CREATE VIEW vs_productos_categorias
AS
	SELECT
		PRD.idproducto,
		PRD.idcategoria,
		CAT.categoria,
		PRD.descripcion,
		PRD.precio, 
		PRD.garantia,
		PRD.fotografia, PRD.create_at
		FROM productos PRD
		INNER JOIN categorias CAT ON CAT.idcategoria = PRD.idcategoria
		WHERE PRD.inactive_at IS NULL
		LIMIT 12;
	
	
	
DELIMITER $$
CREATE PROCEDURE spu_productos_filtrar_categoria(IN _idcategoria INT)
BEGIN
	IF _idcategoria = -1 THEN
		SELECT * FROM vs_productos_categorias ORDER BY create_at;
	ELSE
		SELECT * FROM vs_productos_categorias WHERE idcategoria = _idcategoria ORDER BY create_at;
    END IF;
	
END $$



-- -------------------------------------------------------------------------------------
-- ---------------Procedimientos Alamacenados ESPECIFICACIONES--------------------------
-- -------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_especificaciones_listar ()
BEGIN 
	SELECT ESP.idespecificacion, 
	PRO.descripcion, 
	ESP.clave, 
	ESP.valor
	FROM especificaciones ESP
	INNER JOIN productos PRO ON ESP.idproducto = PRO.idproducto
	WHERE ESP.inactive_at IS NULL;
END $$


DELIMITER $$
CREATE PROCEDURE spu_especificaciones_registrar
(
	IN _idproducto	 	INT,
	IN _clave		VARCHAR(30),
	IN _valor		VARCHAR(300)
)
BEGIN
	INSERT INTO especificaciones
		(idproducto, clave, valor)
		VALUES
		(_idproducto, _clave, _valor);
        
	SELECT @@last_insert_id 'idespecificacion';
END $$