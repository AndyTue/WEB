<?php
print_r($_POST);
require("conection.php"); // Conecta con la BD

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar el nombre de usuario a eliminar del formulario
$id = $_GET['id'];

// Consulta SQL para eliminar el usuario
$sql = "DELETE FROM usuarios WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Usuario eliminado exitosamente.";
    // Redirigir a cuentas_admins.php después de eliminar el usuario
    header("Location: cuentas_admins.php");
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al eliminar el usuario: " . $conn->error;
}

$conn->close();
?>
