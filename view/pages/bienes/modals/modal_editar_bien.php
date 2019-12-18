
<div class="modal modal-success fade" id="editar_bien_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de Edición</h4>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-info alert-dismissible hidden" id="alert_success_edit">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Éxito </h4>
                La edición a sido guardada de manera correcta.<br>
                Actualizando información. Espere por favor...
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-danger alert-dismissible hidden " id="alert_error_edit">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-times"></i> Error </h4>
                Ocurrio un error al actualizar la información. Intente nuevamente y si el problema persiste contacte a Desarrollo de Sistemas.
              </div>
            </div>
          </div>
          <form action="#" method="post" id="frm_editar_bien">
            <input type="hidden" name="option" value="24">
            <input type="hidden" name="bien_id_edit" id="bien_id_edit" value="">
            <div class="row">
              <div class="col-md-12">
                <fieldset>
                  <legend>Características generales del bien</legend>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="grupo" class="control-label">Grupo: </label>
                        <select class="form-control " name="grupo_edit" id="grupo_edit" required>
                          <option value="" >...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="tipo_edit" class="control-label">Tipo: </label>
                        <select class="form-control" name="tipo_edit" id="tipo_edit" required>
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="material_edit" class="control-label">Material: </label>
                        <select class="form-control" name="material_edit" id="material_edit" required>
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="estado_edit" class="control-label">Estado: </label>
                        <select class="form-control" name="estado_edit" id="estado_edit" required>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="descripcion_edit" class="control-label">Descripción: </label>
                        <textarea style="resize: vertical;" class="form-control" name="descripcion_edit" id="descripcion_edit" required></textarea>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <fieldset>
                  <legend>Especificaciones del bien</legend>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="marca_edit" >Marca: </label>
                        <select class="form-control" name="marca_edit" id="marca_edit" required>
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="modelo_edit" class="control-label">Modelo: </label>
                        <select class="form-control" name="modelo_edit" id="modelo_edit" required>
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="color_edit" class="control-label">Color: </label>
                        <select class="form-control" name="color_edit" id="color_edit" required>
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inventario_edit" class="control-label">Inventario: </label>
                        <input type="text" name="inventario_edit" id="inventario_edit" class="form-control" placeholder="Escriba aqui..." maxlength="100" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="serie_edit" class="control-label">Serie: </label>
                        <input type="text" name="serie_edit" id="serie_edit" class="form-control" placeholder="Número de serie" maxlength="100" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for=""> Descripcion de la ubicacación </label>
                        <textarea name="desc_ub_edit" id="desc_ub_edit" placeholder="Editar la ubicacación del bien" class="form-control" style="resize: vertical;"></textarea>
                      </div>
                    </div>
                  </div>
                  
                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <fieldset>
                  <legend>Datos de la adquisición</legend>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="factura_edit" class="control-label">Factura:</label>
                        <input type="text" name="factura_edit" id="factura_edit" class="form-control" placeholder="Número de factura" maxlength="100" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="importe_edit" class="control-label"> Importe: </label>
                        <input type="number" name="importe_edit" id="importe_edit" class="form-control" placeholder="Ej. 10000" maxlength="100"  pattern="[0-9]*" step=".01">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="adquisicion_edit" class="control-label"> Fecha de adquisición: </label>
                        <input type="date" name="adquisicion_edit" id="adquisicion_edit" class="form-control" placeholder="Ej. 10000" maxlength="100"  value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="proveedor_edit" class="control-label">Proveedor: </label>
                        <select class="form-control" name="proveedor_edit" id="proveedor_edit" >
                          <option value="" selected>...</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <fieldset>
                  <legend>Datos de la asignación</legend>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="hidden" id="asignacion_id" name="asignacion_id" value="">
                        <label for="servidor_edit" class="control-label">Servidor público:</label>
                        <input type="text" name="servidor_edit" id="servidor_edit" class="form-control servidor" placeholder="Nombre de servidor público" maxlength="100" required>
                        <input type="hidden" name="servidor_id_edit" id="servidor_id_edit" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="factura_edit" class="control-label">Tipo de asignación:</label>
                        <select id="t_asigna" name="t_asigna" class="form-control" required>
                        </select>
                      </div>
                    </div>
                    
                  </div>

                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Cancelar</button>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-info btn-flat pull-right"> <i class="fa fa-floppy-o"></i> Guardar </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>