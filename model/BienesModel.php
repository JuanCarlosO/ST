<?php  
require_once 'conection.php';
require_once 'anexgrid.php';
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "es_ES");

class BienesModel extends Conection
{
	protected $sql;
	protected $stmt;
	public $result;
	public function getGrupos()
	{
		try {
			$this->sql = " SELECT * FROM grupos ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getTBienes($grupo)
	{
		try {
			$wh = "";
			if ($grupo != '') {
				$wh .= " AND grupo_id = ".$grupo;
			}
			$this->sql = " SELECT * FROM t_bienes WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getMateriales()
	{
		try {
			$this->sql = " SELECT * FROM materiales ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getMarcas()
	{
		try {
			$this->sql = " SELECT * FROM marcas ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getModelos()
	{
		try {
			$this->sql = " SELECT * FROM modelos ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getColores()
	{
		try {
			$this->sql = " SELECT id,UPPER(nombre) AS nombre FROM color ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function saveMarca($marca)
	{
		try {
			$this->sql = " INSERT INTO marcas (nombre) VALUES (?) ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$marca);
			$this->stmt->execute();
			$this->result = array('message' => 'success' );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('message' => $e->getMessage()  );
		}
	}
	public function saveModelo($modelo)
	{
		try {
			$this->sql = " INSERT INTO modelos (nombre) VALUES (?) ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$modelo);
			$this->stmt->execute();
			$this->result = array('message' => 'success' );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('message' => $e->getMessage()  );
		}
	}
	public function saveColor($color)
	{
		try {
			$this->sql = " INSERT INTO color (nombre) VALUES (?) ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$color);
			$this->stmt->execute();
			$this->result = array('message' => 'success' );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('message' => $e->getMessage()  );
		}
	}
	public function saveBien($post)
	{
		try {
			session_start();
			
			$person_id = $_SESSION['person_id'];
			#Buscar el area a la que pertence la persona
			$this->sql = "SELECT area_id FROM personal WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($person_id));
			$area_id = $this->stmt->fetch( PDO::FETCH_OBJ );
			$grupos = '';
			if ($area_id->area_id == '4') 
			{
				if($post['grupo']=='2' or $post['grupo']=='4' or $post['grupo']=='6' )
				{
					throw new Exception("USTED  NO TIENE PERMITIDO AGREGAR BIENES DEL GRUPO SELECCIONADO",1);
				}
			}
			if ($area_id->area_id == '25') 
			{
				if($post['grupo']=='3' or $post['grupo']=='5' or $post['grupo']=='7' )
				{
					throw new Exception("USTED  NO TIENE PERMITIDO AGREGAR BIENES DEL GRUPO SELECCIONADO",1);
				}
			}

			$ubica = mb_strtoupper($post['desc_ub']);
			$desc = mb_strtoupper($post['descripcion']);
			$inv = mb_strtoupper($post['inventario']);
			$serie = mb_strtoupper($post['serie']);
			$this->sql = " INSERT INTO bienes (
				id,
				marca_id,
				descripcion,
				serie,
				status,
				grupo_id,
				tipo_id,
				material_id,
				inventario,
				modelo_id,
				color_id,
				desc_ub,
				fecha_reg,
				factura,
				importe,
				pro_id,
				fecha_adq,
				dura_garantia,
				ubicacion,
			)  VALUES ('',?,?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?,?,?,5) ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			
			$this->stmt->bindParam(1,$post['marca']);
			$this->stmt->bindParam(2,$desc);
			$this->stmt->bindParam(3,$serie);
			$this->stmt->bindParam(4,$post['estado']);
			$this->stmt->bindParam(5,$post['grupo']);
			$this->stmt->bindParam(6,$post['tipo']);
			$this->stmt->bindParam(7,$post['material']);
			$this->stmt->bindParam(8,$inv);
			$this->stmt->bindParam(9,$post['modelo']);
			$this->stmt->bindParam(10,$post['color']);
			$this->stmt->bindParam(11,$ubica);
			$this->stmt->bindParam(12,$post['factura']);
			$this->stmt->bindParam(13,$post['importe']);
			$this->stmt->bindParam(14,$post['proveedor']);
			$this->stmt->bindParam(15,$post['adquisicion']);
			$this->stmt->bindParam(16,$post['duracion_g']);
			$this->stmt->execute();

			$this->result = array('estado'=>'success','message' => 'ALTA DE BIEN EXITOSA.' );
			session_destroy();
			return json_encode($this->result) ;
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message' => $e->getMessage()  ));
		}
	}
	/*Guarda al proveedor*/
	public function saveProveedor($nombre)
	{
		
		try {
			$nombre = mb_strtoupper($nombre);
			$this->sql = " INSERT INTO proveedores (nombre) VALUES (?) ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$nombre);
			$this->stmt->execute();
			$this->result = array('message' => 'success' );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('message' => $e->getMessage()  );
		}
	}
	/*Obtener los proveedores*/
	public function getProveedores()
	{
		try {
			$this->sql = " SELECT * FROM proveedores ORDER BY id DESC ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}	
	}
	public function getBienes()
	{
		try {
			session_start();
			$anexgrid = new AnexGrid();
			$wh = "";
			foreach($anexgrid->filtros as $f)
			{
				if($f['columna'] != ''){
					if($f['columna'] == 'inventario'){
						$wh .= " AND b.inventario LIKE '%".$f['valor']."%'";
					}
					if($f['columna'] == 'serie'){
						$wh .= " AND b.serie LIKE '%".$f['valor']."%'";
					}
					if($f['columna'] == 'personal_id'){
						$wh .= " AND a.personal_id = ".$this->getIDPerson($f['valor']);
					}
					if($f['columna'] == 'status'){
						$wh .= " AND b.status = ".$f['valor'];
					}
				}
			}

			$person_id = $_SESSION['person_id'];
			#Buscar el area a la que pertence la persona
			$this->sql = "SELECT area_id FROM personal WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($person_id));
			$area_id = $this->stmt->fetch( PDO::FETCH_OBJ );
			$grupos = '';
			if ($area_id->area_id == '4') 
			{
				$grupos = '1,3,5,7';
			}
			if ($area_id->area_id == '25') 
			{
				$grupos = '1,2,4,6';
			}
			
			$this->sql = "
			SELECT
			    b.id,
			    b.descripcion,
			    b.serie,
			    b.status,
			    b.inventario,
			    b.desc_ub,
			    m.nombre AS marca,
			    g.nombre AS grupo,
			    t.nombre AS tipo,
			    mo.nombre AS modelo,
			    b.fecha_reg AS registro,
			    b.fecha_adq AS adquisicion,
			    UPPER(c.nombre) AS color,
			    ma.nombre AS material,
			    p.nombre AS proveedor,
			    CONCAT(
			        pe.nombre,
			        ' ',
			        pe.ap_pat,
			        ' ',
			        pe.ap_mat
			    ) AS asignadoa,
			    b.factura,
		        b.importe,
		        b.pro_id,
		        b.fecha_adq,
		        b.dura_garantia
			FROM
			    bienes AS b
			LEFT JOIN marcas AS m
			ON
			    m.id = b.marca_id
			LEFT JOIN grupos AS g
			ON
			    g.id = b.grupo_id
			LEFT JOIN t_bienes AS t
			ON
			    t.id = b.tipo_id
			LEFT JOIN modelos AS mo
			ON
			    mo.id = b.modelo_id
			LEFT JOIN color AS c
			ON
			    c.id = b.color_id
			LEFT JOIN materiales AS ma
			ON
			    ma.id = b.material_id
			LEFT JOIN proveedores AS p
			ON
			    p.id = b.pro_id
			LEFT JOIN asignacion AS a
			ON
			    a.bien_id = b.id AND a.status = 1 AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			";
			/*Agregar where de anexgrid*/
			/*Agregar where de anexgrid*/
			$this->sql .= " WHERE 1=1 ".$wh;
			$this->sql .= " ORDER BY ".$anexgrid->columna." ".$anexgrid->columna_orden;
			$this->sql .= " LIMIT ".$anexgrid->pagina.",".$anexgrid->limite;

			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			/*Obtener el total*/
			$this->sql = "
			SELECT
			    COUNT(b.id) AS Total
			FROM
			    bienes AS b
			LEFT JOIN marcas AS m
			ON
			    m.id = b.marca_id
			LEFT JOIN grupos AS g
			ON
			    g.id = b.grupo_id
			LEFT JOIN t_bienes AS t
			ON
			    t.id = b.tipo_id
			LEFT JOIN modelos AS mo
			ON
			    mo.id = b.modelo_id
			LEFT JOIN color AS c
			ON
			    c.id = b.color_id
			LEFT JOIN materiales AS ma
			ON
			    ma.id = b.material_id
			LEFT JOIN proveedores AS p
			ON
			    p.id = b.pro_id
			LEFT JOIN asignacion AS a
			ON
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			";
			$this->sql .= " WHERE 1=1 ".$wh;
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			
			return $anexgrid->responde( $this->result,$total );
			#return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}

	/*Obtener el reporte por equipo*/
	public function getREquipo($post)
	{
		try {
			$condicion = '';
			$grupo = ( isset($post['grupo'])&& !empty($post['grupo']) ) ? $condicion .= ' AND b.grupo_id = '.$post['grupo'] : '' ;
			$tipo = ( isset($post['tipo']) && !empty($post['tipo']) ) ? $condicion .= ' AND b.tipo_id = '.$post['tipo'] : '' ;
			$estado = ( isset($post['estado']) && !empty($post['estado'])) ? $condicion .= ' AND b.status = '.$post['estado'] : '' ;
			
			$this->sql = "
				SELECT
				    b.id,
				    b.descripcion,
				    b.serie,
				    b.status,
				    b.inventario,
				    b.desc_ub,
				    m.nombre AS marca,
				    g.nombre AS grupo,
				    t.nombre AS tipo,
				    mo.nombre AS modelo,
				    b.fecha_reg AS registro,
				    b.fecha_adq AS adquisicion,
				    UPPER(c.nombre) AS color,
				    ma.nombre AS material,
				    p.nombre AS proveedor,
				    CONCAT(
				        pe.nombre,
				        ' ',
				        pe.ap_pat,
				        ' ',
				        pe.ap_mat
				    ) AS asignadoa
				FROM
				    bienes AS b
				LEFT JOIN marcas AS m
				ON
				    m.id = b.marca_id
				LEFT JOIN grupos AS g
				ON
				    g.id = b.grupo_id
				LEFT JOIN t_bienes AS t
				ON
				    t.id = b.tipo_id
				LEFT JOIN modelos AS mo
				ON
				    mo.id = b.modelo_id
				LEFT JOIN color AS c
				ON
				    c.id = b.color_id
				LEFT JOIN materiales AS ma
				ON
				    ma.id = b.material_id
				LEFT JOIN proveedores AS p
				ON
				    p.id = b.pro_id
				LEFT JOIN asignacion AS a
				ON
				    a.bien_id = b.id
				LEFT JOIN personal AS pe
				ON
				    pe.id = a.personal_id
				WHERE
				    1 = 1 ".$condicion."
				ORDER BY
				    id
				DESC
				    
			";
			
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}	
	}
	/*Obtener los Areas*/
	public function getAreas()
	{
		try {
			$this->sql = " SELECT id,nombre FROM area ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}	
	}
	/*Obtener al personal*/
	public function getPersonal($term)
	{
		try {
			$criterio = "'%".$term."%'";
			
			$this->sql = " SELECT id, CONCAT( nombre,' ',ap_pat,' ',ap_mat ) AS value FROM personal WHERE
			status = 'ALTA' AND nombre LIKE ".$criterio." OR ap_pat LIKE ".$criterio. " OR ap_mat LIKE ".$criterio;
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}	
	}
	/*Obtener el reporte por USUARIO O AREA*/
	public function getRUser($post)
	{
		try {
			$condicion = '';
			$aux_ids = array();
			#Si existe el id del personal, buscar los bienes de la persona
			if ( isset($post['servidor_id']) && !empty($post['servidor_id']) ) 
			{
				$servidor = $post['servidor_id']; 

				$this->sql = " SELECT bien_id FROM asignacion WHERE personal_id = ? ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam( 1,$servidor );
				$this->stmt->execute();
				$bienes_ids = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				foreach ($bienes_ids as $key => $id) {
					array_push($aux_ids,$id->bien_id);
				}
				/*Conversion a string*/
				$aux_ids = implode(',',$aux_ids);
				
				/*Buscar en la tabla de bienes , las asignaciones registradas*/
				$this->sql = " SELECT 
					b.id,
					b.descripcion,
					b.serie,
					b.status,
					b.inventario,
					b.desc_ub,
					m.nombre AS marca,
					g.nombre AS grupo,
					t.nombre AS tipo,
					mo.nombre AS modelo,
					b.fecha_reg AS registro,
					b.fecha_adq AS adquisicion,
					UPPER(c.nombre) AS color,
					ma.nombre AS material,
					p.nombre AS proveedor,
					CONCAT(
					    pe.nombre,
					    ' ',
					    pe.ap_pat,
					    ' ',
					    pe.ap_mat
					) AS asignadoa
				 FROM bienes AS b
				 INNER JOIN marcas AS m
				 ON
				     m.id = b.marca_id
				 INNER JOIN grupos AS g
				 ON
				     g.id = b.grupo_id
				 INNER JOIN t_bienes AS t
				 ON
				     t.id = b.tipo_id
				 INNER JOIN modelos AS mo
				 ON
				     mo.id = b.modelo_id
				 INNER JOIN color AS c
				 ON
				     c.id = b.color_id
				 INNER JOIN materiales AS ma
				 ON
				     ma.id = b.material_id
				 INNER JOIN proveedores AS p
				 ON
				     p.id = b.pro_id
				 INNER JOIN asignacion AS a
				 ON
				     a.bien_id = b.id
				 INNER JOIN personal AS pe
				 ON
				    pe.id = a.personal_id WHERE b.id IN ($aux_ids) ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$bienes = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				
				return json_encode($bienes) ;
			} 
			elseif( isset($post['area']) && !empty($post['area']) )
			{
				$area = $post['area'];
				#Buscar a los usuarios pertenecientes al area
				$this->sql = "SELECT id FROM personal WHERE area_id = ?";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$area);
				$this->stmt->execute();
				$personas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				foreach ($personas as $key => $id) {
					array_push($aux_ids,$id->id);
				}
				$aux_ids = implode(',',$aux_ids);
				#ubicar los bienes con las personas (En asignaciones)
				$this->sql = "SELECT bien_id FROM asignacion WHERE personal_id IN (?)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$aux_ids);
				$this->stmt->execute();
				$asignaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				#Limpiar arreglo auxiliar
				unset($aux_ids);
				$aux_ids = array();
				foreach ($asignaciones as $key => $id) {
					array_push($aux_ids,$id->bien_id);
				}
				$aux_ids = implode(',',$aux_ids);
				#Buscar los bienes (Bienes)
				$this->sql = "SELECT 
					b.id,
					b.descripcion,
					b.serie,
					b.status,
					b.inventario,
					b.desc_ub,
					m.nombre AS marca,
					g.nombre AS grupo,
					t.nombre AS tipo,
					mo.nombre AS modelo,
					b.fecha_reg AS registro,
					b.fecha_adq AS adquisicion,
					UPPER(c.nombre) AS color,
					ma.nombre AS material,
					p.nombre AS proveedor,
					CONCAT(
					    pe.nombre,
					    ' ',
					    pe.ap_pat,
					    ' ',
					    pe.ap_mat
					) AS asignadoa
				 FROM bienes AS b
				 INNER JOIN marcas AS m
				 ON
				     m.id = b.marca_id
				 INNER JOIN grupos AS g
				 ON
				     g.id = b.grupo_id
				 INNER JOIN t_bienes AS t
				 ON
				     t.id = b.tipo_id
				 INNER JOIN modelos AS mo
				 ON
				     mo.id = b.modelo_id
				 INNER JOIN color AS c
				 ON
				     c.id = b.color_id
				 INNER JOIN materiales AS ma
				 ON
				     ma.id = b.material_id
				 INNER JOIN proveedores AS p
				 ON
				     p.id = b.pro_id
				 INNER JOIN asignacion AS a
				 ON
				     a.bien_id = b.id
				 INNER JOIN personal AS pe
				 ON
				    pe.id = a.personal_id
				  WHERE b.id IN ($aux_ids)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$bienes = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return  json_encode($bienes);
			}else{
				return json_encode( array('message'=>'No selecciono ningún criterio') );
			}
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}	
	}
#Funcion para recuperar informacion de un bien 
	public function getEspecificBien($id)
	{
		try {
			$this->sql = "
				SELECT
				  b.id,
				  b.descripcion,
				  b.serie,
				  b.status,
				  b.inventario,
				  b.desc_ub,
				  b.factura,
				  b.importe,
				  b.fecha_adq,
				  m.nombre AS marca,
				  g.nombre AS grupo,
				  t.nombre AS tipo,
				  mo.nombre AS modelo,
				  b.fecha_reg AS registro,
				  b.fecha_adq AS adquisicion,
				  UPPER(c.nombre) AS color,
				  ma.nombre AS material,
				  p.nombre AS proveedor,
				  CONCAT(
				    pe.nombre,
				    ' ',
				    pe.ap_pat,
				    ' ',
				    pe.ap_mat
				  ) AS asignadoa
				FROM
				  bienes AS b
				LEFT JOIN
				  marcas AS m ON m.id = b.marca_id
				LEFT JOIN
				  grupos AS g ON g.id = b.grupo_id
				LEFT JOIN
				  t_bienes AS t ON t.id = b.tipo_id
				LEFT JOIN
				  modelos AS mo ON mo.id = b.modelo_id
				LEFT JOIN
				  color AS c ON c.id = b.color_id
				LEFT JOIN
				  materiales AS ma ON ma.id = b.material_id
				LEFT JOIN
				  proveedores AS p ON p.id = b.pro_id
				LEFT JOIN
				  asignacion AS a ON a.bien_id = b.id
				LEFT JOIN
				  personal AS pe ON pe.id = a.personal_id
				  WHERE b.id = ?
				LIMIT 1
				
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array( $id ) );
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('error' => $e->getMessage() ) );
		}
	}
	public function updateBien()
	{
		try {
			$post = $_POST;
			#Armar el Query para actualizar el bien
			$this->sql = "UPDATE bienes SET ";
			if ( !empty($post['marca_edit'] ) ) {
				$this->sql  .= " marca_id 	= ".$post['marca_edit']. " ";
			}
			if ( !empty($post['descripcion_edit'] ) ) {
				$this->sql  .= ", descripcion 	= '".$post['descripcion_edit']. "' ";
			}
			if ( !empty($post['serie_edit'] ) ) {
				$this->sql  .= ", serie 	= '".$post['serie_edit']. "' ";
			}
			if ( !empty($post['estado_edit'] ) ) {
				$this->sql  .= ", status 	= ".$post['estado_edit']. " ";
			}
			if ( !empty($post['grupo_edit'] ) ) {
				$this->sql  .= ", grupo_id 	= ".$post['grupo_edit']. " ";
			}
			if ( !empty($post['tipo_edit'] ) ) {
				$this->sql  .= ", tipo_id 	= ".$post['tipo_edit']. " ";
			}
			if ( !empty($post['inventario_edit'] ) ) {
				$this->sql  .= ", inventario 	= '".$post['inventario_edit']. "' ";
			}
			if ( !empty($post['modelo_edit'] ) ) {
				$this->sql  .= ", modelo_id 	= ".$post['modelo_edit']. " ";
			}
			if ( !empty($post['color_edit'] ) ) {
				$this->sql  .= ", color_id 	= ".$post['color_edit']. " ";
			}
			if ( !empty($post['material_edit'] ) ) {
				$this->sql  .= ", material_id 	= ".$post['material_edit']. " ";
			}
			if ( !empty($post['desc_ub_edit'] ) ) {
				$this->sql  .= ", desc_ub 	= '".$post['desc_ub_edit']. "' ";
			}
			if ( !empty($post['factura_edit'] ) ) {
				$this->sql  .= ", factura 	= '".$post['factura_edit']. "' ";
			}
			if ( !empty($post['importe_edit'] ) ) {
				$this->sql  .= ", importe 	= '".$post['importe_edit']. "'";
			}
			if ( !empty($post['proveedor_edit'] ) ) {
				$this->sql  .= " pro_id 	= ".$post['proveedor_edit']. " ";
			}
			if ( !empty($post['adquisicion_edit'] ) ) {
				$this->sql  .= " fecha_adq 	= '".$post['adquisicion_edit']. "' ";
			}
			
			$this->sql  .=" WHERE  id = ".$post['bien_id']."";
			#echo $this->sql; exit;

			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( );
			
			
			return json_encode( array('estado'=>'success','message'=>'SE A ACTUALIZADO EL BIEN DE MANERA EXITOSA.') );
		} catch (Exception $e) {
			return json_encode( array('message' => $e->getMessage() ) );
		}
	}
	public function asignarBien($post)
	{
		try {
			#print_r( $post );die();
			if ( !empty($post['servidor_id']) && !empty($post['bien_id_asigna'])) {
				$this->sql = "
					INSERT INTO asignacion (personal_id,bien_id,status,tipo,area_id) VALUES (?,?,?,?,?);
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(
					array( $post['servidor_id'],$post['bien_id_asigna'],1,$post['tipo'],$post['area'] )
				);
				return json_encode( array( 'message' => 'success' ) );
			} else {
				return json_encode( array( 'message' => 'Error verificar los campos' ) );
			}
			
			
		} catch (Exception $e) {
			return json_encode( array('message' => $e->getMessage() ) );
		}
	}

	public function getArea($term)
	{
		try {
			$criterio = "'%".$term."%'";
			
			$this->sql = " SELECT id, nombre AS value FROM area WHERE nombre LIKE ".$criterio;
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message' => $e->getMessage() ) );
		}
	}

	public function getIDPerson($fullName)
	{
		try {
			$criterio = "'%".$fullName."%'";
			
			$this->sql = " SELECT * FROM personal WHERE CONCAT(nombre,' ',ap_pat,' ',ap_mat) LIKE ".$criterio."";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetch( PDO::FETCH_OBJ );
			return $this->result->id ;
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function autocompleteBienes()
	{
		try {

			$criterio = "'%".$_REQUEST['term']."%'";
			
			$this->sql = " SELECT id, CONCAT('Serie: ',serie,' Inventario: ',inventario) AS value FROM  bienes WHERE serie LIKE $criterio OR inventario LIKE $criterio ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			if ( $this->stmt->rowCount() > 0 ) {
				return json_encode($this->result);
			}else{
				return json_encode(array('id'=>'0','value'=>'SIN COINCIDENCIAS'));
			}
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function autocompleteRefacciones()
	{
		try {

			$criterio = "'%".$_REQUEST['term']."%'";
			
			$this->sql = " SELECT id, CONCAT('Serie: ',serie,' Inventario: ',inventario) AS value FROM  refacciones WHERE serie LIKE $criterio OR inventario LIKE $criterio ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			if ( $this->stmt->rowCount() > 0 ) {
				return json_encode($this->result);
			}else{
				return json_encode(array('SIN COINCIDENCIAS'));
			}
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message' => $e->getMessage() ) );
		}
	}
	
}
?>
