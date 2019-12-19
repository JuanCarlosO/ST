<div class="modal modal-default fade" id="modal_edit_user">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de edición del personal</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible hidden " id="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Aviso! </h4>
              <p id="message"></p>
            </div>
          </div>
        </div>
        <form id="frm_edit_user">
          <input type="hidden" name="option" value="54">
          <input type="hidden" id="edit_persona" name="edit_persona" value="">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">NOMBRE(S)</label>
                <input type="text" id="name" name="name" required="" class="form-control" autofocus autocomplete="off">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for=""> PRIMER APELLIDO</label>
                <input type="text" id="ap_pat" name="ap_pat" required="" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">SEGUNDO APELLIDO</label>
                <input type="text" id="ap_mat" name="ap_mat" required="" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">CLAVE DE SERVIDOR PÚBLICO</label>
                <input type="text" id="clave" name="clave" required="" class="form-control"  placeholder="Escriba solo números" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for=""> ÁREA A LA QUE PERTENCE </label>
                <select id="select_area" name="select_area" class="form-control select2" required></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">GENERO DE LA PERSONA</label>
                <br>
                <div class="col-md-6">
                  <label for="m">MASCULINO:</label><input type="radio" id="m" name="sexo" value="1" required>
                </div>
                <div class="col-md-6">
                  <label for="f">FEMENINO:</label> <input type="radio" id="f" name="sexo" value="2">
                </div>


              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for=""> Estatus de la persona</label>
                <select name="estado" class="form-control" required>
                  <option value="">...</option>
                  <option value="1" selected>ALTA</option>
                  <option value="2">BAJA</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <button type="reset" class="btn btn-danger  btn-flat"> <i class="fa fa-paint-brush"></i> Limpiar formulario </button>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-success btn-block btn-flat"> <i class="fa fa-floppy-o"></i> Guardar </button>
            </div>
            <div class="col-md-5"></div>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>