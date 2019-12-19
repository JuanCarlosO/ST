<?php 
error_reporting(E_ALL);


include 'Security.php';
spl_autoload_register(function ($class) {
    include $class.'.php';
});
$solicitante 	= new Solicitante;
$bienes 		= new Bienes;
$st 			= new Soporte;
$sti 			= new STI;
$other			= new Other;

#print_r($_REQUEST);exit;

if ( isset( $_POST['option'] ) ) 
{
	$option = $_POST['option'] ;
	switch ( $option ) {
		case '1':
			session_start();
			session_destroy();
			# Buscar que el usuario y contraseña exista en la BD 
			$acceso = new Security();
			
			
			$nick = isset($_POST['username']) ? $_POST['username'] : 0;
			$pass = isset($_POST['userpass']) ? $_POST['userpass'] : 0;
			
			

			if ( $nick != '0' AND $pass != '0' ) 
			{
			 
				$result = $acceso->search_data_login($nick,$pass);
				
				if (is_array($result)) 
				{
					session_start();
					$_SESSION['user_id'] =  $result[0]['id'];
					$_SESSION['person_id'] = $result[0]['person_id'];
					$_SESSION['perfil_id'] = $result[0]['perfil_id'];
					header('Location: ../index.php?menu=general');
				}
				else
				{
					header('Location: ../login.php?err=deny-access');
				}
			}
			else
			{
				if ( $nick == 0 ) 
				{
					header('Location: ../login.php?err=userempty');
				}
				if ( $pass == 0 ) 
				{
					header('Location: ../login.php?err=passempty');
				}

			}

			break;
		case '2':#Dar de alta un ticket (Solicitante)
			echo $solicitante->save_fail($_POST);
			break;
		case '2E':#Dar de alta un ticket (Solicitante)
			echo $solicitante->calificarService($_POST);
			break;
		case '3':#Generar lista del personal de ST
			echo $solicitante->getPersonST();
			break;
		case '4':#Generar lista del personal de ST
			echo $solicitante->getList( $_POST );
			break;
		case '5':#Generar lista del personal de ST
			echo $solicitante->getName();
			break;
		case '6':#Generar lista del personal de ST
			echo $solicitante->listGeneral();
			break;
		/*Casos que ocupara el perfil de bienes */
		case '7':
			echo $bienes->getGrupos();#obtener el catálogo de grupos de bienes 
			break;
		case '8':			
			echo $bienes->getTBienes( $_POST['grupo'] );#obtener los tipos de bienes pertenecientes al grupo seleccioando 
			break;
		case '9':
			echo $bienes->getMateriales();#obtener los tipos de bienes pertenecientes al grupo seleccioando 
			break;
		case '10':
			echo $bienes->getMarcas();#obtener las marcas 
			break;
		case '11':
			echo $bienes->getModelos();#obtener los modelos 
			break;
		case '12':
			echo $bienes->getColores();#obtener las colores 
			break;
		case '13':
			echo $bienes->saveMarca( mb_strtoupper($_POST['marca']) );#obtener las colores 
			break;
		case '14':
			echo $bienes->saveModelo( mb_strtoupper($_POST['modelo']) );#obtener las colores 
			break;
		case '15':
			echo $bienes->saveColor( mb_strtoupper($_POST['color']) );#obtener las colores 
			break;
		case '16':
			echo $bienes->saveBien($_POST);#obtener las colores 
			break;
		case '17':
			echo $bienes->saveProveedor($_POST);#Guardar a un proveedor 
			break;
		case '18':
			echo $bienes->getProveedores();#obtener las Proveedores 
			break;
		case '19':
			echo $bienes->getBienes();
			break;
		case '20':
			echo $bienes->getREquipo($_POST);
			break;
		case '21':
			echo $bienes->getRUser($_POST);
			break;
		case '22':
			echo $bienes->getAreas();
			break;
		case '23':
			#Busqueda del detalle de un bien en especifico
			echo $bienes->getEspecificBien($_POST['bien_id_edit']);
			break;
		case '24':
			echo $bienes->updateBien();
			break;
		case '25':
			echo $bienes->asignarBien($_POST);
			break;
		/*Fin de los casos de perfil de bienes */
		/*Inicio de los casos del perfil de Soporte */
		case '26':
			echo $st->newsSolicitudes();
			break;
		case '27':
			#echo json_encode( ['message'=>'success','count'=>3] );die();
			echo $st->countNewsSolicitudes();
			break;
		case '28':
			#echo json_encode( ['message'=>'success','count'=>3] );die();
			echo $st->viewSol();
			break;
		case '29':
			echo $st->delSol($_POST['id'],$_POST['motivo']);
			break;
		case '29':
			echo $st->searchBienes($_POST['a']);
			break;
		case '30':
			echo $st->loadDevices($_POST['a']);
			break;
		case '31':
			echo $st->loadFail($_POST['r']);
			break;
		case '32':
			echo $st->getPrinters();
			break;
		case '33':
			echo $st->reparacionExterna($_POST['r'],$_POST['b']);
			break;
		case '34':
			echo $st->atenderSol($_POST);
			break;
		case '35':
			echo $st->getHistory($_POST);
			break;
		case '36':
			echo $st->getPersonSoporte();
			break;
		case '37':
			echo $st->getBinesPerson($_POST['servidor']);
			break;
		case '38':
			echo $st->saveSolicitud($_POST);
			break;
		case '39':
			echo $st->generaReporte($_POST);
			break;
		case '40':
			echo $st->getRubros();
			break;
		case '41':
			echo $st->generateExcel($_POST['list']);
			break;
		case '42':
			echo $st->reporteEquipo($_POST['f1'],$_POST['f2']);
			break;
		case '43':
			echo $st->reporteSolicitud($_POST['f1'],$_POST['f2']);
			break;
		case '44':
			echo $st->reporteRubro($_POST['f1'],$_POST['f2']);
			break;
		case '45':
			echo $st->reportePersonalST($_POST['f1'],$_POST['f2']);
			break;
		/*Fin de los casos del perfil de Soporte */
		/*Rutas del perfil STI*/
		case '46':
			echo $sti->getAreas();
			break;
		case '47':
			echo $sti->searchAsignacion($_POST['bien']);
			break;
		case '48':
			echo $sti->saveBien($_POST);
			break;
		case '49':
			echo $sti->getPersonal();
			break;
		case '50':
			echo $sti->savePerson($_POST);
			break;
		case '51':
			echo $sti->AllPersonal();
			break;
		case '52':
			echo $sti->getPuestos($_POST['persona']);
			break;
		case '53':
			echo $sti->savePuestos($_POST);
			break;
		case '54':
			echo $sti->searchPuestos($_POST['persona']);
			break;
		case '55':
			echo $sti->del_puesto($_POST['puesto']);
			break;
		case '56':
			echo $sti->buscar_bienes_personal($_POST);
			break;
		case '57':
			echo $sti->createBaja($_POST);
			#echo json_encode( array( 'estado'=>'success','message'=>'Algo malo ocurrio' ) );
			break;
		case '58':
			echo $sti->addGarantia($_POST);
			break;
		case '59':
			echo $sti->sinReparacionExt();
			break;
		case '60':
			echo $sti->bienes_c_refa();
			break;
		case '61':
			echo $sti->searchRefacciones($_POST);
			break;
		case '62':
			echo $sti->delRefaccion($_POST['refaccion']);
			break;
		case '63':
			echo $sti->searchBienBaja($_POST['criterio']);
			break;
		case '64':
			echo $sti->bajaTemportal($_POST['bien_id'],$_POST['comment']);
			break;
		case '65':
			echo $sti->bajaDefinitiva($_POST['bien_id'],$_POST['comment']);
			break;
		case '66':
			echo $sti->bajaDefinitiva($_POST['bien_id'],$_POST['comment']);
			break;
		case '67':
			echo $sti->getBajas();
			break;
		case '68':
			echo $sti->updateBajaDefinitiva($_POST['baja_id']);
			break;
		case '69':
			echo $sti->listBienes();
			break;
		case '70':
			echo $sti->asignarRefaccion($_POST,$_FILES);	
			break;
		case '71':
			echo $sti->saveReparaExterna($_POST,$_FILES);	
			break;
		case '72':
			echo $sti->proveedorGarantias();	
			break;
		case '73':
			echo $sti->reparacionesActivas();	
			break;
		case '74':
			echo $sti->adjuntarDoc($_POST,$_FILES);	
			break;
		/*Fin de las rutas*/
		case '75':
			echo $other->Register($_POST);	
			break;
		case '76':
			echo $sti->generateBajaDefinitiva($_POST,$_FILES);	
			break;
		case '77':
			echo $sti->reporteEquipo($_POST);	
			break;
		case '78':
			echo $sti->reporteUser($_POST);	
			break;
		case '79':
			echo $st->listFallas();	
			break;
		case '80':
			echo $sti->reporteFalla($_POST);	
			break;
		case '81':
			echo $sti->xlsAsignacion($_POST);	
			break;
		case '82':
			echo $st->CancelarSol();	
			break;
		case '83':
			echo $sti->repararEquipo($_POST['re']);	
			break;
		case '84':
			echo $sti->reasignarBien();	
			#echo json_encode(array('status'=>'success','message'=>'Mi mensaje de exito'));
			break;
		case '85':
			echo $sti->saveAsignarRefaccion();	
			#echo json_encode(array('status'=>'success','message'=>'Mi mensaje de exito'));
			break;
		case '86':
			echo $sti->saveRefaccion();	
			break;
		case '87':
			echo $sti->getAsignaRef();	
			break;
		case '88':
			echo $sti->saveDoc();	
			break;
		case '89':
			echo $sti->getTipoDoc();	
			break;
		case '90':
			echo $sti->getDocumento();	
			break;
		case '91':
			echo $sti->atenderRExterna();	
			break;
		
		default:
			echo json_encode(array('estado'=>'error','message'=>'El puente no encontro la ruta a la que desea enlazarse.'));
			break;
	}
}
elseif( isset($_GET) )
{
	$option = $_GET['option'];
	switch ( $option ) {
		case '1':
			# Autocompletado del personal
			echo $bienes->getPersonal($_GET['term']);
			break;
		case '2':
			# Autocompletado de bienes
			echo $sti->getInventarios($_GET['term']);
			break;
		case '3':
			# Autocompletado del aREA
			echo $bienes->getArea($_GET['term']);
			break;
		case '4':
			# Autocompletado del bienes por serie
			echo $sti->getSeries($_GET['term']);
			break;
		case '5':
			# Autocompletado del bienes por serie
			echo $sti->getInventario($_GET['term']);
			break;
		#AnexGrid para la carga de bienes
		case '6':
			# Autocompletado del bienes por serie
			echo $bienes->getBienes();
			break;
		case '7':
			# Autocompletado del bienes por serie
			echo $st->getReparaciones();
			break;
		case '8':
			# Autocompletado del bienes por serie
			echo $bienes->getBienes();
			break;
		case '9':
			# Autocompletado del bienes por serie
			echo $bienes->autocompleteBienes();
			break;
		case '10':
			# Autocompletado del bienes por serie
			echo $bienes->autocompleteRefacciones();
			break;
		case '11':
			# Autocompletado del bienes por serie
			echo $sti->getRefacciones();
			break;
		case '12':
			# Autocompletado del bienes por serie
			echo $sti->getRExternas();
			break;
		case '13':
			# Autocompletado del bienes por serie
			echo $sti->getDocumentos();
			break;
		case '14':
			# Autocompletado del bienes por serie
			echo $sti->getNamesDocs();
			break;
		case '15':
			# Autocompletado del bienes por serie
			echo $sti->getRExternasByDoc();	
			break;
			
		default:
			# code...
			break;
	}
}
else
{
	print_r ( array( 'message'=>'La opción del puente no existe. Verifique con Desarrollo de Sistemas' ) );die();
}


?>