<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Criterios de búsqueda</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-info"></i> Aviso!</h4>
                                <b>Nota:</b> Para el uso correcto de este apartado, se debera usar únicamente uno de los campos disponibles a la vez y en caso de completar los dos, se tomará como prioridad el nombre del servidor público.
                            </div>
                        </div>
                    </div>
                    <form id="frm_reporte_user" action="#" method="post">
                        <input type="hidden" name="option" value="21">
                        <input type="hidden" id="servidor_id" name="servidor_id" value="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre de Servidor Público</label>
                                    <input type="text" id="servidor" name="servidor" value="" placeholder="Escriba un nombre o apellido y seleccione el nombre de la persona" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Buscar por área</label>
                                    <select id="area" name="area" class="form-control select2">
                                        <option value="">...</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-flat btn-block btn-danger " onclick="limpiar_form();"> <i class="fa fa-trash-o"></i> Limpiar formulario</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-flat btn-block"> <i class="fa fa-search"></i> Buscar información</button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Resultado de la búsqueda</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive">
                                <table id="tbl_r_user" class="table table-hover table-bordered"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
