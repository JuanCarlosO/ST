<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="asignar_refaccion">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Ventana de asignación de refacciones</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert  hidden" id="alert-asignar">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-info"></i> <label id="estado-asignar"></label> </h4>
              <p id="message-asignar"></p>
            </div>
          </div>
        </div>
        <form action="#" method="post" id="frm-asignar-refaccion">
          <input type="hidden" id="option" name="option" value="85">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>¿Para quien es la refacción?</label>
                <input type="text" id="sp" name="sp" class="form-control" placeholder="Ej: Juan..." required>
                <input type="hidden" id="sp_id" name="sp_id" value="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Serie/Inventario del bien</label>
                <input type="text" id="bien" name="bien" class="form-control" placeholder="Ej: SAMI..." required>
                <input type="hidden" id="bien_id" name="bien_id" value="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Serie/Inventario de la refacción</label>
                <input type="text" id="refaccion" name="refaccion" class="form-control" placeholder="Ej: 9876..." required>
                <input type="hidden" id="refaccion_id" name="refaccion_id" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Fecha de asignación</label>
                <input type="date" id="f_asigna" name="f_asigna" value="" class="form-control" required> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success btn-flat btn-block">
                <i class="fa fa-floppy-o"></i> Asignar refacción
              </button>
            </div>
            <div class="col-md-4"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>