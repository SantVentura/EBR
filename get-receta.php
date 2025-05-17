<?php
require 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM recetas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo json_encode($resultado->fetch_assoc());
} else {
    echo json_encode(["error" => "Receta no encontrada"]);
}
?>
