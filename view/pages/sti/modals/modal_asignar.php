<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-info fade" id="asignar_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de asignación de bienes</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible hidden " id="alert_success_asignar">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Éxito </h4>
                El bien a sido asignado de manera exitosa <br>
                Espere por favor, guardando todos los cambios.
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-danger alert-dismissible hidden " id="alert_error_asignar">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-times"></i> Error </h4>
                Ocurrio un error al asginar el bien. Intente Nuevamente y si el problema persiste contacte a Desarrollo de Sistemas.
              </div>
            </div>
          </div>
          <form action="#" id="frm_asignar">
            <input type="hidden" name="option" value="25">
            <input type="hidden" name="bien_id_asigna" id="bien_id_asigna" value="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="servidor">Nombre del servidor público</label>
                  <input type="text" id="servidor" name="servidor" value="" placeholder="Escriba un nombre o apellido y seleccione el nombre de la persona" class="form-control" required>
                  <input type="hidden" name="servidor_id" id="servidor_id" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="servidor">Tipo de asignación</label>
                  <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">...</option>
                    <option value="1">PERMANENTE</option>
                    <option value="2">TEMPORAL</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="servidor">Área en la que estara ubicado el bien</label>
                  <input type="text" name="area" id="area" placeholder="Escriba el nombre de un área" value="">
                  <input type="hidden" name="area_id" id="area_id" value="">
                </div>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cancelar</button>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-flat pull-right"> <i class="fa fa-floppy-o"></i> Guardar </button>
              </div>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>