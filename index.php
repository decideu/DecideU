<!--
    Decide U
    Index
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Enlace de conexion a la hoja de estilo-->
        <link rel="stylesheet" href="css/estilo.css">
        <title>DecideU</title>
    </head>
    <body>
        <!--Fondo principal-->
        <div class="fondo">
            <!--Parte de arriba, menu-->
            <div class="arriba">
                <div class="logo">
                    <img src="img/logo.png" class="logoindex"> DecideU
                </div>
                <div>
                    <a href="iniciar.php">Iniciar Sesión</a>
                </div>
            </div>
            <!--Contenido principal, titulo-->
            <div class="contenido">
                <h2>Bienvenido a</h2>
                <h1>DecideU</h1>
                <p>¿Confundido en tú futuro?</p>
                <p>Te ayudamos a descubrirlo</p>
                <a href="#info" onclick="scrollSuave(event,'info')" class="boton">Más información</a>
            </div>
        </div>
        <!--Seccion para pequeña intro de nosotros-->
        <section id="info" class="info">
            <div class="contenido2">
                <h2>Sobre nosotros</h2>
                <p>Sabemos lo difícil que es elegir una carrera. Por ello creamos DecideU, una herramienta para los estudiantes del CBTis No. 37 para elegir una carrera profesional.</p>
                <p>Ofreciendo recomendaciones dependiendo de tus puntajes en los test.</p>
                <p>DecideU te orienta, <span class="destacado">¡tú decides!</span></p>
            </div>
        </section>
        <!--Conexion al script-->
        <script src="js/decideu.js"></script>
    </body>
</html>
<!--incluir el footer-->
<?php include("footer.php"); ?>