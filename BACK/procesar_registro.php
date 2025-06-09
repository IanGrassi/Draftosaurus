<?php 
// Conexión a la base de datos
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'registro_jugadores';

echo "Conexión exitosa";
  die();

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die('Fallo la conexión: ' . mysqli_connect_error());
}
  $nombre = $_POST["Nombre"];

$query = "INSERT INTO registro_jugadores.jugadores (id, nombre, fecha_registro) 
          VALUES ('$id', '$nombre', '$fecha_registro')";
$result = mysqli_query($conn, $query);

$_SESSION["ID"] = $id;
$_SESSION["Nombre"] = $nombre;
$_SESSION["Fecha"] = $fecha_registro;;
?>