<?php 
    include "conexion.php";

    $conexion = conectar();
    $errorMsg = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST["usuario"];
        $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);

        if(empty($usuario) || empty($clave)){
            echo "<script>alert('Todos los campos son obligatorios');</script>";
        } else {       
            $confirmarExistencia = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = ?");
            $confirmarExistencia->bind_param("s", $usuario);
            $confirmarExistencia->execute();
            $resultado = $confirmarExistencia->get_result();
            
            if($resultado->num_rows > 0){
                $errorMsg = "Ya se encuentra este usuario registrado";
            } else {
                $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, clave) VALUES (?, ?)");
                $stmt->bind_param("ss", $usuario, $clave);
                
            if($stmt->execute()) {
                echo "<script>alert('Se han ingresado correctamente los datos');</script>";
            } else {
                echo "<script>alert('Error');</script>";
            }
            
            $stmt->close();
        }
    }
        $conexion->close();
        $confirmarExistencia->close();
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
        <div id="register_box"> <!-- DA UN ERROR AL PONERLE EL ESTILO, SOLO FUNCIONA CON login_box -->
            <form action="" method="post" id="registerform">
                <div class=" mb-5" id="register_box">
                    <h1 style="color: #FF6600; font-size: 48px;" >Nuevo usuario</h1>
                </div>
                <div class="login_form d-flex mb-5" >
                    <img src="recursos/usuario.png" class="me-3" alt="usuario" style="width: 28px; height: 28px;">
                    <input type="text" name="usuario" class="input_login" id="usuario" placeholder="Ingrese el nuevo usuario"  style="width: 100%; font-size: 24px; color: white; background: none; border: none;">
                </div>
                <div class="login_form d-flex mb-5">
                    <img src="recursos/candado.png" alt="usuario" class="me-3" style="width: 28px; height: 28px;">
                    <input type="password" name="clave" id="contraseña" class="input_login" placeholder="Ingrese la contraseña"  style="width: 100%; font-size: 24px; color: white; background: none; border: none;">
                </div>
                <div class="login_form d-flex mb-5">
                <img src="recursos/candado.png" alt="usuario" class="me-3" style="width: 28px; height: 28px;">
                <input type="password" name="confirmarClave" id="confirmarContraseña" class="input_login" placeholder="Confirme su contraseña"  style="width: 100%; font-size: 24px; color: white; background: none; border: none;">
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <div>
                    <button class="botones_sistema" style="margin-top: 10px; margin-bottom: 20px;" type="submit">Ingresar</button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <p style="color: #FF6600;"><a href="login.php" style="text-decoration: none; color: #CC3300; margin-right: 20px;">Iniciar sesión</a> | <span id="error" style="margin-left: 20px;"><?php echo $errorMsg ?: "Indigo Software"; ?></span></p>
            </div>
        </form>
        </div>
    </div>


    <script src="scripts/registro.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>

