<div class="modal fade" id="modal_atender_rep_ext">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Antender la solicitud de reparación externa.</h4>
				</div>
				<div class="modal-body">
					<div id="modal_alert_re" class="alert  alert-dismissible hidden">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-info"></i> <label id="modal_estado_re"></label> </h4>
		                <p id="modal_message_re"></p>
		            </div>
					<form id="frm_rep_ext" action="#" method="post">
						<input type="hidden" id="re" name="re" value="">
						<input type="hidden" name="option" value="91">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Número de ticket del proveedor.</label>
									<input type="text" id="ticket" name="ticket" value="" placeholder="Ej: 10987" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Buscar documento</label>
									<input type="text" id="documento" name="documento" value="" placeholder="Ej: Factura_2019" required class="form-control">
									<input type="hidden" id="documento_h" name="documento_h" value="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Reparación por</label>
									<select name="t_repara" class="form-control" required>
										<option value="">...</option>
										<option value="1">Proveedor externo</option>
										<option value="1">Garantia</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Observaciones</label>
									<textarea name="observaciones" class="form-control" style="resize: vertical; max-height: 200px;"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-flat btn-block">
									<i class="fa fa-floppy-o"></i> Guardar seguimiento de reparación	
								</button>
							</div>
							<div class="col-md-4"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cancelar</button>
					
				</div>
			</div>
		</div>
	</div>