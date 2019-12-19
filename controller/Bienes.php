<?php 
require_once '../model/BienesModel.php';
/**
 * El controlador
 */
class Bienes
{
	protected $model;
	function __construct()
	{
		$this->model = new BienesModel();
	}
	public function getGrupos()
	{
		return $this->model->getGrupos();
	}
	public function getTBienes($id)
	{
		return $this->model->getTBienes($id);
	}
	public function getMateriales()
	{
		return $this->model->getMateriales();
	}
	public function getMarcas()
	{
		return $this->model->getMarcas();
	}
	public function getModelos()
	{
		return $this->model->getModelos();
	}
	public function getColores()
	{
		return $this->model->getColores();
	}
	public function getProveedores()
	{
		return $this->model->getProveedores();
	}
	public function saveMarca($marca)
	{
		return $this->model->saveMarca($marca);
	}
	public function saveModelo($modelo)
	{
		if ( !empty($modelo) ) {
			return $this->model->saveModelo($modelo);
		}
	}
	public function saveColor($color)
	{
		if ( !empty($color) ) {
			return $this->model->saveColor($color);
		}
	}
	public function saveBien($post)
	{
		if ( isset($post) ) {
			return $this->model->saveBien($post);
		}
	}
	public function saveProveedor($post)
	{
		if ( isset($post) ) {
			return $this->model->saveProveedor($post['proveedor']);
		}
	}
	public function getBienes()
	{
		return $this->model->getBienes();
	}
	public function getREquipo($post)
	{
		if (isset($post)) {
			return $this->model->getREquipo($post);
		}
	}
	public function getAreas()
	{
		return  $this->model->getAreas();
	}
	public function getPersonal($term)
	{
		return  $this->model->getPersonal($term);
	}
	public function getRUser($post)
	{
		if (isset($post)) {
			return $this->model->getRUser($post);
		}
	}
	public function getEspecificBien($post)
	{
		if (isset($post)) {
			return $this->model->getEspecificBien($post);
		}
	}
	public function updateBien()
	{
		return $this->model->updateBien();
	}
	public function asignarBien($post)
	{
		if (isset($post)) {
			return $this->model->asignarBien($post);
		}
	}

	public function getArea($term)
	{
		return $this->model->getArea($term);
	}
	public function autocompleteBienes()
	{
		return $this->model->autocompleteBienes();
	}
	public function autocompleteRefacciones()
	{
		return $this->model->autocompleteRefacciones();
	}
	
	

}
?>