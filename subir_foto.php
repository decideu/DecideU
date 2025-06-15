<!--
    Decide U
    Subir_foto
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 10/06/2025
-->
<?php
// Iniciar sesión para acceder a variables de sesión y mantener estado
session_start();
include("bd.php"); // o tu conexión a base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $file = $_FILES['foto'];
    // Validar errores de subida
    if ($file['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            // Carpeta donde guardamos las fotos
            $uploadDir = 'uploads/perfiles/'; 
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            // Nombre único para evitar colisiones
            $newName = uniqid('perfil_', true) . '.' . $ext;
            $uploadFile = $uploadDir . $newName;
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Aquí puedes guardar la ruta en base de datos o sesión
                // Ejemplo guardando en sesión
                $_SESSION['usuario_foto'] = $uploadFile;
                $id_usuario = $_SESSION['usuario_id'];
                $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $uploadFile, $id_usuario);
                $stmt->execute();
                header("Location: perfil.php"); // rediriges para mostrar la nueva foto
                exit;
            } else {
                echo "Error al mover el archivo subido.";
            }
        } else {
            echo "Formato no permitido. Usa JPG, PNG o GIF.";
        }
    } else {
        echo "Error en la subida del archivo.";
    }
} else {
    echo "No se recibió archivo.";
}
?>