<?php
include 'conexion.php';

// Contar usuarios
$usuarios = $conn->query("SELECT COUNT(*) as total FROM Usuarios")->fetch_assoc()['total'];

// Contar recetas totales
$recetas = $conn->query("SELECT COUNT(*) as total FROM Recetas")->fetch_assoc()['total'];

// Contar recetas pendientes
$pendientes = $conn->query("SELECT COUNT(*) as total FROM Recetas WHERE aprobada = 0")->fetch_assoc()['total'];

// Contar recetas aprobadas
$aprobadas = $conn->query("SELECT COUNT(*) as total FROM Recetas WHERE aprobada = 1")->fetch_assoc()['total'];

// Devolver como JSON
echo json_encode([
    'usuarios' => $usuarios,
    'recetas' => $recetas,
    'pendientes' => $pendientes,
    'aprobadas' => $aprobadas
]);

$conn->close();
?>
