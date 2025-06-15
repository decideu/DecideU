<!--
    Decide U
    Area Razonamiento logico y matematico
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php 
// Iniciar la sesión para guardar y mantener datos entre páginas (estado del test, respuestas, etc.)
session_start();
// Incluir encabezado común que contiene menú, estilos globales, scripts, etc.
include("header.php"); 
// Definir el cuestionario con preguntas, opciones y puntajes asociados
$quiz = [
    //Cada elemento representa una pregunta con sus opciones y puntajes
    [
        'preguntas' => '1. Se organiza una rifa en la cual se ofrecen 20 números. Determina el espacio muestral que se tiene.',
        'opciones' => [
            ['text' => 'A) {0,1,2,…,19}', 'score' => 0],
            ['text' => 'B) {1,2,3,…,20}', 'score' => 1],
            ['text' => 'C) {1,2,3,…,21}', 'score' => 0],
            ['text' => 'D) {0,1,2,…,20}', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '2. Calcula el valor de límite de la siguiente función:',
        'image' => 'img/matep2.png',
        'opciones' => [
            ['text' => 'A) 2', 'score' => 1],
            ['text' => 'B) 4', 'score' => 0],
            ['text' => 'C) 1/2', 'score' => 0],
            ['text' => 'D) 0', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '3. Selecciona el resultado de la multiplicación: 3x (x+4)',
        'opciones' => [
            ['text' => 'A) 7x + 12', 'score' => 0],
            ['text' => 'B) 3x<sup>2</sup> + 4', 'score' => 0],
            ['text' => 'C) 3x<sup>2</sup> + 12x', 'score' => 1],
            ['text' => 'D) 12x<sup>2</sup> + 3', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '4. En una caja hay 4 bolas rojas, 3 verdes y 6 azules. Si se sacan dos bolas consecutivas sin reemplazo, ¿cuál es la probabilidad de que la primera sea roja y la segunda azul?',
        'opciones' => [
            ['text' => 'A) <sup>24</sup>&frasl;<sub>153</sub>', 'score' => 1],
            ['text' => 'B) <sup>18</sup>&frasl;<sub>153</sub>', 'score' => 0],
            ['text' => 'C) <sup>20</sup>&frasl;<sub>153</sub>', 'score' => 0],
            ['text' => 'D) <sup>22</sup>&frasl;<sub>153</sub>', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '5. ¿Cuál es la figura que completa la serie?',
        'image' => 'img/matep5.png',
        'opciones' => [
            ['text' => 'A) Figura 1', 'score' => 0],
            ['text' => 'B) Figura 2', 'score' => 0],
            ['text' => 'C) Figura 3', 'score' => 0],
            ['text' => 'D) Figura 4', 'score' => 0],
            ['text' => 'E) Figura 5', 'score' => 1],
            ['text' => 'F) Figura 6', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '6. Identifique la expresión matemática que utilice correctamente los símbolos de agrupación.',
        'opciones' => [
            ['text' => 'A) 8 + [3 × (4 − 2)] − {6 ÷ 3}', 'score' => 0],
            ['text' => 'B) 8 + [3 × (4 − 2) − {6 ÷ 3}]', 'score' => 1],
            ['text' => 'C) 8 + 3 × (4 − 2 − [6 ÷ 3})', 'score' => 0],
            ['text' => 'D) 8 + [3 × (4 − 2)] − {6 ÷ 3}', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '7. Identifica la solución de la siguiente expresión.',
        'image' => 'img/matep7.png',
        'opciones' => [
            ['text' => 'A) -60', 'score' => 0],
            ['text' => 'B) -150', 'score' => 0],
            ['text' => 'C) -90', 'score' => 0],
            ['text' => 'D) -180', 'score' => 1]
        ]
    ],
    [
        'preguntas' => '8. ¿Con cuántas jeringas de 120 mL se extrae, aproximadamente, el contenido de líquido de una botella de 3.6 L?',
        'opciones' => [
            ['text' => 'A) 20', 'score' => 0],
            ['text' => 'B) 25', 'score' => 0],
            ['text' => 'C) 30', 'score' => 1],
            ['text' => 'D) 35', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '9. Resuelve la operación: (5 × 3) + (12 ÷ 4) = ?',
        'opciones' => [
            ['text' => 'A) 15', 'score' => 0],
            ['text' => 'B) 18', 'score' => 1],
            ['text' => 'C) 20', 'score' => 0],
            ['text' => 'D) 21', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '10. Identifica la representación en lenguaje común correspondiente a la siguiente expresión matemática',
        'image' => 'img/matep10.png',
        'opciones' => [
            ['text' => 'A) El cuadrado del resultado de dividir el producto de dos elevado a la quinta potencia por tres elevado a la tercera potencia entre seis elevado a la segunda potencia.', 'score' => 1],
            ['text' => 'B) El cuadrado del producto de dos elevado a la quinta potencia, tres elevado a la tercera potencia y seis elevado a la segunda potencia.', 'score' => 0],
            ['text' => 'C) El cuadrado del resultado de dividir la suma de dos elevado a la quinta potencia y tres elevado a la tercera potencia entre seis elevado a la segunda potencia.', 'score' => 0],
            ['text' => 'D) El cuadrado del resultado de dividir dos elevado a la quinta potencia entre el producto de tres elevado a la tercera potencia por seis elevado a la segunda potencia.', 'score' => 0]
        ]
    ],
    [
        'preguntas' => '11. ¿Prefieres resolver problemas prácticos con números o analizar conceptos abstractos?',
        'opciones' => [
            ['text' => 'A) Prefiero números', 'score' => 0.5],
            ['text' => 'B) Prefiero conceptos abstractos', 'score' => 0.5],
            ['text' => 'C) Me gustan ambos', 'score' => 0.25],
            ['text' => 'D) No me gustan los problemas', 'score' => 1]
        ]
    ],
    [
        'preguntas' => '12. ¿Cómo te sientes al enfrentarte a un reto matemático que requiere pensar con lógica y paciencia?',
        'opciones' => [
            ['text' => 'A) Me emociona, me gusta resolver ese tipo de problemas', 'score' => 0.5],
            ['text' => 'B) Me interesa, aunque a veces me frustro', 'score' => 0.3],
            ['text' => 'C) No me gusta mucho, pero lo intento', 'score' => 0.2],
            ['text' => 'D) Prefiero evitarlos siempre que puedo', 'score' => 0]
        ]
    ],
];
// INICIALIZAR EL TEST
// Si es la primera vez que entra o se reinicia el test
if (
    !isset($_SESSION['test_name']) || 
    $_SESSION['test_name'] !== 'Razonamiento lógico y matemático' || 
    isset($_POST['reset'])
) {
    // Guardar el cuestionario en la sesión para mantenerlo mientras el usuario responde
    $_SESSION['quiz'] = $quiz;
    // Definir nombre del test
    $_SESSION['test_name'] = 'Razonamiento lógico y matemático';
    // Guardar id del área de conocimiento
    $_SESSION['id_areaconoc'] = 1;
    // Pregunta actual (índice)
    $_SESSION['current'] = 0;
    // Inicializar array de respuestas con valores nulos
    $_SESSION['answers'] = array_fill(0, count($quiz), null);
    // Si se presionó reiniciar, redirigir para evitar reenvío del formulario
    if (isset($_POST['reset'])) {
        header('Location: arearazonami.php');
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
    $question = $_SESSION['quiz'][$current]['preguntas'];
    // Extraer opciones de la pregunta actual
    $options = $_SESSION['quiz'][$current]['opciones'];
    // Respuesta seleccionada previamente, si existe
    $selected = $_SESSION['answers'][$current] ?? null;
} else {
    // Si no hay preguntas disponibles, mostrar mensaje y enlace para reiniciar test
    echo "<p>No hay preguntas disponibles. Por favor, <a href='areasocial.php'>reinicia el test</a>.</p>";
    exit();
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
        <link rel="stylesheet" href="css/estilo2.css" />
        <link rel="stylesheet" href="css/estiloareas.css" />
        <title>Razonamiento lógico y matemático</title>
    </head>
    <body>
        <!-- Fondo y contenedor principal del formulario -->
        <div class="fondoformu">
            <div class="enfrente">
                <!-- Título del área -->
                <h1 class="tituloarea">Razonamiento lógico y matemático</h1>
                <!-- Objetivo del área -->
                <p class="paarea">
                    Objetivo: Evaluar tu capacidad para resolver problemas, razonar con lógica y analizar conceptos relacionados con matemáticas y pensamiento estructurado.
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
                                    <?= $option['text'] ?>
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