<!--
    Decide U
    Perfil
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
// Iniciar sesión para mantener las variables entre páginas
session_start();

// Incluir cabecera común con estilos y conexión a la base de datos
include("header.php");
include("bd.php");

// Inicializar variables
$msg = ""; // Mensaje para mostrar resultados (foto subida, errores, etc.)
$num_control = $_SESSION['num_control'] ?? null; // Obtener número de control del usuario
$foto_perfil = 'https://via.placeholder.com/150'; // Imagen por defecto
$nombre_usuario = 'Usuario'; // Nombre por defecto

// Si el usuario ha iniciado sesión, obtener su nombre y foto desde la base de datos
if ($num_control) {
    $stmt = $conn->prepare("SELECT nombre, foto_perfil FROM usuario WHERE num_control = ?");
    $stmt->bind_param("s", $num_control);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $nombre_usuario = htmlspecialchars($row['nombre']); // Sanitiza para evitar XSS
        if (!empty($row['foto_perfil']) && file_exists($row['foto_perfil'])) {
            $foto_perfil = $row['foto_perfil']; // Usar imagen personalizada si existe
        }
    }
    $stmt->close();
}

// Procesar el formulario de subida de imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $file = $_FILES['foto'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)); // Obtener extensión
        $allowed = ['jpg', 'jpeg', 'png', 'gif']; // Extensiones permitidas
        if (in_array($ext, $allowed)) {
            $uploadDir = 'uploads/perfiles/'; // Carpeta destino
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true); // Crear si no existe
            $newName = uniqid('perfil_', true) . '.' . $ext; // Nombre único
            $uploadFile = $uploadDir . $newName;
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Guardar ruta en base de datos
                $stmt = $conn->prepare("UPDATE usuario SET foto_perfil = ? WHERE num_control = ?");
                $stmt->bind_param("ss", $uploadFile, $num_control);
                if ($stmt->execute()) {
                    $msg = "Foto subida correctamente.";
                    $foto_perfil = $uploadFile; // Actualizar variable para mostrar nueva imagen
                } else {
                    $msg = "Error al guardar la ruta en la base de datos.";
                }
                $stmt->close();
            } else {
                $msg = "Error al mover el archivo.";
            }
        } else {
            $msg = "Formato no permitido (jpg, jpeg, png, gif).";
        }
    } else {
        $msg = "Error al subir el archivo.";
    }
}

// Obtener resultados de los tests desde la base de datos
$resultados_test = [];
if ($num_control) {
    $sql = "SELECT ac.nombre_area, r.calificacion 
            FROM resultados r
            JOIN area_conoc ac ON r.id_areaconoc = ac.id_areaconoc
            WHERE r.num_control = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $num_control);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $resultados_test[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Perfil de Usuario - DecideU</title>
        <!-- Estilos generales y personalizados -->
        <link rel="stylesheet" href="css/foto.css?v=2.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    </head>
    <body>
        <div class="fondoperfil">
            <div class="enfrente">
                <div class="perfil-contenido">
                    <!-- Sección izquierda: foto y nombre del usuario -->
                    <div class="profile-top">
                        <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Foto de perfil" class="profile-photo" />
                        <div class="profile-name"><?= htmlspecialchars($nombre_usuario) ?></div>
                        <!-- Mostrar mensaje de subida -->
                        <?php if (!empty($msg)): ?>
                            <p><?= htmlspecialchars($msg) ?></p>
                        <?php endif; ?>
                        <!-- Formulario para subir nueva imagen -->
                        <form action="" method="post" enctype="multipart/form-data" class="form-foto">
                            <div class="custom-file-upload" id="customUpload">
                                <i class="fa fa-image"></i> Seleccionar imagen
                            </div>
                            <input type="file" name="foto" accept="image/*" required id="fileInput" />
                            <button type="submit" class="upload-button">
                                <i class="fa fa-upload"></i> Subir nueva foto
                            </button>
                        </form>
                        <!-- Botón para editar perfil -->
                        <a href="editar_perfil.php" class="edit-button">
                            <i class="fa fa-user-edit"></i> Editar perfil
                        </a>
                        <!-- Script para activar input al hacer clic en el botón personalizado -->
                        <script>
                            document.getElementById('customUpload').addEventListener('click', function () {
                                document.getElementById('fileInput').click();
                            });
                        </script>
                    </div>
                    <!-- Sección derecha: tabla de resultados -->
                    <div class="profile-results">
                        <div class="sectionres">
                            <h2>Resultados de los test</h2>
                            <?php if (!empty($resultados_test)): ?>
                                <table>
                                    <thead>
                                        <tr><th>Área</th><th>Calificación</th></tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultados_test as $r): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($r['nombre_area']) ?></td>
                                                <td><?= htmlspecialchars($r['calificacion']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No hay resultados de test.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Cerrar sesión (dentro del mismo contenedor) -->
                    <div class="logout-wrapper">
                        <form action="cerrar_sesion.php" method="post">
                            <button type="submit" class="logout-button">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- Incluye footer -->
<?php include("footer.php"); ?>