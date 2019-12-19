<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de bienes y acciones disponibles .</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div id="alert" class="alert alert-success alert-dismissible ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Éxito!</h4>
                            <p id="message"></p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-10">
                          <fieldset>
                            <legend>Formulario de búsqueda por usuario</legend>
                            <form id="frm_buscar_bienes" class="" action="#" method="post">
                              <input type="hidden" name="option" value="56">
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group">
                                    <label for="server">Seleccione al servidor público para buscar sus bienes</label>
                                    <select class="form-control select2" name="select_personal" id="select_personal">
                                      
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                  <button type="submit" name="button" class="btn btn-success btn-flat btn-block center-block">
                                    Buscar bienes del usuario
                                  </button>
                                </div>
                                <div class="col-md-4"></div>
                              </div>
                            </form>
                          </fieldset>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-flat btn-success btn-lg pull-right" data-toggle="tooltip" title="Generar un prestamo" onclick="modal_prestamo();"> <i class="fa fa-mail-reply" style="font-size: 60px;"></i> <br>
                          Prestar un bien </button>
                        </div>
                      </div>
                      
                      <hr>
                      <fieldset>
                        <legend>Formulario de asignación de bienes</legend>
                        <form class="" action="#" method="post">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="type_bien">Seleccione un tipo de bien</label>
                                <select class="form-control select2" id="type_bien" name="type_bien">
                                  <option value=""> ... </option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="type_bien">Listado de bienes disponibles</label>
                                <select class="form-control select2" id="type_bien" name="type_bien">
                                  <option value=""> ... </option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="server">Asignar a </label>
                                <select class="form-control select2" name="server" id="server">
                                  <option value="">...</option>
                                  <option value="Yo">otro mero mero palomero</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <button type="submit" class="btn btn-success btn-block btn-flat " name="button">Asignar el bien </button>
                            </div>
                            <div class="col-md-4"></div>
                          </div>
                        </form>
                      </fieldset>
                      <hr>
                        <div class="table-responsive">
                        	<table class="table table-hover table-bordered" id="">
                        		<thead>
                        			<tr>
                        				<th class="text-center" width="5%">ID</th>
                        				<th class="text-center" width="85%">Características del bien</th>
                        				<th class="text-center" width="10%">Acciones</th>

                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr class="text-center">
                                <td>1000999</td>
                        				<td class="text-left">
                                  <ol type="A">
                                    <li> <label> Criterio: </label> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                    <li> <label> Criterio: </label> Hola mundo</li>
                                    <li> <label> Criterio: </label> Hola mundo</li>
                                  </ol>
                                </td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" id="retirar" class="btn btn-danger btn-flat" data-toggle="tooltip" data-placement="right" title="Retirarle el bien al servidor público" onclick="retirar()"><i class="fa fa-times"></i></button>

                                    <button type="button" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="right" title="Reasignar el bien a un servidor público diferente" onclick="modal_reasignar(1);"><i class="fa fa-exchange"></i></button>
                                  </div>
                                </td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
<?php include 'view/pages/sti/modals/modal_reasignar.php'; ?>
<?php include 'view/pages/sti/modals/modal_prestamo.php'; ?>