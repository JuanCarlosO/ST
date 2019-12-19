<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="modal_adjuntar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de alta de garantía</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert  alert-dismissible hidden" id="adjuntar_alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Aviso! </h4>
              <p id="adjuntar_message"></p>
            </div>
          </div>
        </div>
        
        <form action="#" id="frm_adjuntar" enctype="multipart/form-data" >
        	<input type="hidden" name="option" value="74">
          <input type="hidden" name="repa_ext" id="repa_ext" value="">
          <input type="hidden" name="bien_id" id="bien_id" value="">

        	<div class="row">
        		<div class="col-md-3">
        			<div class="form-group">
        				<label for="">Tipo de documento</label>
        				<select name="tipo_formato" class="form-control" required="required">
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
        		<div class="col-md-9">
        			<div class="form-group">
        				<label for="">Buscar el documento</label>
        				<input type="file" name="archivo" value="" class="form-control" accept=".pdf" required>
        			</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-12">
        			<div class="form-group">
        				<label for="">Escriba algún comentario (opcional)</label>
        				<textarea name="comentario" placeholder="Los comentarios ayudan a tener un panorama más claro de los archivos adjuntados" class="form-control" style="resize: vertical;"></textarea>
        			</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-6">
        			<button type="reset" class="btn btn-danger btn-flat pull-left"> Limpiar formulario </button>
        		</div>
        		<div class="col-md-6">
        			<button type="submit" class="btn btn-success btn-flat pull-right" > <i class="fa fa-floppy-o"></i> Guardar  </button>
        		</div>
        	</div>
        </form>
      </div>
        
    </div>
  </div>
</div>