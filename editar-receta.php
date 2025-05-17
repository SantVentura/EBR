<?php
// editar-receta.php

header('Content-Type: application/json');

// 1. Leer el JSON enviado por JavaScript
$datos = json_decode(file_get_contents("php://input"), true);

// 2. Validar los datos
if (!isset($datos['id'], $datos['titulo'], $datos['descripcion'], $datos['categoria_id'], $datos['imagen'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

$id = (int) $datos['id'];
$titulo = $datos['titulo'];
$descripcion = $datos['descripcion'];
$categoria_id = (int) $datos['categoria_id'];
$imagen = $datos['imagen'];

// 3. Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "blog_recetas");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión']);
    exit;
}

// 4. Ejecutar la actualización (con categoria_id correcto)
$stmt = $conn->prepare("UPDATE recetas SET titulo = ?, descripcion = ?, categoria_id = ?, imagen = ? WHERE id = ?");
$stmt->bind_param("ssisi", $titulo, $descripcion, $categoria_id, $imagen, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]); // <-- Para ver el error real
}

$stmt->close();
$conn->close();
?>
