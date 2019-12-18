<?php
class MPersona 
{
	protected $sql;
	protected $stmt;
	protected $result;
	protected $pdo;
	function __construct()
	{
		$o = new Conection;
		$this->pdo = $o->getPDO();
	}
	
	public function getUser($u,$p)
	{
		$this->sql = "";
		$this->stmt = $this->pdo->prepare( $this->sql );
		$this->stmt->execute();
		$this->result = $this->stmt->fetchAll( PDO::FETCH_ASSOC );
		return $this->result;
	}
}
?>