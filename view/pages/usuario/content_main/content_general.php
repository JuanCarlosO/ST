<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> ¿Tienes problemas con tu equipo de cómputo? <small>  </small> </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_ok" class="alert alert-success alert-dismissible hidden">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Solicitud exitosa!</h4>
                                    La solicitud de apoyo a sido enviada al Departamento de Soporte Técnico. <br>
                                    La solicitud se le reflejará automáticamente al DST en menos de 60 seg.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_error" class="alert alert-danger alert-dismissible hidden">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-times"></i> Ocurrio un problema!</h4>
                                    
                                    <p><label>Problema:</label> <i id="desc_error"></i> </p>
                                </div>
                            </div>
                        </div>
                        
                        

                        <form role="form" id="alta_ticket" method="post">
                            <input type="hidden" name="option" value="2" required>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alert_ok" class="alert alert-info alert-dismissible ">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <p><label>Aviso #1: </label> La caja de texto solo admite números y letras.</p>
                                        <p><label>Aviso #2: </label> Todas las solicitudes que registran en este apartado son asociados a su nombre. Por esta razón no puede solicitar apoyo a nombre de otra persona. </p>
                                        <p><label>Aviso #3: </label> No escribir los siguientes caracteres: <ul>
                                            <li>Comillas</li>
                                            <li>Puntos y comas</li>
                                            <li>Parentesis</li>
                                        </ul></p>
                                    </div>
                                </div>
                            </div>


                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="div_textarea_descripcion" class="form-group">
                                            <label for="exampleInputEmail1">Escriba una breve descripción de la falla</label>
                                            <textarea name="textarea_descripcion" style="font-size:30px; resize: vertical; font:'Arial';" id="textarea_descripcion" autofocus class="form-control" rows="3" placeholder="Escribe aqui...."  required ></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12"></div>
                                    <div class="col-md-4 col-sm-12">
                                        <button type="submit" class="btn btn-block btn-flat btn-success">Enviar ticket</button>
                                    </div>
                                    <div class="col-md-4 col-sm-12"></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
<script>
    //aplicar css con JS 
    var opcion = document.getElementById('option_aside_1');
    opcion.className= 'active';
</script>