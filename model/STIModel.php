<?php  
require_once 'conection.php';
require_once 'anexgrid.php';
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "es_ES");
class STIModel extends Conection
{
	protected $sql;
	protected $stmt;
	public $result;
	public function getInventarios($term)
	{
		try {
			if ( substr($term, 0,1) != ' ' ) {
				$term = "%$term%";
				$this->sql = " SELECT id, CONCAT('Serie: ',serie,' Inventario: ',inventario) AS value FROM bienes WHERE serie LIKE ? OR inventario LIKE ? ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$term);
				$this->stmt->bindParam(2,$term);
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode($this->result) ;
			} else {
				return json_encode( array('message'=>'No se aceptan espacios al inicio de la serie/inventario. ') ) ;
			}
			
			
		} catch (Exception $e) {
			return json_encode( array('error'=>$e->getMessage()) );
		}
	}
	public function searchAsignacion($id)
	{

		try {
			$this->sql = "
			SELECT 
				a.id AS asignacion_id ,
				a.personal_id, 
				CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS full_name,
				a.vigencia
			FROM asignacion AS a
			INNER JOIN personal AS p
			ON p.id = a.personal_id
			WHERE a.bien_id = ? AND a.status = 1
			LIMIT 1
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($id));
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>'Ocurrio un error al solicitar la asignacion, desde STI.'));
		}
	}
	public function saveBien($post)
	{
		
		try {
			$desc 	= mb_strtoupper($post['descripcion']);
			$inv 	= mb_strtoupper($post['inventario']);
			$serie 	= mb_strtoupper($post['serie']);
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
				ubicacion
			)  VALUES ('',?,?,?,?,?,?,?,?,?,?,'',NOW(),'','',NULL,'','',4) ";
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
			$this->stmt->execute();

			#recuperar el  bien
			$this->sql = "SELECT MAX(id) AS ultimo FROM bienes";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$ultimo = $this->stmt->fetch(PDO::FETCH_OBJ);
			
			#Insertar la asignacion
			$this->sql = "INSERT INTO asignacion(id,personal_id,bien_id,status,vigencia,tipo,fecha)
			VALUES ('',?,?,1,?,1,NOW());";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($post['servidor_id'],$ultimo->ultimo,$post['t_asigna']));

			$this->result = array('message' => 'success' );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('message' => $e->getMessage()  );
		}
	}
	public function getAreas()
	{
		try {
			$this->sql = "SELECT * FROM area";
			$this->stmt= $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result=$this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>'Ocurrio un error al consultar las areas'));
		}
	}
	public function getPersonal()
	{
		try {
			$this->sql = "SELECT id,CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS full_name FROM personal";
			$this->stmt= $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result= $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>'Ocurrio un error al consultar las areas'));
		}
	}
	public function AllPersonal()
	{
		try {
			$this->sql = "
			SELECT
			    p.id,
			    CONCAT(p.nombre, ' ', p.ap_pat, ' ', p.ap_mat) AS full_name,
			    concat(a.nombre,'<br>',a.codigo_uni) AS area
			FROM
			    personal AS p
			INNER JOIN area AS a
			ON
			    a.id = p.area_id";
			$this->stmt= $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result= $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>'Ocurrio un error al consultar las areas'));
		}
	}
	public function savePerson($post)
	{
		try {
			#verificar que el usuario no a sido  dado de alta
			$this->sql = "SELECT COUNT(id) AS cuenta FROM personal WHERE clave = ?";
			$this->stmt= $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($post['clave']));
			$alta= $this->stmt->fetch(PDO::FETCH_OBJ);
			if ( $alta->cuenta >=1 ) {
				throw new Exception('El usuario y se encuentra registrado');
			} else {
				 
				if ( !empty($post['name']) ) {
					$name = mb_strtoupper( $post['name'],'UTF-8' );
				}else{
					throw new Exception('El nombre es requerido')	;
				}
				if ( !empty($post['ap_pat']) ) {
					$ap_pat = mb_strtoupper( $post['ap_pat'],'UTF-8' );
				}else{
					throw new Exception('El primer apellido es requerido')	;
				}
				if ( !empty($post['ap_mat']) ) {
					$ap_mat = mb_strtoupper( $post['ap_mat'],'UTF-8' );
				}else{
					throw new Exception('El segundo apellido es requerido')	;
				}
				
				$this->sql = "INSERT INTO personal (id,nombre,ap_pat,ap_mat,clave,area_id,status,genero)
				VALUES('',?,?,?,?,?,?,?);";
				$this->stmt= $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($name,$ap_pat,$ap_mat,$post['clave'],$post['select_area'],$post['sexo'],$post['estado']));
				return json_encode(array('estado'=>'success','message'=>'El servidor público a sido dado de alta exitosamente.'));
			}
			#return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getPuestos($id)
	{
		try {
			$this->sql = "SELECT * FROM puestos WHERE personal_id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function savePuestos($post)
	{
		try {
			$person 	= $post['persona'];
			$puesto 	= $post['tipo_puesto'];
			if ( $puesto == 2 ) 
			{
				$name_puesto = "%".$post['name_puesto']."%";
			}else{
				$name_puesto = "%"."ENCARGADO DE ".$post['encargado']."%";
			}
			$this->sql 	= "SELECT * FROM puestos WHERE personal_id = ? AND nombre LIKE ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($person,$name_puesto));
			$no_filas 	= $this->stmt->rowCount();
			
			if ($no_filas == 0 ) {
				if ( $puesto == 2 ) 
				{
					$name_puesto = $post['name_puesto'];
				}else{
					$name_puesto = "ENCARGADO DE ".$post['encargado'];
				}
				$this->sql = "INSERT INTO puestos (id,nombre,personal_id ) VALUES ('',?,?) ";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($name_puesto,$person));
				return json_encode(array('estado'=>'success','message'=>'Puesto guardado correctamente'));
			}else{
				throw new Exception("Este puesto ya lo tiene asignado el Usuario", 1);
			}
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function searchPuestos($id)
	{
		try {
			$this->sql = "SELECT * FROM puestos WHERE personal_id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function del_puesto($id)
	{
		try {
			$this->sql = "DELETE FROM puestos WHERE id= ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			
			return json_encode(array('estado'=>'success','message'=>'Registro eliminado exitosamente'));
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function buscar_bienes_personal($post)
	{
		try {
			$persona = $post['select_personal'];
			$this->sql = "SELECT * FROM asignacion WHERE personal_id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($persona));
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
			#return json_encode(array('estado'=>'success','message'=>'Registro eliminado exitosamente'));
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	public function createBaja($post)
	{
		try {
			$tipo = $post['tipo_b'];
			$bien = $post['bien_id'];
			$comentario = mb_strtoupper($post['comentario'],'UTF-8');
			#Quitar las asignaciones del bien 
			$this->sql = "UPDATE asignacion SET status = 2 WHERE bien_id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($bien));
			#Insertar la baja
			$this->sql = "INSERT INTO bajas(id,bien_id,tipo,comentario,archivo,fecha) VALUES ('',?,?,?,NULL,NULL)";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($bien,$tipo,$comentario));
			return json_encode( array( 'estado'=>'success','message'=>'EL BIEN YA SE DIO DE BAJA' ) );
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function addGarantia($post)
	{
		try {
			$pro 	= $post['proveedor'];
			$f_ini 	= $post['f_solicitud'];
			$f_fin 	= $post['f_fin'];
			#Insertar la garantia
			$this->sql = "INSERT INTO garantias(id,proveedor_id,f_inicio,f_termino) VALUES ('',?,?,?)";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($pro,$f_ini,$f_fin));
			return json_encode(array('estado'=>'success','message'=>'GARANTIA ALMACENADA CON CORRECTAMENTE' ));
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	public function sinReparacionExt()
	{
		try {
			#Buscar los bienes que necesitan ir con proveedor segun soporte tecnico
			$this->sql = "SELECT solucion_id FROM reparaciones WHERE t_repa = 2 AND estatus = 1 AND solucion_id IS NOT NULL";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$soluciones = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			foreach ($soluciones as $key => $solucion) {
				array_push($aux,$solucion->solucion_id);
			}
			$soluciones =implode(',',$aux);
			#Buscar los bienes afectados 
			$this->sql = "SELECT tbien_id FROM soluciones WHERE id IN ($soluciones)";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$bienes = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			foreach ($bienes as $key => $bien) {
				array_push($aux,$bien->tbien_id);
			}
			$bienes = implode(',',$aux);
			#BUSCAR LAS CARACTERISTICAS DE LOS BIENES
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			
			WHERE
			    b.id IN($bienes)
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$equipos = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($equipos);
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	public function bienes_c_refa()
	{
		try {
			#Buscar los bienes que necesitan ir con proveedor segun soporte tecnico
			$this->sql = "SELECT bien_id FROM asigna_refaccion WHERE estatus = 1";

			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$bienes = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			if ( count($bienes) <= 0  ) {
				return json_encode(array('estado' =>'error' ,'message'=>'No encontramos bienes con refacciones' ));
				die();
			}

			$aux = array();
			foreach ($bienes as $key => $bien) {
				array_push($aux,$bien->bien_id);
			}
			$bienes =implode(',',$aux);
			#BUSCAR LAS CARACTERISTICAS DE LOS BIENES
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE
			    b.id IN($bienes)
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$equipos = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($equipos);
		} catch (Exception $e) {
			json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	#FUNCION PARA BUSCAR LAS REFACCIONES DE UN BIEN
	public function searchRefacciones($post)
	{
		try {
			#Buscar los IDs de las refacciones
			$this->sql = "SELECT refaccion_id FROM asigna_refaccion WHERE bien_id = ? AND estatus = 1;";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($post['bien']));
			$refacciones = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			foreach ($refacciones as $key => $refaccion) {
				array_push($aux,$refaccion->refaccion_id);
			}
			$refacciones =implode(',',$aux);

			#Buscar en la tabla de bienes
			$this->sql = "
			SELECT
			    ar.id AS ref,
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			LEFT JOIN asigna_refaccion AS ar
			ON
			    ar.estatus = 1 AND ar.refaccion_id = b.id
			WHERE
			    b.id IN($refacciones)
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			return json_encode($this->result);
		} catch (Exception $e) {
			return json_decode(array('estado'=>'error','message'=>'Ocurrio un error al buscar las refacciones.'));
		}
	}

	public function delRefaccion($id)
	{
		try {
			$this->sql = "UPDATE asigna_refaccion SET estatus = 2 WHERE id = ? ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			
			return json_encode(array('estado'=>'success','message'=>'Registro eliminado exitosamente'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}
	public function searchBienBaja($criterio)
	{
		try {
			$busqueda  = "%$criterio%";
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE
			    b.serie LIKE ? OR b.inventario LIKE ?
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($busqueda,$busqueda));
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}

	public function bajaTemportal($id,$comment)
	{
		try {
			$this->sql = "INSERT INTO bajas (id,bien_id,tipo,comentario) VALUES ('',?,1,?)";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id,$comment));
			
			$this->sql = "UPDATE bienes SET status = 5 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			return json_encode(array('estado'=>'success','message'=>'El bien se dio de baja temporal con éxito.'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}

	public function bajaDefinitiva($id,$comment)
	{
		try {
			$this->sql = "INSERT INTO bajas (id,bien_id,tipo,comentario) VALUES ('',?,2,?)";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id,$comment));
			
			$this->sql = "UPDATE bienes SET status = 5 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));

			return json_encode(array('estado'=>'success','message'=>'Bien dado de baja definitiva con éxito.'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}

	#Obtener la lista de bienes dados de baja
	public function getBajas()
	{
		try {
			#RECUPERAR LOS IDs DE LOS BIENES DADOS DE BAJA 
			$this->sql = "SELECT bien_id FROM bajas";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$bienes_bajas = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			foreach ($bienes_bajas as $key => $baja) {
				array_push($aux,$baja->bien_id);
			}
			$bienes_bajas = implode(',',$aux);

			#BUSCAR LOS DATOS DE LAS BAJAS
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
			    ba.id AS baja_id,
			    ba.tipo AS t_baja,
			    ba.comentario
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
			LEFT JOIN bajas AS ba
			ON
			    ba.bien_id = b.id
			WHERE
			    b.id IN($bienes_bajas)
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	public function updateBajaDefinitiva($id)
	{
		try {
			
			$this->sql = "UPDATE bajas SET tipo = 2 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));

			return json_encode(array('estado'=>'success','message'=>'El bien cambio a baja definitiva con éxito.'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}

	public function listBienes()
	{
		try {
			
			$this->sql = "
			SELECT
			    b.id,
			    CONCAT('Serie: ',b.serie,' Inventario: ',b.inventario) AS claves			    
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
			LEFT JOIN asigna_refaccion AS ar
			ON
			    ar.estatus = 1 AND ar.bien_id = b.id
			WHERE
			    b.status != 5
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage));
		}
	}

	public function asignarRefaccion($post,$file)
	{
		try 
		{
			$doc = $file['archivo'];
			$bien_id = $post['bien'];
			$refa_id = $post['refaccion'];
			$observaciones = $post['observaciones'];

			if ( $post['bien'] == $post['refaccion'] ) {
				throw new Exception("El bien y la refaccion deben de ser diferentes", 1);
			}
			
			# Si existe el archivo
			if ( $doc['error'] == 0 ) {
				#Revisar el tamaño del archivo 
				if ( $doc['size'] > 10485760 ) {
					throw new Exception("El archivo excede el tamaño admitido (10MB).", 1);
				}
				else
				{
					#verificar que sea del formato correcto
					if ( $doc['type'] == 'application/pdf') {
						$doc_name = $doc['name'];
						$doc_type = $doc['type'];
						$doc_size = $doc['size'];
						$destino = $_SERVER['DOCUMENT_ROOT'].'/ST/uploads/';
						
						#MOver el Doc
						move_uploaded_file($doc['tmp_name'],$destino.$doc_name);

						
						#abrir el archivo
						$file 		= fopen($destino.$doc_name,'r');
						$content 	= fread($file, $doc_size);
						$content = addslashes($content);
						fclose($file);

						#Eliminar  el archivo 
						unlink($_SERVER['DOCUMENT_ROOT'].'/ST/uploads/'.$doc_name);

						$this->sql = "
						INSERT INTO asigna_refaccion (
							id,
							bien_id,
							refaccion_id,
							f_asigna,
							observaciones,
							estatus,
							doc
						) 
						VALUES 
						(
							'',
							?,
							?,
							NOW(),
							?,
							1,
							?
						)";
						$this->stmt = $this->pdo->prepare($this->sql);
						$this->stmt->bindParam(1,$bien_id);
						$this->stmt->bindParam(2,$refa_id);
						$this->stmt->bindParam(3,$observaciones);
						$this->stmt->bindParam(4,$content, PDO::PARAM_LOB);
						$this->stmt->execute();
						return json_encode(
							array('estado'=>'success','message'=>'Refacción asignada exitosamente.')
						);
						
					} else {
						throw new Exception("El archivo no es del tipo admitido", 1);
					}
				}			
			} else {
				$this->sql = "
				INSERT INTO asigna_refaccion (
					id,
					bien_id,
					refaccion_id,
					f_asigna,
					observaciones,
					estatus,
					doc
				) 
				VALUES 
				(
					'',
					?,
					?,
					NOW(),
					?,
					1,
					NULL
				)";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->bindParam(1,$bien_id);
				$this->stmt->bindParam(2,$refa_id);
				$this->stmt->bindParam(3,$observaciones);
				
				$this->stmt->execute();
				return json_encode(
					array('estado'=>'success','message'=>'Refacción asignada exitosamente.')
				);
			}
			
		} catch (Exception $e) {
			return json_encode( array('estado'=>'estado','message'=>$e->getMessage() ) );
		}
	}

	public function saveReparaExterna($post,$files)
	{
		try {
			if ( $files['formato']['error'] == 0 ) 
			{
				$doc = $files['formato'];
				#Revisar el tamaño del archivo 
				if ( $doc['size'] > 10485760 ) {
					throw new Exception("El archivo excede el tamaño admitido (10MB).", 1);
				}
				if ( $doc['type'] == 'application/pdf')
				{
					#print_r($post);die();
					$doc_name = $doc['name'];
					$doc_type = $doc['type'];
					$doc_size = $doc['size'];
					$destino = $_SERVER['DOCUMENT_ROOT'].'/ST/uploads/';
					#MOver el Doc
					move_uploaded_file($doc['tmp_name'],$destino.$doc_name);
					#abrir el archivo
					$file 		= fopen($destino.$doc_name,'r');
					$content 	= fread($file, $doc_size);
					$content 	= addslashes($content);
					fclose($file);

					#Eliminar  el archivo 
					unlink($_SERVER['DOCUMENT_ROOT'].'/ST/uploads/'.$doc_name);
					
					$obs = mb_strtoupper($post['comentarios'],'UTF-8');

					$this->sql = "
					INSERT INTO repa_externa (
						id,
						bien_id,
						reporte_id,
						f_solicitud,
						f_reparacion,
						reporte,
						reporto,
						garantia,
						estatus,
						observaciones,
						tipo
					) 
					VALUES 
					(
						'',
						:bien,
						:reporte_id,
						:f_sol,
						:f_rep,
						:reporte_proveedor,
						:person_st,
						:garantia,
						1,
						:obs,
						:tipo
					)";

					$this->stmt = $this->pdo->prepare($this->sql);

					$this->stmt->bindParam(':bien',$post['externo_bien_id']);
					$this->stmt->bindParam(':reporte_id',$post['reporte_st']);
					$this->stmt->bindParam(':f_sol',$post['f_sol']);
					$this->stmt->bindParam(':f_rep',$post['f_repara']);
					$this->stmt->bindParam(':reporte_proveedor',$post['n_reporte']);
					$this->stmt->bindParam(':person_st',$post['servidor_id']);
					$this->stmt->bindParam(':garantia',$post['proveedor_garantia']);
					
					$this->stmt->bindParam(':obs',$obs);
					$this->stmt->bindParam(':tipo',$post['tipo_g']);
					$this->stmt->execute();

					#Recuperar la reparacion insertada.
					$this->sql = "
					SELECT MAX(id) AS ultimo FROM repa_externa ";
					$this->stmt = $this->pdo->prepare($this->sql);
					$this->stmt->execute();
					$ultimo_reporte = $this->stmt->fetch(PDO::FETCH_OBJ);

					#Actualizar el estatus de la reparacion

					$this->sql = "UPDATE reparaciones SET estatus = 6 WHERE id = ?"; 
					$this->stmt = $this->pdo->prepare($this->sql);
					$this->stmt->bindParam(1,$post['reporte_st']);
					$this->stmt->execute();

					

					#Insertar el documento de la reparacion
					$this->sql = "
					INSERT INTO docs_rep (
						id,
						reparacion_id,
						doc,
						fecha,
						t_doc
					) 
					VALUES 
					(
						'',
						:reporte,
						:doc,
						NOW(),
						:t_doc
					)";
					$this->stmt = $this->pdo->prepare($this->sql);

					$this->stmt->bindParam(':reporte',$ultimo_reporte->ultimo,PDO::PARAM_INT);
					$this->stmt->bindParam(':doc',$content, PDO::PARAM_LOB);
					$this->stmt->bindParam(':t_doc',$post['tipo_formato']);
					$this->stmt->execute();

					#salida
					return json_encode(array('estado'=>'success','message'=>'PROCESO DE REPARACIÓN EXTERA EXITOSO Y DOCUMENTO ALMACENADO DE MANERA CORRECTA. RECUERDE DARLE SEGUIMIENTO.'));
				}
			} 
			else 
			{
				$this->sql = "
				INSERT INTO repa_externa (
					id,
					bien_id,
					reporte_id,
					f_solicitud,
					f_reparacion,
					reporte,
					reporto,
					garantia,
					estatus,
					observaciones,
					tipo
				) 
				VALUES 
				(
					'',
					:bien,
					:reporte_id,
					:f_sol,
					:f_rep,
					:reporte_proveedor,

					:person_st,
					:garantia,
					1,
					:obs,
					:tipo
				)";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->bindParam(':bien',$post['externo_bien_id']);
				$this->stmt->bindParam(':reporte_id',$post['reporte_st']);
				$this->stmt->bindParam(':f_sol',$post['f_sol']);
				$this->stmt->bindParam(':f_rep',$post['f_repara']);
				$this->stmt->bindParam(':reporte_proveedor',$post['n_reporte']);
				
				$this->stmt->bindParam(':person_st',$post['servidor_id']);
				$this->stmt->bindParam(':garantia',$post['proveedor_garantia']);
				
				$this->stmt->bindParam(':obs',$post['comentarios']);
				$this->stmt->bindParam(':tipo',$post['tipo_g']);
				$this->stmt->execute();

				#Actualizar el estatus de la reparacion

				$this->sql = "UPDATE reparaciones SET estatus = 6 WHERE id = ?"; 
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->bindParam(1,$post['reporte_st']);
				$this->stmt->execute();

				#salida
				return json_encode(array('estado'=>'success','message'=>'PROCESO DE REPARACIÓN EXTERA EXITOSO SIN DOCUMENTO ADJUNTO. RECUERDE DARLE SEGUIMIENTO.'));

			}
			
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message'=>$e->getMessage() ) );
		}
	}

	public function proveedorGarantias()
	{
		try {
			$this->sql = "
			SELECT
			    g.id,
			    p.nombre
			FROM
			    garantias AS g
			INNER JOIN proveedores AS p
			ON
			    g.proveedor_id = p.id
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('estado' => 'error','message'=>$e->getMessage() ));
		}
	}

	public function reparacionesActivas()
	{
		try {
			$this->sql = "
			SELECT bien_id FROM repa_externa
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$bienes = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$aux = array();
			foreach ($bienes as $key => $bien) {
				array_push($aux,$bien->bien_id);
			}
			$bienes = implode(',',$aux);
			#Buscar los bienes 
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
			    re.id AS id_re,
			    re.f_solicitud,
		        re.f_reparacion,
		        re.reporte,
		        re.estatus,
		        re.observaciones,
		        re.tipo
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
			LEFT JOIN repa_externa AS re
			ON
			    re.bien_id = b.id
			WHERE
			    b.id IN($bienes) AND re.estatus = 1
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
			
		} catch (Exception $e) {
			return json_encode(array('estado' => 'error','message'=>$e->getMessage() ));
		}
	}

	#metodo de carga de PDF
	public function adjuntarDoc ($post,$files)
	{
		try {
			$rep_id = $post['repa_ext'];
			$t_doc 	= $post['tipo_formato'];
			$doc 	= $files['archivo'];
			#Revisar el tamaño del archivo 
			if ( $doc['size'] > 10485760 ) {
				throw new Exception("El archivo excede el tamaño admitido (10MB).", 1);
			}
			if ($doc['type'] == 'application/pdf') 
			{
				$doc_name = $doc['name'];
				$doc_type = $doc['type'];
				$doc_size = $doc['size'];
				$destino = $_SERVER['DOCUMENT_ROOT'].'/ST/uploads/';
				#MOver el Doc
				move_uploaded_file($doc['tmp_name'],$destino.$doc_name);
				#abrir el archivo
				$file 		= fopen($destino.$doc_name,'r');
				$content 	= fread($file, $doc_size);
				$content 	= addslashes($content);
				fclose($file);

				#Eliminar  el archivo 
				unlink($_SERVER['DOCUMENT_ROOT'].'/ST/uploads/'.$doc_name);
				
				$obs = mb_strtoupper($post['comentario'],'UTF-8');
				$this->sql = "INSERT INTO docs_rep (id,reparacion_id,doc,fecha,t_doc) 
				VALUES ('',?,?,NOW(),?);";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute( array($rep_id,$content,$t_doc) );
				$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
				return json_encode( array('estado'=>'success','message'=>'EL DOCUMENTO SE GUARDO CON ÉXITO.') );
			}
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error', 'message'=>$e->getMessage() ));
		}
	}

	public function generateBajaDefinitiva($post,$files)
	{
		try {
			$comentario = mb_strtoupper($post['observaciones'],'UTF-8');
			$baja = $post['baja_id'];
			$doc 	= $files['file_baja'];
			#Revisar el tamaño del archivo 
			if ( $doc['size'] > 10485760 ) {
				throw new Exception("El archivo excede el tamaño admitido (10MB).", 1);
			}
			if ($doc['type'] == 'application/pdf') 
			{
				$doc_name = $doc['name'];
				$doc_type = $doc['type'];
				$doc_size = $doc['size'];
				$destino = $_SERVER['DOCUMENT_ROOT'].'/ST/uploads/';
				#MOver el Doc
				move_uploaded_file($doc['tmp_name'],$destino.$doc_name);
				#abrir el archivo
				$file 		= fopen($destino.$doc_name,'r');
				$content 	= fread($file, $doc_size);
				$content 	= addslashes($content);
				fclose($file);

				#Eliminar  el archivo 
				unlink($_SERVER['DOCUMENT_ROOT'].'/ST/uploads/'.$doc_name);
				
				$this->sql = "UPDATE bajas SET tipo = 2, comentario = ?, archivo=?,fecha = NOW() WHERE id=?";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute( array($comentario,$content,$baja) );
				return json_encode( array('estado'=>'success','message'=>'BAJA DEFINITIVA GUARDADA') );	
			}
			
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message'=>$e->getMessage()) );
		}
	}

	public function getSeries($t)
	{
		try {
			$criterio = "'%".$t."%'";
			
			$this->sql = " SELECT id,serie AS value FROM bienes WHERE serie LIKE ".$criterio;
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function getInventario($t)
	{
		try {
			$criterio = "'%".$t."%'";
			
			$this->sql = " SELECT id,inventario AS value FROM bienes WHERE inventario LIKE ".$criterio;
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}

	public function reporteEquipo($post)
	{
		try {
			$serie = $post['serie_id'];
			$inventario = $post['inventario_id'];
			$t_bien = $post['tipo'];
			
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE 
			1=1 
			";
			#complementar el Query 
			if ( !empty($post['serie']) ) {
				$this->sql.=" AND b.serie = '".$post['serie']."'";
			}
			if ( !empty($post['inventario']) ) {
				$this->sql.=" AND b.inventario = '".$post['inventario']."'";
			}

			if ( !empty($post['tipo']) ) {
				$this->sql.=" AND b.tipo_id = '".$post['tipo']."'";
			}

			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}

	public function reporteUser($post)
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE 
			1=1 
			";
			#complementar el Query 
			if ( !empty($post['servidor_id']) ) {
				$this->sql.=" AND pe.id = '".$post['servidor_id']."'";
			}
			if ( !empty($post['inventario']) ) {
				$this->sql.=" AND pe.area_id = '".$post['select_area']."'";
			}

			if ( !empty($post['genero']) ) {
				$this->sql.=" AND pe.genero = '".$post['genero']."'";
			}
			
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode($this->result) ;

		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
	public function reporteFalla($post)
	{
		try {
			#print_r($post);die();
			#buscar los bienes que tienen la falla seleccionada
			$this->sql = "SELECT solucion_id FROM reparaciones WHERE falla_id = ? ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($post['fallas']));
			$fallantes = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			foreach ($fallantes as $key => $falta) {
				if (!empty($falta->solucion_id) && $falta->solucion_id != NULL) {
					array_push($aux,$falta->solucion_id);
				}
				
			}
			$fallantes =implode(',',$aux);
			
			#Buscar los bienes en la tabla de soluciones
			$this->sql = "SELECT tbien_id, COUNT(tbien_id) AS cuenta FROM soluciones WHERE id IN ($fallantes) GROUP BY tbien_id; ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$bienes = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			#
			$aux = array();
			foreach ($bienes as $key => $bien) {
				#print_r($bien->tbien_id);echo'<br>';
				array_push($aux,$bien->tbien_id);#
			}
			$bienes =implode(',',$aux);
			#recuperar la info de los bienes 
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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE
			b.id IN ($bienes)
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			$this->result = array('estado'=>'error','message' => $e->getMessage()  );
		}
	}

	public function xlsAsignacion($post)
	{
		try {
			$person = $post['servidor_id'];
			$this->sql = "SELECT bien_id FROM asignacion WHERE personal_id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($person));
			$bienes = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			$aux = array();
			foreach ($bienes as $key => $bien) {
				array_push($aux,$bien->bien_id);
			}
			$bienes =implode(',',$aux);

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
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			WHERE
			    b.id IN($bienes)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($person));
			$result = $this->stmt->fetchAll( PDO::FETCH_OBJ );

			return json_encode($result) ;
		} catch (Exception $e) {
			$this->result = array('estado' =>'error','message'=> $e->getMessage()  );
		}
	}

	public function repararEquipo($re)
	{
		try {
			#recuperar el id de la reparacion 
			$this->sql = "SELECT reporte_id FROM repa_externa WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($re));
			$reparacion_id = $this->stmt->fetch(PDO::FETCH_OBJ);
			$reparacion_id = $reparacion_id->reporte_id;
			#actualizar el estatus de la reparacion externa
			$this->sql = "UPDATE repa_externa SET estatus = 2 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($re));
			#actualizar el estatus de la tabla reparaciones
			$this->sql = "UPDATE reparaciones SET estatus = 7 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($reparacion_id));
			return json_encode(array('estado'=>'success','message'=>'Equipo reparado exitosamente'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function reasignarBien()
	{
		try {
			if (!isset($_POST['bien_id']) || empty($_POST['bien_id'])) {
				throw new Exception("NO SE PUDO SELECCIONAR EL BIEN.", 1);
			}
			if (!isset($_POST['sp_h']) || empty($_POST['sp_h'])) {
				throw new Exception("NO SELECCIONO EL NOMBRE DEL SERVIDOR PÚBLICO.", 1);
			}
			if (!isset($_POST['areas_h']) || empty($_POST['areas_h'])) {
				throw new Exception("NO SELECCIONO UN ÁREA", 1);
			}
			if (!isset($_POST['t_asigna']) || empty($_POST['t_asigna'])) {
				throw new Exception("HAY UN PROBLEMA CON EL TIPO DE ASIGNACIÓN", 1);
			}
			
			$bien 	= $_POST['bien_id'];
			$sp 	= $_POST['sp_h'];
			$area 	= $_POST['areas_h'];
			$asigna = $_POST['t_asigna'];
			#DESHABILITAR TODAS LAS ASIGNACIONES ACTIVAS 
			$this->sql = "UPDATE asignacion SET status = 2 WHERE bien_id = ? ;";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$bien);
			$this->stmt->execute();
			#INSERTAR LA NUEVA ASIGNACION
			$this->sql = "INSERT INTO asignacion (id,personal_id,bien_id,area_id,status,vigencia,tipo,fecha) 
			VALUES (
				'',
				?,
				?,
				?,
				1,
				?,
				2,
				NOW()
			);";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$sp);
			$this->stmt->bindParam(2,$bien);
			$this->stmt->bindParam(3,$area);
			$this->stmt->bindParam(4,$asigna);
			$this->stmt->execute();
			return json_encode(array('estado'=>'success','message'=>'Equipo Reasignado Exitosamente'));
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}

	public function saveAsignarRefaccion()
	{
		try {
			if ( empty($_POST['sp_id']) ) {
				throw new Exception("NO SE SELECCIONO NINGUN NOMBRE DE SERVIDOR PÚBLICO.", 1);
			}
			if ( empty($_POST['bien_id']) ) {
				throw new Exception("NO SE SELECCIONO NINGUN BIEN.", 1);
			}
			if ( empty($_POST['refaccion_id']) ) {
				throw new Exception("NO SE SELECCIONO NINGUNA REFACCIÓN.", 1);
			}
			if ( empty($_POST['f_asigna']) ) {
				throw new Exception("NO SE SELECCIONO FECHA DE ASIGNACIÓN.", 1);
			}
			
			$this->sql = "INSERT INTO asigna_refaccion(id,bien_id,refaccion_id,f_asigna,asignadoa) 
			VALUES
			(
				'',?,?,?,?
			)";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['bien_id']);
			$this->stmt->bindParam(2,$_POST['refaccion_id']);
			$this->stmt->bindParam(3,$_POST['f_asigna']);
			$this->stmt->bindParam(4,$_POST['sp_id']);
			$this->stmt->execute();
			#############################################################################
			$this->sql = "UPDATE refacciones SET asignacion = 2 WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$_POST['refaccion_id']);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message' => 'REFACCIÓN ASIGNADA DE MANERA EXITOSA' ));
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function saveRefaccion()
	{
		try {
			$desc = mb_strtoupper($_POST['descripcion'],'utf-8');		
			$this->sql = "INSERT INTO refacciones(
				id, 
				grupo, 
				tipo_b, 
				material, 
				estado, 
				marca, 
				modelo, 
				inventario, 
				serie, 
				descripcion, 
				asignacion
			) 
			VALUES
			(
				'', 
				?, 
				?, 
				?, 
				?, 
				?, 
				?, 
				?, 
				?, 
				?,
				1
			)";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['grupo']);
			$this->stmt->bindParam(2,$_POST['t_bien']);
			$this->stmt->bindParam(3,$_POST['material']);
			$this->stmt->bindParam(4,$_POST['estado']);
			$this->stmt->bindParam(5,$_POST['marca']);
			$this->stmt->bindParam(6,$_POST['modelo']);
			$this->stmt->bindParam(7,$_POST['inventario']);
			$this->stmt->bindParam(8,$_POST['serie']);
			$this->stmt->bindParam(9,$desc);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message' => 'REFACCIÓN REGISTRADA DE MANERA EXITOSA' ));
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getRefacciones()
	{
		try {
			$anexGrid = new AnexGrid();
			$wh = "";
			foreach($anexGrid->filtros as $f)
			{
				if($f['columna'] != ''){
					if ( $f['columna'] == 'inventario' || $f['columna'] == 'serie' ) {
						$wh .= " AND ".$f['columna']." LIKE '%".$f['valor']."%' ";	
					}else{
						$wh .= " AND ".$f['columna']." = ".$f['valor'];
					}
					
				}
			}	
			$this->sql = "
			SELECT r.id, g.nombre AS grupo,tb.nombre AS tipo_b, m.nombre AS material, r.estado, ma.nombre AS marca,mo.nombre AS modelo, r.inventario, r.serie, r.descripcion, r.asignacion FROM refacciones AS r 
			INNER JOIN grupos AS g ON g.id = r.grupo
			INNER JOIN t_bienes AS tb ON tb.id = r.tipo_b
			INNER JOIN materiales AS m ON m.id = r.material
			INNER JOIN marcas AS ma ON ma.id = r.marca
			INNER JOIN modelos AS mo ON mo.id = r.modelo  
			WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$this->sql = "SELECT COUNT(*) as Total FROM refacciones WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			return $anexGrid->responde($this->result, $total);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getAsignaRef()
	{
		try {
			$ref = $_POST['ref'];
			$this->sql = "
				SELECT a.f_asigna, m.nombre as marca,t.nombre as tipo,CONCAT('Serie: ',b.serie,' Inventario: ',b.inventario ) AS claves,
				CONCAT('Serie: ', r.serie,' Inventario: ',r.inventario) AS refac,
				CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS asignado 
				FROM asigna_refaccion AS a
				INNER JOIN bienes AS b ON b.id = a.bien_id
				INNER JOIN marcas AS m ON m.id = b.marca_id
				INNER JOIN t_bienes AS t ON t.id = b.tipo_id
				INNER JOIN refacciones AS r ON r.id = a.refaccion_id
				INNER JOIN personal AS p ON p.id = a.asignadoa
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getRExternas()
	{
		try {
			$anexGrid = new AnexGrid();
			$wh = "";
			foreach($anexGrid->filtros as $f)
			{
				if($f['columna'] != ''){
					if ( $f['columna'] == 'inventario' || $f['columna'] == 'serie' ) {
						$wh .= " AND ".$f['columna']." LIKE '%".$f['valor']."%' ";	
					}
				}
			}
			$this->sql = "
			SELECT
			    r.id,
			    r.ticket_id,
			    r.afectado_id,
			    r.solucionador_id,
			    r.solucion_id,
			    r.t_repa,
			    r.estatus,
			    r.rubro_id,
			    r.falla_id,
                s.fecha AS f_sol,
                s.desc_solucion,
                b.serie,
                b.inventario,
                m.nombre AS marca,
                g.nombre AS grupo,
                tb.nombre AS tipo_bien,
                CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS afectado,
                CONCAT(pe.nombre,' ',pe.ap_pat,' ',pe.ap_mat) AS solucionador
			FROM
			    reparaciones AS r
			INNER JOIN soluciones AS s 	ON s.id = r.solucion_id
			INNER JOIN bienes 	AS b 	ON b.id = s.tbien_id 
			INNER JOIN marcas 	AS m 	ON m.id = b.marca_id  
			INNER JOIN grupos 	AS g 	ON g.id = b.grupo_id
			INNER JOIN t_bienes AS tb 	ON tb.id = b.tipo_id
			INNER JOIN personal AS p 	ON p.id = r.afectado_id
			INNER JOIN personal AS pe 	ON pe.id = r.solucionador_id
			
			WHERE r.t_repa = 2
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);

			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$this->sql = "SELECT COUNT(*) as Total FROM reparaciones WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			return $anexGrid->responde($this->result, $total);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getRExternasByDoc()
	{
		try {
			$anexGrid = new AnexGrid();
			$wh = "";
			$doc = $anexGrid->parametros[1]['d'];
			
			$this->sql = "
			SELECT r_externa FROM servicio_docs WHERE documento = $doc GROUP BY r_externa
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array( );
			foreach ($this->result as $key => $r) {
				array_push($aux,$r->r_externa);
			}
			$aux 	= implode(',',$aux);
			$this->sql = "
			SELECT
			    r.id,
			    r.ticket_id,
			    r.afectado_id,
			    r.solucionador_id,
			    r.solucion_id,
			    r.t_repa,
			    r.estatus,
			    r.rubro_id,
			    r.falla_id,
                s.fecha AS f_sol,
                s.desc_solucion,
                b.serie,
                b.inventario,
                m.nombre AS marca,
                g.nombre AS grupo,
                tb.nombre AS tipo_bien,
                CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS afectado,
                CONCAT(pe.nombre,' ',pe.ap_pat,' ',pe.ap_mat) AS solucionador
			FROM
			    reparaciones AS r
			INNER JOIN soluciones AS s 	ON s.id = r.solucion_id
			INNER JOIN bienes 	AS b 	ON b.id = s.tbien_id 
			INNER JOIN marcas 	AS m 	ON m.id = b.marca_id  
			INNER JOIN grupos 	AS g 	ON g.id = b.grupo_id
			INNER JOIN t_bienes AS tb 	ON tb.id = b.tipo_id
			INNER JOIN personal AS p 	ON p.id = r.afectado_id
			INNER JOIN personal AS pe 	ON pe.id = r.solucionador_id
			INNER JOIN repa_externa AS re 	ON re.id IN ($aux)
			WHERE r.t_repa = 2
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$this->sql = "SELECT COUNT(*) as Total FROM
			    reparaciones AS r
			INNER JOIN soluciones AS s 	ON s.id = r.solucion_id
			INNER JOIN bienes 	AS b 	ON b.id = s.tbien_id 
			INNER JOIN marcas 	AS m 	ON m.id = b.marca_id  
			INNER JOIN grupos 	AS g 	ON g.id = b.grupo_id
			INNER JOIN t_bienes AS tb 	ON tb.id = b.tipo_id
			INNER JOIN personal AS p 	ON p.id = r.afectado_id
			INNER JOIN personal AS pe 	ON pe.id = r.solucionador_id
			INNER JOIN repa_externa AS re 	ON re.id IN ($aux)
			WHERE r.t_repa = 2 ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			return $anexGrid->responde($this->result, $total);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}

	public function saveDoc()
	{
		try {
			session_start();
			#DATOS DEL POST 
			$tipo = $_POST['t_doc'];
			$nombre = $_POST['nombre'];
			$fecha = $_POST['fecha_doc'];
			$propietario = $_SESSION['person_id'];
			$observaciones = $_POST['observaciones'];
			#DATOS DEL FILES
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/ST/uploads/';
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL TAMAÑO DEL ARCHIVO EXCEDE EL LIMITE (10 MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf' ) 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO NO ES SOPORTADO", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "INSERT INTO carpeta_digital(
						id,
						tipo,
						formato, 
						nombre,
						fecha_doc, 
						propietario,
						observaciones, 
						created_at, 
						archivo
					) 
					VALUES(
					'',
					?,
					?,
					?,
					?,
					?,
					?,
					NOW(),
					?
					)";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$tipo,PDO::PARAM_STR);
					$this->stmt->bindParam(2,$type,PDO::PARAM_STR);
					$this->stmt->bindParam(3,$nombre,PDO::PARAM_STR);
					$this->stmt->bindParam(4,$fecha,PDO::PARAM_STR);
					$this->stmt->bindParam(5,$propietario,PDO::PARAM_STR);
					$this->stmt->bindParam(6,$observaciones,PDO::PARAM_INT);	
					$this->stmt->bindParam(7,$content,PDO::PARAM_LOB);			
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode( array('status'=>'success','message'=>'DOCUMENTO ALMACENADO DE MANERA EXITOSA.') );
				}
			}
			
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message' => 'DOCUMENTO ALMACENADO DE MANERA EXITOSA.') ) ;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getTipoDoc()
	{
		try {
			$this->sql = "SELECT * FROM tipo_docs";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result) ;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getDocumentos()
	{
		try {
			$anexGrid = new AnexGrid();
			$wh = "";

			foreach($anexGrid->filtros as $f)
			{
				if($f['columna'] != ''){
					if ($f['columna'] == 'fecha_doc') {
						$wh .= " AND cd.".$f['columna']." = '".$f['valor']."' ";
					}elseif( $f['columna'] == 'observaciones'){
						$wh .= " AND cd.".$f['columna']." LIKE '%".$f['valor']."%' ";
					}elseif( $f['columna'] == 'nombre'){
						$wh .= " AND cd.nombre LIKE '%".$f['valor']."%' ";
					}else{
						$wh .= " AND ".$f['columna']." LIKE '%".$f['valor']."%' ";
					}
					
				}
			}
			$this->sql = "SELECT cd.id, cd.tipo,UPPER(td.nombre) AS tipo_d, cd.formato, UPPER(cd.nombre) AS nombre, cd.fecha_doc, cd.propietario, UPPER(cd.observaciones) AS observaciones, cd.created_at FROM carpeta_digital AS cd
			INNER JOIN tipo_docs AS td ON td.id = cd.tipo
			WHERE 1=1 $wh";

			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

			$this->sql = "SELECT COUNT(cd.id) as Total FROM carpeta_digital AS cd
			INNER JOIN tipo_docs AS td ON td.id = cd.tipo
			WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			return $anexGrid->responde($this->result, $total);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getDocumento()
	{
		try {
			$id = $_POST['doc'];
			$evidencia = "";
			$this->sql = "SELECT formato,archivo FROM carpeta_digital WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$doc = $this->stmt->fetch(PDO::FETCH_OBJ);
			$evidencia.= '<embed src="data:'.$doc->formato.';base64,'.base64_encode(stripslashes($doc->archivo)).'" type="'.$doc->formato.'" width="100%" height="600px" />';
			return $evidencia;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function getNamesDocs()
	{
		try {
			$term = "%".$_REQUEST['term']."%";
			$this->sql = "SELECT id,nombre AS value FROM carpeta_digital WHERE nombre LIKE ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$term,PDO::PARAM_STR);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	public function atenderRExterna()
	{
		try {

			$this->sql = "UPDATE repa_externa SET estatus = 2 , f_reparacion = DATE(NOW()) WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$_POST['re'],PDO::PARAM_INT);
			$this->stmt->execute();
			$this->sql = "INSERT INTO servicio_docs( id,r_externa, documento,observaciones ) VALUES ('',?,?,?);";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$_POST['re'],PDO::PARAM_INT);
			$this->stmt->bindParam(2,$_POST['documento_h'],PDO::PARAM_INT);
			$this->stmt->bindParam(3,$_POST['observaciones'],PDO::PARAM_STR);
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message' =>'ATENCIÓN A LA REPARACIÓN EXTERNA ALMACENADA DE MANERA EXITOSA.' ) );
			
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message' => $e->getMessage() ) );
		}
	}
	
}
?>

