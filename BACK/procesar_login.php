<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Configuración base de datos

$hostname = "localhost";
$username = "user_brontogames";
$password = "Nr7#Vp6@Lm1!Xq5K";
$database = "bd-brontogames";

/*
$hostname = "localhost";
$username = "root";
$password = "";
$database = "bd-brontogames";
*/

/*
$hostname = "192.168.1.50";
$username = "bd-manager";
$password = "mBdi4#32";
$database = "brontogames";
*/

// Conexión
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $pass   = trim($_POST["password"]);

    // Buscar usuario
    $stmt = $conn->prepare("SELECT ID_Usuario, nombre, password FROM usuario WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña con hash
        if (password_verify($pass, $usuario["password"])) {
            $_SESSION["ID"] = $usuario["ID_Usuario"];
            $_SESSION["Nombre"] = $usuario["nombre"];
            $success = true;
        } else {
            $error = "Contraseña incorrecta";
            $success = false;
        }
    } else {
        // Usuario no registrado
        $error = "Debes registrarte antes de iniciar sesión.";
        $success = false;
    }
    
    // Devolver respuesta JSON
    header('Content-Type: application/json');
    if ($success) {
        echo json_encode(['success' => true, 'redirect' => '../FRONT/ConfiguracionPartida.php']);
    } else {
        echo json_encode(['success' => false, 'message' => $error]);
    }
    $stmt->close();
}

$conn->close();
?>
