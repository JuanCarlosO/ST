<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bienes materiales y sus caracteristicas.</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form id="frm_reporte_equipo" action="#" method="post">
                        <input type="hidden" name="option" value="20">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Seleccione un grupo</label>
                                    <select class="form-control select2" name="grupo" id="grupo" >
                                        <option value="" >...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Seleccione un tipo</label>
                                    <select class="form-control select2" name="tipo" id="tipo" >
                                        <option value="" >...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado" class="control-label">Estado: </label>
                                    <select class="form-control" name="estado" id="estado" >
                                        <option value="" >...</option>
                                        <option value="1">NUEVO</option>
                                        <option value="2">BUENO</option>
                                        <option value="3">REGULAR</option>
                                        <option value="4  ">MALO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
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
                                <table id="tbl_r_equipo" class="table table-hover table-bordered"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
