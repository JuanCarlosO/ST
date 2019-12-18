
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Búsqueda por equipo </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="#" id="frm_r_equipo" method="post">
                        <input type="hidden" name="option" value="77">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Buscar por serie</label>
                                    <input type="text" name="serie" id="serie" class="form-control" autocomplete="off">
                                    <input type="hidden" id="serie_id" name="serie_id" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Buscar por inventario</label>
                                    <input type="text" name="inventario" id="inventario" class="form-control" autocomplete="off">
                                    <input type="hidden" id="inventario_id" name="inventario_id" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Buscar por grupo</label>
                                    <select name="grupo" id="grupo" class="form-control">
                                        <option value="">...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Buscar por tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="">...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="reset" class="btn btn-danger btn-flat pull-left">Limpiar campo</button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-block btn-flat">Buscar</button>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                    	<table class="table table-hover table-bordered" id="tbl_reporte_equipo">
                    		<thead>
                    			<tr>

                    				<th width="5%"  class="text-center">ID</th>
                    				<th width="10%" class="text-center">Tipo</th>
                                    <th width="10%" class="text-center">Marca (Modelo)</th>
                    				<th width="15%" class="text-center">
                                        No. Inventario <br>Serie 
                                    </th>
                    				<th width="15%" class="text-center">Estatus</th>
                    				<th width="15%" class="text-center">Ubicación</th>
                    				<th width="20%" class="text-center">Asignado a</th>
                                    

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

