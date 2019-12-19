<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="modal_add_refaccion">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Alta de refacciones</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert  hidden" id="alert-refaccion">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-info"></i> <label id="estado-refacciones"></label> </h4>
              <p id="message-refacciones"></p>
            </div>
          </div>
        </div>
        <form action="#" method="post" id="frm-add-refaccion">
          <input type="hidden" id="option" name="option" value="86">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Grupo</label>
                <select id="grupo" name="grupo" class="form-control"></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tipo de bien</label>
                <select id="t_bien" name="t_bien" class="form-control" required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Material</label>
                <select id="material" name="material" class="form-control" required></select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Estado de refacción</label>
                <select id="estado" name="estado" class="form-control" required>
                  <option value=""></option> 
                  <option value="1">BUENO</option>
                  <option value="2">REGULAR</option>
                  <option value="3">MALO P/ REPARACIÓN</option>
                  <option value="4">MALO P/ BAJA</option>
                  <option value="5">BAJA</option>
                  <option value="6">ACTA</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Marca</label>
                <select id="marca" name="marca" class="form-control" required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Modelo</label>
                <select id="modelo" name="modelo" class="form-control" required></select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Inventario</label>
                <input type="text" id="inventario" name="inventario" value="" placeholder="Ej: 9876..." required class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Serie</label>
                <input type="text" id="serie" name="serie" value="" placeholder="Ej: 9876..." required class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripción de la refacción</label>
                <textarea name="descripcion" class="form-control" placeholder="Caracteristicas de la refaccion" style="max-height: 250px; resize: vertical;"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success btn-flat">
                <i class="fa fa-floppy-o"></i> Guardar refacción
              </button>
            </div>
            <div class="col-md-4"></div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>