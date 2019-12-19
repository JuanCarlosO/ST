<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <form id="frm_history" action="#">
                            <input type="hidden" name="option" value="35">
                        	<div class="row">
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Fecha inicio:</label>
                        				<input type="date" name="fecha_de" value="<?=date('Y-m-d');?>" class="form-control">
                        			</div>
                        		</div>
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Fecha hasta:</label>
                        				<input type="date" name="fecha_hasta" value="<?=date('Y-m-d');?>" class="form-control">
                        			</div>
                        		</div>
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Calificación del servicio:</label>
                        				<select name="calificacion" class="form-control">
                        					<option value="">...</option>
                        					<option value="1">Excelente</option>
                        					<option value="2">Bueno</option>
                        					<option value="3">Regular</option>
                        					<option value="4">Malo</option>
                        				</select>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col-md-6">
                        			<div class="form-group">
                        				<label>Atendido por:</label>
                        				<select name="soporte" class="form-control" id="soporte" >
                                            <option value="">...</option>
                                        </select>
                        			</div>
                        		</div>
                        	</div>
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" id="btn_reset" class="btn btn-danger btn-flat pull-left" onclick="reset_frm_history();" data-toggle="tooltip" title="Limpia el formulario despues de realizar una busqueda"> <i class="fa fa-paint-brush"></i> Limpiar </button>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-flat btn-block " > <i class="fa fa-search"></i> Consultar</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="table-responsive">
		                        	<table id="tbl_history" class="table table-condensed table-hover table-bordered">
		                        		<thead>
		                        			<tr>
		                        				<th class="text-center" width="5%">#</th>
		                        				<th class="text-center" width="45%">Descripción de la falla/solución</th>
		                        				<th class="text-center" width="15%">Quien solicita</th>
												<th class="text-center" width="10%">Fecha/hora de solicitud</th>
												<th class="text-center" width="15%">Atendido por</th>
												<th class="text-center" width="10%">Fecha/hora de atención</th>
		                        			</tr>
                                            
		                        		</thead>
		                        		<tbody>
		                        			
		                        		</tbody>
                                        <tfoot>
                                            <tr id="buscadores">
                                                <th> </th>
                                                <th>detalle</th>
                                                <th>quien</th>
                                                <th> </th>
                                                <th>atendio</th>
                                                <th> </th>
                                            </tr>
                                        </tfoot>
		                        	</table>
                        		</div>
                        	</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Importar el modal  -->
<?php include 'view/pages/soporte/modals/atender_solicitud.php'; ?>
<script>
    var content = document.getElementById('alls');
    var lista = document.getElementById('listados');
    content.className = 'active';
    lista.className = 'active';
</script>

