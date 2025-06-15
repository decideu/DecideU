<!--
    Decide U
    Bienvenido
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
//Inicia la sesión para acceder a variables
session_start();
//Conexion a al header y base de datos
include("header.php");
include("bd.php");
//Verifica si hay un nombre de usuario para mostrar, si no muestra "invitado"
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--Enlace de conexion a la hoja de estilo-->
        <link rel="stylesheet" href="css/estilo2.css?v=2.0">
        <!--Título-->
        <title>Bienvenido</title>
    </head>
    <body>
        <!--Contenido principal con fondo-->
        <div class="fondobienve">
            <div class="enfrente">
                <!--Saludo donde muestra el numbre de usuario-->
                <h1 class="letrasbienve">¡Hola, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>!</h1>
                <!--Mensaje de bienvenida general-->
                <h2 class="letrasbienve">¡Bienvenido a DecideU!</h2>
                <!--Mensaje introductorio al proposito del sitio-->
                <p class="parrafo">Aquí podrás explorar tus habilidades e intereses.</p>
                <p class="parrafo">Haz clic en cada una de las 5 áreas para comenzar los test.</p>
                <br>
                <!--Contenido de las 5 areas-->
                <div class="areas">
                    <!--Cada sección representa un test distinto-->
                    <section class="section">
                        <!--Muestra una imagen relacionada al test que te dirige al la pagina del test-->
                        <a href="areasocial.php"><img class="img1" src="img/1.PNG" alt="Habilidades sociales"></a>
                        <p>Habilidades sociales e interpersonales</p>
                    </section>
                    <section class="section">
                        <!--Muestra una imagen relacionada al test que te dirige al la pagina del test-->
                        <a href="areacognitiva.php"><img class="img1" src="img/2.PNG" alt="Habilidades cognitivas"></a>
                        <p>Habilidades cognitivas</p>
                    </section>
                    <section class="section">
                        <!--Muestra una imagen relacionada al test que te dirige al la pagina del test-->
                        <a href="areacreati.php"><img class="img1" src="img/3.PNG" alt="Creatividad y expresión artística"></a>
                        <p>Creatividad y expresión artística</p>
                    </section>
                    <section class="section">
                        <!--Muestra una imagen relacionada al test que te dirige al la pagina del test-->
                        <a href="arearazonami.php"><img class="img1" src="img/4.PNG" alt="Razonamiento lógico y matemático"></a>
                        <p>Razonamiento lógico y matemático</p>
                    </section>
                    <section class="section">
                        <!--Muestra una imagen relacionada al test que te dirige al la pagina del test-->
                        <a href="areapensacienti.php"><img class="img1" src="img/5.PNG" alt="Pensamiento Científico"></a>
                        <p>Pensamiento Científico</p>
                    </section>
                </div>
            </div>
        </div>
        <!--Seccion decorativa-->
        <section class="seccion-negro"></section>
    </body>
</html>
<!--incluir el footer-->
<?php include("footer.php"); ?>