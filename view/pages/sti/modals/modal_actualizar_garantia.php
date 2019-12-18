
<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="modal_actualiza">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de actualizacion de información de la garantía</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible  " id="alert_success_asignar">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Éxito! </h4>
              La información a sido actualizada exitosamente.
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible  " id="alert_error_asignar">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-times"></i> Error! </h4>
              <p id="message_error"></p>
            </div>
          </div>
        </div>
        <form action="#" id="frm_update_externa" enctype="multipart/form-data" >
        	<input type="hidden" name="option" value="">
        	<input type="hidden" name="garantia_id" value="">
        	<div class="row">
        		<div class="col-md-5">
        			<div class="form-group">
        				<label for="">Actualizar el estado de la reparación externa</label>
        				<select name="estado" id="estado" class="form-control">
        					<option value="">...</option>
        					<option value="1">Entregado</option>
        					<option value="2">En proceso</option>
        					<option value="3">Pendiente por recoger</option>
        				</select>
        			</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-6">
        			<button type="reset" class="btn btn-danger btn-flat pull-left"> Limpiar formulario </button>
        		</div>
        		<div class="col-md-6">
        			<button type="submit" class="btn btn-success btn-flat pull-right" > <i class="fa fa-floppy-o"></i> Guardar  </button>
        		</div>
        	</div>
        </form>
      </div>
        
    </div>
  </div>
</div>
