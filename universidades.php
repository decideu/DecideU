<!--
    Decide U
    Universidades
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
// Incluir encabezado común de la página y la base de datos
include("header.php");
include("bd.php");
// Obtener la carrera desde la URL con método GET, o null si no está definida
$carrera = $_GET['carrera'] ?? null;
// Escapar caracteres especiales para prevenir inyección SQL
$carrera = $conn->real_escape_string($carrera);
// Inicializar arreglo para almacenar universidades que ofrecen la carrera
$universidades = [];
// Si se proporcionó una carrera, realizar consulta a base de datos
if ($carrera) {
    // Consulta SQL para obtener datos de universidades que ofrecen la carrera dada
    $sql = "SELECT 
                u.nombreUni AS nombre, 
                u.descripción AS descripcion, 
                u.link_universidad AS sitio_web, 
                u.link_beca AS url_becas
            FROM universidad u
            INNER JOIN ofrece o ON u.id_universidad = o.id_universidad
            INNER JOIN carreras c ON o.id_carrera = c.id_carrera
            WHERE c.nombre_carrera = '$carrera'";
    // Ejecutar consulta
    $result = $conn->query($sql);
    // Si la consulta fue exitosa, almacenar los resultados en el arreglo
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $universidades[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Enlaces a hojas de estilo para diseño general y específico de universidades -->
        <link rel="stylesheet" href="css/estilo2.css?v=1.0" />
        <link rel="stylesheet" href="css/universidades.css?v=1.0" />
        <!-- Título -->
        <title>Universidades que ofrecen <?= htmlspecialchars($carrera) ?></title>
    </head>
    <body>
        <!-- Contenedor principal con fondo y contenido centrado -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Sección principal: listado de universidades -->
                <section id="universidades">
                    <h2>Universidades que ofrecen <?= htmlspecialchars($carrera) ?></h2>
                    <br>
                    <!-- Botón para regresar a la página anterior -->
                    <button class="volver">
                        <a href="recomendaciones.php" class="volver">← Volver</a>
                    </button>
                    <?php if (!empty($universidades)): ?>
                        <!-- Contenedor que agrupa todas las universidades encontradas -->
                        <div class="universidades-container">
                            <?php foreach ($universidades as $uni): ?>
                                <!-- Tarjeta individual para cada universidad -->
                                <div class="universidad">
                                    <div class="nombre">
                                        <?= htmlspecialchars($uni['nombre']) ?><br><br>
                                        <!-- Enlace al sitio oficial de la universidad -->
                                        <a href="<?= htmlspecialchars($uni['sitio_web']) ?>" target="_blank" rel="noopener noreferrer">
                                            Sitio oficial
                                        </a>
                                    </div>
                                    <!-- Descripción de la universidad -->
                                    <div class="descripcion"><?= htmlspecialchars($uni['descripcion']) ?></div>
                                    <!-- Enlace para ver información sobre becas, si existe -->
                                    <a href="<?= htmlspecialchars($uni['url_becas'] ?? '#') ?>" target="_blank" rel="noopener noreferrer">
                                        Ver becas
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <!-- Mensaje si no se encontraron universidades que ofrezcan la carrera -->
                        <p>No se encontraron universidades que ofrezcan esta carrera.</p>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </body>
</html>
<!-- Incluir footer -->
<?php include("footer.php"); ?>