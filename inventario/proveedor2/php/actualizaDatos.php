<?php
	require_once "../php/conexion.php";
	$conexion=conexion();
	$id=$_POST['id'];
	$n=$_POST['nombre'];
	$a=$_POST['apellido'];
	$e=$_POST['email'];
	$t=$_POST['telefono'];
	$p=$_POST['precio'];

	$sql="UPDATE t_personasx set nombre='$n',
								apellido='$a',
								email='$e',
								telefono='$t',
								precio='$p'
				where id='$id'";
	echo $result=mysqli_query($conexion,$sql);

 ?>