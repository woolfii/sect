<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>esteban</title>
</head>
<body>


<?php

try{
		$base=new PDO("mysql:host=localhost; dbname=sectdb", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql="SELECT * FROM usuarios WHERE nombre  = :login AND contrasenia= :password";

		$resultado=$base->prepare($sql);
		$login=htmlentities(addslashes($_POST["login"]));
		$password=htmlentities(addslashes($_POST["password"]));
		$resultado->bindValue(":login", $login);
		$resultado->bindValue(":password", $password);
		$resultado->execute();
		$numero_registro=$resultado->rowCount();

		if($numero_registro!=0){

			//echo"<h2>dk</h2";

			session_start();
			$_SESSION["usuario"]=$_POST["login"];

			header("Location:index.html");	

		}else{
            echo "<script type=\"text/javascript\">alert(\"error verifica usuario y contrasenia\");</script>";
			header("location:signup.html");
		}

}catch(Exception $e){
	die("error: ". $e->getMessage());
}



?>	
</body>
</html>