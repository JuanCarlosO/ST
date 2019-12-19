<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Listado y acciones al personal adscrito a la UAI.</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="">
                       <table class="table table-hover table-bordered" id="listadoPersonal">
                          <thead>
                             <tr>
                                <th width="5%" class="text-center">Acciones</th>
                                <th width="5%"  class="text-center">ID</th>
                                <th width="35%" class="text-center">Servidor público</th>
                                <th width="35%" class="text-center">Unidad Administrativa <br> Codigo </th>
                                <th width="20%" class="text-center">Puesto(s)</th>
                                
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
<?php include 'view/pages/sti/modals/modal_asignar_puesto.php'; ?>
<?php include 'view/pages/sti/modals/modal_edit_user.php'; ?>
<?php include 'view/pages/sti/modals/modal_del_puestos.php'; ?>