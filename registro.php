<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conectarse a la base de datos (asegúrate de cambiar estos valores)
require("conection.php"); //conecta con la BD

// Recuperar datos del formulario
$usuario = $_POST['nombreUsuario'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];

// Consulta SQL para insertar un nuevo usuario en la tabla
$sql = "INSERT INTO usuarios2 (usuario, contrasena, correo) VALUES ('$usuario', '$contrasena', '$correo')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. <a href='login.html'>Iniciar sesión</a>";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

$conn->close();
?>
