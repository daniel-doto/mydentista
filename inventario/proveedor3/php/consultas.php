<?php
require_once "../php/conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{
public function totalcosto()
	{
		$sql="SELECT COUNT(*) as total FROM `costo`";
		return ejecutarConsulta($sql);
	}
}
}
 ?>