<?php
// register.php

// Verifica que se haya enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Obtener los datos del formulario
    $nombre_usuario = trim($_POST['username']);
    $correo = trim($_POST['email']);
    $contraseña = trim($_POST['password']);

    // 2. Validar campos
    if (empty($nombre_usuario) || empty($correo) || empty($contraseña)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // 3. Encriptar la contraseña
    $hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // 4. Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "blog_recetas");

    if ($conn->connect_error) {
        echo "Error de conexión: " . $conn->connect_error;
        exit;
    }

    // 5. Verificar si el correo ya existe
    $check = $conn->prepare("SELECT id FROM Usuarios WHERE correo = ?");
    $check->bind_param("s", $correo);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "El correo ya está registrado.";
        $check->close();
        $conn->close();
        exit;
    }

    // 6. Insertar nuevo usuario
    $stmt = $conn->prepare("INSERT INTO Usuarios (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre_usuario, $correo, $hash);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='Login.html'>Inicia sesión aquí</a>";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
