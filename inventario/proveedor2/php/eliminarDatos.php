
<?php
	require_once "../php/conexion.php";
	$conexion=conexion();
	$id=$_POST['id'];

	$sql="DELETE from t_personasx where id='$id'";
	echo $result=mysqli_query($conexion,$sql);
 ?>