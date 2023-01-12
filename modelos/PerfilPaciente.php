<?php
require "../config/Conexion.php";

class PerfilPaciente
{
    public function __construct()
    {

    }

    public function insertarDialogo($idpaciente,$asunto)
    {
         $sql="INSERT INTO dialogopaciente(idpaciente,asunto)VALUES('$idpaciente','$asunto')";
         return ejecutarConsulta($sql);
    }

    //Implementamos un método para eliminar categorías
  	static public function eliminar($id)
  	{
  		$sql="DELETE FROM dialogopaciente WHERE id='$id'";
  		return ejecutarConsulta($sql);
  	}

    static public function paciente($id)
    {
        $sql="SELECT * FROM paciente WHERE idpaciente='".$id."'";
        return ejecutarConsultaSimpleFila($sql);
    }

    static public function dialogo($id)
    {
        $sql="SELECT * FROM dialogopaciente WHERE idpaciente='".$id."' ORDER BY id DESC";
        return ejecutarConsulta($sql);
    }

    static public function editar($id,$asunto)
    {
        $sql="UPDATE dialogopaciente SET asunto='$asunto' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }


    static public function mostrar($id)
    {
        $sql="SELECT * FROM dialogopaciente WHERE id='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    static public function listarpaciente($id)
    {
        $sql="SELECT ci.idcita,CONCAT(u.nombres,' ',u.apellidos) as usuario,CONCAT(m.nombres,' ',m.apellidos) as medico,CONCAT(p.nombres,' ',p.apellidos) as paciente,hr.fecha,h.nombre as hora,ci.costo,ci.observaciones,ci.agregado,ci.estado FROM cita as ci
    INNER JOIN usuario as u on u.idusuario=ci.idusuario
    INNER JOIN paciente as p on p.idpaciente=ci.idpaciente
    INNER JOIN detalle_horario as dh on dh.iddetalle_horario=ci.iddetalle_horario
    INNER JOIN hora as h on h.idhora=dh.idhora 
    INNER JOIN horario as hr on hr.idhorario=dh.idhorario 
    INNER JOIN medico as m on m.idmedico=hr.idmedico WHERE P.idpaciente='".$id."' order by ci.idcita desc";
        return ejecutarConsulta($sql);
    }

}
?>
