<?php 
require_once 'conection.php';
require_once 'anexgrid.php';

header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "es_ES");

class SoporteModel extends Conection
{
	protected $sql;
	protected $stmt;
	public $result;

	public function newsSolicitudes()
	{
		$this->sql = "
			SELECT
			    r.id,
			    r.t_repa,
			    r.estatus,
			    UPPER(t.desc_falla) AS falla,
			    t.fecha,
			    (SELECT CONCAT( nombre, ' ', ap_pat, ' ',ap_mat ) FROM personal  WHERE id = afectado_id ) AS afectado,
			    afectado_id,
				(SELECT CONCAT( nombre, ' ', ap_pat, ' ',ap_mat ) FROM personal  WHERE id = solucionador_id )  AS tecnico,
			    UPPER(s.desc_solucion) AS solucion,
			    s.fecha AS f_sol
			FROM
			    reparaciones AS r
			LEFT JOIN tickets AS t
			ON
			    t.id = r.ticket_id
			LEFT JOIN soluciones AS s ON s.id = r.solucion_id
			WHERE r.estatus != 5 AND r.estatus != 3 AND r.estatus != 4
		";
		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->execute();
		$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
		return json_encode( $this->result );
	}
	public function countNewsSolicitudes()
	{
		$this->sql = "
			SELECT
			    COUNT(id) AS cuenta
			FROM
			    reparaciones
			WHERE estatus = 1
		";
		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->execute();
		$this->result = $this->stmt->fetch( PDO::FETCH_OBJ );
		$cuenta = $this->result->cuenta;
		return json_encode( array('message'=>'success', 'count'=>$cuenta) );
	}
	public function viewSol()
	{
		try {
			$id = $_POST['id'];
			$this->sql = "
				UPDATE reparaciones SET estatus=2 WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->execute();
			return json_encode( array('message'=>'success')  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function CancelarSol()
	{
		try {
			$id = $_POST['id'];
			$this->sql = "
				UPDATE reparaciones SET estatus=5 WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->execute();
			return json_encode( array('message'=>'success')  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function delSol($id,$motivo)
	{
		session_start();
		$responsable = $_SESSION['person_id'];
		try {
			$this->sql = "
				UPDATE reparaciones SET estatus=5 WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->execute();
			#Agregar la  cancelacion a la tabla de cancelaciones
			$this->sql = "
				INSERT INTO cancelaciones (id, reparacion_id,responsable_id, motivo) VALUES ('',?,?,?)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->bindParam(2,$responsable);
			$this->stmt->bindParam(3,$motivo);
			$this->stmt->execute();

			return json_encode( array('message'=>'success')  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function searchBienes($afectado)
	{
		try {
			$this->sql = "
				SELECT * FROM asignacion
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->execute();
			#Agregar la  cancelacion a la tabla de cancelaciones
			$this->sql = "
				INSERT INTO cancelaciones (id, reparacion_id,responsable_id, motivo) VALUES ('',?,?,?)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id);
			$this->stmt->bindParam(2,$responsable);
			$this->stmt->bindParam(3,$motivo);
			$this->stmt->execute();

			return json_encode( array('message'=>'success')  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function loadDevices($afectado)
	{
		try {
			$this->sql = "
				SELECT 
					bien_id
				FROM asignacion
				WHERE personal_id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$afectado);
			$this->stmt->execute();
			$bienes_id = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$aux = array();
			#Convertir el arreglo en una cadena
			foreach ($bienes_id as $key => $v) {
				array_push($aux,$v->bien_id);
			}
			$bienes_id = implode(',',$aux);
			/*Buscar la lista de bienes*/
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
				    WHERE b.id IN ($bienes_id) 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			return json_encode( $this->result );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function loadFail($r)
	{

		try {
			$this->sql = "
				SELECT 
					r.id,r.t_repa,r.estatus,UPPER(t.desc_falla) AS falla,
					t.fecha AS f_falla,
					r.afectado_id,
					CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS afectado
				FROM reparaciones AS r
				LEFT JOIN tickets AS t ON t.id = r.ticket_id
				LEFT JOIN personal AS p ON p.id = r.afectado_id
				WHERE r.id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$r);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);

			return json_encode(  $this->result  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function getPrinters()
	{
		try 
		{
			$this->sql = "
				SELECT
				    b.id,CONCAT(ma.nombre, ' - ', mo.nombre) AS impresora
				FROM
				    bienes AS b
				INNER JOIN modelos AS mo
				ON
				    mo.id = b.modelo_id
				INNER JOIN marcas AS ma
				ON
				    ma.id = b.marca_id
				WHERE
				    b.tipo_id = 27
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			return json_encode(  $this->result  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function reparacionExterna($id,$bien)
	{
		try 
		{
			session_start();
			$st_person = $_SESSION['person_id'];
			#Insertar la solución
			
			$this->sql = "
				INSERT INTO soluciones(id, fecha, desc_solucion, tbien_id) VALUES ('',NOW(),'ENVIADO A REPARACIÓN EXTERNA',?);
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$bien);
			$this->stmt->execute();
			#******RECUPERAR EL ID DE A SOLUCION INSERTADA*******************
			$solucion = $this->pdo->lastInsertId();
			#************************************************
			$this->sql = "
				SELECT * FROM soluciones WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solucion);
			$this->stmt->execute();
			$bien = $this->stmt->fetch(PDO::FETCH_OBJ);

			$this->sql = "
				UPDATE reparaciones SET estatus = 1 , t_repa = 2 , solucion_id =?, solucionador_id=? WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solucion);
			$this->stmt->bindParam(2,$st_person);
			$this->stmt->bindParam(3,$id);
			$this->stmt->execute();

			#INICIALIZAR LA REPARACION EXTERNA 
			$this->sql = "INSERT INTO repa_externa (
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
			VALUES (
				'',
				?,
				?,
				DATE(NOW()),
				NULL,
				NULL,
				?,
				NULL,
				1,
				NULL,
				NULL
			);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$bien->id);
			$this->stmt->bindParam(2,$id);
			$this->stmt->bindParam(3,$st_person);
			$this->stmt->execute();
			return json_encode( array('estado'=>'success','message'=>'success')  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function atenderSol($post)
	{
		try 
		{
			#Recuperar las varables.
			$solucion = ( isset( $_POST['solution'] ) ) ? $_POST['solution'] : false ;
			$device = ( isset($_POST['device']) || !empty($_POST['device'])  ) ? $_POST['device'] : NULL;
			$falla = $post['fallas'];
			session_start();
			$user_st = $_SESSION['person_id'];

			if ( !$solucion ) {
				return json_encode( array( 'estado'=>'error','message'=>'Escriba una solución' ) ); exit;
			} else {
				if (empty($device)){
					$this->sql = "INSERT INTO soluciones (id,fecha,desc_solucion,tbien_id) VALUES ('',NOW(),?,NULL);";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$solucion);
					$this->stmt->execute();
				}
				elseif ($device == 0 || $device == '0') 
				{

					#$device = $_POST['printers'];
					$device = ( !isset($post['printers']) || !empty($post['printers'])  ) ? $post['printers']:NULL;
					#Insertar la solución 
					$this->sql = "INSERT INTO soluciones (id,fecha,desc_solucion,tbien_id) VALUES ('',NOW(),?,$device);";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$solucion);
					$this->stmt->execute();
					

				}elseif ( $device == '' ) {
					return json_encode( array( 'estado'=>'error','message'=>'Seleccione un dispositivo.' ) ); exit;
				}else{
					#Insertar la solución 
					$this->sql = "
						INSERT INTO soluciones(id,fecha,desc_solucion,tbien_id) VALUES ('',NOW(),?,?); 
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$solucion);
					$this->stmt->bindParam(2,$device);
					$this->stmt->execute();
				}
			}
			#Recupera rubro
			$rubro = $post['rubro'];
			#Recuperar la solucion
			$this->sql = "
				SELECT MAX(id) AS ultimo FROM soluciones
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			$ultimo = $this->result->ultimo;
			
			#Insertar la reparacion
			$this->sql = "
				UPDATE reparaciones SET solucionador_id = ? , solucion_id = ?, estatus=3, falla_id =?, rubro_id = ? WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$user_st);
			$this->stmt->bindParam(2,$ultimo);
			$this->stmt->bindParam(3,$falla);
			$this->stmt->bindParam(4,$rubro);
			$this->stmt->bindParam(5,$_POST['reparacion_id']);
			$this->stmt->execute();
			return json_encode( array( 'estado'=>'success', 'message'=>'Proceso completado con éxito.' ) );

		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function getHistory($post)
	{
		try 
		{

			$ini = $post['fecha_de'];
			$fin = $post['fecha_hasta'];

			$this->sql = "
				SELECT id FROM tickets WHERE DATE(fecha) BETWEEN ? AND ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($ini,$fin));
			$fallas = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			/*hacer un arreglo de fallas */
			$aux = array();
			foreach ($fallas as $key => $val) {
				array_push($aux,$val->id);
			}
			$fallas = implode(',',$aux);
			#echo $fallas;exit;
			#SI BUSCA LOS SERVICIOS CON CALIFICACIÓN
			if ( isset($post['calificacion']) and !empty($post['calificacion']) and $post['calificacion']!= '' ) 
			{
				#1. buscar las reparaciones 
				$this->sql = "SELECT id FROM reparaciones WHERE ticket_id IN ($fallas)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$repa_id = $this->stmt->fetchAll(PDO::FETCH_OBJ);

				/*hacer un arreglo de fallas */
				$aux = array();
				foreach ($repa_id as $key => $val) {
					array_push($aux,$val->id);
				}
				$repa_id = implode(',',$aux);
				#buscar cuantos de ellos estan calificados
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($repa_id) AND calificacion = ".$post['calificacion'];
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll(PDO::FETCH_OBJ);
				
				/*hacer un arreglo de fallas */
				$aux = array();
				foreach ($calificados as $key => $val) {
					array_push($aux,$val->reparacion_id);
				}
				$calificados = implode(',',$aux);

				$this->sql = "SELECT ticket_id FROM reparaciones WHERE id IN ($calificados)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$reparados = $this->stmt->fetchAll(PDO::FETCH_OBJ);

				/*hacer un arreglo de fallas */
				$aux = array();
				foreach ($reparados as $key => $val) {
					array_push($aux,$val->ticket_id);
				}
				$reparados = implode(',',$aux);

				$this->sql = "
				SELECT id FROM tickets WHERE id IN ($reparados) 
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$fallas = $this->stmt->fetchAll(PDO::FETCH_OBJ);
	
				/*hacer un arreglo de fallas */
				$aux = array();
				foreach ($fallas as $key => $val) {
					array_push($aux,$val->id);
				}
				$fallas = implode(',',$aux);
			} 
			#BUSCAR LAS SOLICITUDES QUE FUERON ATENDIDAS POR UNA PERSONA DE ST 
			if (isset($post['soporte']) and !empty($post['soporte']) and $post['soporte']!= '' ) 
			{
				# buscar las reparaciones donde intervino esa persona 
				$this->sql = "
					SELECT ticket_id FROM reparaciones WHERE ticket_id IN ($fallas)  AND solucionador_id = 
				".$post['soporte'];
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$fallas = $this->stmt->fetchAll(PDO::FETCH_OBJ);
				/*hacer un arreglo de fallas */
				$aux = array();
				foreach ($fallas as $key => $val) {
					array_push($aux,$val->id);
				}
				$fallas = implode(',',$aux);
			}
			
			
			#print_r($fallas);die();
			$this->sql = "
				SELECT
				    r.id,
				    UPPER(t.desc_falla) AS falla,
				    t.fecha AS f_sol,
				    UPPER(s.desc_solucion) AS solucion,
				    s.fecha AS f_atendio,
				    (
				    SELECT
				        CONCAT(nombre, ' ', ap_pat, ' ', ap_mat)
				    FROM
				        personal
				    WHERE
				        id = r.afectado_id
				) AS afectado,
				(
				    SELECT
				        CONCAT(nombre, ' ', ap_pat, ' ', ap_mat)
				    FROM
				        personal
				    WHERE
				        id = r.solucionador_id
				) AS atendio,
				rb.nombre AS Categoria
				FROM
				    reparaciones r
				LEFT JOIN tickets t ON
				    t.id = r.ticket_id
				LEFT JOIN soluciones s ON
				    s.id = r.solucion_id
				LEFT JOIN rubros rb ON
				    rb.id = r.rubro_id
				WHERE
				    ticket_id IN( $fallas )
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$reportes = $this->stmt->fetchAll(PDO::FETCH_OBJ);

			return json_encode(  $reportes  );	
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function getPersonSoporte()
	{
		try {
			$this->sql = "SELECT id, CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS full_name FROM personal WHERE area_id = 27";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			if ( count($this->result) == 0 ) {
				return json_encode( array( 'estado'=>'vacio','message'=>'NO EXITE PERSONAL DE SOPORTE TÉCNICO.' ) ); exit;
			}else{
				return json_encode( $this->result );
			}
			
		} catch (Exception $e) {
			return json_encode( array( 'estado'=>'error','message'=>$e->getMessage() ) );
		}
	}
	public function getBinesPerson($servidor)
	{
		try {

			$this->sql = "SELECT bien_id FROM asignacion WHERE personal_id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array($servidor) );
			$bien_ids = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			/*Generar un arreglo*/
			$aux = array();
			foreach ($bien_ids as $key => $val) {
				array_push( $aux, $val->bien_id );
			}
			$bien_ids = implode(',',$aux);
			
			/*Buscar los id en la tabla de bienes*/
			$this->sql = "SELECT b.id,
			UPPER( CONCAT(tb.nombre,' Serie:',b.serie,' Inventario:',b.inventario) ) AS bien 
			FROM bienes AS b
				INNER JOIN t_bienes AS tb
				ON tb.id = b.tipo_id WHERE b.id IN ($bien_ids)";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(  );
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );

			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array( 'message'=>$e->getMessage() ) );
		}
	}
	public function saveSolicitud($post)
	{
		#print_r($post);die();
		session_start();
		try {
			if ( isset($post['device']) ) {
				
 				if ( !empty($post['device']) ) {

					if ($post['device'] == 0 || $post['device'] == '0') {
						if ( isset($post['printers']) AND !empty($post['printers']) ) 
						{
							$device = $post['printers'];
						}else{
							throw new Exception("Debe de seleccionar una impresora o copiadora", 1);
						}
					}
				}
				elseif( $post['device'] == '0')
				{
					if ( isset($post['printers']) AND !empty($post['printers']) ) {
						$device = $post['printers'];
					}else{
						throw new Exception("Debe de seleccionar una impresora o copiadora", 1);
					}
				}else{
					$device = '';
				}
			}
			
			/*Insertar el ticket*/
			$falla =  mb_strtoupper($post['txt_falla'], 'UTF-8');			
			$this->sql = "INSERT INTO tickets(id,desc_falla,fecha) VALUES ('',?,NOW());";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array($falla) );
			/*Recuperar el ticket insertado*/
			$this->sql = "SELECT MAX(id) AS ultimo FROM tickets";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$ticket = $this->stmt->fetch( PDO::FETCH_OBJ );
			/*Insertar la solución*/
			$sol =  mb_strtoupper($post['txt_solucion'], 'UTF-8');
			if (empty($device)) {
				#die('Si esta vacio');
				$this->sql = "INSERT INTO soluciones (id,fecha,desc_solucion,tbien_id) VALUES ('',NOW(),:solucion,NULL);";
			}else
			{
				#die('No esta vacio');
				$this->sql = "INSERT INTO soluciones (id,fecha,desc_solucion,tbien_id) VALUES ('',NOW(),:solucion,$device);";
			}
			#die('Fin de la ejecucion');
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(':solucion',$sol,PDO::PARAM_STR);
			$this->stmt->execute();
			
			/*Recuperar la ultima solucion*/
			$this->sql = "SELECT MAX(id) AS ultimo FROM soluciones";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$solucion = $this->stmt->fetch( PDO::FETCH_OBJ );
			$ultim = $solucion->ultimo;
			
			#print_r($solucion->ultimo);die();
			/*Recuperar afectado y st*/
			$user_st = $_SESSION['person_id'];
			$user 	 = $post['servidor_id'];
			$falla = $post['fallas'];
			$rubro = $post['rubro'];

			/*Insertar la reparacion*/
			$this->sql = "INSERT INTO reparaciones (
				id, ticket_id, afectado_id, solucionador_id, solucion_id, t_repa, estatus, rubro_id,falla_id 
			) 
			VALUES ('',?,?,?,?,1,3,?,?);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array( $ticket->ultimo, $user, $user_st, $ultim,$rubro,$falla ) );

			return json_encode( array('status'=>'success','message'=>'Solicitud almacenada con éxito') );

		} catch (Exception $e) {
			return json_encode( array('status'=>'error', 'message'=>$e->getMessage() ) );
		}
	}
	public function generaReporte($post)
	{
		try {
			#Verificar el contenido de las variables 
			if (		
			    $post['option']			== '' AND 
			    $post['t_report']		== '' AND 	
			    $post['fecha_de']		== '' AND 	
			    $post['fecha_hasta']	== '' AND 		
			    $post['soporte']		== '' AND 	
			    $post['rubro']			== '' AND 
			    $post['calificacion']	== ''		
			) 
			{
				#Recupera todos los tickets
				$this->sql = "SELECT id FROM tickets";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			} 
			else 
			{
				#Definir el SQL PARA RECUPERAR LAS FALLAS
				$this->sql = "SELECT * FROM tickets WHERE 1=1 ";

				#Si las fechas no estan vacias
				if ( !empty($post['fecha_de']) && !empty($post['fecha_hasta']) ) 
				{
					$this->sql.= " AND DATE(fecha) BETWEEN ? AND ?";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
					$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				}
				elseif ( !empty($post['fecha_de']) AND empty($post['fecha_hasta']) )
				{
					return json_encode( array('estado'=>'error','message'=>' <center> Verifique el campo de <b>Fecha hasta.</b> </center>') , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
				}elseif ( empty($post['fecha_de']) AND !empty($post['fecha_hasta']) )
				{
					return json_encode( array('estado'=>'error','message'=>'<center> Verifique el campo de <b>Fecha inicio.</b> </center>' ) , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ;
				}else{
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
					$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				}

			}

			#Convertir el objeto en arreglo
			$aux = array();
			foreach ($fallas as $key => $falla) {
				array_push($aux,$falla->id);
			}
			$fallas = implode(',',$aux);

			#Buscar cuales fueron resueltas por alguien en especial y si no continuar
			$soporte 		= $post['soporte'];
			$rubro 			= $post['rubro'];
			$calificacion 	= $post['calificacion'];
			if (isset($post['fallas'])) {
				if( empty($post['fallas']) ){
					$falla = '';
				}else{
					$falla 			= ' AND falla_id = '.$post['fallas'].' ';
				}
			}

			if ( $soporte != '' and $rubro != '' and $calificacion != '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) AND rubro_id = $rubro $falla AND solucionador_id = $soporte
				";		
				
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) AND calificacion = $calificacion ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );
			}
			elseif ( $soporte != '' and $rubro != '' and $calificacion == '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) AND rubro_id = $rubro $falla AND solucionador_id = $soporte
				";	

				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			elseif ( $soporte == '' and $rubro == '' and $calificacion == '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) $falla 
				";	
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			elseif ( $soporte == '' and $rubro != '' and $calificacion == '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) AND rubro_id = $rubro $falla
				";	
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			elseif ( $soporte != '' and $rubro == '' and $calificacion != '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) AND solucionador_id = $soporte $falla
				";	
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) AND calificacion = $calificacion  ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			elseif ( $soporte == '' and $rubro == '' and $calificacion != '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) $falla
				";	
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) AND calificacion = $calificacion  ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			elseif ( $soporte != '' and $rubro == '' and $calificacion == '' ) {
				$this->sql = "
					SELECT id
					FROM reparaciones 
					WHERE ticket_id IN ($fallas) AND solucionador_id = $soporte $falla
				";	
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($post['fecha_de'],$post['fecha_hasta']));
				$ids_reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($ids_reparaciones as $key => $reparacion) {
					array_push($aux,$reparacion->id);
				}	
				$ids_reparaciones =implode(',',$aux);
				#buscar las de calificacion de servicio
				$this->sql = "SELECT reparacion_id FROM calificaciones WHERE reparacion_id IN ($ids_reparaciones) ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$calificados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				$aux = array();
				foreach ($calificados as $key => $calificado) {
					array_push($aux,$calificado->reparacion_id);
				}	
				$calificados =implode(',',$aux);
				#buscar toda la informacion
				$this->sql = "
					SELECT 
						r.id,r.estatus,r.t_repa,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
					    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
					    s.fecha AS f_sol,
					    t.fecha AS f_falla,
					    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
					    ru.nombre AS rubro,
					    c.calificacion,
					    s.desc_solucion AS solucion ,
					    t.desc_falla AS falla
					FROM reparaciones AS r
					INNER JOIN tickets AS t ON t.id = r.ticket_id
					INNER JOIN soluciones AS s ON s.id = r.solucion_id
					INNER JOIN bienes as b on b.id = s.tbien_id
					INNER JOIN rubros as ru on ru.id = r.rubro_id
					INNER JOIN calificaciones as c on c.reparacion_id= r.id
					WHERE r.id IN ($calificados)
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode( $this->result );	
			}
			
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getRubros()
	{
		try {
			$this->sql = "SELECT * FROM rubros";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$rubros = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $rubros );
		} catch (Exception $e) {
			
		}
	}
	public function generateExcel($lista)
	{
		try {
			#Obtener el año del servidor
			
			$this->sql = "
			SELECT COUNT(*) AS cuenta FROM reportes WHERE YEAR(f_elabora) = YEAR(NOW())
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$num_reporte = $this->stmt->fetch( PDO::FETCH_OBJ );
			$num_reporte = (int) $num_reporte->cuenta;
			if ($num_reporte == 0 ) {
				#hacer Array el arreglo de IDs
				$aux = explode(',', $lista);
				$conteo = count($aux);

				$uf  = 1;
				$uf  = (int) $uf;

				$this->sql = "INSERT INTO reportes (id,consecutivo,f_elabora,uf) VALUES ('',1,NOW(),?);";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($conteo));;
				#rECUPERAR EL ID DEL REPORTE
				$this->sql = "SELECT MAX(id) AS ultimo FROM reportes ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$ultimo = $this->stmt->fetch(PDO::FETCH_OBJ);
				#RECUPERAR EL id DEL ULTIMO REPORTE PARA AGREGARLO A SERVICIOS DEL REPORTE
				$this->sql = "
				SELECT MAX(id) AS ultimo FROM reportes WHERE YEAR(f_elabora) = YEAR(NOW())
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$last_report = $this->stmt->fetch( PDO::FETCH_OBJ );
				$last_report = $last_report->ultimo;
				
				foreach ($aux as $a) {
					$this->sql = "INSERT INTO servicios_reporte (id,reparacion_id,reporte_id,folio) VALUES ('',?,?,?);";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->execute(array( $a,$last_report,$uf ));
					$uf++;
				}
			}else{
				#SI ya existen reportes RECUPERAR ULTIMO FOLIO Y CONSECUTIVO
				$aux = explode(',', $lista);
				$conteo = count($aux);
				$conteo = (int) $conteo;

				$this->sql = "
				SELECT MAX(id) AS cuenta,consecutivo,uf FROM reportes WHERE YEAR(f_elabora) = YEAR(NOW())
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$last = $this->stmt->fetch( PDO::FETCH_OBJ );
				$con = $last->consecutivo;
				$con = (int)$con;
				$con = $con+1;

				$uf  = $last->uf;
				$uf  = (int) $uf;
				$uf  = $uf+$conteo;

				#INSERTAR DATOS DEL SIGUIENTE REPORTE
				$this->sql = "INSERT INTO reportes (id,consecutivo,f_elabora,uf) VALUES ('',?,NOW(),?);";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute(array($con,$uf));;
				#RECUPERAR EL id DEL ULTIMO REPORTE PARA AGREGARLO A SERVICIOS DEL REPORTE
				$this->sql = "
				SELECT MAX(id) AS ultimo FROM reportes WHERE YEAR(f_elabora) = YEAR(NOW())
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$last_report = $this->stmt->fetch( PDO::FETCH_OBJ );
				$last_report = $last_report->ultimo;
				
				foreach ($aux as $a) {
					$this->sql = "INSERT INTO servicios_reporte (id,reparacion_id,reporte_id,folio) VALUES ('',?,?,?);";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->execute(array( $a,$last_report,$uf ));
					$uf++;
				}
				
			}
			
			#RECUPERAR EL id DEL ULTIMO REPORTE PARA AGREGARLO A SERVICIOS DEL REPORTE
			$this->sql = "
			SELECT MAX(id) AS ultimo FROM reportes WHERE YEAR(f_elabora) = YEAR(NOW())
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$last_report = $this->stmt->fetch( PDO::FETCH_OBJ );
			$last_report = $last_report->ultimo;

			$this->sql = "
				SELECT 
					r.id,r.estatus,r.t_repa,
				    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = afectado_id) AS afectado,
				    (SELECT CONCAT(nombre,' ',ap_pat, ' ',ap_mat) AS nombre FROM personal WHERE id = solucionador_id) AS solucionador,
				    s.fecha AS f_sol,
				    t.fecha AS f_falla,
				    (SELECT nombre FROM t_bienes WHERE id = b.tipo_id) AS bien, 
				    ru.nombre AS rubro,
				    c.calificacion,
				    s.desc_solucion AS solucion ,
				    t.desc_falla AS falla,
				    sr.folio,
				    YEAR(re.f_elabora) AS year
				FROM reparaciones AS r
				INNER JOIN tickets AS t ON t.id = r.ticket_id
				INNER JOIN soluciones AS s ON s.id = r.solucion_id
				INNER JOIN bienes as b on b.id = s.tbien_id
				INNER JOIN rubros as ru on ru.id = r.rubro_id
				INNER JOIN calificaciones as c on c.reparacion_id= r.id
				INNER JOIN servicios_reporte as sr  ON  r.id = sr.reparacion_id
				INNER JOIN reportes re ON re.id = sr.reporte_id
				WHERE r.id IN ($lista)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$buscados = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $buscados );
		} catch (Exception $e) {
			
		}
	}
	public function reporteEquipo($f1,$f2)
	{
		try {
			# Buscar las fallas en el rango de fechas
			$this->sql = "
				SELECT
				    id
				FROM
				    tickets				
				WHERE
				    fecha BETWEEN ? AND ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array( $f1,$f2 ));
			$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			
			if ( count( $fallas ) > 0 ) {
				#Convertir el resultado en array
				$aux = array();
				foreach ($fallas as $key => $falla) {
					if ($falla->id != NULL) {
						array_push($aux,$falla->id);
					}
				}
				$fallas = implode(',',$aux);
				/*Buscar las reparaciones*/
				$this->sql = "
					SELECT
					    solucion_id 
					FROM
					    reparaciones				
					WHERE
					    ticket_id IN ($fallas) AND solucion_id IS NOT NULL
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$reparaciones = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				/*Convertir las reparaciones a array*/
				$aux = array();
				foreach ($reparaciones as $key => $falla) {
					if ( $falla->solucion_id != null ) {
						array_push($aux,$falla->solucion_id);
					}		
				}
				$reparaciones = implode(',',$aux);
				
				#Hacer el conteo de los bienes en la tabla de Soluciones
				$this->sql = "
					SELECT
					    CONCAT(tb.nombre,' - ',m.nombre) AS device,COUNT(tbien_id) AS cuenta
					FROM
					    soluciones AS s
					INNER JOIN bienes AS b ON b.id = s.tbien_id
					INNER JOIN t_bienes AS tb ON tb.id = b.tipo_id
					INNER JOIN modelos AS m ON m.id = b.modelo_id

					WHERE
					    s.id IN ($reparaciones)
					GROUP BY s.tbien_id				     
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
				return json_encode($this->result);
			} else {
				throw(new Exception('No se encontro información con el criterio de busqueda seleccionado.'));
			}
			
			
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error', 'message'=>$e->getMessage()) );
		}
	}
	public function reporteSolicitud($f1,$f2)
	{
		try {
			# Buscar las fallas en el rango de fechas
			$this->sql = "
				SELECT
				    id
				FROM
				    tickets				
				WHERE
				    fecha BETWEEN ? AND ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array( $f1,$f2 ));
			$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			#Convertir el resultado en array
			$aux = array();
			foreach ($fallas as $key => $falla) {
				array_push($aux,$falla->id);
			}
			$fallas = implode(',',$aux);
			$this->sql = "
				SELECT
				    CONCAT(p.nombre, ' ', p.ap_pat, ' ', p.ap_mat) AS afectado,
				    COUNT(r.afectado_id) AS cuenta
				FROM
				    reparaciones AS r
				INNER JOIN personal AS p
				ON
				    p.id = r.afectado_id
				WHERE r.ticket_id IN ($fallas)
				AND r.solucion_id IS NOT NULL
				GROUP BY
				    r.afectado_id
				ORDER BY
				    cuenta
				DESC
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('error'=>$e->getMessage()) );
		}
	}
	public function reporteRubro($f1,$f2)
	{
		try {
			#BUscar las fallas en el rango de fechas
			$this->sql = "
				SELECT
				    id
				FROM
				    tickets				
				WHERE
				    fecha BETWEEN ? AND ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array( $f1,$f2 ));
			$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			$aux = array();
			foreach ($fallas as $key => $falla) {
				array_push($aux,$falla->id);
			}
			$fallas = implode(',',$aux);
			$this->sql = "
				SELECT
				    COUNT(re.id) AS cuenta,
				    r.nombre AS rubro
				FROM
				    reparaciones AS re
				INNER JOIN rubros AS r
				ON
				    r.id = re.rubro_id
				WHERE
				    re.solucion_id IS NOT NULL AND re.ticket_id IN ($fallas)
				GROUP BY
				    re.rubro_id
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($f1,$f2));
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function reportePersonalST($f1,$f2)
	{
		try {
			#BUscar las fallas en el rango de fechas
			$this->sql = "
				SELECT
				    id
				FROM
				    tickets				
				WHERE
				    fecha BETWEEN ? AND ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array( $f1,$f2 ));
			$fallas = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			$aux = array();
			foreach ($fallas as $key => $falla) {
				array_push($aux,$falla->id);
			}
			$fallas = implode(',',$aux);
			$this->sql = "
				SELECT
				    COUNT(r.id) AS cuenta,
				    CONCAT(p.nombre, ' ', p.ap_pat, ' ', p.ap_mat) AS persona
				FROM
				    reparaciones AS r
				INNER JOIN personal AS p
				ON
				    p.id = r.solucionador_id
				WHERE
				    r.solucion_id IS NOT NULL AND r.ticket_id IN ($fallas)
				GROUP BY
				    r.solucionador_id
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($f1,$f2));
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message'=>$e->getMessage()) );
		}
	}

	public function listFallas()
	{
		try {
			$this->sql = "SELECT id, UPPER(nombre) AS nombre FROM fallas";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getReparaciones()
	{
		try {
			$anexGrid = new AnexGrid();
			$wh = "";
			foreach($anexGrid->filtros as $f)
			{
				if($f['columna'] != ''){
					if($f['columna'] == 'estatus'){
						$wh .= " AND r.estatus = ".$f['valor'];
					}
				}
			}
			$this->sql = "SELECT t.id,UPPER(t.desc_falla) AS falla,t.fecha,r.t_repa,r.estatus,s.fecha AS f_solucion,UPPER(s.desc_solucion ) AS solucion,r.id AS reparacion,r.afectado_id

			FROM tickets AS t 
			LEFT JOIN reparaciones AS r ON r.ticket_id = t.id
			LEFT JOIN soluciones AS s ON s.id = r.solucion_id
			LEFT JOIN fallas AS f ON f.id = r.solucion_id
				WHERE 1=1 $wh
			ORDER BY t.$anexGrid->columna $anexGrid->columna_orden
        	LIMIT $anexGrid->pagina,$anexGrid->limite";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$registros = $this->stmt->fetchAll( PDO::FETCH_ASSOC );

			$this->sql = "SELECT COUNT(*) as Total FROM tickets AS t 
			LEFT JOIN reparaciones AS r ON r.ticket_id = t.id
			LEFT JOIN soluciones AS s ON s.id = r.solucion_id WHERE 1=1 $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ )->Total;
			return $anexGrid->responde($registros, $total);
		} catch (Exception $e) {
			return json_encode(array('estado'=>'error','message'=>$e->getMessage()));
		}
	}
}
/*
Plantilla de codigo
$this->sql = "";
$this->stmt = $this->pdo->prepare( $this->sql );
$this->stmt->execute();
$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
return json_encode( $this->result );
 */
?>
