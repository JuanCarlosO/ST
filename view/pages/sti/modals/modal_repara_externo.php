<div class="modal fade" id="modal_repara_externo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="#" method="post" id="frm_repara_ext">
        <input type="hidden" name="option" value="71">
        <input type="hidden" id="externo_bien_id" name="externo_bien_id" value="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Control de reparaciones externas por equipo.</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div id="modal_re_alert" class="alert  alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> AVISO! </h4>
                  <p id="message_re"></p>
                </div>
              </div>
            </div>
            <div class="row">
            	<div class="col-md-3">
            		<div class="form-group">
            		    <label for="tipo_g">Mandar a </label>
            		    <select id="tipo_g" name="tipo_g" required class="form-control">
            		    	<option value="">...</option>
            		    	<option value="1">Proveedor externo</option>
            		    	<option value="2">Garantia </option>
            		    </select>
            		</div>
            	</div>
            	<div class="col-md-3">
            		<div class="form-group">
            		    <label for="f_sol">Fecha de solicitud</label>
            		   	<input type="date" name="f_sol" value="<?=date('Y-m-d')?>" placeholder="" class="form-control" required>
            		</div>
            	</div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="f_repara">Fecha de reparación</label>
                    <input type="date" name="f_repara" value="<?=date('Y-m-d')?>" placeholder="" class="form-control">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for=""># de reporte <i class="fa fa-question-circle" data-toggle="tooltip" title="Este debe de ser un número de ticket que el proveedor brinda a la persona que reporta. Este número de reporte puede o no existir. "></i> </label>
                    <input type="text" name="n_reporte" value="" placeholder="Ej: 666" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="reporto">ID del reporte </label> <big><i class="fa fa-question-circle" data-toggle="tooltip" title="Este es un número que debe de brindarte el DST."></i></big>
                  <input type="text" name="reporte_st" value="" placeholder="Ej: 1" class="form-control" required autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="reporto">Nombre de la persona que reporta</label>
                  <input type="text" name="reporto" id="servidor" value="" placeholder="" class="form-control" required>
                  <input type="hidden" id="servidor_id" name="servidor_id" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="reporto">¿Quién brinda la garantía?</label>
                  <select name="proveedor_garantia" id="proveedor_garantia" class="form-control" required></select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="reporto">¿Desea adjuntar documento?</label>
                  <select name="tipo_formato" class="form-control"  onchange="toggle_div_documento(this.value)" required="">
                    <option value="">...</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                  </select>
                </div>
              </div>
              <div id="div_documento" class="hidden">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="reporto">¿Qué tipo de documento es ?</label>
                    <select name="tipo_formato" class="form-control" >
                      <option value="">...</option>
                      <option value="1">Oficio de salida de equipo</option>
                      <option value="2">Oficio de entrada de equipo</option>
                      <option value="3">Factura</option>
                      <option value="4">Nota</option>
                      <option value="5">Recibo</option>
                      <option value="6">Reporte de reparacion</option>
                      <option value="7">Aviso al DGSEI</option>
                      <option value="8">Respuesta del DGSEI</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="reporto">Buscar documento</label>
                    <input type="file" name="formato" value="" placeholder="Buscar el archivo PDF" class="form-control" accept=".pdf">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="reporto">Observaciones</label>
                  <textarea name="comentarios" id="comentarios" class="form-control" placeholder="Escriba alguna observación o dato que pueda ser reelavante para usted en el futuro." style="resize: vertical;" rows="5"></textarea>
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