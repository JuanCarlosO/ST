<?php 
/**
 * Clase encargada en cifrar y descifrar passwords
 */
include_once '../model/conection.php';
define('METHOD','AES-256-CBC');
define('SECRET_KEY','$J@M35$_');
define('SECRET_IV','22242522');

class Security
{
	public $pdo ;
	public $pass;
	public $output;
	function __construct()
	{
		#INICILIZAR LA VARIBLE DE CONEXION
		$aux = new Conection;
		$this->pdo = $aux->getPDO();
	}
	public function encrypt_pass($param)
	{
		$this->pass = $param;
		$this->output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$this->output=openssl_encrypt($this->pass, METHOD, $key, 0, $iv);
		$this->output=base64_encode($this->output);
		return $this->output;
	}

	public function decrypt_pass($param)
	{
		$this->pass = $param;
		$key=hash('sha256', SECRET_KEY); 
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$this->output=openssl_decrypt(base64_decode($this->pass), METHOD, $key, 0, $iv);
		return $this->output;
	}
	
	public function search_data_login($user, $password)
	{
		try {
			$sql = "SELECT * FROM usuario WHERE user = ? LIMIT 1";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(1,$user);
			$stmt->execute();
			$res = $stmt->fetchAll( PDO::FETCH_ASSOC );
			if ( is_array($res) AND count($res) > 0 ) 
			{
				return $res;
			}
			else
			{
				throw new Exception("Error: No existe el nombre de usuario");
			}
		} 
		catch (Exception $e) 
		{
			return $e->getMessage();
		}
	}
	public function insert_user_DB($user,$pass)
	{
		#ESTA FUNCION, PERMITIRA DAR DE ALTA AL LOS USUARIOS EN LA BASE DE DATOS
		$stmt = $this->pdo->prepare('INSERT INTO REGISTRY (name, value) VALUES (?, ?)');
		$stmt->bindParam(1,$user);
		$stmt->bindParam(2,$pass);
		$stmt->execute();
		return 'Exitoso';
	}

}

