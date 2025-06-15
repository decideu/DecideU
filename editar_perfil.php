<!--
    Decide U
    Editar perfil
    Guerrero Castro Blanca Teresita
    Cibrian Castro Ana Cristina
    Vega Escalante Romina
    Última actualización: 14/06/2025
-->
<?php
// editar_perfil.php
session_start();
include("header.php");
include("bd.php");

$num_control = $_SESSION['num_control'] ?? null;

if (!$num_control) {
    header("Location: perfil.php");
    exit();
}

$msg = "";

// Obtener datos actuales
$stmt = $conn->prepare("SELECT nombre, apellido_pat, apellido_mat, curp FROM usuario WHERE num_control = ?");
$stmt->bind_param("s", $num_control);
$stmt->execute();
$res = $stmt->get_result();
$usuario = $res->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $ap = trim($_POST['apellido_pat']);
    $am = trim($_POST['apellido_mat']);
    $curp = strtoupper(trim($_POST['curp']));
    $contra = $_POST['contraseña'];

    if (empty($nombre) || empty($ap) || empty($am) || empty($curp)) {
        $msg = "Todos los campos son obligatorios.";
    } else {
        // Actualizar datos
        if (!empty($contra)) {
            $stmt = $conn->prepare("UPDATE usuario SET nombre=?, apellido_pat=?, apellido_mat=?, curp=?, contraseña=? WHERE num_control=?");
            $stmt->bind_param("ssssss", $nombre, $ap, $am, $curp, $contra, $num_control);
        } else {
            $stmt = $conn->prepare("UPDATE usuario SET nombre=?, apellido_pat=?, apellido_mat=?, curp=? WHERE num_control=?");
            $stmt->bind_param("sssss", $nombre, $ap, $am, $curp, $num_control);
        }

        if ($stmt->execute()) {
            $msg = "Datos actualizados correctamente.";
            $_SESSION['nombre'] = $nombre;
        } else {
            $msg = "Error al actualizar.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Editar Perfil</title>
        <link rel="stylesheet" href="css/foto.css?v=2.1">
    </head>
    <body>
        <div class="fondoperfil">
            <div class="enfrente">
                <div class="perfil-contenido">
                    <div class="profile-top">
                        <!-- Titulo -->
                        <h2>Editar Perfil</h2>
                        <!-- Muestra mensaje de éxito o error -->
                        <?php if (!empty($msg)): ?>
                            <p class="mensaje-perfil"><?= htmlspecialchars($msg) ?></p>
                        <?php endif; ?>
                        <!-- Formulario para editar los datos -->
                        <form method="post" class="form-foto editar-form">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_pat">Apellido paterno</label>
                                <input type="text" id="apellido_pat" name="apellido_pat" value="<?= htmlspecialchars($usuario['apellido_pat']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellido_mat">Apellido materno</label>
                                <input type="text" id="apellido_mat" name="apellido_mat" value="<?= htmlspecialchars($usuario['apellido_mat']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="curp">CURP</label>
                                <input type="text" id="curp" name="curp" value="<?= htmlspecialchars($usuario['curp']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña (opcional)</label>
                                <input type="password" id="contraseña" name="contraseña" placeholder="Nueva contraseña">
                            </div>
                            <button type="submit" class="upload-button">Guardar Cambios</button>
                            <br><br>
                            <a href="perfil.php" class="logout-button">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- Incluye footer -->
<?php include("footer.php"); ?>