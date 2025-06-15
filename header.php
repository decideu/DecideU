<!--
    Decide U
    Header
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--Enlace de conexion a la hoja de estilo-->
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <!--Contenido-->
        <header class="top-header">
            <!--Logo superior a la izq-->
            <div class="logo-menu">
                <!--Imagen del logo con enlace-->
                <a href="bienvenido.php">
                    <img src="img/logo.png" alt="Logo">
                </a>
            </div>
            <!--Icono de la derecha superior-->
            <div class="menu" onclick="toggleMenu()">
                <!--Caracter de menú hamburguesa-->
                &#9776;
            </div>
            <!--Menú lateral oculto que se muestra con script-->
            <nav class="menu-lateral" id="menuLateral">
                <!--Enlaces a las demas paginas-->
                <a href="bienvenido.php">Bienvenido</a>
                <a href="recomendaciones.php">Recomendaciones</a>
                <a href="perfil.php">Perfil</a>
            </nav>
        </header>
        <!--Conexion al script-->
        <script src="js/decideu.js"></script>
    </body>
</html>