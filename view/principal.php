<?php include 'view/pages/head.php'; ?>
<body class="hold-transition skin-green sidebar-mini ">
	<div class="wrapper">
		<!-- Main Header -->
		<?php include_once 'view/pages/navbar.php'; ?>
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once 'view/pages/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?php
			if (  isset($_SESSION['perfil_id']) )
			{
				$perfil = $_SESSION['perfil_id'];
				#redireccionaro de acuerdo al nivel del perfil
				switch ( $perfil ) {
					case '1': #Perfil Administrador
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'general':
							  		include 'view/pages/usuario/content_header/header_general.php';
							  		include 'view/pages/usuario/content_main/content_general.php';
							  		break;
							  	case 'listar':
							  		include 'view/pages/usuario/content_header/header_listar.php';
							  		include 'view/pages/usuario/content_main/content_listar.php';
							  		break;
							  	case 'inst':
							  		include 'view/pages/usuario/content_header/header_instructivos.php';
							  		include 'view/pages/usuario/content_main/content_instructivos.php';
							  		break;
							  	default:
							  		echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
							  		die();
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
						}
						break;
					case '2':#Perfil de personal de ST
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'general':
							  		include 'view/pages/soporte/content_header/header_general.php';
							  		include 'view/pages/soporte/content_main/content_general.php';
							  		break;
							  	case 'all':
							  		include 'view/pages/soporte/content_header/header_all.php';
							  		include 'view/pages/soporte/content_main/content_all.php';
							  		break;
							  	case 'create':
							  		include 'view/pages/soporte/content_header/header_create.php';
							  		include 'view/pages/soporte/content_main/content_create.php';
							  		break;
							  	case 'report':
							  		include 'view/pages/soporte/content_header/header_report.php';
							  		include 'view/pages/soporte/content_main/content_report.php';
							  		break;
							  	case 'export':
							  		include 'view/pages/soporte/content_header/header_report.php';
							  		include 'view/pages/soporte/export/export_excel.php';
							  		break;
							  	case 'repair':
							  		include 'view/pages/soporte/content_header/header_repair.php';
							  		include 'view/pages/soporte/content_main/content_repair.php';
							  		break;
							  	default:
							  		echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
							  		die();
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
						}
						break;
					case '3':#Perfil STI
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'general':
							  		include 'view/pages/sti/content_header/header_general.php';
							  		include 'view/pages/sti/content_main/content_general.php';
							  		include 'view/pages/sti/modals/modal_reasignar.php';
							  		include 'view/pages/sti/modals/modal_editar_bien.php';
							  		include 'view/pages/sti/modals/modal_bajas.php';
							  		break;
							  	case 'new_bien':
								  	include 'view/pages/sti/content_header/header_new_bien.php';
								  	include 'view/pages/sti/content_main/content_new_bien.php';
							  	break;
							  	case 'generate_esta':
								  	include 'view/pages/sti/content_header/header_estadistica.php';
								  	include 'view/pages/sti/content_main/content_estadistica.php';
							  	break;
							  	case 'presta':
								  	include 'view/pages/sti/content_header/header_presta.php';
								  	include 'view/pages/sti/content_main/content_presta.php';
							  	break;
							  	case 'reasigna':
								  	include 'view/pages/sti/content_header/header_reasigna.php';
								  	include 'view/pages/sti/content_main/content_reasigna.php';
							  	break;
							  	case 'trash':
								  	include 'view/pages/sti/content_header/header_trash.php';
								  	include 'view/pages/sti/content_main/content_trash.php';
							  	break;
							  	case 'list_person':
								  	include 'view/pages/sti/content_header/header_personal.php';
								  	include 'view/pages/sti/content_main/content_personal.php';
							  	break;
							  	case 'new_person':
								  	include 'view/pages/sti/content_header/header_general.php';
								  	include 'view/pages/sti/content_main/content_add_persona.php';
							  	break;
							  	case 'new_sol':
								  	include 'view/pages/usuario/content_header/header_general.php';
							  		include 'view/pages/usuario/content_main/content_general.php';
							  	break;
							  	case 'r_equipo':
								  	include 'view/pages/sti/content_header/header_r_equipo.php';
								  	include 'view/pages/sti/content_main/content_r_equipo.php';
							  	break;
							  	case 'r_user':
								  	include 'view/pages/sti/content_header/header_r_user.php';
								  	include 'view/pages/sti/content_main/content_r_user.php';
							  	break;
							  	case 'r_fail':
								  	include 'view/pages/sti/content_header/header_r_fail.php';
								  	include 'view/pages/sti/content_main/content_r_fail.php';
							  	break;
							  	case 'r_history':
								  	include 'view/pages/sti/content_header/header_r_history.php';
								  	include 'view/pages/sti/content_main/content_r_history.php';
							  	break;
								case 'create_presta':
									include 'view/pages/sti/content_header/header_create_presta.php';
							  	include 'view/pages/sti/content_main/content_create_presta.php';
									break;
						/*------------------------------------------------------------------------*/
								case 'edit_user':
									include 'view/pages/sti/content_header/header_create_presta.php';
							  		include 'view/pages/sti/content_main/content_create_presta.php';
									break;
								case 'del_user':
									include 'view/pages/sti/content_header/header_create_presta.php';
							  		include 'view/pages/sti/content_main/content_create_presta.php';
									break;
								case 'acuse_user':
									include 'view/pages/sti/content_header/header_create_presta.php';
							  		include 'view/pages/sti/content_main/content_create_presta.php';
									break;

								case 'reparacion_ext':
									include 'view/pages/sti/content_header/header_r_ext.php';
							  		include 'view/pages/sti/content_main/content_r_ext.php';
							  		#Modales
							  		include 'view/pages/sti/modals/modal_add_garantia.php';
							  		include 'view/pages/sti/modals/modal_adjuntar.php';
							  		include 'view/pages/sti/modals/modal_detalle.php';
							  		include 'view/pages/sti/modals/modal_actualizar_garantia.php';
							  		include 'view/pages/sti/modals/modal_repara_externo.php';
									break;
								case 'reparacion_int':
									include 'view/pages/sti/content_header/header_r_int.php';
							  		include 'view/pages/sti/content_main/content_r_int.php';
							  		include 'view/pages/sti/modals/modal_asigna_refaccion.php';
							  		include 'view/pages/sti/modals/modal_add_refaccion.php';
							  		include 'view/pages/sti/modals/modal_detalle_asignacion_refaccion.php';
									break;
								case 'asignaciones':
									include 'view/pages/sti/content_header/header_asignaciones.php';
							  		include 'view/pages/sti/content_main/content_asignaciones.php';
									break;
								case 'cloud':
									include 'view/pages/sti/content_header/header_cloud.php';
							  		include 'view/pages/sti/content_main/content_cloud.php';
									break;
								
							  	default:
							  		echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
							  		die();
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/ST/denegado.php' </script> ";
						}
						break;
					case '4':#perfil de bienes
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'general':
							  		include 'view/pages/bienes/content_header/header_general.php';
							  		include 'view/pages/bienes/content_main/content_general.php';
							  		break;
							  	case 'add':
							  		include 'view/pages/bienes/content_header/header_add.php';
							  		include 'view/pages/bienes/content_main/content_add.php';
							  		break;
							  	case 'r_equipo':
							  		include 'view/pages/bienes/content_header/header_r_equipo.php';
							  		include 'view/pages/bienes/content_main/content_r_equipo.php';
							  		break;
							  	case 'r_user':
							  		include 'view/pages/bienes/content_header/header_r_user.php';
							  		include 'view/pages/bienes/content_main/content_r_user.php';
							  		break;
							  	default:
							  		echo " <script> location.href = 'http://172.16.40.14/ST/denegado.php' </script> ";
							  		die();
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://172.16.40.14/ST/denegado.php' </script> ";
						}
						
						break;

					default:
						echo " <script> alert('El perfil logeado no existe'); location.href = 'http://172.16.40.14/ST/denegado.php'; </script> ";
						break;
				}

			}
			?>
		</div>
		<?php include 'view/pages/footer.php'; ?>
		<?php include 'view/pages/aside_lateral.php'; ?>
  	<div class="control-sidebar-bg"></div>
  </div>
<?php include 'view/pages/scripts.php'; ?>
