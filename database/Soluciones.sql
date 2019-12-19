CREATE TABLE soluciones (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	fecha DATETIME NOT NULL,
	desc_solucion TEXT NOT NULL, 
	tbien_id INT NOT NULL,
	FOREIGN KEY (tbien_id) REFERENCES t_bienes(id)
) COMMENT = 'Registro de soluciones a fallas por parte de ST ';