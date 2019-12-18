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
                    </div>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert  alert-dismissible hidden" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa "></i> <label id="estado"></label></h4>
                        <p id="message"></p>
                      </div>
                    </div>
                  </div>
                  <form action="#" method="post" id="frm_xlsx_asignacion">
                    <input type="hidden" name="option" value="88">
                    <div class="row">
                    	<div class="col-md-4">
                    		<div class="form-group">
                    			<label>Seleccionar tipo de documento</label>
                    			<select id="t_doc" name="t_doc" class="form-control"></select>
                    		</div>
                    	</div>
                    	<div class="col-md-4">
                    		<div class="form-group">
                    			<label>Asunto/Nombre del documento</label>
                    			<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Ej: Factura_de_mayo" autocomplete="off">
                    		</div>
                    	</div>
                    	<div class="col-md-4">
                    		<div class="form-group">
                    			<label>Buscar documento</label>
                    			<input type="file" class="form-control" id="archivo" name="archivo" value="" accept=".pdf">
                    		</div>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="form-group">
                    			<label>Observaciones</label>
                    			<textarea name="observaciones" class="form-control" style="resize: vertical; max-height: 200px;"></textarea>
                    		</div>
                    	</div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
