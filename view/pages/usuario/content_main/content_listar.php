<?php 
date_default_timezone_set('America/Mexico_City');
?>
<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulario y listado de solicitudes. </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    	<div class="box-body">
                    		<form action="#" method="post" id="frm_solicitudes">
                                <input type="hidden" name="option" value="4">
                    			<div class="row">
                    				<div class="col-md-3">
                    					<input type="date" name="date_ini" value="<?=date('Y-m-d');?>" class="form-control" autofocus>
                    				</div>
                    				<div class="col-md-3">
                    					<input type="date" name="date_fin" value="<?=date('Y-m-d');?>" class="form-control">
                    				</div>
                    				
                    			</div>
                    			<br>
                    			<div class="row">
                    				<div class="col-md-4"></div>
                    				<div class="col-md-4">
                    					<input type="submit" name="btn_search" value="Buscar servicios" class="btn btn-flat btn-block btn-success">
                    				</div>
                    				<div class="col-md-4"></div>
                    			</div>
                    		</form>
                    	</div>
                    	<div class="box-footer">
                    		<table id="solicitudes" class="table table-bordered table-striped" >
                    			<thead>
                    				<tr>
                    					<th class="text-center" width="5%">#</th>
                    					<th class="text-center" width="35%">Descripción de mi falla</th>
                    					<th class="text-center" width="35%">Solución a mi falla</th>
                    					<th class="text-center" width="20%">Quien vio y/o atendio</th>
                    					<th class="text-center" width="5%">Estatus</th>
                    					<th class="text-center" width="5%"></th>
                    				</tr>
                    			</thead>
                    			<tbody></tbody>
                    		</table>
                    	</div>

                    </div>
                    <!-- ./box-body -->
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- /.content -->

<div class="modal fade" id="modal_calificar">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="#" method="post" id="frm_calificar">
				<input type="hidden" name="option" value="2E">
                <input type="hidden" name="reparacion_id" id="reparacion_id" value="">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center">Calificar el servicio</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible hidden" id="success">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Operación exitosa! </h4>
                          <p id="mensaje_success"></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible hidden" id="error">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Algo malo ocurrio! </h4>
                          <p id="mensaje_error"></p>
                        </div>
                      </div>
                    </div>
					<label>¿La calificación de este servicio considera que es?</label>
					<table width="100%" class="table table-hover" border="1">
						<thead>
							<tr height="100px">
								<th style="vertical-align: middle;" class="text-center" >
									<label for="cal1">  <h3> Excelente </h3> </label> <input type="radio" required name="valor_cal" id="cal1" checked value="1">
								</th>
								<th style="vertical-align: middle;" class="text-center">
									<label for="cal2">  <h3> Bueno </h3> </label> <input type="radio" required name="valor_cal" id="cal2" value="2">
								</th>
								<th style="vertical-align: middle;" class="text-center">
									<label for="cal3">  <h3> Regular </h3> </label> <input type="radio" required name="valor_cal" id="cal3" value="3">
								</th>
								<th style="vertical-align: middle;" class="text-center">
									<label for="cal4">  <h3> Malo </h3> </label> <input type="radio" required name="valor_cal" id="cal4" value="4">
								</th>
							</tr>
							<tr>
								<td colspan="4">
								<textarea name="comentario" id="comentario" autofocus="off" class="form-control" style="resize: vertical;" placeholder="Escriba una observación sobre la atención de este servicio."></textarea>
								</td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success btn-flat"> Guardar calificación</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	//aplicar css con JS 
	var opcion = document.getElementById('option_aside_2');
	opcion.className= 'active';
</script>