<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Atender solicitud</h4>
				</div>
					<div class="modal-body ">
						<div class="row">
							<div class="col-md-12">
	                            <div id="success_modal" class="alert alert-success alert-dismissible hidden">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                <h4><i class="icon fa fa-check"></i> Operación exitosa!</h4>
	                                <p id="mensaje_exito"></p>
	                            </div>
                        	</div>
						</div>
						<div class="row">
							<div class="col-md-12">
	                            <div id="error_modal" class="alert alert-danger alert-dismissible hidden">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                <h4><i class="icon fa fa-times"></i> Ocurrio un error!</h4>
	                                <p id="mensaje_error"></p>
	                            </div>
                        	</div>
						</div>
						<form id="frm_resolver_sol" action="#" class="cuerpo">
							<input type="hidden" id="reparacion_id" name="reparacion_id" value="">
							<input type="hidden" name="option" value="34">
							<div class="row">
								<div class="col-md-9">
									<div class="form-group">
										<label>Usuario afectado:</label>
										<input type="text" name="servidor" id="servidor" value="" class="form-control" placeholder="Escriba el nombre de un servidor público" disabled>
										<input type="hidden" name="servidor_id" value="" id="servidor_id">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">¿Requiere reparación externa?</label>
										<div class="col-md-6">
											Si: <input type="radio" name="r_externa" value="0" onclick="reparacion_externa();" >
										</div>
										<div class="col-md-6">
											No: <input type="radio" name="r_externa" value="1" checked >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Dispositivo que presentó la falla:</label>
										<select id="device" name="device" class="form-control" ></select>
									</div>
								</div>
								<div id="div_printers" class="col-md-4 hidden">
									<div class="form-group">
										<label>Dispositivo que presentó la falla:</label>
										<select id="printers" name="printers" class="form-control " ></select>
									</div>
								</div>
								<div id="" class="col-md-4 ">
									<div class="form-group">
										<label>Categoria de la falla:</label>
										<select id="fallas" name="fallas" class="form-control select2" required></select>
									</div>
								</div>
								<div id="" class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Tipo de rubro:</label>
                                        <select id="rubro" name="rubro" class="form-control" required></select>
                                    </div>
                                </div>
								
							</div>
							<div class="row"></div>
							<div class="row"></div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="description">Descripción de la falla:</label>
										<textarea id="falla" name="falla" class="form-control" placeholder="Escriba aqui la falla que presento el usuario" rows="5" required style="resize: vertical;"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="solution">Solución a la falla:</label>
										<textarea id="solution" name="solution" class="form-control" placeholder="Escriba aqui la solución a la falla" rows="5" required style="resize: vertical;"></textarea>
									</div>
								</div>
							</div>
							
						    <div class="row">
						    	<div class="col-md-4"></div>
						       
						        <div class="col-md-4">
						            <button type="submit" class="btn btn-success btn-flat btn-block"> <i class="fa fa-floppy-o"></i> Guardar solución </button>
						        </div>
						        <div class="col-md-4"></div>
						    </div>
						</form>
						
					</div>
		</div>
	</div>
</div>