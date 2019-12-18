var table_sol;
$(document).ready(function() {
	apply_dataTables( $('#solicitudes') );
	$('[data-toggle="tooltip"]').tooltip();
	//Fomulario de alta
	frm_alta_ticket();
	/*Mantener activo el popover*/
	$('[data-toggle="popover"]').popover(); 
	/*Cargar listado por formulario */
	getListSolicitud();
	list_general();
	frm_calificar();
	/*Buscar el nombre del solicitante*/
	searchName();

	
	
});
/*Función para aplicar DataTables*/
function apply_dataTables(table) 
{

	table_sol=table.DataTable({
		 "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
	});	
}
/*Funcion para salir*/
function logout() 
{
	location.href= 'login.php';
	return false;
}

function actualizarPag(ir) 
{

	if ( ir > 0 ) 
	{

		switch( ir )
		{
			case 1:
				location.href = 'login.php';		
			break;
		}
	}
	else
	{
		location.href = 'login.php';
	}
}
/*Funcion que abre el modal para calificar un servicio*/
function modal_calificar(num)
{
	$('#modal_calificar').modal();
	$('#reparacion_id').val(num);
	return false;
}

/*Alta de ticket*/
function frm_alta_ticket() 
{
	$('#alta_ticket').submit(function(e) {
		e.preventDefault();
		var data_form = $(this).serialize();
		//alert( "Data del formulario:"+$(this).serialize() );
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: data_form,
		})
		.done(function(data) {
			//alert(data);
			if (data['status'] == 200) {
				$('#alert_ok').removeClass('hidden');
				/*ocultar nuevamente la alerta*/
				setTimeout(function(){
					$('#alert_ok').addClass('hidden');
					document.getElementById("alta_ticket").reset(); 
				},6000);
			}
			if (data['status'] == 500) {
				$('#alert_error').removeClass('hidden');
				$('#desc_error').text( data['mensaje'] );
				/*ocultar nuevamente la alerta*/
				setTimeout(function(){
					$('#alert_error').addClass('hidden');
					document.getElementById("alta_ticket").reset(); 
				},15000);
			}

		})
		.fail(function() {
			alert( 'Hubo un problema con el controlador, actualice la página y si el problema persiste, contacte a Desarrollo de sistemas' );
		})
		;
		
	});
}


/*Agregar registros a la tabla de solicitudes de manera dinamica */
function getListSolicitud ()
{
	$('#frm_solicitudes').submit(function(e){
		e.preventDefault();
		/*Serializar datoa del frm*/
		var data_form = $(this).serialize();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: data_form,
		})
		.done(function(data) {
			var estado,solucion,solucionador;
			table_sol.clear().draw();
			
			/*Agregar contenido a la tabla*/
			$.each(data, function(i, sol) {
				
				/*Verificar el estatus de la solicitud */
				if (sol.estatus == 'Sin atender') {
					estado = '<span class="label label-warning">PENDIENTE</span>';
					accion = '';
				}
				else if( sol.estatus == 'Atendido' )
				{
					accion = '<div class="btn-group-vertical">'+
	                    		'<button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Calificar este servicio" onclick="modal_calificar('+sol.repa_id+');"><i class="fa  fa-check-square-o"></i></button>'+
	                		'</div>';
	            	estado = '<span class="label label-success">ATENDIDO</span>';
				}else if (sol.estatus == 'Visto'){
					accion = '<img src="view/dist/img/en_camino.gif" width="60px" height="60px" alt="Soporte en camino" data-toggle="tooltip" title="Soporte Técnico viene en camino">';
					estado = '<span class="label label-info">VISTO</span>';
				}else if (sol.estatus == 'Evaluado'){
					accion = '<div class="btn-group-vertical">'+
								'<i style="font-size: 20px;" class="fa fa-history"></i>'+
							'</div>';
					estado = '<span class="label label-success">EVALUADO</span>';
				}else if (sol.estatus == 'Cancelado'){
					accion = '<h4 class="text-center"> <i class="fa  fa-frown-o text-red"></i> </h4>'
					estado = '<span class="label label-danger">CANCELADO</span>';
				}

				if (sol.solution==null) {
					solucion = '<span class="label label-warning">PENDIENTE</span>';
				}else{
					solucion = sol.solution.toUpperCase();
				}
				if (sol.full_name == null) {
					solucionador = '<span class="label label-warning">PENDIENTE</span>';
				}else{
					solucionador  = sol.full_name.toUpperCase();
				}

				table_sol.row.add( [
		            (i+1),
		            sol.falla.toUpperCase(),
		            solucion,
		            solucionador,
		            estado,
		            accion		            
		        ] ).draw( false );
			});
			
		})
		.fail(function() {
			alert("Ocurrio un error. Se debe de verificar el Controlador");
		});
		
	});
	return false;
}

