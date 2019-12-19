<?php
require_once '../model/STIModel.php';
require_once 'Classes/PHPExcel.php';

class STI
{
	protected $model;
	function __construct()
	{
		$this->model = new STIModel;
	}
	public function getInventarios($term)
	{
		return $this->model->getInventarios($term);
	}
	public function searchAsignacion($id)
	{
		return $this->model->searchAsignacion($id);
	}
	public function saveBien($post)
	{
		return $this->model->saveBien($post);
	}
	public function getAreas()
	{
		return $this->model->getAreas();
	}
	public function getPersonal()
	{
		return $this->model->getPersonal();
	}
	public function savePerson($post)
	{
		return $this->model->savePerson($post);
	}
	public function AllPersonal()
	{
		return $this->model->AllPersonal();
	}
	public function getPuestos($id)
	{
		return $this->model->getPuestos($id);
	}
	public function savePuestos($post)
	{
		return $this->model->savePuestos($post);
	}
	public function searchPuestos($id)
	{
		return $this->model->searchPuestos($id);
	}
	public function del_puesto($id)
	{
		return $this->model->del_puesto($id);
	}
	public function buscar_bienes_personal($post)
	{
		return $this->model->buscar_bienes_personal($post);
	}
	public function createBaja($post)
	{
		return $this->model->createBaja($post);
	}
	public function addGarantia($post)
	{
		return $this->model->addGarantia($post);
	}
	public function sinReparacionExt()
	{
		return $this->model->sinReparacionExt();
	}
	public function bienes_c_refa()
	{
		return $this->model->bienes_c_refa();
	}
	public function searchRefacciones($post)
	{
		return $this->model->searchRefacciones($post);
	}
	public function delRefaccion($refaccion)
	{
		return $this->model->delRefaccion($refaccion);
	}
	public function searchBienBaja($criterio)
	{
		return $this->model->searchBienBaja($criterio);
	}
	public function bajaTemportal($id,$comment)
	{
		return $this->model->bajaTemportal($id,$comment);
	}
	public function bajaDefinitiva($id,$comment)
	{
		return $this->model->bajaDefinitiva($id,$comment);
	}
	public function getBajas()
	{
		return $this->model->getBajas();
	}
	public function updateBajaDefinitiva($id)
	{
		return $this->model->updateBajaDefinitiva($id);
	}
	public function listBienes()
	{
		return $this->model->listBienes();
	}
	public function asignarRefaccion($post,$file)
	{
		return $this->model->asignarRefaccion($post,$file);
	}
	public function saveReparaExterna($post,$file)
	{
		return $this->model->saveReparaExterna($post,$file);
	}
	public function proveedorGarantias()
	{
		return $this->model->proveedorGarantias();
	}
	public function reparacionesActivas()
	{
		return $this->model->reparacionesActivas();
	}
	public function adjuntarDoc($post,$files)
	{
		return $this->model->adjuntarDoc($post,$files);
	}
	public function generateBajaDefinitiva($post,$files)
	{
		return $this->model->generateBajaDefinitiva($post,$files);
	}
	public function getSeries($post)
	{
		return $this->model->getSeries($post);
	}
	public function getInventario($post)
	{
		return $this->model->getInventario($post);
	}
	public function reporteEquipo($post)
	{
		return $this->model->reporteEquipo($post);
	}
	public function reporteUser($post)
	{
		return $this->model->reporteUser($post);
	}
	public function reporteFalla($post)
	{
		return $this->model->reporteFalla($post);
	}
	public function xlsAsignacion($post)
	{
		$bienes = $this->model->xlsAsignacion($post);
		
		// Create new PHPExcel object
		$excel = new PHPExcel();
		// Set document properties
		$excel->getProperties()->setCreator("UAI")
									 ->setLastModifiedBy("STI")
									 ->setTitle("LISTADO DE ASIGNACIÓN DE BIENES")
									 ->setSubject("BIENES")
									 ->setDescription("")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("");
		$style_title = array(
		       'alignment' => array(
		           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		       )
		   );
		
		#DEFINIENDO LA ESTRUCTURA INICIAL
		$excel->setActiveSheetIndex(0)->setCellValue('A1','LISTADO DE ASIGNACIÓN DE BIENES');
		$excel->setActiveSheetIndex(0)->mergeCells('A1:H1');

        // Rename worksheet
        $excel->getActiveSheet()->setTitle('Asignaciones');


	    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$sheet = $excel->setActiveSheetIndex(0);
		$sheet->getStyle('A1:H1')->ApplyFromArray($style);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        ob_start();
        $objWriter->save('php://output');
        $xlsData = ob_get_contents();
		ob_end_clean();
		$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
		);

		echo json_encode($response);
	}

	
	public function repararEquipo($re)
	{
		return $this->model->repararEquipo($re);
	}
	public function reasignarBien()
	{
		return $this->model->reasignarBien();
	}
	public function saveAsignarRefaccion()
	{
		return $this->model->saveAsignarRefaccion();
	}
	public function saveRefaccion()
	{
		return $this->model->saveRefaccion();
	}
	public function getRefacciones()
	{
		return $this->model->getRefacciones();
	}
	public function getAsignaRef()
	{
		return $this->model->getAsignaRef();
	}
	public function getRExternas()
	{
		return $this->model->getRExternas();
	}
	public function saveDoc()
	{
		return $this->model->saveDoc();
	}
	public function getTipoDoc()
	{
		return $this->model->getTipoDoc();
	}
	public function getDocumentos()
	{
		return $this->model->getDocumentos();
	}
	public function getDocumento()
	{
		return $this->model->getDocumento();
	}
	public function getNamesDocs()
	{
		return $this->model->getNamesDocs();
	}
	public function atenderRExterna()
	{
		return $this->model->atenderRExterna();
	}
	public function getRExternasByDoc()
	{
		return $this->model->getRExternasByDoc();
	}
}
 ?>