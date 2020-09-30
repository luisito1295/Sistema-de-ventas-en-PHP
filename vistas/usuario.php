<?php
//Activamos el alamacenamiento del buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){
  header("Location: login.html");
}else{
require 'header.php';
if($_SESSION['acceso']==1){
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
                          <h1 class="box-title">Usuario <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Estado</th>
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
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 600px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-12 col-md-12 col-ms-12 col-xs-12">
                          <label>Nombre*:</label>
                          <input type="hidden" name="idusuario" id="idusuario">
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Tipo de documento:</label>
                          <select class="form-control  selectpicker" name="tipo_documento" id="tipo_documento" data-live-search="true" required>
                            <option value="RFC">RFC</option>
                            <option value="CURP">CURP</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Numero:</label>
                          <input type="number" class="form-control" name="num_documento" id="num_documento" placeholder="Numero de documento" required>                          
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Direcion:</label>
                          <input type="text" class="form-control" name="direccion" id="direccion" maxlength="256" placeholder="Direccion">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Telefono:</label>
                          <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256" placeholder="Telefono">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Email:</label>
                          <input type="email" class="form-control" name="email" id="email" maxlength="256" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Cargo:</label>
                          <input type="text" class="form-control" name="cargo" id="cargo" maxlength="256" placeholder="Cargo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Login:</label>
                          <input type="text" class="form-control" name="login" id="login" maxlength="256" placeholder="Login">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Clave:</label>
                          <input type="password" class="form-control" name="clave" id="clave" maxlength="256" placeholder="Clave" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                            <label>Permisos:</label>
                          <ul style="list-style:none;" id="permisos">

                          </ul>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-ms-6 col-xs-12">
                          <label>Imagen:</label>
                          <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen">
                          <input type="hidden" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuesta">
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/usuario.js"></script>

<?php 
ob_end_flush();
}

?>