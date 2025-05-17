<?php
include 'conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$sql = "DELETE FROM Recetas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);
$conn->close();
?>
