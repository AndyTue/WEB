<?php
//print_r($_POST);

require("conection.php");

// Recuperar datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consulta SQL para verificar el inicio de sesión
$sql = "SELECT * FROM usuarios2 WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
	// Inicio de sesión exitoso
	session_start();
	$_SESSION['usuario'] = $usuario;
	header("Location: tienda.php");
} else {
	// Inicio de sesión fallido
	echo "Nombre de usuario o contraseña incorrectos.";
}


$conn->close();
