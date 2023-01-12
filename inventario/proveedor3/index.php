<?php require_once "../vistas/parte_superior.php"?>
<!--Inicio del conte principal-->
<div class="container">


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Tabla De Productos -Proveedor 3</title>
	<link rel="stylesheet" type="text/css" href="../proveedor3/librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../proveedor3/librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../proveedor3proveedor3/librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="../proveedor3/librerias/select2/css/select2.css">
  <link rel="stylesheet" type="text/css" href="../proveedor3/librerias/datatables/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../proveedor3/librerias/datatables/dataTables.bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="../proveedor3/librerias/datatables/dataTables.bootstrap.min.css">


<script src="../proveedor3/bootstrap4/js/bootstrap.min.js"></script>
	<script src="../proveedor3/librerias/jquery-3.2.1.min.js"></script>
  <script src="../proveedor3/js/funciones.js"></script>
	<script src="../proveedor3/librerias/bootstrap/js/bootstrap.js"></script>
	<script src="../proveedor3/librerias/alertifyjs/alertify.js"></script>
  <script src="../proveedor3/librerias/select2/js/select2.js"></script>

    <script src="../proveedor3/librerias/datatables/jquery-3.5.1.js"></script>
    <script src="../proveedor3/librerias/datatables/jquery.dataTables.min.js"></script>
    <script src="../proveedor3/librerias/librerias/datatables/dataTables.bootstrap.min.js"></script>


  <!-- Librerias para exportar en pdf y excel -->
  <script src="../proveedor3/librerias/datatables/buttons/dataTables.buttons.min.js"></script>
  <script src="../proveedor3/librerias/datatables/buttons/jszip.min.js"></script>
 <script src="../proveedor3/librerias/datatables/buttons/pdfmake.min.js"></script>
  <script src="../proveedor3/librerias/datatables/buttons/vfs_fonts.js"></script>
  <script src="../proveedor3/librerias/datatables/buttons/buttons.html5.min.js"></script>


</head>
<body>

	<div class="container">
    <div id="buscador"></div>
		<div id="tabla"></div>
	</div>

	<!-- Modal para registros nuevos -->

<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agrega nuevo producto</h4>
      </div>
      <div class="modal-body">
        <div>
          <label>Nombre del producto:</label>
          <input type="text" name="" id="nombre" class="form-control input-sm" placeholder="nombre del producto"  required="">

        </div>
        	<div>
              <label>Descripción:</label>
          <input type="text" name="" id="apellido" class="form-control input-sm"  placeholder="Descripción del producto" required="">

          </div>
          <div>
            <label>Fecha de agregado:</label>
          <input type="text" name="" id="email" class="form-control input-sm"  placeholder="fecha del producto" required="">

          </div>
          <div>
            <label>Cantidad:</label>
          <input type="text" name="" id="telefono" class="form-control input-sm"  placeholder="ejemplo: 2 piezas" required="">

          </div>
          <div>
             <label>Costo total:</label>
          <input type="text" name="" id="precio" class="form-control input-sm"  placeholder="ejemplo: 250.00" required="">

          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo" onsubmit="return validar();">
        Agregar
        </button>

      </div>
    </div>
  </div>
</div>

<!-- Modal para edicion de datos -->

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
      </div>
      <div class="modal-body">
      		<input type="text" hidden="" id="idpersona" name="">
        	<label>Nombre del producto:</label>
        	<input type="text" name="" id="nombreu" class="form-control input-sm" required>
        	<label>Descripción:</label>
        	<input type="text" name="" id="apellidou" class="form-control input-sm" required>
        	<label>Fecha de agregado:</label>
        	<input type="text" name="" id="emailu" class="form-control input-sm" required>
        	<label>Cantidad:</label>
        	<input type="text" name="" id="telefonou" class="form-control input-sm" required>
          <label>Costo total:</label>
          <input type="text" name="" id="preciou" class="form-control input-sm" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>

      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript" src="../componentes/validaciones/validaciones.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('./componentes/tabla.php');
    $('#buscador').load('./componentes/buscador.php');
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#guardarnuevo').click(function(){
          nombre=$('#nombre').val();
          apellido=$('#apellido').val();
          email=$('#email').val();
          telefono=$('#telefono').val();
          precio=$('#precio').val();
            agregardatos(nombre,apellido,email,telefono,precio);
        });



        $('#actualizadatos').click(function(){
          actualizaDatos();
        });

    });
</script>
