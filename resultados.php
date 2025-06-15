<!--
    Decide U
    Resultados
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
// Iniciar sesión para acceder a datos del usuario y respuestas guardadas
session_start();

// Incluir conexión a la base de datos (archivo bd.php)
include("bd.php");

// Verificar que el usuario haya iniciado sesión con su número de control
if (!isset($_SESSION['num_control'])) {
    // Si no hay sesión activa, redirigir al inicio de sesión
    header("Location: iniciar.php");
    exit();
}

// Obtener datos guardados del test desde la sesión
$quiz = $_SESSION['quiz'] ?? [];               // Cuestionario con preguntas y opciones
$test_name = $_SESSION['test_name'] ?? 'test';// Nombre del test (ej. 'social')
$answers = $_SESSION['answers'] ?? [];         // Respuestas del usuario (índices de opciones)

// Verificar que el usuario haya respondido al menos una pregunta
$respuestas_validas = array_filter($answers, fn($a) => $a !== null);
if (empty($respuestas_validas)) {
    // Si no hay respuestas válidas, mostrar alerta y regresar a la página principal
    echo "<script>alert('No has respondido el test.'); window.location.href = 'bienvenido.php';</script>";
    exit();
}

// Inicializar variables para cálculo de resultados
$total = 0;          // Suma total de puntajes
$correctas = 0;      // Contador de respuestas con puntaje positivo
$incorrectas = 0;    // Contador de respuestas con puntaje cero o inválidas

// Recorrer cada respuesta para calcular puntaje y conteo
foreach ($answers as $i => $answerIndex) {
    // Verificar que la opción seleccionada exista en la pregunta actual
    if (isset($quiz[$i]['opciones'][$answerIndex])) {
        // Obtener puntaje de la opción seleccionada
        $score = $quiz[$i]['opciones'][$answerIndex]['score'];
        $total += $score; // Sumar puntaje al total

        // Contar respuestas buenas o malas según el puntaje
        if ($score > 0) {
            $correctas++;
        } else {
            $incorrectas++;
        }
    } else {
        // Si la opción no existe (respuesta inválida), contar como incorrecta
        $incorrectas++;
    }
}

// Guardar la calificación total en la sesión para usar en otras páginas si se desea
$_SESSION['calificaciones'][$test_name] = $total;

// Obtener datos del usuario para registrar resultados en la base de datos
$num_control = $_SESSION['num_control'];            // Número de control del usuario
$id_areaconoc = $_SESSION['id_areaconoc'] ?? null;  // ID del área de conocimiento (ej. 5 para social)
$fecha = date("Y-m-d");                              // Fecha actual en formato YYYY-MM-DD

// Insertar o actualizar los resultados en la base de datos solo si hay datos válidos
if ($num_control && $id_areaconoc !== null) {
    // Verificar que el usuario exista en la tabla 'usuario'
    $check = $conn->prepare("SELECT 1 FROM usuario WHERE num_control = ?");
    $check->bind_param("s", $num_control);
    $check->execute();
    $result = $check->get_result();

    if ($result && $result->num_rows > 0) {
        // Insertar o actualizar registro en la tabla 'resultados'
        $stmt = $conn->prepare("
            INSERT INTO resultados (fecha_rea, calificacion, num_control, id_areaconoc)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                fecha_rea = VALUES(fecha_rea),
                calificacion = VALUES(calificacion)
        ");
        // Enlazar parámetros: fecha (string), total (double), num_control (string), id_areaconoc (int)
        $stmt->bind_param("sdsi", $fecha, $total, $num_control, $id_areaconoc);
        $stmt->execute();
    }
}
?>
<!-- Incluir encabezado común de la página -->
<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <!-- Vincular hojas de estilo personalizadas -->
        <link rel="stylesheet" href="css/estilo2.css">
        <link rel="stylesheet" href="css/estiloareas.css">
        <title>Resultados del Test</title>
    </head>
    <body>
        <!-- Contenedor principal con fondo y contenido centrado -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Sección para mostrar resultados -->
                <div class="contenidoresultados">
                    <!-- Título con el nombre del test -->
                    <h2>Resultados del test: <?= htmlspecialchars($test_name) ?></h2>
                    <!-- Mostrar puntaje total con formato numérico de dos decimales -->
                    <p><strong>Puntaje total:</strong> <?= number_format($total, 2) ?></p>
                    <!-- Mostrar conteo de respuestas buenas -->
                    <p><strong>Respuestas correctas:</strong> <?= $correctas ?></p>
                    <!-- Mostrar conteo de respuestas malas -->
                    <p><strong>Respuestas incorrectas:</strong> <?= $incorrectas ?></p>
                    <!-- Listado detallado de cada respuesta -->
                    <ul>
                        <?php foreach ($answers as $i => $resp): ?>
                            <li>
                                <strong>Pregunta <?= $i + 1 ?>:</strong>
                                <!-- Mostrar texto de la opción seleccionada o indicar si no fue respondida -->
                                <?= htmlspecialchars($quiz[$i]['opciones'][$resp]['text'] ?? 'No respondida') ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Botón para continuar o volver a la página principal -->
                <div class="botone">
                    <a href="bienvenido.php" class="botone">Siguiente encuesta</a>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- Incluir pie de página común -->
<?php include("footer.php"); ?>