-- 1°: Uso DB
USE appstore;

-- 2°: Limpiando las tablas 
DELETE FROM usuarios;
ALTER TABLE usuarios AUTO_INCREMENT 1;

-- -------------------------------------------------------------------------------------
-- -----------------------------INSERTANDO DATOS----------------------------------------
-- -------------------------------------------------------------------------------------

-- Categorías
 INSERT INTO categorias(categoria) VALUES
	('Computadoras'),
	('Telefonos Moviles'),
	('Monitores'),
	('Accesorios'),
	('Perifericos');
	
	
-- Productos
INSERT INTO productos(idcategoria, descripcion, precio, garantia) VALUES
	(1,'Laptop HP Pavilon',2500,12),
	(2,'iPhone 13 Pro',3500, 24),
	(3,'Monitor LG 27',1000, 12),
	(4,'Auricular Sony',250, 12),
	(5,'Impresora a Epson',1500, 18);
	
	
-- Roles
INSERT INTO roles (rol) VALUES
	('Administrador'),
	('Invitado')
	('Asistente');


-- Nacionalidades
INSERT INTO nacionalidades (nombre_pais , nombre_corto) VALUES
	('Andorra', 'AND'),
	('Emiratos Árabes Unidos', 'ARE'),
	('Afganistán', 'AFG'),
	('Antigua y Barbuda', 'ATG'),
	('Anguila', 'AIA'),
	('Albania', 'ALB'),
	('Armenia', 'ARM'),
	('Antillas Neerlandesas', 'ANT'),
	('Angola', 'AGO'),
	('Antártida', 'ATA'),
	('Argentina', 'ARG'),
	('Samoa Americana', 'ASM'),
	('Austria', 'AUT'),
	('Australia', 'AUS'),
	('Aruba', 'ABW'),
	('Islas Áland', 'ALA'),
	('Azerbaiyán', 'AZE'),
	('Bosnia y Herzegovina', 'BIH'),
	('Barbados', 'BRB'),
	('Bangladesh', 'BGD'),
	('Bélgica', 'BEL'),
	('Burkina Faso', 'BFA'),
	('Bulgaria', 'BGR'),
	('Bahréin', 'BHR'),
	('Burundi', 'BDI'),
	('Benin', 'BEN'),
	('San Bartolomé', 'BLM'),
	('Bermudas', 'BMU'),
	('Brunéi', 'BRN'),
	('Bolivia', 'BOL'),
	('Brasil', 'BRA'),
	('Bahamas', 'BHS'),
	('Bhután', 'BTN'),
	('Isla Bouvet', 'BVT'),
	('Botsuana', 'BWA'),
	('Belarús', 'BLR'),
	('Belice', 'BLZ'),
	('Canadá', 'CAN'),
	('Islas Cocos', 'CCK'),
	('República Centro-Africana', 'CAF'),
	('Congo', 'COG'),
	('Suiza', 'CHE'),
	('Costa de Marfil', 'CIV'),
	('Islas Cook', 'COK'),
	('Chile', 'CHL'),
	('Camerún', 'CMR'),
	('China', 'CHN'),
	('Colombia', 'COL'),
	('Costa Rica', 'CRI'),
	('Cuba', 'CUB'),
	('Cabo Verde', 'CPV'),
	('Islas Christmas', 'CXR'),
	('Chipre', 'CYP'),
	('República Checa', 'CZE'),
	('Alemania', 'DEU'),
	('Yibuti', 'DJI'),
	('Dinamarca', 'DNK'),
	('Domínica', 'DMA'),
	('República Dominicana', 'DOM'),
	('Argel', 'DZA'),
	('Ecuador', 'ECU'),
	('Estonia', 'EST'),
	('Egipto', 'EGY'),
	('Sahara Occidental', 'ESH'),
	('Eritrea', 'ERI'),
	('España', 'ESP'),
	('Etiopía', 'ETH'),
	('Finlandia', 'FIN'),
	('Fiji', 'FJI'),
	('Islas Malvinas', 'KLK'),
	('Micronesia', 'FSM'),
	('Islas Faroe', 'FRO'),
	('Francia', 'FRA'),
	('Gabón', 'GAB'),
	('Reino Unido', 'GBR'),
	('Granada', 'GRD'),
	('Georgia', 'GEO'),
	('Guayana Francesa', 'GUF'),
	('Guernsey', 'GGY'),
	('Ghana', 'GHA'),
	('Gibraltar', 'GIB'),
	('Groenlandia', 'GRL'),
	('Gambia', 'GMB'),
	('Guinea', 'GIN'),
	('Guadalupe', 'GLP'),
	('Guinea Ecuatorial', 'GNQ'),
	('Grecia', 'GRC'),
	('Georgia del Sur e Islas Sandwich del Sur', 'SGS'),
	('Guatemala', 'GTM'),
	('Guam', 'GUM'),
	('Guinea-Bissau', 'GNB'),
	('Guayana', 'GUY'),
	('Hong Kong', 'HKG'),
	('Islas Heard y McDonald', 'HMD'),
	('Honduras', 'HND'),
	('Croacia', 'HRV'),
	('Haití', 'HTI'),
	('Hungría', 'HUN'),
	('Indonesia', 'IDN'),
	('Irlanda', 'IRL'),
	('Israel', 'ISR'),
	('Isla de Man', 'IMN'),
	('India', 'IND'),
	('Territorio Británico del Océano Índico', 'IOT'),
	('Irak', 'IRQ'),
	('Irán', 'IRN'),
	('Islandia', 'ISL'),
	('Italia', 'ITA'),
	('Jersey', 'JEY'),
	('Jamaica', 'JAM'),
	('Jordania', 'JOR'),
	('Japón', 'JPN'),
	('Kenia', 'KEN'),
	('Kirguistán', 'KGZ'),
	('Camboya', 'KHM'),
	('Kiribati', 'KIR'),
	('Comoros', 'COM'),
	('San Cristóbal y Nieves', 'KNA'),
	('Corea del Norte', 'PRK'),
	('Corea del Sur', 'KOR'),
	('Kuwait', 'KWT'),
	('Islas Caimán', 'CYM'),
	('Kazajstán', 'KAZ'),
	('Laos', 'LAO'),
	('Líbano', 'LBN'),
	('Santa Lucía', 'LCA'),
	('Liechtenstein', 'LIE'),
	('Sri Lanka', 'LKA'),
	('Liberia', 'LBR'),
	('Lesotho', 'LSO'),
	('Lituania', 'LTU'),
	('Luxemburgo', 'LUX'),
	('Letonia', 'LVA'),
	('Libia', 'LBY'),
	('Marruecos', 'MAR'),
	('Mónaco', 'MCO'),
	('Moldova', 'MDA'),
	('Montenegro', 'MNE'),
	('Madagascar', 'MDG'),
	('Islas Marshall', 'MHL'),
	('Macedonia', 'MKD'),
	('Mali', 'MLI'),
	('Myanmar', 'MMR'),
	('Mongolia', 'MNG'),
	('Macao', 'MAC'),
	('Martinica', 'MTQ'),
	('Mauritania', 'MRT'),
	('Montserrat', 'MSR'),
	('Malta', 'MLT'),
	('Mauricio', 'MUS'),
	('Maldivas', 'MDV'),
	('Malawi', 'MWI'),
	('México', 'MEX'),
	('Malasia', 'MYS'),
	('Mozambique', 'MOZ'),
	('Namibia', 'NAM'),
	('Nueva Caledonia', 'NCL'),
	('Níger', 'NER'),
	('Islas Norkfolk', 'NFK'),
	('Nigeria', 'NGA'),
	('Nicaragua', 'NIC'),
	('Países Bajos', 'NLD'),
	('Noruega', 'NOR'),
	('Nepal', 'NPL'),
	('Nauru', 'NRU'),
	('Niue', 'NIU'),
	('Nueva Zelanda', 'NZL'),
	('Omán', 'OMN'),
	('Panamá', 'PAN'),
	('Perú', 'PER'),
	('Polinesia Francesa', 'PYF'),
	('Papúa Nueva Guinea', 'PNG'),
	('Filipinas', 'PHL'),
	('Pakistán', 'PAK'),
	('Polonia', 'POL'),
	('San Pedro y Miquelón', 'SPM'),
	('Islas Pitcairn', 'PCN'),
	('Puerto Rico', 'PRI'),
	('Palestina', 'PSE'),
	('Portugal', 'PRT'),
	('Islas Palaos', 'PLW'),
	('Paraguay', 'PRY'),
	('Qatar', 'QAT'),
	('Reunión', 'REU'),
	('Rumanía', 'ROU'),
	('Serbia y Montenegro', 'SRB'),
	('Rusia', 'RUS'),
	('Ruanda', 'RWA'),
	('Arabia Saudita', 'SAU'),
	('Islas Solomón', 'SLB'),
	('Seychelles', 'SYC'),
	('Sudán', 'SDN'),
	('Suecia', 'SWE'),
	('Singapur', 'SGP'),
	('Santa Elena', 'SHN'),
	('Eslovenia', 'SVN'),
	('Islas Svalbard y Jan Mayen', 'SJM'),
	('Eslovaquia', 'SVK'),
	('Sierra Leona', 'SLE'),
	('San Marino', 'SMR'),
	('Senegal', 'SEN'),
	('Somalia', 'SOM'),
	('Surinam', 'SUR'),
	('Santo Tomé y Príncipe', 'STP'),
	('El Salvador', 'SLV'),
	('Siria', 'SYR'),
	('Suazilandia', 'SWZ'),
	('Islas Turcas y Caicos', 'TCA'),
	('Chad', 'TCD'),
	('Territorios Australes Franceses', 'ATF'),
	('Togo', 'TGO'),
	('Tailandia', 'THA'),
	('Tanzania', 'TZA'),
	('Tayikistán', 'TJK'),
	('Tokelau', 'TKL'),
	('Timor-Leste', 'TLS'),
	('Turkmenistán', 'TKM'),
	('Túnez', 'TUN'),
	('Tonga', 'TON'),
	('Turquía', 'TUR'),
	('Trinidad y Tobago', 'TTO'),
	('Tuvalu', 'TUV'),
	('Taiwán', 'TWN'),
	('Ucrania', 'UKR'),
	('Uganda', 'UGA'),
	('Estados Unidos de América', 'USA'),
	('Uruguay', 'URY'),
	('Uzbekistán', 'UZB'),
	('Ciudad del Vaticano', 'VAT'),
	('San Vicente y las Granadinas', 'VCT'),
	('Venezuela', 'VEN'),
	('Islas Vírgenes Británicas', 'VGB'),
	('Islas Vírgenes de los Estados Unidos de América', 'VIR'),
	('Vietnam', 'VNM'),
	('Vanuatu', 'VUT'),
	('Wallis y Futuna', 'WLF'),
	('Samoa', 'WSM'),
	('Yemen', 'YEM'),
	('Mayotte', 'MYT'),
	('Sudáfrica', 'ZAF');



