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
                        <h4><i class="icon fa "></i> Aviso!</h4>
                        <p id="message"></p>
                      </div>
                    </div>
                  </div>
                  
                  <form action="#" method="post" id="frm_xlsx_asignacion">
                    <input type="hidden" name="option" value="81">
                    <div class="row">
                      <div class="col-md-12">
                        <a href="" id="enlace" class="btn btn-success pull-right hidden"> <i class="fa  fa-file-excel-o"></i> Descargar</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">NOMBRE DEL SERVIDOR PÚBLICO</label>
                          <input type="text" id="servidor" name="servidor" required="" class="form-control" autofocus autocomplete="off">
                          <input type="hidden" name="servidor_id" id="servidor_id" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-danger  btn-flat"> <i class="fa fa-paint-brush"></i> Limpiar campo </button>
                      </div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-block btn-flat"> <i class="fa fa-floppy-o"></i> Buscar </button>
                      </div>
                      <div class="col-md-5"></div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
