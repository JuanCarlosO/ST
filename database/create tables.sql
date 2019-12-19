/*Creación del catalogo de fallas*/
CREATE TABLE fallas 
(
	id int not null auto_increment,
	nombre varchar(100) not null, 
	rubro_id int not null,
	FOREIGN KEY(rubro_id) REFERENCES rubro(id),
	PRIMARY KEY (id)
)ENGINE=InnoDB COMMENT = 'Catálogo de fallas'
;