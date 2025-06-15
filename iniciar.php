<!--
    Decide U
    Iniciar
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Ayuda a que el diseño sea responsive-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!--Enlace de conexion a la hoja de estilo-->
        <link rel="stylesheet" href="css/iniciar.css">
        <title>Inicio de sesión</title>
    </head>
    <body>
        <!-- Botón de cerrar (volver al index) -->
        <a href="index.php" class="cerrar-btn" title="Volver al inicio">
            <i class='bx bx-x'></i>
        </a>
        <!--Contenido principal-->
        <div class="container">
            <!--Formulario de Acceso-->
            <div class="form-box login">
                <!--Esto envia los datos a ingresar.php para iniciar sesion-->
                <form action="ingresar.php" method="POST">
                    <?php
                        // Mostrar mensaje de error si hay uno guardado en la sesión
                        if (isset($_SESSION['message'])) {
                            echo "<div class='mensaje-error'>{$_SESSION['message']}</div>";
                            unset($_SESSION['message']); // Limpiar el mensaje después de mostrarlo
                        }
                    ?>
                    <!-- Título -->
                    <h1>Acceder</h1>
                    <br>
                    <!--Campos a ingresar y sus iconos-->
                    <div class="input-box">
                        <input type="text" name="nombreinicio" placeholder="Numero de control">
                        <i class='bx bx-user'></i> 
                    </div>
                    <br>
                    <div class="input-box">
                        <input type="password" name="contrainicios" placeholder="Contraseña">
                        <i class='bx bx-lock'></i> 
                    </div>
                    <br>
                    <!--Envia el formulario-->
                    <button type="submit" name="ingresar" value="ingresar" class="btn">Acceder</button>
                </form>
            </div>
            <!--Formulario de registro-->
            <div class="form-box registro">
                <!--Esto envia los datos a guardar.php para registrarse-->
                <form action="guardar.php" method="POST">
                    <h1>
                        <!--Titulo-->
                        Registrarse
                        <!--Campos a ingresar y sus iconos-->
                        <div class="input-box">
                            <input type="text" name="nombre" placeholder="Nombre del usuario" autofocus>
                            <i class='bx bx-user'></i> 
                        </div>
                        <div class="input-box">
                            <input type="text" name="AP" placeholder="Apellido paterno" autofocus>
                            <i class='bx bx-label'></i> 
                        </div>
                        <div class="input-box">
                            <input type="text" name="AM" placeholder="Apellido materno" autofocus>
                            <i class='bx bx-label'></i> 
                        </div>
                        <div class="input-box">
                            <input type="text" name="numerocon" placeholder="Número de control" autofocus>
                            <i class='bx bx-id-card'></i>
                        </div>
                        <div class="input-box">
                            <input type="text" name="curp" placeholder="Curp" autofocus>
                            <i class='bx bx-lock'></i> 
                        </div>
                        <div class="input-box">
                            <input type="password" name="contra" placeholder="Contraseña" autofocus>
                            <i class='bx bx-lock'></i> 
                        </div>
                        <!--Enviar el formulario-->
                        <button type="submit" name="save" value="Registrarse" class="btn">Registrarse</button>
                    </h1>
                </form>
            </div>
            <!--Panel para cambiar entre formularios-->
            <div class="toggle-box">
                <!--Panel izq que muestra el iniciar sesion, dirige al apartado de registro-->
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido</h1>
                    <p>¿Aún no tienes una cuenta?</p>
                    <button class="btn registro-btn">Registrarse</button>
                </div>
                <!--Panel derecho que muestra el registro, dirige al apartado de iinicio de sesion-->
                <div class="toggle-panel toggle-right">
                    <h1>Bienvenido de nuevo</h1>
                    <p>¿Ya tienes una cuenta?</p>
                    <button class="btn acceso-btn">Acceder</button>
                </div>
            </div>
        </div>
        <!--Conexion al script-->
        <script src="js/decideu.js"></script>
    </body>
</html>