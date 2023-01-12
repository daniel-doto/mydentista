<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
date_default_timezone_set('UTC');

if (!isset($_SESSION["nombres"])||!isset($_SESSION["apellidos"])||!isset($_SESSION["cargo"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['perfilpaciente']==1)
{
 require_once "../modelos/PerfilPaciente.php";

$id=$_GET['id'];
$paciente=PerfilPaciente::paciente($id);

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" id="nuevo">
                          <h1 class="box-title">Paciente : <?php echo $paciente['nombres'].' '.$paciente['apellidos']; ?></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    
                    <!-- /.box-header -->
                    
                    <div class="panel-body " style="height: 200px;" id="formularioregistros">

                      <form name="formulario" id="formulario" method="POST">

                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="">Asunto</label>
                          <textarea class="form-control" name="asunto" id="asunto" required rows="4" cols="30">
                            
                          </textarea>

                        </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="idpaciente" id="idpaciente" value="<?php echo  $paciente['idpaciente'];?>">
                            <input type="hidden" name="id"  id="id" value="">

                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          </div>

                        </form>
                        </div>



                        <!-- centro -->
                    <div class="panel-body table-responsive" style="height: 200px;" >
                      <h3>Lista de Dialogo</h3>
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <th>Accion</th>
                          <th>Asunto Dialogo</th>
                          <th>Fecha</th>
                        </thead>
                        <tbody>
                          <?php $listadialogo=PerfilPaciente::dialogo($id);

                          foreach ($listadialogo as $d) {
                             echo '<tr>
                                    <td>
                                    <button  type="button" class="btn btn-warning" onclick="mostrar('.$d['id'].')"><i class="fas fa-pencil-alt"></i></button>
                                      <button class="btn btn-danger" onclick="eliminarasunto('.$d['id'].')"><i class="fa fa-trash"></i></button></td>
                                    <td>'.$d['asunto'].'</td>
                                    <td>'.date('d/m/Y h:i:s A', strtotime($d['fecha'])).'</td>
                                  </tr>';
                           } ?>
                          

                        </tbody>
                      </table>
                    </div>


                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <h3>Lista de Citas</h3>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Ticket</th>
                            <th>Anular</th>
                            <th>Usuario</th>
                            <th>medico</th>
                            <th>paciente</th>
                            <th>fecha - hora</th>
                            <th>precio</th>
                            <th>observaciones</th>
                            <th>Estado</th>

                          </thead>

                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->


    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <?php
  }
  else
  {
    require 'noacceso.php';
  }
  require 'footer.php';
  ?>

<!--datepicker-->
<script>
var tabla;

//Función que se ejecuta al inicio
function init(){
  listar();
  $("#formulario").on("submit",function(e)
  {
    guardaryeditar(e);
  })
}

//Función limpiar
function limpiar()
{
  $("#id").val("");
  $("#asunto").val("");
  $("#idpaciente").val("");
}


//Función Listar
//Función Listar
function listar()
{
  tabla=$('#tbllistado').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: '../ajax/perfilpaciente.php?op=listar&idpaciente=<?php echo $id;?>',
          type : "get",
          dataType : "json",
          error: function(e){
            console.log(e.responseText);
          }
        },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
      "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
  }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
   e.preventDefault(); //No se activará la acción predeterminada del evento
   $("#btnGuardar").prop("disabled",true);
   var formData = new FormData($("#formulario")[0]);
   $.ajax({
           url: "../ajax/perfilpaciente.php?op=guardaryeditar",
             type: "POST",
             data: formData,
             contentType: false,
             processData: false,

             success: function(datos)
             {
                swal({
                 title: 'Paciente',
                 type: 'success',
                 text:datos
               });
              location='';
             }

         });
  limpiar();
}



function mostrar(id)
{

  $.post("../ajax/perfilpaciente.php?op=mostrar",{id : id}, function(data, status)
  {
    data = JSON.parse(data);
    $("#asunto").val(data.asunto);
    $("#id").val(data.id);
    $("#idpaciente").val(data.idpaciente);

  })
}

//Función para activar registros
function eliminarasunto(id)
{
  swal({
        title: "¿Eliminar?",
        text: "¿Está seguro Que desea Eliminar?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#008df9',
        confirmButtonText: "Si",
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
        },function(isConfirm){
        if (isConfirm){
            $.post("../ajax/perfilpaciente.php?op=eliminar", {id : id}, function(e){
            swal("!!! Eliminar !!!", e ,"success");
                location.reload();
            });
        }else {
        swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
       }
      });
}




function anular(idcita)
{
    swal({
                title: "Anular?",
                text: "¿Está seguro Que Desea Anular la Cita?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                cancelButtonColor: '#FF0000',
                confirmButtonText: "Si",
                confirmButtonColor: "#008df9",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true
                },function(isConfirm){
                if (isConfirm){
                  $.post("../ajax/cita.php?op=anular", {idcita : idcita}, function(e){
                    swal(
                      '!!! Anular !!!',e,'success')
                      tabla.ajax.reload();
                  });
                }else {
                swal("! Cancelado ¡", "Se Cancelo la Anulacion de la Cita", "error");
               }
              });
}



function pagado(idcita)
{
  swal({
             title: "¿Pagar?",
             text: "¿Está seguro Que Desea pagar la Cita?",
             type: "warning",
             showCancelButton: true,
             cancelButtonText: "No",
             cancelButtonColor: '#FF0000',
             confirmButtonText: "Si",
             confirmButtonColor: "#008df9",
             closeOnConfirm: false,
             closeOnCancel: false,
             showLoaderOnConfirm: true
             },function(isConfirm){
             if (isConfirm){
                $.post("../ajax/cita.php?op=pagado", {idcita : idcita}, function(e){
              swal('!!! Pagar !!!',e,'success')
                  tabla.ajax.reload();
              });
             }else {
             swal("! Cancelado ¡", "Se Cancelo la Anulacion de la Cita", "error");
            }
           });
}

init();

</script>
<?php
}
ob_end_flush();
?>
