<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
include('bd.php');

if (isset($_POST['save'])) {
    // Capturar y limpiar datos (algunos campos opcionales)
    $nombre = trim($_POST['nombre']);
    $ap = trim($_POST['AP']); // opcional
    $am = trim($_POST['AM']); // opcional
    $numcont = strtoupper(trim($_POST['numerocon']));
    $curp = strtoupper(trim($_POST['curp'])); // opcional
    $contra = $_POST['contra'];

    // Validar campos obligatorios: nombre, número de control y contraseña
    if (empty($nombre) || empty($numcont) || empty($contra)) {
        $_SESSION['message'] = 'Nombre, número de control y contraseña son obligatorios.';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    // Validar nombre (solo letras y espacios, máximo 50 caracteres)
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}$/", $nombre)) {
        $_SESSION['message'] = 'Nombre inválido (solo letras, máximo 50 caracteres).';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    // Validar número de control (alfanumérico, máximo 22 caracteres)
    if (!preg_match("/^[A-Z0-9]{1,22}$/i", $numcont)) {
        $_SESSION['message'] = 'Número de control inválido (máximo 22 caracteres alfanuméricos).';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    // Validar CURP (si se llenó)
    if (!empty($curp) && !preg_match("/^[A-Z0-9]{1,18}$/i", $curp)) {
        $_SESSION['message'] = 'CURP inválida. Solo se permiten letras y números (máximo 18 caracteres).';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    // Validar apellidos si se ingresaron (opcionales)
    if (!empty($ap) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}$/", $ap)) {
        $_SESSION['message'] = 'Apellido paterno inválido (solo letras, máximo 50 caracteres).';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    if (!empty($am) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}$/", $am)) {
        $_SESSION['message'] = 'Apellido materno inválido (solo letras, máximo 50 caracteres).';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }

    // Verificar si ya existe el número de control
    $stmt = $conn->prepare("SELECT num_control FROM usuario WHERE num_control = ?");
    $stmt->bind_param("s", $numcont);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = 'El número de control ya está registrado.';
        $_SESSION['message_type'] = 'danger';
        $stmt->close();
        header("Location: iniciar.php");
        exit();
    }
    $stmt->close();

    // Guardar la contraseña tal cual (puedes encriptar si deseas con password_hash)
    $contra_guardar = $contra;

    // Insertar usuario (se permiten valores vacíos en campos opcionales)
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellido_pat, apellido_mat, num_control, curp, contraseña) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $ap, $am, $numcont, $curp, $contra_guardar);

    if ($stmt->execute()) {
        $_SESSION['num_control'] = $numcont;
        $_SESSION['nombre'] = $nombre;
        header("Location: bienvenido.php");
        exit();
    } else {
        $_SESSION['message'] = 'Ocurrió un error al registrar el usuario.';
        $_SESSION['message_type'] = 'danger';
        header("Location: iniciar.php");
        exit();
    }
    $stmt->close();
}
?>