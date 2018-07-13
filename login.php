<?php

session_start();

$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];


include("conexion.php");
//verifica si hay usuario registrado y si la contrasena coincide.
$proceso = $conexion->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasenia= '$contrasenia' ");

	if($resultado = mysqli_fetch_array($proceso)){
		$_SESSION['u_usuario'] = $usuario;
		header("location: agenda.php");
	}
	else{
		
		header("location: signup.html");

	}




?>
