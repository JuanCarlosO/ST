<div class="modal fade" id="modal_add_color">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="#" method="post" id="frm_add_color">
        <input type="hidden" name="option" value="15">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar un color o combinación de colores al catálogo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-success alert-dismissible hidden" id="alert_success3">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Éxito </h4>
                  Color agregado correctamente al catálogo.
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible hidden" id="alert_error3">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-times"></i> Error </h4>
                  Ocurrio un error al guardar el color. Intente Nuevamente y su el problema persiste contacte a Desarrollo de Sistemas.
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="color">Escriba el color </label>
                <input class="form-control" id="color" name="color" placeholder="Escriba aqui el color o combinación" type="text" autofocus>
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