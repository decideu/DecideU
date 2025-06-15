<!--
    Decide U
    Ingresar
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 12/06/2025
-->
<?php
//Inicio de sesion
session_start();
//Conexion a la base de datos
include("bd.php");
//condicion
if(isset($_POST['ingresar'])){
    //Capturar lo que escribio el usuario
    $usuario = $_POST['nombreinicio'];
    $contraseña = $_POST['contrainicios'];
    //Buscar si existe en la base de datos
    $consulta = $conn->prepare("SELECT * FROM usuario  WHERE num_control = ? AND contraseña = ?");
    $consulta->bind_param("ss", $usuario,$contraseña);
    $consulta->execute();
    $resultado = $consulta->get_result();
    //Condicion si si lo encuentra
    if($resultado->num_rows > 0){
        $datos = $resultado->fetch_assoc();
        //Guardar los datos para usarlos despues
        $_SESSION['num_control'] = $datos['num_control'];
        $_SESSION['nombre'] = $datos['nombre'];
        //dirige pafina principal
        header("Location: bienvenido.php");
        exit();
    } else{
        //Si no coincide, guarda mensaje de error
        $_SESSION['message'] = 'Usuario o contraseña incorrecta.';
        $_SESSION['message_type'] = 'danger';
        //regresar al login
        header("Location: iniciar.php");
        exit();
    }
}
?>