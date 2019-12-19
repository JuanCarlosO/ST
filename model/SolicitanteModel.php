<?php 
require_once 'conection.php';
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "es_ES");

class SolicitanteModel extends Conection
{
	protected $sql;
	protected $stmt;
	public $result;
	
	public function SaveFail($falla)
	{
		session_start();#Iniciar session
		#print_r($post);die();
		try {
			#Recuperar el id de la persona logeada
			$persona 	= $_SESSION['person_id'];
			#Buscar sus servicios y verificar que los califico 	
			$this->sql = " SELECT COUNT(id) AS cuenta FROM reparaciones WHERE afectado_id = ? AND estatus =3";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($persona));
			$repar = $this->stmt->fetch( PDO::FETCH_OBJ );
			$cuenta = (int) $repar->cuenta;
			#echo $repar->cuenta."-> ".gettype($cuenta);die();
			/*Condicional */
			if ($cuenta == 0) {
				
				#insertar la falla en la bd
				$this->sql = "INSERT INTO tickets (desc_falla) VALUES (?)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$falla);
				$this->stmt->execute();
				#Recuperar el id de la insercion 
				$this->sql = " SELECT MAX(id) AS last FROM tickets ";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$id_falla = $this->stmt->fetch( PDO::FETCH_OBJ );
				
				/*Insertar en la tabla reparaciones lo ocurrido*/
				$this->sql = "INSERT INTO reparaciones (ticket_id,afectado_id,estatus) VALUES (?,?,1)";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$id_falla->last);
				$this->stmt->bindParam(2,$persona);
				$this->stmt->execute();
				return json_encode( array('status'=>'200','mensaje'=>'Se guardado exitosamente su solicitud') );
			} else {
				throw new Exception("DETECTAMOS QUE TIENES SOLICITUDES SIN CALIFICAR, Y ES NECESARIO QUE INDIQUES UNA CALIFICACIÓN Y UNA OPINION DEL SERVICIO DEL DEPARTAMENTO DE SOPORTE TÉCNICO.", 1);
				
			}
			
			
			
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'500','mensaje'=>$e->getMessage()) );
		}		
	}
	public function getPersonST()#NO esta en uso actualmente 
	{
		$this->sql = " SELECT id,concat(nombre,' ',ap_pat,' ',ap_mat) AS full_name FROM personal WHERE area_id = 27  ";
		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->execute();
		$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
		return json_encode( $this->result );
	}
	/*Listado general*/
	public function listGeneral($logger)
	{
		//print_r($post);die();
		$this->sql = " 
		SELECT 
		    r.id AS repa_id,
		    r.t_repa, 
		    t.desc_falla as falla,
		    t.fecha as f_falla,
		    s.desc_solucion as solution,
		    s.fecha as f_sol , 
		    s.tbien_id as bien, 
		    
		    r.estatus,
		    CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS full_name
		FROM reparaciones AS r 
		LEFT JOIN tickets AS t ON t.id = r.ticket_id
		LEFT JOIN soluciones AS s ON s.id = r.solucion_id
		LEFT JOIN bienes AS b ON b.id = s.tbien_id 
		LEFT JOIN personal AS p ON r.solucionador_id = p.id
		WHERE r.afectado_id = ?
		";

		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->bindParam(1,$logger);
		$this->stmt->execute();
		$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
		return json_encode( $this->result );
	}
	/*Listado por rango de fechas*/
	public function getList($post)
	{
		session_start();#Iniciar session
		$persona 	= $_SESSION['person_id'];
		#print_r($post);die();
		$this->sql = " 
		SELECT 
		    r.id AS repa_id,
		    r.t_repa, 
		    t.desc_falla as falla,
		    t.fecha as f_falla,
		    s.desc_solucion as solution,
		    s.fecha as f_sol , 
		    s.tbien_id as bien, 
		    r.estatus,
		    CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS full_name
		FROM reparaciones AS r 
		LEFT JOIN tickets AS t ON t.id = r.ticket_id
		LEFT JOIN soluciones AS s ON s.id = r.solucion_id
		LEFT JOIN bienes AS b ON b.id = s.tbien_id 
		LEFT JOIN personal AS p ON r.solucionador_id = p.id
		WHERE DATE( t.fecha ) BETWEEN ? AND ? AND r.afectado_id = ? ORDER BY repa_id DESC";

		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->bindParam(1,$post['date_ini'],PDO::PARAM_STR);
		$this->stmt->bindParam(2,$post['date_fin'],PDO::PARAM_STR);
		$this->stmt->bindParam(3,$persona);
		$this->stmt->execute();
		$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
		//print_r($this->result);die();
		return json_encode( $this->result );
	}
	public function getName($id)
	{
		$this->sql = " SELECT concat(nombre,' ',ap_pat,' ') AS short_name FROM personal WHERE id = ? ";
		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->bindParam(1,$id);
		$this->stmt->execute();
		$this->result = $this->stmt->fetch( PDO::FETCH_OBJ );
		return json_encode( $this->result );
	}
	/*Calificar el servicio*/
	public function calificarService($post)
	{
		try {
			$this->sql = " INSERT INTO calificaciones (id,reparacion_id,calificacion,observacion) VALUES ('',?,?,?); ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['reparacion_id']);
			$this->stmt->bindParam(2,$post['valor_cal']);
			$this->stmt->bindParam(3,$post['comentario']);
			$this->stmt->execute();
			#Cambiar el estado de la reparacion
			$this->sql = " UPDATE reparaciones SET estatus = 4 WHERE id = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['reparacion_id']);
			$this->stmt->execute();
			return json_encode( array('estado'=>'success','message'=>'A sido guardada la calificación de este servicio') );
		return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('estado'=>'error','message'=>$e->getMessage()) );
		}
	}
}
?>