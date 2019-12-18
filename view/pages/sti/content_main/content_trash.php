<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="alert" class="alert alert-success alert-dismissible hidden">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Aviso!</h4>
                            <p id="message"></p>
                        </div>
                        <form action="#" id="formulario_bajas" method="post">
                            <input type="hidden" id="inventario_id" name="inventario_id" value="">
                            <input type="hidden" name="option" value="">
                            <fieldset>
                                <legend><center>Formulario de búsqueda de bienes para su baja.</center></legend>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Buscar por número de inventario o número de serie:</label>
                                        <div class="input-group input-group-md">
                                            <input type="text" id="criterio" name="criterio" value="" placeholder="Escriba aqui número de inventario o serie..." class="form-control" required autocomplete="off">
                                            <span class="input-group-btn">
                                              <button type="submit" class="btn btn-success btn-flat"> <i class="fa fa-search"></i> </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <br>
                        <div id="div_resultados" class="table-responsive hidden">
                            <table id="tbl_resultado_baja" class="table table-bordered table-hover ">
                                <caption><h4><center>LISTADO DE COINCIDENCIAS ENCONTRADAS</center></h4></caption>
                                <thead>
                                    <tr>
                                        <th width="5%">Acciones</th>
                                        <th width="5%">ID</th>
                                        <th>Tipo</th>
                                        <th>Serie <br>Inventario</th>
                                        <th>Estatus</th>
                                        <th>Asignado a</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="alert" class="alert alert-success alert-dismissible hidden">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Aviso!</h4>
                            <p id="message"></p>
                        </div>
                        <div id="div_bajas" class="table-responsive ">
                            <table id="tbl_bajas" class="table table-bordered table-hover ">
                                <caption><h4><center>LISTADO DE BIENES DADOS DE BAJA</center></h4></caption>
                                <thead>
                                    <tr>
                                        <th width="5%">Acciones</th>
                                        <th width="5%">ID</th>
                                        <th>Caracteristicas del bien</th>
                                        <th width="10%">Tipo de baja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-yellow ">
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" onclick="bajaDefinitiva();">Baja definitiva</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>1</td>
                                        <td>
                                            <ul>
                                                <li> <label>Inventario:</label>12312312312 </li>
                                                <li> <label>Inventario:</label>asfasdasdas </li>
                                                <li> <label>Inventario:</label>asd6a87s6d87as6 </li>
                                            </ul>
                                        </td>
                                        <td>Temporal</td>
                                    </tr>
                                    <tr class="bg-red-active ">
                                        <td>
                                            
                                        </td>
                                        <td>1</td>
                                        <td>
                                            <ul>
                                                <li> <label>Inventario:</label>12312312312 </li>
                                                <li> <label>Inventario:</label>asfasdasdas </li>
                                                <li> <label>Inventario:</label>asd6a87s6d87as6 </li>
                                            </ul>
                                        </td>
                                        <td>Definitiva</td>
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

<?php require_once 'view/pages/sti/modals/modal_baja_definitiva.php'; ?>