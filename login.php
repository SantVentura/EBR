<?php
session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "blog_recetas";

// Conectar a la base de datos
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica que los datos llegaron
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Consulta al usuario por correo
        $stmt = $conn->prepare("SELECT U.id, U.nombre_usuario, U.contraseña, R.nombre_rol 
                                FROM Usuarios U 
                                JOIN AsignacionRoles AR ON U.id = AR.usuario_id 
                                JOIN Roles R ON AR.rol_id = R.id 
                                WHERE U.correo = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['contraseña']) { // Idealmente deberías usar password_hash()
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
                $_SESSION['rol'] = $user['nombre_rol'];
                

                if ($user['nombre_rol'] === "admin") {
                    header("Location:/EBR/admin-dashboard.html");
                    exit;
                } else {
                    header("Location:/EBR/Home.html");
                    exit;
                }
                
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }

        $stmt->close();
    } else {
        echo "Por favor, complete todos los campos.";
    }
}

$conn->close();
?>
