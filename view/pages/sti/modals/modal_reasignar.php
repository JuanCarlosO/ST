<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="modal_reasignar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de reasignación de bien</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-dismissible hidden " id="modal_reasigna_alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-info"></i> <label id="modal_estado"></label></h4>
              <p id="modal_message"></p>
            </div>
          </div>
        </div>
                
        <form action="#" id="frm_reasignar" method="post">
          <input type="hidden" name="option" value="84">
          <input type="hidden" name="bien_id" id="bien_id" value="">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="sp">Reasignar a</label>
                <input type="text" id="sp" name="sp" value="" placeholder="Escriba un nombre o apellido y seleccione el nombre de la persona" class="form-control" required autocomplete="off">
                <input type="hidden" name="sp_h" id="sp_h" value="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tipo de asignación</label>
                <select id="t_asigna" name="t_asigna" class="form-control" required>
                  <option value="">...</option>  
                  <option value="1">Permanente</option>
                  <option value="2">Temporal</option>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Área en la que estará ubicado el bien</label>
                <input type="text" id="areas" name="areas" value="" placeholder="Ej: Departamento de ..." required class="form-control">
                <input type="hidden" id="areas_h" name="areas_h" value="">
              </div>
            </div>
            
            
          </div>  
          <div class="row">
            <div class="col-md-6">
              <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cancelar</button>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-success btn-flat pull-right"> <i class="fa fa-floppy-o"></i> Guardar reasignación </button>
            </div>
          </div>
        </form>
      </div>
        
    </div>
  </div>
</div>








        



            




            