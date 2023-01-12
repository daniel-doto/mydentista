<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cita
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idusuario,$idpaciente,$iddetalle_horario,$costo,$observaciones)
	{
		$sql="INSERT INTO cita (idusuario,idpaciente,iddetalle_horario,costo,observaciones,estado)
		VALUES ('$idusuario','$idpaciente','$iddetalle_horario','$costo','$observaciones','pendiente')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para insertar registros
	public function editar($id,$iddetalle_horario,$costo,$observaciones)
	{
		$sql="UPDATE cita SET iddetalle_horario='$iddetalle_horario',costo='$costo',observaciones='$observaciones' 	WHERE idcita='$id'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros
	public function mostrar($id)
	{
		$sql="SELECT C.*,E.idespecialidad,M.idmedico,H.idhorario,DH.idhora FROM cita C INNER JOIN paciente P ON P.idpaciente=C.idpaciente INNER JOIN detalle_horario DH ON dH.iddetalle_horario=C.iddetalle_horario INNER JOIN horario H ON H.idhorario=DH.idhorario INNER JOIN medico M ON M.idmedico=H.idmedico INNER JOIN especialidad E ON E.idespecialidad=M.idespecialidad WHERE idcita='$id'";
        return ejecutarConsultaSimpleFila($sql);
	}


	//Implementamos un método para anular la cita
	public function anular($idcita)
	{
		$sql="UPDATE cita SET estado='anulado' WHERE idcita='$idcita'";
		return ejecutarConsulta($sql);
	}
  public function pagado($idcita)
  {
    $sql="UPDATE cita SET estado='pagado' WHERE idcita='$idcita'";
    return ejecutarConsulta($sql);
  }



	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,ci.costo,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
		INNER JOIN usuario as u on u.idusuario=ci.idusuario
		INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
		INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
		INNER JOIN hora as h on h.idhora=dh.idhora 
		INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
		INNER JOIN medico as m on m.idmedico=hr.idmedico order by ci.idcita desc";
		return ejecutarConsulta($sql);
	}

	public function listarmedico($id_especialidad)
	{
		$sql="SELECT idmedico,CONCAT(nombres,' ',apellidos) as nombres FROM medico WHERE idespecialidad = '$id_especialidad' and estado='1'";
		return ejecutarConsulta($sql);
	}

	public function listarfecha($id_medico)
	{
		$sql="SELECT * FROM `horario` WHERE idmedico='$id_medico' and estado='1'";
		return ejecutarConsulta($sql);
	}

	public function listarhora($id_idhorario)
	{
		$sql="SELECT dh.iddetalle_horario,h.nombre FROM detalle_horario as dh
	INNER JOIN hora as h on dh.idhora=h.idhora
	WHERE dh.idhorario='$id_idhorario'";
		return ejecutarConsulta($sql);
	}

	public function listarcosto($idespecialidad)
	{
		$sql="SELECT * FROM `costo` WHERE idespecialidad='$idespecialidad'";
		return ejecutarConsulta($sql);
	}


	public function citaticket($idcita){
		$sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,ci.costo,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
		INNER JOIN usuario as u on u.idusuario=ci.idusuario
		INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
		INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
		INNER JOIN hora as h on h.idhora=dh.idhora 
		INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
		INNER JOIN medico as m on m.idmedico=hr.idmedico WHERE ci.idcita='$idcita'";
		return ejecutarConsulta($sql);
	}


}
?>
