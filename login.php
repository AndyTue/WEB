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
            <!--   <a href="blog.html">Blog</a>-->
            <a href="contacto.php">Contacto</a>
            <a href="favoritos.php">Favoritos</a>
            <!-- icono cerrar menu responsive -->
            <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
        </nav>
        <!-- Boton de login -->
        <form action="login.php">
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
                    <strong><span class="link-blanco">Inicio</span> / Iniciar sesión</strong>
                </div>
                <div class="centro">
                    <h2>Iniciar sesión</h2>
                </div>
            </div>
            <section id="blog" class="blog">
                <div class="formulario-login">

                    <form action="login.php" method="POST">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required>

                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" required>

                        <button type="submit">Iniciar sesión</button>
                        <p>¿No tienes una cuenta? <a href="registro.php">Registrarte</a></p>
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
    require("conection.php"); // Asegúrate de tener la conexión a la base de datos

    // Recuperar datos del formulario y prevenir inyección SQL
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);

    // Consulta SQL para verificar el inicio de sesión en la tabla usuarios
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol'] = $row['rol'];

        if ($row['rol'] === 'admin') {
            header("Location: dashboard.html"); // Redirigir al dashboard de administrador
            exit();
        } else {
            header("Location: tienda.php"); // Redirigir a la tienda para usuarios regulares
            exit();
        }
    } else {
        // Consultar en la tabla admins si no se encontró en la tabla usuarios
        $sql2 = "SELECT * FROM admins WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows == 1) {
            $row = $result2->fetch_assoc();
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['rol'] = 'admin'; // Establecer el rol como admin

            header("Location: dashboard.html"); // Redirigir al dashboard de administrador
            exit();
        } else {
            // Inicio de sesión fallido
            echo '<script>';
            echo 'alert("No se encontró la cuenta. Verifique sus credenciales.")';
            echo '</script>';
        }
    }
}
?>