<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">  </h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<fieldset>
						<legend> ~ Búscar el bien ~ </legend>
						<form action="" method="post">
							<input type="hidden" name="option" value="">
							<div class="row">
								<!-- Mi contenido -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="type_bien">Seleccione un tipo de bien</label>
										<select name="type_bien" id="type_bien" class="form-control" >
											<option value="">...</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Listado de bienes disponibles</label>
										<select class="form-control select2" style="width: 100%;" required>
											<option value=""  selected>...</option>
											<option value="IMPRESORA">IMPRESORA</option>
											<option value="AP">AP</option>
											<option value="CABLE">CABLE</option>
											<option value="MODEM">MODEM</option>
											<option value="TELÉFONOS">TELÉFONOS</option>
											<option value="CÁMARA">CÁMARA</option>
											<option value="CPU">CPU</option>
										</select>
									</div>

								</div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-4">
									<div class="col-md-1">
										<button type="submit" class="btn btn-success btn-flat"> <i class="fa fa-search"></i> Buscar coincidencias </button>
									</div>
								</div>
								<div class="col-md-4"></div>
							</div>
						</form>
					</fieldset>
					<fieldset>
						<legend> ~ Buscar por número de serie ~ </legend>
						<div class="row">
							<form action="#" method="post">
								<input type="hidden" name="option" id="option" value="">
								<input type="hidden" name="bien_id" id="bien_id" value="">
								<div class="col-md-8">

									<div class="form-group">
										<label>Escriba el número de serie</label>
										<div class="input-group input-group-md">
											<input type="text" name="serie" value="" placeholder="Ej: 12345678" class="form-control">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-success btn-flat"> <i class="fa fa-search"></i> </button>
											</span>
										</div>
									</div>
								</div>

							</form>

						</div>
					</fieldset>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered" id="listadoBienes">
									<thead>
										<tr>
											<th width="5%" class="text-center">#</th>
											<th width="10%" class="text-center">Tipo <br> (Status)</th>
											<th width="15%" class="text-center">Grupo</th>
											<th width="15%" class="text-center">No. Inventario</th>
											<th width="15%" class="text-center">Serie</th>
											<th width="10%" class="text-center">Marca</th>
											<th width="15%" class="text-center">Modelo</th>
											<th width="20%" class="text-center">Asignado a</th>
											<th class="text-center"> Acciones </th>

										</tr>
									</thead>
									<tbody>
										<tr class="text-center">
											<td>data</td>
											<td>data</td>
											<td>data</td>
											<td>data</td>
											<td>data</td>
											<td>data</td>
											<td>data</td>
											<td>Nombre de algún servidor público.</td>
											<td>
												<form action="index.php?menu=create_presta" method="post">
													<input type="hidden" name="option" value="">
													<input type="hidden" name="bien_id" value="">
													<button type="submit" class="btn btn-success btn-flat" data-toggle="tooltip" title="Prestar el bien"> 
														<i class="fa fa-share"></i> 
													</button>
												</form>
												 
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box -->
		</div>
	</div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- /.content -->
