<?php
include 'conexion.php'; // Incluir archivo de conexión

$data = json_decode(file_get_contents('php://input'), true); // Obtener los datos enviados por POST
$id_receta = $data['id'];

// Actualizar el estado de la receta
$sql = "UPDATE Recetas SET aprobada = 1 WHERE id = $id_receta";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>
