<div class="modal fade" id="modal_repara_garantia">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" method="post" id="frm_garantia">
        <input type="hidden" name="option" value="">
        <input type="hidden" id="garantia_bien_id" name="garantia_bien_id" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Reparación por apartado de garantia</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div id="garantia_alert" class="alert  alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> AVISO! </h4>
                  <p id="garantia_message"></p>
                </div>
              </div>
            </div>
            <div class="row">
            	<div class="col-md-3">
                  <div class="form-group">
                    <label>Fecha de solicitud</label>
                    <input type="date" name="f_sol" class="form-control">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label>Número de serie o inventario</label>
                    <input type="date" name="equipo" class="form-control" id="equipo" placeholder="Ej. 22222222">
                    <input type="hidden" name="equipo_id" id="equipo_id">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label>Número de serie o inventario</label>
                    <input type="date" name="equipo" class="form-control" id="equipo" placeholder="Ej. 22222222">
                    <input type="hidden" name="equipo_id" id="equipo_id">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label>Número de reporte</label>
                    <input type="text" name="reporte" class="form-control" id="reporte" placeholder="Ej. 00130">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group"></div>
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