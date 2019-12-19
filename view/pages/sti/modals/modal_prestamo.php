<div class="modal fade" id="modal_prestamo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="#" method="post" id="frm_add_prestamo">
        <input type="hidden" name="option" value="13">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Generar un préstamo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="servidor">¿Para quien es el prestamo?</label>
                  <input type="text" id="servidor" name="servidor" value="" class="form-control" placeholder="Escriba el nombre de la persona">
                  <input type="hidden" id="servidor_id" name="servidor_id" value="">
                </div>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Buscar bien por Serie o Inventario</label>
                  <input type="text" name="inventarios" id="inventarios" value="" placeholder="Escriba la Serie o el  No. inventario" class="form-control">
                  <input type="hidden" name="inventario_id" id="inventario_id" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="f_retiro">Fecha aproximada de retiro del bien</label>
                  <input type="date" name="f_retiro" id="f_retiro" value="<?=date('Y-m-d')?>" class="form-control">
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