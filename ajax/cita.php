<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Cita.php";

$cita=new Cita();

$idcita=isset($_POST["idcita"])? limpiarCadena($_POST["idcita"]):"";
$idusuario=$_SESSION["idusuario"];
$idpaciente=isset($_POST["idpaciente"])? limpiarCadena($_POST["idpaciente"]):"";
$iddetalle_horario=isset($_POST["iddetalle_horario"])? limpiarCadena($_POST["iddetalle_horario"]):"";
$costo=isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcita)){
			$rspta=$cita->insertar($idusuario,$idpaciente,$iddetalle_horario,$costo,$observaciones);
			echo $rspta ? "cita registrada" : "No se pudieron registrar todos los datos de la cita";
		}
		else {
        $rspta=$cita->editar($idcita,$iddetalle_horario,$costo,$observaciones);
      echo $rspta ? "cita Editada" : "No se pudieron editar todos los datos de la cita";
		}
	break;

	case 'mostrar':
		$rspta=$cita->mostrar($idcita);
 		echo json_encode($rspta);
	break;


  case 'anular':
    $rspta=$cita->anular($idcita);
    echo $rspta ? "cita anulada" : "cita no se puede anular";
  break;

  case 'pagado':
		$rspta=$cita->pagado($idcita);
 		echo $rspta ? "cita pagada" : "cita no se puede pagar";
	break;


	case 'listar':
		$rspta=$cita->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$url='../reportes/exTicket.php?id=';
 			$data[]=array(
 				"0"=>($reg->estado=='pendiente')?' <button class="btn btn-success" onclick="pagado('.$reg->idcita.')"><i class="fa fa-money"></i></button>'.'<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>' :
 					'<a target="_blank" href="'.$url.$reg->idcita.'"><button class="btn btn-warning"><i class="fa fa-file-pdf"></i></button></a>',

         		 "1"=>($reg->estado!='anulado')?' <button class="btn btn-danger" onclick="anular('.$reg->idcita.')"><i class="fa fa-close"></i></button>':
   					'<span class="label bg-red">Anulado</span>',
            "2"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idcita.')"><i class="fas fa-pencil-alt"></i></button>',
				 "3"=>$reg->usuario,
				 "4"=>$reg->medico,
 				"5"=>$reg->paciente,
 				"6"=>date('d/m/Y h:i:s A', strtotime($reg->fecha.' '.$reg->hora)),
 				"7"=>$reg->costo,
 				"8"=>$reg->observaciones,
 				"9"=>($reg->estado=='anulado')?'<span class="label bg-red">anulado</span>':
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

	case 'selectPaciente':
		require_once "../modelos/Paciente.php";
		$paciente = new Paciente();

		$rspta = $paciente->select();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idpaciente . '>' . $reg->nombre . '</option>';
				}
	break;

  case 'selectEspecialidad':
    require_once "../modelos/Especialidad.php";
    $especialidad = new Especialidad();
    $rspta = $especialidad->listar();
	echo '<option value=""  selected disabled>seleccione Especialidad</option>';
    while ($reg = $rspta->fetch_object())
        {
        echo '<option value=' . $reg->idespecialidad . '>' . $reg->nombre . '</option>';
        }
  break;


  case 'selectMedico':
      $id_especialidad = $_POST['idespecialidad'];
    		$rspta = $cita->listarmedico($id_especialidad);
    echo '<option value=""  selected disabled>seleccione medico</option>';
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->idmedico . '>' . $reg->nombres . '</option>';
    				}
	break;


  case 'selectFecha':
        $id_medico = $_POST['idmedico'];
      		$rspta = $cita->listarfecha($id_medico);
      echo '<option value=""  selected disabled>seleccione fecha</option>';
      		while ($reg = $rspta->fetch_object())
      				{
      				echo '<option value=' . $reg->idhorario . '>' . $reg->fecha . '</option>';
      				}
	break;



  case 'selectHora':
    	$id_horario = $_POST['idhorario'];
    		$rspta = $cita->listarhora($id_horario);
    echo '<option value=""  selected disabled>seleccione Hora</option>';
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->iddetalle_horario . '>' . $reg->nombre . '</option>';
    				}
	break;

/*  case 'selectcosto':
    $idespecialidad = $_POST['idespecialidad'];
    		$rspta = $cita->listarcosto($idespecialidad);
    		while ($reg = $rspta->fetch_object())
    				{
    				echo '<option value=' . $reg->idcosto . '>' . $reg->precio . '</option>';
    				}
	break;
          */
}
?>
