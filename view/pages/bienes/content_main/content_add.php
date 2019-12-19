
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Complete el formulario guardar un bien nuevo.</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="alert  alert-dismissible hidden" id="alert_success4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Aviso! </h4>
                            <p id="message_error"></p>
                          </div>
                        </div>
                      </div>
                      

                        <form class="form-horizontal" id="frm_add_bien" action="#" method="post">
                          <input type="hidden" name="option" value="16" required>
                          <div class="row">
                              <div class="col-md-12">
                                <fieldset>
                                  <legend>Características generales del bien</legend>
                                  <div class="form-group">
                                    <label for="grupo" class="col-sm-1 control-label">Grupo: </label>
                                    <div class="col-sm-2">
                                      <select class="form-control " name="grupo" id="grupo" required>
                                        <option value="" selected>...</option>
                                      </select>
                                    </div>
                                    <label for="tipo" class="col-sm-1 control-label">Tipo: </label>
                                    <div class="col-sm-2">
                                      <select class="form-control" name="tipo" id="tipo" required>
                                        <option value="" selected>...</option>
                                      </select>
                                    </div>
                                    <label for="material" class="col-sm-1 control-label">Material: </label>
                                    <div class="col-sm-2">
                                      <select class="form-control" name="material" id="material" required>
                                        <option value="" selected>...</option>
                                      </select>
                                    </div>
                                    <label for="estado" class="col-sm-1 control-label">Estado: </label>
                                    <div class="col-sm-2">
                                      <select class="form-control" name="estado" id="estado" required>
                                        <option value="" selected>...</option>
                                        <option value="1">NUEVO</option>
                                        <option value="2">BUENO</option>
                                        <option value="3">REGULAR</option>
                                        <option value="4">MALO</option>
                                      </select>
                                    </div>
                                  </div>
                                    
                                  <div class="form-group">
                                      <label for="descripcion" class="col-sm-1 control-label">Descripción: </label>
                                      <div class="col-sm-11">
                                        <textarea style="resize: vertical;" class="form-control" name="descripcion" id="descripcion" required></textarea>
                                      </div>
                                  </div>
                                </fieldset>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <fieldset>
                                <legend>Especificaciones del bien</legend>
                                <div class="form-group">
                                  <label for="marca" class="col-sm-1 control-label">Marca: </label>
                                  <div class="col-sm-3">
                                    <div class="input-group input-group-md">
                                      <select class="form-control select2" name="marca" id="marca" required>
                                        <option value="" selected>...</option>
                                      </select>
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Agregar una marca nueva" onclick="modal_marca();"> 
                                          <i class="fa fa-plus"></i> 
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <!-- **************************************************** -->
                                  <label for="modelo" class="col-sm-1 control-label">Modelo: </label>
                                  <div class="col-sm-3">
                                    <div class="input-group input-group-md">
                                      <select class="form-control select2" name="modelo" id="modelo" required>
                                        <option value="" selected>...</option>
                                      </select>
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Agregar un modelo nuevo" onclick="modal_modelo();"> 
                                          <i class="fa fa-plus"></i> 
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <!-- **************************************************** -->
                                  <label for="inventario" class="col-sm-1 control-label">Inventario: </label>
                                  <div class="col-sm-3">
                                    <input type="text" name="inventario" id="inventario" class="form-control" placeholder="Escriba aqui..." maxlength="100" required>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <!-- **************************************************** -->
                                  <label for="serie" class="col-sm-1 control-label">Serie: </label>
                                  <div class="col-sm-3">
                                    <input type="text" name="serie" id="serie" class="form-control" placeholder="Escriba aqui..." maxlength="100" required>
                                  </div>
                                  <!-- **************************************************** -->
                                  <label for="color" class="col-sm-1 control-label">Color: </label>
                                  <div class="col-sm-3">
                                    <div class="input-group input-group-md">
                                      <select class="form-control" name="color" id="color" required>
                                        <option value="" selected>...</option>
                                      </select>
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Agregar un color nuevo" onclick="modal_color();"> 
                                          <i class="fa fa-plus"></i> 
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <!-- **************************************************** -->
                                  
                                </div>
                                <div class="form-group">
                                  <label for="desc_ub" class="col-sm-2 control-label">Descripción de la ubicación: </label>
                                  <div class="col-sm-10">
                                    <textarea style="resize: vertical;" class="form-control" name="desc_ub" id="desc_ub"></textarea required>
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
                                  <div class="form-group">
                                    <!-- **************************************************** -->
                                    <label for="factura" class="col-sm-1 control-label">Factura:</label>
                                    <div class="col-sm-3">
                                      <input type="text" name="factura" id="factura" class="form-control" placeholder="Número de factura" maxlength="100" required>
                                    </div>
                                    <!-- **************************************************** -->
                                    <label for="importe" class="col-sm-1 control-label"> Importe: </label>
                                    <div class="col-sm-2">
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-dollar"></i>
                                        </div>
                                        <input type="text" name="importe" id="importe" class="form-control" placeholder="Ej. 10000" maxlength="100" required pattern="[0-9]*">
                                      </div>
                                    </div>
                                    <!-- **************************************************** -->
                                    <label for="adquisicion" class="col-md-2 control-label"> Fecha de adquisición: </label>
                                    <div class="col-sm-2">
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="date" name="adquisicion" id="adquisicion" class="form-control" placeholder="Ej. 10000" maxlength="100" required pattern="[0-9]*">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <!-- **************************************************** -->
                                    <label for="proveedor" class="col-sm-1 control-label">Proveedor: </label>
                                    <div class="col-sm-3">
                                      <div class="input-group input-group-md">
                                        <select class="form-control select2" name="proveedor" id="proveedor" required>
                                          <option value="" selected>...</option>
                                        </select>
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-success btn-flat" data-toggle="tooltip" title="Agregar un proveedor nuevo" onclick="modal_proveedor();"> 
                                            <i class="fa fa-plus"></i> 
                                          </button>
                                        </span>
                                      </div>
                                    </div>
                                    <!-- **************************************************** -->
                                    <!-- **************************************************** -->
                                    <label for="duracion_g" class="col-sm-2 control-label">Duración de la garantía: </label>
                                    <div class="col-sm-3">
                                      <div class="input-group input-group-md">
                                        <input type="text" name="duracion_g" id="duracion_g" value="" placeholder="Ej: 1 mes, 1 año o 15 días." class="form-control">
                                      </div>
                                    </div>
                                    <!-- **************************************************** -->
                                  </div>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                          <div class="box-footer">
                            <div class="row">
                                <div class="col-md-4 col-xs-4 col-sm-4">
                                  
                                </div>
                                <div class="col-md-4 col-xs-4 col-sm-4">
                                    <button type="submit" class="btn btn-flat btn-block btn-success "> <i class="fa fa-floppy-o"></i> Guardar</button>
                                </div>
                                <div class="col-md-4 col-xs-4 col-sm-4"></div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- importacion de modales -->
<?php include 'view/pages/bienes/modals/modal_add_marca.php' ?>
<?php include 'view/pages/bienes/modals/modal_add_color.php' ?>
<?php include 'view/pages/bienes/modals/modal_add_modelo.php' ?>
<?php include 'view/pages/bienes/modals/modal_add_proveedor.php' ?>
