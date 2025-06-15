<!--
    Decide U
    Recomendaciones
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
// Iniciar sesión para acceder a variables de sesión
session_start();
// Incluir encabezado y conexión a la base de datos
include("header.php");
include("bd.php");

// Obtener número de control del usuario desde sesión
$num_control = $_SESSION['num_control'] ?? null;

// Función para obtener la descripción de una carrera por su nombre
function obtenerDescripcionCarrera($conn, $nombreCarrera) {
    $stmt = $conn->prepare("SELECT descripcion_car FROM carreras WHERE nombre_carrera = ?");
    $stmt->bind_param("s", $nombreCarrera);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc()['descripcion_car'] : "Descripción no disponible.";
}

// Función para obtener recomendaciones basadas en calificaciones del usuario
function obtenerRecomendaciones($conn, $num_control) {
    $usuario = ['RL' => 0, 'HC' => 0, 'HS' => 0, 'CE' => 0, 'PC' => 0];

    $sql = "SELECT id_areaconoc, calificacion FROM resultados WHERE num_control = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $num_control);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $valor = floatval($row['calificacion']) / 10.0;
        switch ($row['id_areaconoc']) {
            case 1: $usuario['RL'] = $valor; break;
            case 2: $usuario['HC'] = $valor; break;
            case 3: $usuario['HS'] = $valor; break;
            case 4: $usuario['CE'] = $valor; break;
            case 5: $usuario['PC'] = $valor; break;
        }
    }

    $sql2 = "SELECT carrera, RL, HC, HS, CE, PC FROM afinidad";
    $result2 = $conn->query($sql2);
    $recomendaciones = [];

    function productoPunto($a, $b) {
        return $a['RL'] * $b['RL'] + $a['HC'] * $b['HC'] + $a['HS'] * $b['HS'] + $a['CE'] * $b['CE'] + $a['PC'] * $b['PC'];
    }

    function norma($a) {
        return sqrt($a['RL']**2 + $a['HC']**2 + $a['HS']**2 + $a['CE']**2 + $a['PC']**2);
    }

    while ($fila = $result2->fetch_assoc()) {
        $carreraVector = [
            'RL' => $fila['RL'], 'HC' => $fila['HC'],
            'HS' => $fila['HS'], 'CE' => $fila['CE'], 'PC' => $fila['PC']
        ];
        $denominador = norma($usuario) * norma($carreraVector);
        $sim = ($denominador != 0) ? productoPunto($usuario, $carreraVector) / $denominador : 0;

        $recomendaciones[] = [
            'nombre' => $fila['carrera'],
            'afinidad' => $sim
        ];
    }

    usort($recomendaciones, fn($a, $b) => $b['afinidad'] <=> $a['afinidad']);
    return array_slice($recomendaciones, 0, 5);
}

// Función que devuelve áreas incompletas del usuario
function obtenerAreasFaltantes($conn, $num_control) {
    $sql = "SELECT DISTINCT id_areaconoc FROM resultados WHERE num_control = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $num_control);
    $stmt->execute();
    $result = $stmt->get_result();

    $respondidas = [];
    while ($row = $result->fetch_assoc()) {
        $respondidas[] = intval($row['id_areaconoc']);
    }

    // Definir nombres de las 5 áreas
    $todas = [
        1 => 'Razonamiento Lógico',
        2 => 'Habilidades Cognitivas',
        3 => 'Habilidades Sociales',
        4 => 'Creatividad y Expresión',
        5 => 'Pensamiento Crítico'
    ];

    // Retornar áreas que no están respondidas
    $faltantes = [];
    foreach ($todas as $id => $nombre) {
        if (!in_array($id, $respondidas)) {
            $faltantes[] = $nombre;
        }
    }
    return $faltantes;
}

// Si se presiona "Actualizar recomendaciones"
if (isset($_POST['actualizar'])) {
    unset($_SESSION['recomendaciones']);
}

// Variables iniciales
$mensaje = "";
$descripcion = "";
$top_recomendacion = null;
$universidades = [];

