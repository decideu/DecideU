<!--
    Decide U
    Area Social
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php 
// Iniciar sesión para mantener el estado del test y guardar respuestas
session_start();
// Incluir encabezado común del sitio (menú, cabecera, etc)
include("header.php"); 
// Cuestionatio
$quiz_social = [
    //Cada elemento representa una pregunta con sus opciones y puntajes
    [
        'pregunta' => '1. Si alguien de tu equipo no entiende su tarea, ¿qué haces?',
        'opciones' => [
            ['text' => 'A) Te molestas por retrasos.', 'score' => 0],
            ['text' => 'B) Le explicas con calma.', 'score' => 1],
            ['text' => 'C) Ignoras el problema.', 'score' => 0],
            ['text' => 'D) Pides que lo cambien de equipo.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '2. ¿Qué es lo más importante para que un equipo funcione bien?',
        'opciones' => [
            ['text' => 'A) Que todos trabajen igual.', 'score' => 0.7],
            ['text' => 'B) Que se lleven bien.', 'score' => 0.5],
            ['text' => 'C) Que se escuche a todos.', 'score' => 1],
            ['text' => 'D) Que haya un líder estricto.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '3. Cuando alguien expresa una emoción fuerte, tú...',
        'opciones' => [
            ['text' => 'A) No sabes cómo reaccionar.', 'score' => 0],
            ['text' => 'B) Le escuchas y das apoyo.', 'score' => 1],
            ['text' => 'C) Cambias de tema.', 'score' => 0.5],
            ['text' => 'D) Te alejas.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '4. ¿Cuál de las siguientes frases es más útil para resolver un malentendido?',
        'opciones' => [
            ['text' => 'A) "No es mi culpa"', 'score' => 0],
            ['text' => 'B) "Olvídalo"', 'score' => 0.5],
            ['text' => 'C) "¿Podemos hablarlo?"', 'score' => 1],
            ['text' => 'D) "Siempre haces lo mismo"', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '5. En una discusión de grupo, ¿qué haces?',
        'opciones' => [
            ['text' => 'A) Tomas el control sin preguntar.', 'score' => 0],
            ['text' => 'B) Escuchas antes de opinar.', 'score' => 1],
            ['text' => 'C) Evitas hablar.', 'score' => 0.2],
            ['text' => 'D) Apoyas solo a tus amistades.', 'score' => 0.5]
        ]
    ],
    [
        'pregunta' => '6. ¿Qué haces si un compañero está triste o molesto?',
        'opciones' => [
            ['text' => 'A) Le dejas solo.', 'score' => 0.5],
            ['text' => 'B) Le preguntas si quiere hablar.', 'score' => 1],
            ['text' => 'C) Lo ignoras.', 'score' => 0.5],
            ['text' => 'D) Te enojas por su actitud.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '7. En un trabajo en equipo, si hay un problema o desacuerdo entre compañeros, ¿qué harías?',
        'opciones' => [
            ['text' => 'A) Trataría de escuchar a todos y buscar un acuerdo que funcione para todos.', 'score' => 1],
            ['text' => 'B) Preferiría evitar discutir y enfocarme en hacer bien mi parte.', 'score' => 0.5],
            ['text' => 'C) Defendería mi opinión aunque haya conflicto.', 'score' => 0.6],
            ['text' => 'D) Pediría al profesor que intervenga.', 'score' => 0.3]
        ]
    ],
    [
        'pregunta' => '8. ¿Cuál de estas situaciones refleja mejor el trabajo en equipo?',
        'opciones' => [
            ['text' => 'A) Hacer todo tú solo.', 'score' => 0],
            ['text' => 'B) Repartir tareas y comunicarse.', 'score' => 1],
            ['text' => 'C) Seguir órdenes sin opinar.', 'score' => 0.2],
            ['text' => 'D) Dejar que otros hagan más.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '9. ¿Te gusta participar en actividades donde haya interacción con otras personas?',
        'opciones' => [
            ['text' => 'A) Sí, mucho.', 'score' => 1],
            ['text' => 'B) A veces.', 'score' => 0.5],
            ['text' => 'C) Prefiero trabajar solo.', 'score' => 0],
            ['text' => 'D) No me gusta trabajar en grupo.', 'score' => 0]
        ]
    ],
    [
        'pregunta' => '10. ¿Qué tipo de situaciones disfrutas más?',
        'opciones' => [
            ['text' => 'A) Resolver problemas con otros.', 'score' => 1],
            ['text' => 'B) Reflexionar en silencio.', 'score' => 0.5],
            ['text' => 'C) Crear cosas visuales o musicales.', 'score' => 0],
            ['text' => 'D) Analizar datos.', 'score' => 0]
        ]
    ],
];
// INICIALIZAR EL TEST
// Si es la primera vez que entra o se reinicia el test
if (
    !isset($_SESSION['test_name']) || 
    $_SESSION['test_name'] !== 'Habilidades sociales e interpersonales' || 
    isset($_POST['reset'])
) {
    // Guardar el cuestionario en la sesión para mantenerlo mientras el usuario responde
    $_SESSION['quiz'] = $quiz_social;
    // Definir nombre del test
    $_SESSION['test_name'] = 'Habilidades sociales e interpersonales';
    // Guardar id del área de conocimiento
    $_SESSION['id_areaconoc'] = 5;
    // Pregunta actual (índice)
    $_SESSION['current'] = 0;
    // Inicializar array de respuestas con valores nulos
    $_SESSION['answers'] = array_fill(0, count($quiz_social), null);
    // Si se presionó reiniciar, redirigir para evitar reenvío del formulario
    if (isset($_POST['reset'])) {
        header('Location: areasocial.php');
        exit();
    }
}
// PROCESAR RESPUESTAS Y NAVEGACIÓN DEL TEST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar respuesta seleccionada en la sesión, si existe
    if (isset($_POST['answer'])) {
        $_SESSION['answers'][$_SESSION['current']] = intval($_POST['answer']);
    }
    // Si se presiona "Siguiente"
    if (isset($_POST['next'])) {
        // Si no es la última pregunta, avanzar
        if ($_SESSION['current'] < count($_SESSION['quiz']) - 1) {
            $_SESSION['current']++;
        } else {
            // Última pregunta: redirigir a resultados
            header('Location: resultados.php');
            exit();
        }
    }
    // Si se presiona "Atrás"
    if (isset($_POST['prev']) && $_SESSION['current'] > 0) {
        $_SESSION['current']--;
    }
}
// OBTENER PREGUNTA ACTUAL Y OPCIONES
$current = $_SESSION['current'] ?? 0;
if (isset($_SESSION['quiz'][$current])) {
    // Extraer texto de la pregunta actual
    $question = $_SESSION['quiz'][$current]['pregunta'];
    // Extraer opciones de la pregunta actual
    $options = $_SESSION['quiz'][$current]['opciones'];
    // Respuesta seleccionada previamente, si existe
    $selected = $_SESSION['answers'][$current] ?? null;
} 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Font Awesome para iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <!-- Hojas de estilo personalizadas -->
        <link rel="stylesheet" href="css/estilo2.css?v=5" />
        <link rel="stylesheet" href="css/estiloareas.css?v=1" />
        <title>Habilidades sociales e interpersonales</title>
    </head>
    <body>
        <!-- Fondo y contenedor principal del formulario -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Título del área -->
                <h1 class="tituloarea">Habilidades sociales e interpersonales</h1>
                <!-- Objetivo del área -->
                <p class="paarea">
                    Objetivo: Identificar qué tan desarrolladas están tus habilidades sociales, emocionales y de trabajo colaborativo.
                </p>
                <!-- Formulario del cuestionario -->
                <div class="contenido-cuestionario" id="cuestionario">
                    <form method="post" id="quizForm">
                        <!--Mostrar pregunta actual-->
                        <div class="pregunta"><?= htmlspecialchars($question) ?></div>
                        <!-- Si la pregunta tiene una imagen, mostrarla -->
                        <?php if (isset($_SESSION['quiz'][$current]['image'])): ?>
                            <div class="imagen-pregunta">
                                <img src="<?= $_SESSION['quiz'][$current]['image'] ?>" alt="Imagen de la pregunta" />
                            </div>
                        <?php endif; ?>
                        <!--Mostar las opciones a seleccionar-->
                        <div class="opciones">
                            <?php foreach ($options as $index => $option): ?>
                                <label>
                                    <input type="radio" name="answer" value="<?= $index ?>" <?= ($selected === $index) ? 'checked' : '' ?> required>
                                    <?= htmlspecialchars($option['text']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <!-- Botones de navegación -->
                        <div class="navegacion">
                            <!-- Botón Atrás (deshabilitado en la primera pregunta) -->
                            <button type="submit" name="prev" class="botone" <?= $current === 0 ? 'disabled' : '' ?>>
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <!-- Botón Reiniciar -->
                            <button type="submit" name="reset" class="botone">
                                <i class="fas fa-rotate-left"></i>
                            </button>
                            <!-- Botón Siguiente o Finalizar (según última pregunta) -->
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
<!-- Incluir footer común -->
<?php include("footer.php"); ?>
