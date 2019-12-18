<div class="modal fade" id="modal_baja_definitiva">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <form action="#" method="post" id="frm_baja_definitiva">
        <input type="hidden" name="option" value="76">
        <input type="hidden" id="baja_id" name="baja_id" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Justificación de baja definitiva.</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-dismissible hidden" id="alert_baja_definitiva">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> Aviso! </h4>
                  <p id="message_baja_definitiva"></p>
                </div>
              </div>
            </div>
            
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="color">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Escriba aqui..." autofocus style="resize: vertical;" rows="6"></textarea>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="color">Archivo de baja</label>
                    <input type="file" id="file_baja" name="file_baja" class="form-control" title="Clic para buscar el archivo de baja">
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