<!--
    Decide U
    Base de datos
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 10/06/2025
-->
<!--Conexion al localhost-->
<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'decideu' //nombre de la base de datos
    ) or die(mysqli_connect_error());
?>
