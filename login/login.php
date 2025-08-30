<?php
include "conexion.php";
check_sesion_admin();
mostrarErrores();
$conexion = conectar();
$errorMsg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = trim($_POST["usuario"]);
    $clave = trim($_POST["clave"]);

    $peticion = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $peticion->bind_param("s", $usuario);
    $peticion->execute();

    $resultado = $peticion->get_result();
    
    if($resultado->num_rows == 1){
        $usuarioEncontrado = $resultado->fetch_assoc();
    
        if(password_verify($clave, $usuarioEncontrado['clave'])){
            $_SESSION['id_usuario'] = $usuarioEncontrado['id'];
            header("Location: index.php");
           
        } else {
            $errorMsg = "Contraseña equivocada";
        }
    } else {
        $errorMsg = "Usuario no encontrado";
    }


}

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login_caja_principal container">
        <div id="login_box" style="padding: 100px;">
            <form action="" id="loginform" method="post">
            <div class="login_titulo mb-5">
                    <h1 style="color: #FF6600; font-size: 48px;" >Login</h1>
                </div>
                <div class="login_form d-flex" style="margin: 65px 0;" >
                    <img src="recursos/usuario.png" class="me-3" alt="correo" style="width: 28px; height: 28px;">
                    <input type="text" name="usuario" id="usuario" class="input_login" placeholder="Ingrese su correo"  style="width: 100%; font-size: 24px; color: white; background: none; border: none;">
                </div>
                <div class="login_form d-flex mb-5">
                    <img src="recursos/candado.png" alt="usuario" class="me-3" style="width: 28px; height: 28px;">
                    <input type="password" name="clave" id="clave" class="input_login" placeholder="Ingrese la contraseña"  style="width: 100%; font-size: 24px; color: white; background: none; border: none;">
                </div>
                    <div class="mt-5 d-flex justify-content-center">
                        <button class="botones_sistema" style="margin-top: 10px; margin-bottom: 20px;" type="submit">Ingresar</button>
                    <div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <p style="color: #FF6600;"><a href="registro.php" style="text-decoration: none; color: #CC3300; margin-right: 20px;">Nuevo usuario</a> | <span style="margin-left: 20px; " id = "error"><?php echo $errorMsg ?: 'Indigo Software';?></span></p>
            </div>
        </form>
        </div>
    </div>


    <script src="scripts/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>

