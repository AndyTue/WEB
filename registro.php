<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>SneakerBoutique</title>
</head>
<body>
<div class="contenedor">
    <header>
        <div class="logo-titulo">
            <a href="index.php">
                <i class="fa-regular fa-circle-dot"></i>
                <h1>SneakerBoutique</h1>
            </a>
        </div>
        <nav id="nav">
            <a href="index.php" class="selected">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <a href="contacto.php">Contacto</a>
            <a href="favoritos.php">Favoritos</a>
            <!-- icono cerrar menu responsive -->
            <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
        </nav>
        <!-- Boton de login -->
        <form action="../Proyecto/login.php">
            <button class="btn-longin">Iniciar Sesión</button>
        </form>
        <div id="nav-responsive">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="carrito">
            <a href="carrito.php"><!--Debe marcar el numero de productos dentro del carrito-->
                <span class="icono-carrito">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <?php
                        // Inicializar el contador de productos en el carrito
                        $cantidadProductos = 0;

                        // Verificar si hay productos en el carrito
                        if (!empty($_SESSION['tienda'])) {
                            // Sumar la cantidad total de productos, incluyendo las cantidades de productos idénticos
                            foreach ($_SESSION['tienda'] as $detalles) {
                                $cantidadProductos += $detalles['cantidad'];
                            }
                        }
                        ?>
                        <div class="total-item-carrito">
                            <?php echo $cantidadProductos; ?>
                        </div>
                    </span>
            </a>
        </div>
    </header>

    <section class="contenedor-seccion">
        <div class="fondo-seccion"></div>
        <div class="header-seccion">
            <div class="col">
                <strong><span class="link-blanco">Inicio</span> / Registro</strong>
            </div>
            <div class="centro">
                <h2>Registro</h2>
            </div>
        </div>
        <section id="blog" class="blog">
            <div class="formulario-login">
                <form action="registro.php" method="POST">
                    <label for="nombreUsuario">Nombre de usuario:</label>
                    <input type="text" id="nombreUsuario" name="nombreUsuario" required>

                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" required>

                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>

                    <button type="submit">Registrarse</button>
                    <p>¿Ya tienes una cuenta? <a href="../Proyecto/login.php">Iniciar sesión</a></p>
                </form>
            </div>
        </section>
    </section>
</div>

<script src="script.js"></script>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("conection.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

// Recuperar datos del formulario
    $usuario = $_POST['nombreUsuario'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];

// Verifica si existe usuario y correo
    $sqlCheck = "SELECT * FROM usuarios WHERE correo = ? OR usuario = ?";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param("ss", $correo, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["correo"] === $correo) {
                // Inicio de sesión fallido
                echo '<script>';
                echo 'alert("El correo electrónico ya está registrado.")';
                echo '</script>';
            }
            if ($row["usuario"] === $usuario) {
                echo '<script>';
                echo 'alert("El nombre de usuario ya está en uso.")';
                echo '</script>';
            }
        }
    } else {
        // Consulta SQL preparada para insertar un nuevo usuario en la tabla
        $sql = "INSERT INTO usuarios (usuario, contrasena, correo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $contrasena, $correo);

        if ($stmt->execute()) {
            echo "Registro exitoso. <a href='../Proyecto/login.php'>Iniciar sesión</a>";
        } else {
            echo '<script>';
            echo 'alert("Error al registrar usuario.")';
            echo '</script>';
        }
    }

    $stmt->close();
    $conn->close();
}
?>