-- Usuarios
INSERT INTO usuarios (idrol, idnacionalidad, apellidos, nombres, email, clave_acceso) VALUES
(1, 3,'Cáceres Martinez', 'Andrea Silvana', 'silvana@gmail.com', 'caceresAndrea123'),
(1, 7,'Contreras Altamirano', 'Sneyder Jhon', 'sneyder@gmail.com', 'contreras1299SNYDER'),
(2, 10,'Gómez Rodrigues', 'Ana Lucia', 'analucia@gmail.com', 'anaLUCIA2020'),
(2,20,'López Gonzales', 'Marco Antonio', 'marcoantonio@gmail.com', "AntonioLopez");


-- Encriptando las claves : SENATI123
UPDATE usuarios SET
	clave_acceso = '$2y$10$75lA.B0Xsqf12p96E/myo.MJG3EylGhH92ENeFKMcQ2Ysjk//FmHm';
    


-- -------------------------------------------------------------------------------------
-- --------------------EJECUTANDO PROCEDIMIENTOS ALMACENADOS----------------------------
-- -------------------------------------------------------------------------------------

CALL spu_productos_registrar(1,'New', 12, 1, NULL)

CALL spu_usuarios_registrar(2, 63, 'Salvador', 'Marina', 'marina@gmail.com', '12345', '');

CALL spu_usuarios_login('sneyder@gmail.com');

CALL buscarCP (5); 

SELECT*FROM usuarios




 