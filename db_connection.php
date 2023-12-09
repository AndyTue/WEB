<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sneakerboutique";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>