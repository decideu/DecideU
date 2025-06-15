<!--
    Decide U
    Area cognitiva
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
        'preguntas' => '1. Cuando estudio un tema difícil por primera vez…',
        'opciones' => [
            ['text' => 'A) Lo explico con mis palabras o hago esquemas', 'score' => 1.0],
            ['text' => 'B) Lo leo varias veces aunque no entienda bien', 'score' => 0.7],
            ['text' => 'C) Espero que alguien me lo explique', 'score' => 0.4],
            ['text' => 'D) Lo dejo para después', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '2. Si debes estudiar para tres exámenes en una semana y solo tienes 6 días, ¿cómo distribuirías tu tiempo para cada materia?',
        'opciones' => [
            ['text' => 'A) Estudiar un día por materia', 'score' => 0.7],
            ['text' => 'B) Estudiar solo la materia más difícil', 'score' => 0.3],
            ['text' => 'C) Estudiar un poco cada día para todas las materias', 'score' => 1.0],
            ['text' => 'D) No estudiar hasta el último día', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '3. Observa esta secuencia durante 5 segundos: 7, 4, 9, 2, 6. Ahora, sin volver a verla, ¿cuáles eran el segundo y el cuarto número (de izquierda a derecha)?',
        'opciones' => [
            ['text' => 'A) 4 y 6', 'score' => 0.5],
            ['text' => 'B) 9 y 2', 'score' => 0.5],
            ['text' => 'C) 4 y 2', 'score' => 1.0],
            ['text' => 'D) 2 y 6', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '4. ¿Qué haces cuando un maestro da muchas instrucciones rápido?',
        'opciones' => [
            ['text' => 'A) Apunto lo más importante y organizo la información', 'score' => 1.0],
            ['text' => 'B) Trato de recordar todo sin anotar', 'score' => 0.6],
            ['text' => 'C) Me distraigo o me confundo fácil', 'score' => 0.3],
            ['text' => 'D) Espero a que lo repita', 'score' => 0.2]
        ]
    ],
    [
        'preguntas' => '5. ¿Qué haces para recordar tareas o fechas importantes?',
        'opciones' => [
            ['text' => 'A) Le pido a alguien que me las recuerde', 'score' => 0.4],
            ['text' => 'B) Trato de recordarlas de memoria', 'score' => 0.6],
            ['text' => 'C) Uso agenda o recordatorios en el celular', 'score' => 1.0],
            ['text' => 'D) Se me olvidan seguido', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '6. Identifica el patrón y completa la serie: 2, 4, 8, 16, ...',
        'opciones' => [
            ['text' => 'A) 18', 'score' => 0.0],
            ['text' => 'B) 20', 'score' => 0.0],
            ['text' => 'C) 32', 'score' => 1.0],
            ['text' => 'D) 24', 'score' => 0.0]
        ]
    ],
    [
        "preguntas" => "Observa la imagen con atención.",
        "opciones" => [] // Sin opciones
    ],
    [
        'preguntas' => '7. Recuerda y responde: ¿Cuàles eran los principales colores había en la imagen que viste hace un momento? No volver atràs<',
        'opciones' => [
            ['text' => 'A) Amarillo, morado y blanco', 'score' => 0.0],
            ['text' => 'B) Rojo, naranja y azul', 'score' => 0.0],
            ['text' => 'C) Rojo, verde y azul', 'score' => 1.0],
            ['text' => 'D) Morado, rojo y azul', 'score' => 0.0]
        ]
    ],
    [
        'preguntas' => '8. ¿Cuál es la mejor forma de organizar tu tiempo para cumplir con un proyecto escolar que debes entregar en dos semanas?',
        'opciones' => [
        ['text' => 'A) Empezar el último día', 'score' => 0.0],
        ['text' => 'B) Dividir el trabajo en partes y avanzar poco a poco', 'score' => 1.0],
        ['text' => 'C) Esperar que alguien más lo haga', 'score' => 0.0],
        ['text' => 'D) No hacer nada', 'score' => 0.0]
    ]
    ],
    [
        'preguntas' => '9. ¿Prefieres aprender con materiales visuales, auditivos o prácticos?',
        'opciones' => [
            ['text' => 'A) Visuales', 'score' => 1.0],
            ['text' => 'B) Auditivos', 'score' => 0.8],
            ['text' => 'C) Prácticos', 'score' => 0.9],
            ['text' => 'D) No sé', 'score' => 0.3]
        ]
    ],
    [
        'preguntas' => '10. ¿Te gusta más organizar tus tareas con listas y horarios o trabajar de manera espontánea?',
        'opciones' => [
            ['text' => 'A) De manera espontánea', 'score' => 0.5],
            ['text' => 'B) Listas y horarios', 'score' => 1.0],
            ['text' => 'C) Me da igual', 'score' => 0.3],
            ['text' => 'D) No lo sé', 'score' => 0.0]
        ]
    ],
];
// Inicialización del test
// Si es la primera vez que entra a esta página o presionó el botón de reiniciar
if (!isset($_SESSION['test_name']) || $_SESSION['test_name'] !== 'Habilidades cognitivas' || isset($_POST['reset'])) {
    // Guarda el cuestionario completo en la sesión para mantenerlo disponible mientras dure el test
    $_SESSION['quiz'] = $quiz;
    // Define el nombre del test actual para evitar mezclar con otros tests
    $_SESSION['test_name'] = 'Habilidades cognitivas';
    // Guarda el ID del área de conocimiento (útil para guardar resultados luego)
    $_SESSION['id_areaconoc'] = 2;
    // Empieza en la primera pregunta (índice 0)
    $_SESSION['current'] = 0;
    // Inicializa el arreglo para guardar respuestas, con valores nulos indicando sin respuesta
    $_SESSION['answers'] = array_fill(0, count($quiz), null);

    // Si se presionó el botón reiniciar, redirige para limpiar POST y evitar reenvío
    if (isset($_POST['reset'])) {
        header('Location: areacognitiva.php'); // Redirige a esta misma página
        exit();
    }
}

// Procesamiento de respuestas y navegación del test
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guarda la respuesta seleccionada para la pregunta actual
    if (isset($_POST['answer'])) {
        // Convierte el valor recibido a entero y lo guarda en la posición correspondiente
        $_SESSION['answers'][$_SESSION['current']] = intval($_POST['answer']);
    }

    // Si el usuario presionó el botón "Siguiente"
    if (isset($_POST['next'])) {
        // Si no está en la última pregunta, avanza a la siguiente
        if ($_SESSION['current'] < count($_SESSION['quiz']) - 1) {
            $_SESSION['current']++;
        } else {
            // Si ya respondió la última pregunta, redirige a la página de resultados
            header('Location: resultados.php');
            exit();
        }
    }

    // Si el usuario presionó el botón "Atrás" y no está en la primera pregunta
    if (isset($_POST['prev']) && $_SESSION['current'] > 0) {
        $_SESSION['current']--;
    }
}

// Obtener la pregunta actual para mostrar
$current = $_SESSION['current'] ?? 0;

// Verificar que haya preguntas en el cuestionario y que la actual exista
if (isset($_SESSION['quiz']) && isset($_SESSION['quiz'][$current])) {
    $preguntaActual = $_SESSION['quiz'][$current];
    // Verifica si la clave 'preguntas' existe en el arreglo
    $question = isset($preguntaActual['preguntas']) ? $preguntaActual['preguntas'] : '';
    // Verifica si la clave 'opciones' existe y es un arreglo
    $options = isset($preguntaActual['opciones']) && is_array($preguntaActual['opciones']) ? $preguntaActual['opciones'] : [];
    // Obtiene la respuesta seleccionada (si ya se había guardado)
    $selected = $_SESSION['answers'][$current] ?? null;
} else {
    echo "<p>No hay preguntas disponibles. Por favor, <a href='areacognitiva.php?reset=1'>reinicia el test</a>.</p>";
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
        <link rel="stylesheet" href="css/estilo2.css">
        <link rel="stylesheet" href="css/estiloareas.css?v=1">
        <title>Habilidades cognitivas</title>
    </head>
    <body>
        <!-- Contenedor principal con fondo y diseño -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Título del área -->
                <h1 class="tituloarea">Habilidades cognitivas</h1>
                <!-- Descripción u objetivo del área -->
                <p class="paarea">Objetivo: Evaluar tus capacidades cognitivas para el aprendizaje y el desempeño académico, tales como atención, organización y manejo eficiente del tiempo.</p>
                <!-- Contenedor del cuestionario -->
                <div class="contenido-cuestionario" id="cuestionario">
                    <form method="post" id="quizForm">
                        <!-- Mostrar la pregunta actual -->
                        <?php if (empty($options) && $current === 6): ?>
                            <!-- Pantalla intermedia con imagen -->
                            <div class="pregunta">
                                <p style="font-size: 1.3rem; font-weight: bold; color: #333;">
                                    Observa la imagen con atención. Luego se te hará una pregunta.
                                </p>
                            </div>
                            <div class="imagen-pregunta">
                                <img src="img/imgP7Cogni.png" alt="Imagen para prueba de memoria">
                            </div>
                        <?php else: ?>
                            <!-- Mostrar la pregunta -->
                            <div class="pregunta"><?= htmlspecialchars($question) ?></div>
                            <!-- Mostrar las opciones para responder -->
                            <div class="opciones">
                                <?php foreach ($options as $index => $option): ?>
                                    <label>
                                        <!-- Radio button para que el usuario seleccione solo una opción -->
                                        <input type="radio" name="answer" value="<?= $index ?>" <?= ($selected === $index) ? 'checked' : '' ?> required>
                                        <?= htmlspecialchars($option['text']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Botones para navegar en el test -->
                        <div class="navegacion">
                            <!-- Botón para ir a la pregunta anterior, desactivado si es la primera pregunta -->
                            <button type="submit" name="prev" class="botone" <?= $current === 0 ? 'disabled' : '' ?>>
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <!-- Botón para reiniciar el test -->
                            <button type="submit" name="reset" class="botone">
                                <i class="fas fa-rotate-left"></i>
                            </button>
                            <!-- Botón para avanzar a la siguiente pregunta o finalizar (icono cambia si es la última pregunta) -->
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
<!-- Incluye el pie de página común -->
<?php include("footer.php"); ?>