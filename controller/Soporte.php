<?php
require_once '../model/SoporteModel.php';
class Soporte
{
	protected $model;
	protected $result;
	function __construct()
	{
		$this->model = new SoporteModel();
	}
	public function newsSolicitudes()
	{
		return $this->model->newsSolicitudes();
	}
	public function countNewsSolicitudes()
	{
		return $this->model->countNewsSolicitudes();
	}
	public function viewSol()
	{
		return $this->model->viewSol();
	}
	public function delSol($id,$motivo)
	{
		return $this->model->delSol($id,$motivo);
	}
	public function searchBienes($afectado)
	{
		return $this->model->searchBienes($afectado);
	}
	public function loadDevices($afectado)
	{
		return $this->model->loadDevices($afectado);
	}
	public function loadFail($r)
	{
		return $this->model->loadFail($r);
	}
	public function getPrinters()
	{
		return $this->model->getPrinters();
	}
	public function reparacionExterna($id,$bien)
	{
		if ($bien > 0) 
		{
			return $this->model->reparacionExterna($id,$bien);
		}
		else
		{
			return json_encode(array('estado' =>'error' , 'message'=>'Debe de seleccionar un bien'));
		}
	}
	public function atenderSol($post)
	{
		return $this->model->atenderSol($post);
	}
	public function getHistory($post)
	{
		return $this->model->getHistory($post);
	}
	public function getPersonSoporte()
	{
		return $this->model->getPersonSoporte();
	}
	public function getBinesPerson($servidor)
	{
		return $this->model->getBinesPerson($servidor);
	}
	public function saveSolicitud($post)
	{
		return $this->model->saveSolicitud($post);
	}
	public function generaReporte($post)
	{
		return $this->model->generaReporte($post);
	}
	public function getPersonalST($term)
	{
		return $this->model->getPersonalST($term);
	}
	public function getRubros()
	{
		return $this->model->getRubros();
	}
	public function generateExcel($lista)
	{
		/*el JSON a Array*/
		$json = json_decode($lista);
		$aux = array();
		foreach ($json as $key => $v) {
			array_push($aux, $v->value);
		}
		#Convertir en cadena
		$lista = implode(',',$aux);
		#Recuperar el arreglo de la busqueda 
		return $this->model->generateExcel($lista);
	}
	public function reporteEquipo($f1,$f2)
	{
		return $this->model->reporteEquipo($f1,$f2);
	}
	public function reporteSolicitud($f1,$f2)
	{
		return $this->model->reporteSolicitud($f1,$f2);
	}
	public function reporteRubro($f1,$f2)
	{
		return $this->model->reporteRubro($f1,$f2);
	}
	public function reportePersonalST($f1,$f2)
	{
		return $this->model->reportePersonalST($f1,$f2);
	}
	public function listFallas()
	{
		return $this->model->listFallas();
	}
	public function getReparaciones()
	{
		return $this->model->getReparaciones();
	}
	public function CancelarSol()
	{
		return $this->model->CancelarSol();
	}
	
}
?>