<?php

	require_once "../php/conexion.php";
	$conexion=conexion();
	$n=$_POST['nombre'];
	$a=$_POST['apellido'];
	$e=$_POST['email'];
	$t=$_POST['telefono'];
	$p=$_POST['precio'];

	$sql="INSERT into t_personasx (nombre,apellido,email,telefono,precio)
								values ('$n','$a','$e','$t','$p')";
	echo $result=mysqli_query($conexion,$sql);

 ?>