<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Consulta para obtener las recetas que no están aprobadas
$sql = "SELECT r.id, r.titulo, r.descripcion, r.imagen, r.vista_previa, c.nombre_categoria, u.nombre_usuario 
        FROM Recetas r
        JOIN CategoriasRecetas c ON r.categoria_id = c.id
        JOIN Usuarios u ON r.usuario_id = u.id
        WHERE r.aprobada = 1"; // Solo recetas aprobadas
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    $recetas = [];
    while ($row = $result->fetch_assoc()) {
        // Añadir cada receta al array
        $recetas[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'imagen' => $row['imagen'], // Ruta de la imagen
            'vista_previa' => $row['vista_previa'],
            'categoria' => $row['nombre_categoria'],
            'usuario' => $row['nombre_usuario']
        ];
    }
    // Devolver las recetas en formato JSON
    echo json_encode($recetas);
} else {
    echo json_encode([]); // Si no hay recetas, devolver un array vacío
}

// Cerrar la conexión
$conn->close();
?>
