<?php
// ESTAS SON LAS VARIABLES GLOBALES PARA SOLO REFERENCIARLAS EN LA FUNCION QUE CONECTA LA BASE DE DATOS
DEFINE("SERVER", "localhost");
DEFINE("USUARIO", "root");
DEFINE("PASS", "");
DEFINE("BASE", "taller_gerardo");
//DEFINE("URL_FRONT","http://localhost/");

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
function mostrarErrores() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function check_session(){
	session_start();
		if(!isset($_SESSION['id_usuario'])){
		header("Location: login.php"); 
	  }
}
function check_sesion_admin(){
	session_start();
	if(isset($_SESSION['id_usuario'])){
			header("Location: index.php");
	}
}

?>
