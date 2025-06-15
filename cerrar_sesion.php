<!--
    Decide U
    Cerrar_sesion
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
    session_start();
    session_unset();
    session_destroy();
    
    header("Location: /index.php");
    exit();
?>