function searchName() 
{
	//$('#profile_name').text('Este es mi nombre');
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '5'},
	})
	.done(function(data) {
		$('.profile_name').text(data.short_name);
	})
	.fail(function() {
		$('.profile_name').text('Error. Usuario no encontrado');
	});
	
	return false;	
}

/*Listado general de solicitudes */
function list_general() 
{
	$.ajax({
		url: 'controller/puente.php',
		type: 'POST',
		dataType: 'json',
		data: {option: '6'},
	})
	.done(function(data) {
		var estado,solucion,solucionador;
		table_sol.clear().draw();
		/*Verificar el estatus de la solicitud */
		
		$.each(data, function(i, sol) {
			if (sol.estatus == 'Sin atender') {
				estado = '<span class="label label-warning">PENDIENTE</span>';
				accion = '';
			}
			else if( sol.estatus == 'Atendido' )
			{
				accion = '<div class="btn-group-vertical">'+
	                		'<button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Calificar este servicio" onclick="modal_calificar('+sol.repa_id+');"><i class="fa  fa-check-square-o"></i></button>'+
	            		'</div>';
	        	estado = '<span class="label label-success">ATENDIDO</span>';
			}else if (sol.estatus == 'Visto'){
				accion = '<img src="view/dist/img/en_camino.gif" width="60px" height="60px" alt="Soporte en camino" data-toggle="tooltip" title="Soporte Técnico viene en camino">';
				estado = '<span class="label label-info">VISTO</span>';
			}else if (sol.estatus == 'Evaluado'){
				accion = '<div class="btn-group-vertical">'+
							'<i style="font-size: 20px;" class="fa fa-history"></i>'+
						'</div>';
				estado = '<span class="label label-success">EVALUADO</span>';
			}else if (sol.estatus == 'Cancelado'){
				accion = '<h4 class="text-center"> <i class="fa  fa-frown-o text-red"></i> </h4>'
				estado = '<span class="label label-danger">CANCELADO</span>';
			}

			if (sol.solution==null) {
				solucion = '<span class="label label-warning">PENDIENTE</span>';
			}else{
				solucion = sol.solution.toUpperCase();
			}
			if (sol.full_name == null) {
				solucionador = '<span class="label label-warning">PENDIENTE</span>';
			}else{
				solucionador  = sol.full_name.toUpperCase();
			}
			table_sol.row.add( [
		            (i+1),
		            sol.falla.toUpperCase(),
		            solucion,
		            solucionador,
		            estado,
		            accion		            
		    ] ).draw( false );
		});
	})
	.fail(function() {
		console.log("error");
	});
	return false;
}
/*Calificar un servicio*/
function frm_calificar ()
{
	$('#frm_calificar').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'controller/puente.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize() ,
		})
		.done(function(data) {
			if (data.estado == 'success') {
				$('#success').removeClass('hidden');
				$('#mensaje_success').text(data.message);
				setTimeout(function() {
					$('#success').addClass('hidden');
					$('#mensaje_success').text('');
				},6000);
				setTimeout(function(){
					list_general() ;
					document.getElementById('frm_calificar').reset();
					$('#modal_calificar').modal('toggle');
				},2500);
			}else{
				$('#error').removeClass('hidden');
				$('#mensaje_error').text(data.message);
				setTimeout(function() {
					$('#error').addClass('hidden');
					$('#mensaje_error').text('');
				},6000);
				setTimeout(function(){
					list_general() ;
					document.getElementById('frm_calificar').reset();
					$('#modal_calificar').modal('toggle');
				},4250);
			}
		})
		.fail(function() {
			console.log("error");
		});
		
	});
	return false;
}

/*CARGAR LOS MANUALES*/
function laod_manual(doc)
{
	var d = 'manuales/'+doc+'.pdf'
	$('#vista_doc').attr('src',d);
	document.location.href= "#vista_doc";
	return false;
}