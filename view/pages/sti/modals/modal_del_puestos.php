<div class="modal modal-default fade" id="modal_del_puestos">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de eliminación puestos del personal</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert  alert-dismissible hidden " id="alert_puestos">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Aviso! </h4>
              <p id="message"></p>
            </div>
          </div>
        </div>
        <table id="list_puestos" class="table table-hover table-bordered">
        	<caption> <h3><center>Puesto(s) asignado(s)</center></h3> </caption>
        	<thead>
        		<tr>
        			<th class="text-center">NOMBRE DEL PUESTO</th>
        			<th class="text-center">ELIMINAR</th>
        		</tr>
        	</thead>
        	<tbody></tbody>
        </table>
        
      </div>
    </div>
  </div>
</div>