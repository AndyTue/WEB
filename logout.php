<?php
session_start(); // Inicializar la sesión si no lo has hecho ya

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión, también se borra la cookie de sesión.
// Nota: Esto destruirá la sesión y no solo los datos de la sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: login.php");
exit();
?>
