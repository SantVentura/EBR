<?php
header('Content-Type: application/json');

if (!isset($_FILES['imagen'])) {
    echo json_encode(['success' => false, 'error' => 'No se recibió archivo']);
    exit;
}

$archivo = $_FILES['imagen'];
$nombre_original = basename($archivo['name']);
$ext = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
$permitidas = ['jpg', 'jpeg', 'png', 'gif'];

// Validar extensión
if (!in_array($ext, $permitidas)) {
    echo json_encode(['success' => false, 'error' => 'Tipo de archivo no permitido']);
    exit;
}

// Carpeta uploads (asegúrate que exista y tenga permisos)
$carpeta = 'uploads/';
if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

// Generar nombre único para evitar colisiones
$nuevo_nombre = uniqid('img_') . '.' . $ext;
$ruta_destino = $carpeta . $nuevo_nombre;

// Mover archivo
if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
    echo json_encode(['success' => true, 'url' => $ruta_destino]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al guardar el archivo']);
}
?>
