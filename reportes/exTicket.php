<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1)
  session_start();

  if (!isset($_SESSION["nombres"])||!isset($_SESSION["apellidos"])||!isset($_SESSION["cargo"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el ticket';
}
else
{
if ($_SESSION['cita']==1)
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase Venta
require_once "../modelos/Cita.php";
//Instanaciamos a la clase con el objeto venta
$cita = new Cita();
//En el objeto $rspta Obtenemos los valores devueltos del método citacabecera del modelo
$rspta = $cita->citaticket($_GET["id"]);
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "My Dentista S.A.C.";
$documento = "20477157772";
$direccion = "San Juan 122, 50850 Temoaya, Méx.";
$telefono = "(+52)722 496 7705";
$email = "mydentistaeva@gmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        .:::::<strong> <?php echo $empresa; ?></strong>:::::.<br>
        <?php echo $documento; ?><br>
        <?php echo $direccion .' - '.$telefono; ?><br>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $reg->agregado; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>Paciente: <?php echo $reg->paciente; ?></td>
    </tr>
    <tr>
        <td>Medico: <?php echo $reg->medico; ?></td>
    </tr>
    <tr>
        <td>Fecha de la Cita: <?php echo $reg->fecha; ?></td>
    </tr>
    <tr>
        <td>Hora de la Cita: <?php echo $reg->hora; ?></td>
    </tr>
    <tr>
        <td><?php echo "Ticket"." : 000".$reg->idcita; ?></td>
    </tr>
    <tr>
        <td>Nº de cita : <?php echo " 000".$reg->idcita ; ?></td>
    </tr>
</table>
<br>
<!-- Mostramos los detalles de la cita en el documento HTML -->
<table border="0" align="center" width="300px">


    <!-- Mostramos los totales de la cita en el documento HTML -->
    <tr>
    <td>&nbsp;</td>
    <td align="right"><b>TOTAL:</b></td>
    <td ><b>S/ <?php echo $reg->costo; ?></b></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">¡Gracias por Solicitar su Cita!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">My Dentista</td>
    </tr>
    <tr>
      <td colspan="3" align="center">San Juan 122, 50850 Temoaya, Méx.</td>
    </tr>

</table>
<br>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el ticket';
}

}
ob_end_flush();
?>