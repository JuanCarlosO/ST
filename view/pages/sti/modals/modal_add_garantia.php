<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-info fade" id="addGarantia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de alta de garantía</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert  alert-dismissible hidden " id="modal_alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-info"></i> AVISO! </h4>
              <p id="message"></p>
            </div>
          </div>
        </div>
        
        <form action="#" id="frm_add_garantia" >
          <input type="hidden" name="option" value="58">
          <div class="row">
          	<div class="col-md-4">
              <div class="form-group">
                <label for="f_solicitud">Fecha de inicio</label>
                <input type="date" id="f_solicitud" name="f_solicitud" value="<?=date('Y-m-d')?>" class="form-control" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="f_solicitud">Fecha de termino</label>
                <input type="date" id="f_fin" name="f_fin" value="<?=date('Y-m-d')?>" class="form-control" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="proveedor">Proveedor que brinda la garantía </label>
                <select class="form-control " name="proveedor" id="proveedor" required>
                  <option value="" disabled="" selected="">...</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success btn-flat btn-block"> <i class="fa fa-floppy-o"></i> Guardar  </button>
            </div>
            <div class="col-md-4"></div>
          </div>
          <!-- <div id="archivos">
          	<div class="row">
          		<div class="col-md-6">
          			<button type="button" class="btn btn-block btn-social btn-success btn-flat" onclick="add_field_file();">
	                    <i class="fa fa-file-word-o"></i> Quiero agregar documento
	                </button>
          		</div>
          	</div>
          	
          		
          </div> -->
        </form>
      </div>
        
    </div>
  </div>
</div>