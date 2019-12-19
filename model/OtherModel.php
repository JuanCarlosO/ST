<?php 
require_once 'conection.php';
require_once '../controller/Security.php';
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "es_ES");

class OtherModel extends Conection
{
	protected $sql;
	protected $stmt;
	public $result;
	
	public function Register($post)
	{
		try {
			$s = new Security;
			$pass = $s->encrypt_pass($post['reply_pass']);
			$user = $post['user_name'];
			$person_id = $post['servidor_id'];
			$genero = $post['genero'];
			$clave = $post['clave'];
			#$area = $post['area_id'];
			#BUSCAR QUE EL NOMBRE DE USUARIO NO EXISTA
			$aux = '%'.$user.'%';
			$this->sql = "SELECT COUNT(id) AS cuenta FROM usuario WHERE user LIKE ? ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($aux));
			$resultado = $this->stmt->fetch(PDO::FETCH_OBJ);
			
			if ( $resultado->cuenta >= 1 ) {
				throw new Exception('EL NOMBRE DE USUARIO YA EXISTE INTENTE NUEVAMENTE', 1);
			}
			#Actualizar la informacion del usuario
			$this->sql = "UPDATE personal SET genero = ?, status=1, clave = ? WHERE id =? ";
			$this->stmt = $this->pdo->prepare($this->sql );
			$this->stmt->execute(array($genero,$clave,$person_id));

			$this->sql = "INSERT INTO usuario (id,user,pass, person_id,	perfil_id,status) VALUES ('',?,?,?,1,1)";
			$this->stmt = $this->pdo->prepare($this->sql );
			$this->stmt->execute(array($user,$pass,$person_id));
			
			return json_encode( array('estado'=>'success','message'=>'YA ESTAS REGISTRADO. AHORA PUEDES INICIAR SESIÓN.') );
		} catch (Exception $e) {
			return json_encode( array('estado'=>'500','mensaje'=>$e->getMessage()) );
		}		
	}
	
	
	
	
}
?>