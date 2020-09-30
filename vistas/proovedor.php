<?php
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){
  header("Location: login.html");
}else{
require 'header.php';
if($_SESSION['compras']==1){
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Proovedor <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tblistado" class="table table-striped table-bordered table-condesed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Numero</th>
                            <th>Telefono</th>
                            <th>Email</th>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Numero</th>
                            <th>Telefono</th>
                            <th>Email</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="post">
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Nombre:</label>
                          <input type="hidden" name="idpersona" id="idpersona">
                          <input type="hidden" name="tipo_persona" id="tipo_persona" value="Proovedor">
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Tipo documento:</label>
                          <select class="form-control col-lg-6 col-md-6 col-ms-6 col-xs-12" name="tipo_documento" id="tipo_documento" required>
                            <option value="DNI">DNI</option>
                            <option value="RFC">RFC</option>
                            <option value="INE">INE</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Numero documento:</label>
                          <input type="text" class="form-control col-lg-6 col-md-6 col-ms-6 col-xs-12" name="num_documento" id="num_documento" placeholder="Documento">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Direccion:</label>
                          <input type="text" class="form-control col-lg-6 col-md-6 col-ms-6 col-xs-12" name="direccion" id="direccion" placeholder="Direccion">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Telefono:</label>
                          <input type="text" class="form-control col-lg-6 col-md-6 col-ms-6 col-xs-12" name="telefono" id="telefono" placeholder="Telefono">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Email:</label>
                          <input type="email" class="form-control col-lg-6 col-md-6 col-ms-6 col-xs-12" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button class="btn btn-danger" onclick="cancelarform()" type="button" ><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                      </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}else{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/proovedor.js"></script>

<?php 
ob_end_flush();
}

?>