
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="view/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="view/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris -->
<script src="view/dist/js/raphael.min.js"></script>
<script src="view/dist/js/morris.min.js"></script>
<!-- Select2 -->
<script src="view/dist/js/select2.min.js"></script>


<?php 
if ( isset($_SESSION['perfil_id']) ) 
{
	switch ( $_SESSION['perfil_id'] ) {
		case '1':
			echo '<script src="view/dist/js/main.solicitante.js"></script>';
			
			break;
		case '2':
			echo '<script src="view/dist/js/push.min.js"></script>';
			echo '<script src="view/dist/js/main.soporte.js"></script>';
			break;
		case '3':
			echo '<script src="view/dist/js/main.sti.js"></script>';
			break;
		case '4':
			echo '<script src="view/dist/js/main.bienes.js"></script>';
			break;
		default:
			echo '<script src="view/dist/js/main.other.js"></script>';
			break;
	}
}
?>
<!-- Scripts para creacion de botones de exportacion DataTables -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js " type="text/javascript" ></script>
<!-- SCRIPTS DE AUTOCOMPLETADO-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="view/dist/js/jquery.anexgrid.js"></script>







</body>
</html>