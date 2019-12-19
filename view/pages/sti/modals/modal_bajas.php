<div class="modal fade" id="modal_bajas">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" method="post" id="frm_bajas">
        <input type="hidden" name="option" value="57">
        <input type="hidden" id="bien_id" name="bien_id" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Apartado de bajas</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div id="modal_alert" class="alert  alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> AVISO! </h4>
                  <p id="message"></p>
                </div>
              </div>
            </div>
            <div class="row">
            	<div class="col-md-4">
            		<div class="form-group">
            		    <label for="marca">Seleccione un tipo de baja </label>
            		    <select id="tipo_b" name="tipo_b" required class="form-control">
            		    	<option value="">...</option>
            		    	<option value="1">Temporal</option>
            		    	<option value="2">Definitiva</option>
            		    </select>
            		</div>
            	</div>
            	<div class="col-md-8">
            		<div class="form-group">
            		    <label for="marca">Agrege un comentario/razón/descripción/motivo de la baja </label>
            		   	<textarea class="form-control" name="comentario" id="comentario" placeholder="Escriba aqui" style="resize: vertical;" required></textarea>
            		</div>
            	</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success btn-flat"> <i class="fa fa-floppy-o"></i> Guardar </button>
          </div>
      </form>
    </div>
  </div>
</div>