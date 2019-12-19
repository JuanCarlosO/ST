<div class="modal fade" id="modal_add_puesto">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <form action="#" method="post" id="frm_add_puesto">
        <input type="hidden" name="option" value="53">
        <input type="hidden" id="persona" name="persona" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Crear una nueva asignacion de puesto.</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="alert  alert-dismissible hidden" id="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Aviso! </h4>
                  <p id="message"></p>
                </div>
              </div>
            </div>
            
            <div class="box-body">
              <div class="row">
              	<div class="col-md-4">
              		<div class="form-group">
              		  <label for="color">Tipo de puesto </label>
              		  <select id="tipo_puesto" name="tipo_puesto" class="form-control" required onchange="changeCampo(this.value);">
              		  	<option value="">...</option>
              		  	<option value="1">ENCARGADO</option>
              		  	<option value="2">EMPLEADO</option>
              		  </select>
              		</div>
              	</div>
              	<div class="col-md-6">
              		<div id="campo_aux" class="form-group">
              		  
              		</div>
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