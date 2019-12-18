<style type="text/css">
  ul.ui-autocomplete {
    z-index: 1100;
  }
</style>
<div class="modal modal-default fade" id="modal_edit_refaccion">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ventana de edición asignación de refacciones</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-dismissible hidden " id="refaciones_alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Aviso! </h4>
              <p id="refacciones_message"></p>
            </div>
          </div>
        </div>
        
        <div class="table-responsive">
        	<table id="tbl_refacciones" class="table table-hover table-bordered">
        		<thead>
        			<tr>
        				<th>ID</th>
        				<th>Refacción</th>
        				<th width="5%">Eliminar</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr class="text-center">
        				<td>1</td>
        				<td>asdasdasawdasd</td>
        				<td>
        					<button type="button" class="btn btn-flat btn-danger " data-toggle="tooltip" title="Eliminar esta asignacion de refacción" onclick="del_refaccion();">
        						<i class="fa fa-times"></i>
        					</button>
        				</td>
        			</tr>
        			<tr class="text-center">
        				<td>1</td>
        				<td>asdasdasawdasd</td>
        				<td>
        					<button type="button" class="btn btn-flat btn-danger " data-toggle="tooltip" title="Eliminar esta asignacion de refacción" onclick="del_refaccion();">
        						<i class="fa fa-times"></i>
        					</button>
        				</td>
        			</tr>
        			<tr class="text-center">
        				<td>1</td>
        				<td>asdasdasawdasd</td>
        				<td>
        					<button type="button" class="btn btn-flat btn-danger " data-toggle="tooltip" title="Eliminar esta asignacion de refacción" onclick="del_refaccion();">
        						<i class="fa fa-times"></i>
        					</button>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
      </div>
        
    </div>
  </div>
</div>