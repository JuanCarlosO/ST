CREATE TABLE fallas(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(255) NOT NULL COMMENT 'nombre de falla presentado' 
	
) COMMENT = 'Catálogo de fallas, util para relacionar un reporte a una falla';