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
                  <!-- <div class="row">
                    <div class="col-md-4"> 
                      <button class="btn btn-block btn-social btn-success btn-flat" data-toggle="modal" data-target="#addGarantia">
                        <i class="fa fa-plus"></i> Alta de garantía
                      </button>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-12">
                      <div id="alert" class="alert alert-dismissible hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> AVISO!</h4>
                        <p id="message"></p>
                      </div>
                    </div>
                  </div>
                  <h3>Buscar por nombre de documento</h3>
                  <div class="row">
                      <div class="col-md-10">
                        <label>Buscar equipos involucrados por nombre de dumento</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="name_doc" id="name_doc">
                          <input type="hidden" id="name_doc_h" name="name_doc_h" value="">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-flat" onclick="buscar_re_documento();">
                                  <i class="fa fa-search"></i>
                                </button>
                              </span>
                        </div>
                      </div>
                  </div>
                  <br>
                  
                  
                  <div class="table-responsive">
                    <div id="reparacion_externa"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>


