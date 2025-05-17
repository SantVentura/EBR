<?php
// Datos de la base de datos
$servername = "localhost"; // o el host que uses
$username = "root";        // tu usuario de MySQL
$password = "";            // tu contraseña de MySQL
$dbname = "blog_recetas";  // el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
