CREATE TABLE t_bien(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(200) NOT NULL, 
	grupo_id INT NOT NULL,
	FOREIGN KEY (grupo_id) REFERENCES grupos(id)
)ENGINE=InnoDB COMMENT = 'Catálogo de tipo de bienes';