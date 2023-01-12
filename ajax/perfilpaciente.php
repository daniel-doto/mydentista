<?php
 require_once "../modelos/PerfilPaciente.php";

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idpaciente=isset($_POST["idpaciente"])? limpiarCadena($_POST["idpaciente"]):"";
$asunto=isset($_POST["asunto"])? limpiarCadena($_POST["asunto"]):"";

switch ($_GET["op"])
{

      case 'guardaryeditar':
      if(empty($id))
      {
        $rspta=PerfilPaciente::insertarDialogo($idpaciente,$asunto);
       echo  $rspta?"Dialogo  Se registro con exito":"Dialogo no se pudo registrar";
      }
      else
       {
         $rspta=PerfilPaciente::editar($id,$asunto);
         echo  $rspta?"paciente  Se Edito con exito !":"Paciente no se pudo Editar";

        }
        break;


      case 'eliminar':
    		$rspta=PerfilPaciente::eliminar($id);
     		echo $rspta?"eliminada":"no se puede eliminar";
    	break;

  case 'mostrar':
       $rspta=PerfilPaciente::mostrar($id);
          echo  json_encode($rspta);
      break;

  case 'listar':
    $rspta=PerfilPaciente::listarpaciente($_GET["idpaciente"]);
    //Vamos a declarar un array
    $data= Array();

    while ($reg=$rspta->fetch_object()){
      $url='../reportes/exTicket.php?id=';
      $data[]=array(
        "0"=>($reg->estado=='pendiente')?' <button class="btn btn-success" onclick="pagado('.$reg->idcita.')"><i class="fa fa-money"></i></button>'.'<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>' :
          '<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>',

             "1"=>($reg->estado!='anulado')?' <button class="btn btn-danger" onclick="anular('.$reg->idcita.')"><i class="fa fa-close"></i></button>':
            '<span class="label bg-red">Anulado</span>',
         "2"=>$reg->usuario,
         "3"=>$reg->medico,
        "4"=>$reg->paciente,
        "5"=>$reg->fecha.' - '.$reg->hora,
        "6"=>$reg->costo,
        "7"=>$reg->observaciones,
        "8"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
        '<span class="label bg-green">'.$reg->estado.'</span>'



        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);

  break;

}
?>
