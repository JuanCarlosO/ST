<div class="modal fade" id="modal_add_marca">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="#" method="post" id="frm_add_marca">
        <input type="hidden" name="option" value="13">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar una marca nueva al catálogo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div id="marca_alert_success" class="alert alert-success alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Éxito </h4>
                  Marca agregada correctamente al catálogo.
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div id="marca_alert_error" class="alert alert-danger alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-times"></i> Error </h4>
                  La marca no se pudo agregar
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="marca">Escriba el nombre de la marca </label>
                <input class="form-control" id="marca" name="marca" placeholder="Escriba aqui la marca" type="text" maxlength="100"required autofocus>
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