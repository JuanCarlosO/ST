<?php  
require_once '../model/OtherModel.php';
class Other extends OtherModel
{	
	protected $model;
	function __construct()
	{
		$this->model = new OtherModel();
	}
	public function Register($post)
	{
		return $this->model->Register($post);
	}
}
?>