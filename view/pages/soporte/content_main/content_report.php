<section class="hidden" id="section_export">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="table-responsive">
                        <table id="tbl_reportes_entregados" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="5%">FECHAS</th>
                                    <th width="40%">FIRMA</th>
                                    <th width="40%">DESCRIPCIONES</th>
                                    <th width="5%">AFECTADO</th>
                                    
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
<!-- Main content -->
    <section id="section_normal" class="content container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <form id="frm_reporte" action="#">
                            <input type="hidden" name="option" value="39">
                        	<div class="row">
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Tipo de reporte</label>
                        				<select id="t_report" name="t_report" class="form-control" required autofocus onchange="change_t_report();">
                        					<option value="">...</option>
                        					<option value="1">Generar reporte</option>
                        					<!-- <option value="2">Reportes entregados</option> -->
                        					<option value="2">Muestreo </option>
                        				</select>
                        			</div>
                        		</div>
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Fecha inicio:</label>
                        				<input type="date" name="fecha_de" id="fecha_de" value="<?=date('Y-m-d');?>" class="form-control">
                        			</div>
                        		</div>
                        		<div class="col-md-4">
                        			<div class="form-group">
                        				<label>Fecha hasta:</label>
                        				<input type="date" name="fecha_hasta" id="fecha_hasta" value="<?=date('Y-m-d');?>" class="form-control">
                        			</div>
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col-md-5">
                        			<div class="form-group">
                        				<label>Atendido por:</label>
                        				<select name="soporte" id="soporte" class="form-control">
                                            <option value="">...</option>
                                        </select>
                        			</div>
                        		</div>
                        		<div class="col-md-2">
                        			<div class="form-group">
                        				<label>Rubro:</label>
                        				<select id="rubro" name="rubro" class="form-control">
                        					<option value="">...</option>
                        				</select>
                        			</div>
                        		</div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Falla:</label>
                                        <select id="fallas" name="fallas" class="form-control">
                                            <option value="">...</option>
                                        </select>
                                    </div>
                                </div>
                        		<div class="col-md-2">
                        			<div class="form-group">
                        				<label>Calificación del servicio:</label>
                        				<select id="calificacion" name="calificacion" class="form-control">
                        					<option value="">...</option>
                        					<option value="1">Excelente</option>
                        					<option value="2">Bueno</option>
                        					<option value="3">Regular</option>
                        					<option value="4">Malo</option>
                        				</select>
                        			</div>
                        		</div>
                        	</div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success btn-flat btn-block"> 
                                    	<i class="fa fa-file-excel-o"></i> Generar
                                    </button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <a class="btn btn-app bg-green color-palette hidden" onclick="exportMiSelect();">
                                    <i class="fa fa-file-excel-o"></i> Exportar mi selección
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible hidden">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                                    <p></p>
                                </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla_reporte" class="table table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" name="check_all" value="0" onchange="selectAll(this.value);"> </th>
                                                <th>ID</th>
                                                <th>EQUIPO</th>
                                                <th>RUBRO</th>
                                                <th>FECHAS</th>
                                                <th>DESCRIPCIONES</th>
                                                <th>PERSONAL</th>
                                                <th>CALIFICACIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="div_muestreo" class="row">
                            <div id="m_equipo" class="col-md-3">
                                <div class="table-responsive">
                                    <table id="tbl_m_equipo" class="table table-bordered table-hover">
                                        <caption><center><h3>Muestra por Equipo</h3></center></caption>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Cuenta</th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table id="tbl_m_solicitud" class="table table-bordered table-hover">
                                        <caption><center><h3>Muestra por Solicitud</h3></center></caption>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Persona afectada</th>
                                                <th class="text-center">Cuenta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table id="tbl_m_rubro" class="table table-bordered table-hover">
                                        <caption><center><h3>Muestra por Rubro</h3></center></caption>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Criterio</th>
                                                <th class="text-center">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table id="tbl_m_personalst" class="table table-bordered table-hover">
                                        <caption><center><h3>Muestra por Personal ST</h3></center></caption>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Soporte Técnico</th>
                                                <th class="text-center">Cuenta</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Importar el modal  -->
<?php include 'view/pages/soporte/modals/atender_solicitud.php'; ?>
<script>
    var content = document.getElementById('reports');
    content.className = 'active';
</script>