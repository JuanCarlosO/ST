<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div id="alert" class="alert  alert-dismissible hidden">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 id="title_alert"></h4>
                            <p id="message"></p>
                        </div>
                        
                        <form id="frm_create_sol" action="#" method="post">
                            <input type="hidden" name="option" value="38">
                        	<div class="row">
                        		<div class="col-md-10">
                        			<div class="form-group">
                        				<label>Usuario afectado:</label>
                        				<input type="text" id="servidor" name="servidor" value="" class="form-control" placeholder="Escriba el nombre de un servidor público" required>
                                        <input type="hidden" name="servidor_id" id="servidor_id" value="">
                        			</div>
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col-md-3">
                        			<div class="form-group">
                        				<label>Dispositivo que presentó la falla:</label>
                        				<select id="device" name="device" class="form-control" >
                        					<option value="">~Debe buscar primero al usuario~</option>
                        				</select>
                        			</div>
                        		</div>
                                <div id="div_printers" class="col-md-3 hidden">
                                    <div class="form-group">
                                        <label>Dispositivo que presentó la falla:</label>
                                        <select id="printers" name="printers" class="form-control " ></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">¿Requiere reparación externa?</label>
                                        <div class="col-md-6">
                                            Si: <input type="radio" name="r_externa" value="2" >
                                        </div>
                                        <div class="col-md-6">
                                            No: <input type="radio" name="r_externa" value="1" checked >
                                        </div>
                                    </div>
                                </div>
                        		<div id="" class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Categoria de la falla:</label>
                                        <select id="fallas" name="fallas" class="form-control select2" ></select>
                                    </div>
                                </div>
                        		<div id="" class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Tipo de rubro:</label>
                                        <select id="rubro" name="rubro" class="form-control select2" ></select>
                                    </div>
                                </div>
                        		
                        	</div>
                        	<div class="row">
                        		<div class="col-md-6">
                        			<div class="form-group">
                        				<label for="description">Descripción de la falla:</label>
                        				<textarea id="description" class="form-control" placeholder="Escriba aqui la falla que presento el usuario" rows="5" name="txt_falla" required style="resize: vertical;"></textarea >
                        			</div>
                        		</div>
                        		<div class="col-md-6">
                        			<div class="form-group">
                        				<label for="solution">Solución a la falla:</label>
                        				<textarea id="solution" class="form-control" placeholder="Escriba aqui la solución a la falla" rows="5" name="txt_solucion" required style="resize: vertical;"></textarea>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="row">
                        		
                        	</div>
                            <div class="row">
                                <div class="col-md-4">
                                	<button type="reset" name="reset" class="btn btn-flat btn-danger pull-right"> <i class="fa fa-paint-brush"></i> Limpiar campos</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-flat btn-block"> <i class="fa fa-floppy-o"></i> Guardar</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Importar el modal  -->
<?php include 'view/pages/soporte/modals/atender_solicitud.php'; ?>
<script>
    var content = document.getElementById('create_sol');
    content.className = 'active';
</script>