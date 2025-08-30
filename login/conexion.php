<?php
// ESTAS SON LAS VARIABLES GLOBALES PARA SOLO REFERENCIARLAS EN LA FUNCION QUE CONECTA LA BASE DE DATOS
DEFINE("SERVER", "localhost");
DEFINE("USUARIO", "root");
DEFINE("PASS", "");
DEFINE("BASE", "usuarios_db");

// ESTA FUNCION ES LA USARAS MULTIPLES VECES PARA CONECTARTE DE MANERA SEGURA A LA DB - PRIMERO EMPIEZA CON MYSQLi LUEGO PASA A PDO

function conectar(){
	$con = @mysqli_connect(SERVER, USUARIO, PASS, BASE);
    $error = mysqli_error($con);
	if(!$con){
		die("imposible conectarse: ".$error);
	}
	if (@mysqli_connect_errno()) {
		die("Conexion Fallo: ".mysqli_connect_errno()." : ". mysqli_connect_error());
	}
	$query = "set names utf8";
	$resultado=$con->query($query);
	return $con;
	$con->close();
}


?>