if (!$num_control) {
    $mensaje = "Debes iniciar sesión para ver recomendaciones.";
    $recomendaciones = [];
} else {
    $faltantes = obtenerAreasFaltantes($conn, $num_control);

    if (empty($faltantes)) {
        // Usuario completó todo
        if (!isset($_SESSION['recomendaciones'])) {
            $_SESSION['recomendaciones'] = obtenerRecomendaciones($conn, $num_control);
        }
        $recomendaciones = $_SESSION['recomendaciones'];
        $top_recomendacion = $recomendaciones[0] ?? null;

        if ($top_recomendacion) {
            $descripcion = obtenerDescripcionCarrera($conn, $top_recomendacion['nombre']);
            $idCarrera = obtenerIdCarrera($conn, $top_recomendacion['nombre']);
            if ($idCarrera) {
                $universidades = obtenerUniversidadesPorCarrera($conn, $idCarrera);
            }
        }
    } else {
        // Faltan tests
        $mensaje = "Completa los 5 tests para obtener recomendaciones.<br><strong>Áreas pendientes:</strong><ul>";
        foreach ($faltantes as $falta) {
            $mensaje .= "<li>$falta</li>";
        }
        $mensaje .= "</ul>";
        $recomendaciones = [];
    }
}
// Función para obtener ID de carrera por nombre
function obtenerIdCarrera($conn, $nombreCarrera) {
    $stmt = $conn->prepare("SELECT id_carrera FROM carreras WHERE nombre_carrera = ?");
    $stmt->bind_param("s", $nombreCarrera);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result && $result->num_rows > 0) ? $result->fetch_assoc()['id_carrera'] : null;
}
// Función para obtener universidades que ofrecen una carrera
function obtenerUniversidadesPorCarrera($conn, $idCarrera) {
    $sql = "SELECT * FROM universidad u
            INNER JOIN ofrece o ON u.id_universidad = o.id_universidad
            WHERE o.id_carrera = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCarrera);
    $stmt->execute();
    $result = $stmt->get_result();
    $universidades = [];
    while ($fila = $result->fetch_assoc()) {
        $universidades[] = $fila;
    }
    return $universidades;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Conexion de las hojas de estilo -->
        <link rel="stylesheet" href="css/estilo2.css?v=2.0" />
        <link rel="stylesheet" href="css/recomen.css?v=2.0" />
        <title>Recomendaciones</title>
    </head>
    <body>
        <div class="fondoremon">
            <div class="enfrente">
                <div class="container">
                    <div class="sidebar">
                        <h2>Secciones</h2>
                        <?php if (!empty($recomendaciones)): ?>
                            <div id="recomendaciones-buttons">
                                <?php foreach ($recomendaciones as $index => $r): ?>
                                    <button type="button" class="rec-button" onclick="mostrarRecomendacion(<?= $index ?>)">
                                        Recomendación <?= $index + 1 ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" style="margin-top: 1em;">
                            <button type="submit" name="actualizar">Actualizar recomendaciones</button>
                        </form>
                    </div>
                    <div class="main">
                        <section id="recomendaciones">
                            <h2>Carreras recomendadas para ti</h2>
                            <!-- Mostrar mensaje si faltan tests o si no hay recomendaciones -->
                            <?php if (!empty($mensaje)): ?>
                                <div class="alerta">
                                    <?= $mensaje ?>
                                </div>
                            <?php elseif (empty($recomendaciones)): ?>
                                <p>No hay recomendaciones disponibles.</p>
                            <?php else: ?>
                                <div id="contenido-recomendacion">
                                    <?php foreach ($recomendaciones as $index => $r):
                                        $descripcion_actual = obtenerDescripcionCarrera($conn, $r['nombre']);
                                    ?>
                                        <div class="recomendacion-contenido" id="rec-<?= $index ?>" style="<?= $index !== 0 ? 'display:none;' : '' ?>">
                                            <h1><?= htmlspecialchars($r['nombre']) ?></h1>
                                            <p><?= nl2br(htmlspecialchars($descripcion_actual)) ?></p>
                                            <p><strong>Afinidad:</strong> <?= round($r['afinidad'] * 100, 1) ?>%</p>
                                            <br>
                                            <a href="universidades.php?carrera=<?= urlencode($r['nombre']) ?>" class="button">
                                                Universidades que ofrecen
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/decide.js"></script>
    </body>
</html>
<?php include("footer.php"); ?>