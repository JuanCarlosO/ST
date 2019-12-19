<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<!-- Main content -->
<section class="content container-fluid" id="section">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
                        <div class="col-md-12">
                            <div id="success" class="alert alert-success alert-dismissible hidden">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Operación exitosa!</h4>
                                <p id="mensaje_exitoso"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="error" class="alert alert-danger alert-dismissible hidden">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Operación fallida!</h4>
                                <p id="mensaje_erroneo"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="table-responsive">
                    			<div id="solicitudes_list"></div>
                    		</div>
                    	</div>
                    </div>	
				</div>
			</div>
		</div>
	</div>
</section>
<audio id="audio" >
</audio>

<!-- Importar el modal  -->
<?php include 'view/pages/soporte/modals/atender_solicitud.php'; ?>
<script>
	var content = document.getElementById('new');
	var lista = document.getElementById('listados');
	content.className = 'active';
	lista.className = 'active';
</script>