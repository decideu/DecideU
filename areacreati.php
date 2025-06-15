<!--
    Decide U
    Area Creatividad
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php 
//Inicia sesion para almacenar progreso
session_start();
//Incluye encabezado común del sitio
include("header.php"); 
// Cuestionatio
$quiz = [
    //Cada elemento representa una pregunta con sus opciones y puntajes
    [
        'preguntas' => '1. ¿Cuál de estas actividades estimula más la creatividad visual?',
        'opciones' => [
            ['text' => 'A) Hacer dibujos libres.', 'score' => 1.0],
            ['text' => 'B) Resolver ecuaciones matemáticas.', 'score' => 0.0],
            ['text' => 'C) Memorizar fechas históricas.', 'score' => 0.0],
            ['text' => 'D) Leer instrucciones técnicas.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '2. Estás en un equipo y deben presentar un tema escolar. ¿Qué propuesta aporta más creatividad?',
        'opciones' => [
            ['text' => 'A) Leer el texto en voz alta.', 'score' => 0.0],
            ['text' => 'B) Hacer una maqueta o cartel visual.', 'score' => 1.0],
            ['text' => 'C) Presentar una diapositiva sin imágenes.', 'score' => 0.3],
            ['text' => 'D) Repartirse el texto y explicarlo.', 'score' => 0.5]
        ]
    ],
    [
        'preguntas' => '3. ¿Cuál de estas actitudes representa mejor a una persona creativa?',
        'opciones' => [
            ['text' => 'A) Propone ideas diferentes aunque no siempre funcionen.', 'score' => 1.0],
            ['text' => 'B) Solo sigue métodos conocidos.', 'score' => 0.0],
            ['text' => 'C) Evita arriesgarse a fallar.', 'score' => 0.0],
            ['text' => 'D) Espera instrucciones para actuar.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '4. ¿Qué habilidad es importante para una carrera artística?',
        'opciones' => [
            ['text' => 'A) Ser bueno en cálculo numérico.', 'score' => 0.3],
            ['text' => 'B) Tener sensibilidad para los colores, formas o sonidos.', 'score' => 1.0],
            ['text' => 'C) Memorizar textos extensos.', 'score' => 0.3],
            ['text' => 'D) Seguir procedimientos sin cambios.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '5. En una actividad con materiales reciclados, ¿qué haces?',
        'opciones' => [
            ['text' => 'A) Pruebo combinarlos para hacer algo nuevo.', 'score' => 1.0],
            ['text' => 'B) Pido ejemplos antes de comenzar.', 'score' => 0.5],
            ['text' => 'C) Copio lo que alguien más hace.', 'score' => 0.3],
            ['text' => 'D) No se me ocurre nada.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '6. ¿Qué tipo de expresión artística implica mayor uso de símbolos y emociones?',
        'opciones' => [
            ['text' => 'A) Pintura abstracta.', 'score' => 1.0],
            ['text' => 'B) Manualidades repetitivas.', 'score' => 0.3],
            ['text' => 'C) Ensamble de piezas con instrucciones.', 'score' => 0.2],
            ['text' => 'D) Calcar figuras.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '7. ¿Cuál de las siguientes profesiones requiere más creatividad visual?',
        'opciones' => [
            ['text' => 'A) Diseño gráfico.', 'score' => 1.0],
            ['text' => 'B) Contaduría.', 'score' => 0.0],
            ['text' => 'C) Abogacía.', 'score' => 0.0],
            ['text' => 'D) Medicina general.', 'score' => 0.3]
        ]
    ],
    [
        'preguntas' => '8. Si observas una imagen con muchos elementos, ¿qué haces primero?',
        'opciones' => [
            ['text' => 'A) Analizo lo que me llama la atención y busco un significado.', 'score' => 1.0],
            ['text' => 'B) Me fijo solo en los colores.', 'score' => 0.5],
            ['text' => 'C) No le pongo atención.', 'score' => 0.0],
            ['text' => 'D) Me fijo solo en lo que dicen los demás.', 'score' => 0.3]
        ]
    ],
    [
        'preguntas' => '9. ¿Te gusta participar en actividades como dibujo, pintura, música o teatro?',
        'opciones' => [
            ['text' => 'A) Sí, mucho.', 'score' => 0.5],
            ['text' => 'B) A veces.', 'score' => 0.3],
            ['text' => 'C) Casi nunca.', 'score' => 0.1],
            ['text' => 'D) No me interesa.', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '10. ¿Qué tipo de actividades disfrutas más en tu tiempo libre?',
        'opciones' => [
            ['text' => 'A) Crear cosas como dibujos, canciones o manualidades.', 'score' => 0.5],
            ['text' => 'B) Ver películas o escuchar música.', 'score' => 0.3],
            ['text' => 'C) Resolver acertijos o problemas.', 'score' => 0.2],
            ['text' => 'D) Hacer tareas repetitivas o físicas.', 'score' => 0.0]
        ]
    ],
];
// INICIO DEL TEST
// Si es la primera vez que se carga el test, o si es otro test distinto, o se presionó el botón reiniciar
if (!isset($_SESSION['test_name']) || $_SESSION['test_name'] !== 'Creatividad y expresión artística' || isset($_POST['reset'])) {
    // Guarda el cuestionario completo en sesión para mantenerlo mientras dure el test
    $_SESSION['quiz'] = $quiz;
    // Define el nombre del test actual
    $_SESSION['test_name'] = 'Creatividad y expresión artística';
    // Guarda el id del área del conocimiento
    $_SESSION['id_areaconoc'] = 3;
    // Indica que comenzamos en la pregunta 0 (la primera)
    $_SESSION['current'] = 0;
    // Inicializa el arreglo para guardar respuestas del usuario (null para sin respuesta)
    $_SESSION['answers'] = array_fill(0, count($quiz), null);

    // Si se presionó el botón reiniciar, recarga la página para resetear el test
    if (isset($_POST['reset'])) {
        header('Location: areacreati.php'); // Redirige a esta misma página
        exit();
    }
}

// PROCESO DE RESPUESTAS Y NAVEGACIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guarda la respuesta seleccionada por el usuario en la pregunta actual
    if (isset($_POST['answer'])) {
        $_SESSION['answers'][$_SESSION['current']] = intval($_POST['answer']);
    }

    // Si el usuario presionó el botón "Siguiente"
    if (isset($_POST['next'])) {
        // Avanza a la siguiente pregunta si no es la última
        if ($_SESSION['current'] < count($_SESSION['quiz']) - 1) {
            $_SESSION['current']++;
        } else {
            // Si es la última pregunta, redirige a la página de resultados
            header('Location: resultados.php');
            exit();
        }
    }

    // Si el usuario presionó el botón "Atrás"
    if (isset($_POST['prev']) && $_SESSION['current'] > 0) {
        $_SESSION['current']--;
    }
}

// Mostrar la pregunta actual
$current = $_SESSION['current'] ?? 0;

// Verifica que existan preguntas y que la actual sea válida
if (isset($_SESSION['quiz']) && isset($_SESSION['quiz'][$current])) {
    $question = $_SESSION['quiz'][$current]['preguntas'];  // Texto de la pregunta actual
    $options = $_SESSION['quiz'][$current]['opciones'];    // Opciones para la pregunta actual
    $selected = $_SESSION['answers'][$current] ?? null;   // Respuesta seleccionada por el usuario (si la hay)
} else {
    // Si no hay preguntas disponibles muestra mensaje y enlace para reiniciar test social (puedes cambiarlo)
    echo "<p>No hay preguntas disponibles. Por favor, <a href='areasocial.php?reset=1'>reinicia el test</a>.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Enlaces a hojas de estilo externas -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="css/estilo2.css?v=5">
        <link rel="stylesheet" href="css/estiloareas.css?v=1">
        <title>Creatividad y expresión artística</title>
    </head>
    <body>
        <!-- Contenedor principal con fondo -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Título del área -->
                <h1 class="tituloarea">Creatividad y expresión artística</h1>
                <!-- Descripción u objetivo del área -->
                <p class="paarea">Objetivo: Detectar habilidades relacionadas con artes visuales, música, diseño gráfico, arquitectura, publicidad, comunicación visual, animación, entre otras.</p>

                <!-- Contenido del cuestionario -->
                <div class="contenido-cuestionario" id="cuestionario">
                    <form method="post" id="quizForm">
                        <!-- Mostrar la pregunta actual -->
                        <div class="pregunta"><?= htmlspecialchars($question) ?></div>
                        <!-- Mostrar las opciones de respuesta -->
                        <div class="opciones">
                            <?php foreach ($options as $index => $option): ?>
                                <label>
                                    <!-- Opción tipo radio para que solo se seleccione una -->
                                    <input type="radio" name="answer" value="<?= $index ?>" <?= ($selected === $index) ? 'checked' : '' ?> required>
                                    <?= htmlspecialchars($option['text']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <!-- Botones de navegación del test -->
                        <div class="navegacion">
                            <!-- Botón para ir a la pregunta anterior (desactivado si es la primera) -->
                            <button type="submit" name="prev" class="botone" <?= $current === 0 ? 'disabled' : '' ?>>
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <!-- Botón para reiniciar el test -->
                            <button type="submit" name="reset" class="botone">
                                <i class="fas fa-rotate-left"></i>
                            </button>
                            <!-- Botón para avanzar o finalizar (cambia icono si es la última pregunta) -->
                            <button type="submit" name="next" class="botone">
                                <i class="fas <?= $current === count($_SESSION['quiz']) - 1 ? 'fa-check' : 'fa-arrow-right' ?>"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const cuestionario = document.getElementById('cuestionario');
                if (cuestionario) {
                    cuestionario.scrollIntoView({ behavior: 'smooth' });
                }
            });
        </script>
    </body>
</html>
<!-- Incluye pie de página común -->
<?php include("footer.php"); ?>