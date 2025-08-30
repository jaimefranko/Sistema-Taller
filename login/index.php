<?php
include_once("conexion.php");
check_session();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido! <?php echo $_SESSION['usuario'] ?: '';?></h1>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>