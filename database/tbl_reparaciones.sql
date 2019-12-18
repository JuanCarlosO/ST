CREATE TABLE reparaciones(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ticket_id INT NOT NULL COMMENT 'FK que hace referencia a la falla' ,
	afectado_id INT NOT NULL COMMENT 'FK de persona que presenta la falla' ,
	solucionador_id INT NOT NULL COMMENT 'FK persona de ST que atendio' ,
	solucion_id INT NOT NULL COMMENT 'FK que tiene la solucion(es)' ,
	t_repa ENUM('Interna','Externa') NOT NULL COMMENT 'tipo de reparación',

	/*Declaracion de llaves foraneas*/
	FOREIGN KEY (ticket_id) REFERENCES tickets(id),
	FOREIGN KEY (afectado_id) REFERENCES personal(id),
	FOREIGN KEY (solucionador_id) REFERENCES personal(id),
	FOREIGN KEY (solucion_id) REFERENCES soluciones(id)
) COMMENT = 'Relación de la fallla con la solución';