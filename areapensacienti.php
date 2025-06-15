<!--
    Decide U
    Area Pensamiento Cientifico
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php 
// Inicia sesión para almacenar progreso
session_start();
// Incluye encabezado común del sitio
include("header.php"); 
// Cuestionario Ciencias (corregido el nombre para que coincida con el test)
$quiz_ciencias = [
    //Cada elemento representa una pregunta con sus opciones y puntajes
    [
        'preguntas' => '1. ¿Qué enunciado describe las características correspondientes al modelo atómico de Bohr?',
        'opciones' => [
            ['text' => 'A) Los electrones giran alrededor del núcleo en órbitas y, además, no emiten ni absorben energía sino que se presentan en un estado estacionario.', 'score' => 1],
            ['text' => 'B) La materia está formada por átomos que son indivisibles, no se pueden destruir, y los átomos de un mismo elemento tienen propiedades iguales.', 'score' => 0],
            ['text' => 'C) Se considera que el átomo tiene carga positiva con electrones repartidos como pequeños gránulos distribuidos en su interior.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '2. ¿Cuál es la implicación ecológica que conlleva la eliminación de manglares para la construcción de complejos hoteleros en México?',
        'opciones' => [
            ['text' => 'A) La destrucción de las cadenas alimentarias tanto del manglar como las que dependen del mar.', 'score' => 1],
            ['text' => 'B) La destrucción de los manglares atenta contra el patrimonio natural de la región.', 'score' => 0],
            ['text' => 'C) La tala de manglares reduce la pesca, lo cual afecta la economía de una región.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '3. Definición de cariotipo.',
        'opciones' => [
            ['text' => 'A) Ordenamiento de los cromosomas de un individuo.', 'score' => 1],
            ['text' => 'B) Conjunto de características observables de un individuo.', 'score' => 0],
            ['text' => 'C) Colección de genes de un individuo.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '4. ¿Qué método permite separar el aceite que contamina un cuerpo de agua?',
        'opciones' => [
            ['text' => 'A) Destilación.', 'score' => 0],
            ['text' => 'B) Evaporación.', 'score' => 0],
            ['text' => 'C) Decantación.', 'score' => 1]
        ]
    ],
    [
        'preguntas' => '5. Un señor quiere atravesar un pueblo, de oeste a este, a 8 km/h, lo que le tomaría 20 minutos; sin embargo, manteniendo la misma dirección, disminuye su __________ a 5 km/h y tarda 30 minutos, por lo que al final su __________ es de -0.830 m/s2.',
        'opciones' => [
            ['text' => 'A) velocidad - aceleración', 'score' => 0],
            ['text' => 'B) aceleración - rapidez', 'score' => 0],
            ['text' => 'C) rapidez - velocidad', 'score' => 1]
        ]
    ],
    [
        'preguntas' => '6. ¿Cómo la aplicación de la máquina de vapor en medios de transporte transformó a la sociedad?',
        'opciones' => [
            ['text' => 'A) Los gremios artesanales desaparecieron porque pudieron migrar a las ciudades.', 'score' => 0],
            ['text' => 'B) El tiempo de movilidad entre distancias largas disminuyó considerablemente.', 'score' => 1],
            ['text' => 'C) El desplazamiento de las personas encareció, por lo que redujeron sus desplazamientos.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '7. ¿Cuál es el efecto de la gravedad en el vagón que se desplaza a través de una montaña rusa?',
        'opciones' => [
            ['text' => 'A) Permanece constante la velocidad tanto al subir como al bajar.', 'score' => 0],
            ['text' => 'B) Disminuye la velocidad del vagón al subir y aumenta al bajar.', 'score' => 1],
            ['text' => 'C) Aumenta la velocidad al subir y disminuye al bajar.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '8. El aporte calórico necesario para el desayuno de un adolescente de 15 años es de 492 kcal. ¿Qué combinación de alimentos puede cumplir con el requerimiento calórico recomendado?',
        'image' => 'img/cienciasp8.png',
        'opciones' => [
            ['text' => 'A) 100 g de cereal con chocolate, 1 pieza de plátano y 250 mL de leche.', 'score' => 0],
            ['text' => 'B) 100 g de huevo con frijoles, 2 tortillas y 250 mL de jugo de naranja.', 'score' => 1],
            ['text' => 'C) 1 pieza de plátano, un paquete de galletas de 83 g y 250 mL de agua purificada.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '9. Relaciona el estado de agregación con el esquema que lo representa.',
        'image' => 'img/cienciasp9.png',
        'opciones' => [
            ['text' => 'A) 1a, 2c, 3b, 4d', 'score' => 0],
            ['text' => 'B) 1b, 2c, 3c, 4a', 'score' => 1],
            ['text' => 'C) 1a, 2b, 3a, 4c', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '10. Relaciona el estado de agregación con el esquema que lo representa.',
        'image' => 'img/cienciasp10.png',
        'opciones' => [
            ['text' => 'A) 1ad, 2bc', 'score' => 1],
            ['text' => 'B) 1ab, 2cd', 'score' => 0],
            ['text' => 'C) 1bc, 2ad', 'score' => 0],
            ['text' => 'D) 1bd, 2ac', 'score' => 0]
        ]
    ],
];
// Si es la primera vez que entra o se reinicia el test, inicializa las variables de sesión
if (!isset($_SESSION['test_name']) || $_SESSION['test_name'] !== 'Pensamiento cientìfico' || isset($_POST['reset'])) {
    // Guarda el cuestionario en la sesión para mantenerlo
    $_SESSION['quiz_ciencias'] = $quiz_ciencias;

    // Guarda el nombre del test para evitar mezclar otros tests
    $_SESSION['test_name'] = 'Pensamiento cientìfico';

    // Guarda el id del área para referencia (base de datos, etc.)
    $_SESSION['id_areaconoc'] = 4;

    // La pregunta actual empieza en 0
    $_SESSION['current'] = 0;

    // Inicializa el arreglo de respuestas con null (sin responder)
    $_SESSION['answers'] = array_fill(0, count($quiz_ciencias), null);

    // Si se presionó reiniciar, recarga la página para evitar reenvío de formulario
    if (isset($_POST['reset'])) {
        header('Location: areaciencias.php');  // Cambia el nombre si tu archivo tiene otro nombre
        exit();
    }
}

// Procesa el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guarda la respuesta seleccionada para la pregunta actual
    if (isset($_POST['answer'])) {
        $_SESSION['answers'][$_SESSION['current']] = intval($_POST['answer']);
    }

    // Si se presionó siguiente
    if (isset($_POST['next'])) {
        // Si no es la última pregunta, avanza
        if ($_SESSION['current'] < count($_SESSION['quiz_ciencias']) - 1) {
            $_SESSION['current']++;
        } else {
            // Si es la última, redirige a resultados
            header('Location: resultados.php');
            exit();
        }
    }

    // Si se presionó anterior y no está en la primera pregunta
    if (isset($_POST['prev']) && $_SESSION['current'] > 0) {
        $_SESSION['current']--;
    }
}

// Obtiene el índice de la pregunta actual
$current = $_SESSION['current'] ?? 0;

// Verifica que exista la pregunta para evitar errores
if (isset($_SESSION['quiz_ciencias'][$current])) {
    // Obtiene el texto de la pregunta actual
    $question = $_SESSION['quiz_ciencias'][$current]['preguntas'];

    // Obtiene las opciones para responder
    $options = $_SESSION['quiz_ciencias'][$current]['opciones'];

    // Obtiene la respuesta seleccionada previamente, si hay alguna
    $selected = $_SESSION['answers'][$current] ?? null;
} else {
    // Mensaje si algo falla o no hay preguntas disponibles
    echo "<p>No hay preguntas disponibles. Por favor, <a href='areaciencias.php?reset=1'>reinicia el test</a>.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Estilos y fuente de iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link rel="stylesheet" href="css/estilo2.css" />
        <link rel="stylesheet" href="css/estiloareas.css" />
        <title>Pensamiento científico</title>
    </head>
    <body>
        <!-- Contenedor con fondo para el formulario -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Título y descripción del área -->
                <h1 class="tituloarea">Pensamiento científico</h1>
                <p class="paarea">Objetivo: Evaluar tus conocimientos sobre fenómenos naturales, conceptos de biología, física y química, y su impacto en el entorno.</p>

                <!-- Contenedor principal del test -->
                <div class="contenido-cuestionario" id="cuestionario">
                    <form method="post" id="quizForm">
                        <!-- Pregunta actual -->
                        <div class="pregunta"><?= htmlspecialchars($question) ?></div>
                        <!-- Si la pregunta tiene una imagen, mostrarla -->
                        <?php if (isset($_SESSION['quiz_ciencias'][$current]['image'])): ?>
                            <div class="imagen-pregunta">
                                <img src="<?= $_SESSION['quiz_ciencias'][$current]['image'] ?>" alt="Imagen de la pregunta" />
                            </div> 
                        <?php endif; ?>
                        <!-- Opciones para responder -->
                        <div class="opciones">
                            <?php foreach ($options as $index => $option): ?>
                                <label>
                                    <!-- Radio button para la opción -->
                                    <input type="radio" name="answer" value="<?= $index ?>" <?= ($selected === $index) ? 'checked' : '' ?> required>
                                    <?= htmlspecialchars($option['text']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <!-- Botones de navegación: anterior, reiniciar, siguiente -->
                        <div class="navegacion">
                            <button type="submit" name="prev" class="botone" <?= $current === 0 ? 'disabled' : '' ?>>
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <button type="submit" name="reset" class="botone">
                                <i class="fas fa-rotate-left"></i>
                            </button>
                            <button type="submit" name="next" class="botone">
                                <i class="fas <?= $current === count($_SESSION['quiz_ciencias']) - 1 ? 'fa-check' : 'fa-arrow-right' ?>"></i>
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
<?php 
// Incluye el pie de página común
include("footer.php"); 
?>