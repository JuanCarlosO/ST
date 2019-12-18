<?php 
/**
 * Clase que permite realizar todas las acciones de una persona
 */


class Persona
{
	protected $person ;
	function __construct()
	{
		$this->person = new MPersona;
	}

	public function getUsuario($u,$p)
	{
		if ( $u != 0 AND $p != 0 ) 
		{
			$this->person->getUser($u,$p);
		}
	}

}
?>