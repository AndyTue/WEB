<?php
include 'db_connection.php';

// Comprobar si la sesión no está iniciada antes de intentar iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para obtener la información del producto desde la base de datos
function obtenerInfoProductoDesdeBD($producto) {
    global $conn;

    // Verificar si la conexión a la base de datos se estableció correctamente
    if (!$conn) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para obtener la información del producto
    $sql = "SELECT name, price, image AS imagen_url FROM tenis_snk WHERE id = '$producto'";
    $result = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Si hay resultados, devolver la información del producto
        $row = $result->fetch_assoc();
        return $row;
    } else {
        // Si no hay resultados, devolver un array vacío o manejar el caso según sea necesario
        return array();
    }
}

// Función para obtener la URL de la imagen específica para cada producto
function obtenerUrlImagen($conn, $producto) {
    // Ruta de la carpeta de imágenes
    $rutaCarpeta = 'img/';

    // Consultar la base de datos para obtener el nombre de la imagen
    $query = "SELECT image FROM tenis_snk WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $producto);
    $stmt->execute();
    $stmt->bind_result($imagen);

    // Manejo de errores
    if ($stmt->fetch()) {
        $stmt->close();
        // Retornar la URL de la imagen
        return $rutaCarpeta . $imagen;
    } else {
        // Manejo de errores
        echo "Error al obtener la URL de la imagen: " . $stmt->error;
        return '';
    }
}

// Verificar si se proporciona el parámetro 'eliminar' y es válido
if (isset($_GET['eliminar'])) {
    $productoEliminar = $_GET['eliminar'];

    // Eliminar el producto del carrito
    unset($_SESSION['tienda'][$productoEliminar]);
}

// Verificar si se proporciona el parámetro 'pagar' y es válido
if (isset($_POST['pagoRealizado']) && $_POST['pagoRealizado'] === 'true') {
    // Aquí puedes realizar cualquier lógica relacionada con el pago, como registrar la transacción en la base de datos, enviar correos electrónicos, etc.

    // Después de completar la transacción, vaciar el carrito
    $_SESSION['tienda'] = array();
}
// Verificar si se proporciona el parámetro 'producto' y es válido
if (isset($_GET['producto'])) {
    $productoAgregar = $_GET['producto'];

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['tienda'][$productoAgregar])) {
        // Si está en el carrito, incrementar la cantidad
        $_SESSION['tienda'][$productoAgregar]['cantidad']++;
    } else {
        // Si no está en el carrito, agregarlo con cantidad 1
        $_SESSION['tienda'][$productoAgregar] = array('cantidad' => 1);
    }
}
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
<div class="contenedor"><!--Eliminar todo y hacer que funcione como el carrito que ya habias echo-->
    <header>
        <div class="logo-titulo">
            <a href="index.php">
                <i class="fa-regular fa-circle-dot"></i>
                <h1>SneakerBoutique</h1>
            </a>
        </div>
        <nav id="nav">
            <a href="index.php">Inicio</a>
            <a href="tienda.php">Tienda</a>
            <!--a href="blog.html">Blog</a>-->
            <a href="contacto.php">Contacto</a>
            <a href="login.html">Iniciar Sesión</a>
            <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
        </nav>
        <div id="nav-responsive">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="carrito">

            <a href="carrito.php">
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
                <strong><span class="link-blanco">Inicio</span> / Carrito</strong>
            </div>
            <div class="centro">
                <h2>Mi Carrito</h2>
            </div>
            <div class="col busqueda">

            </div>
        </div>


        <section class="mi-carrito">
            <div class="productos-carrito">
            <?php
                // Verificar si hay productos en el carrito
                if (!empty($_SESSION['tienda'])) {
                    echo "<table class='carrito-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Descripción</th>";
                    echo "<th>Cantidad</th>";
                    echo "<th>Eliminar</th>";
                    echo "<th>Precio</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    $total = 0;

                    foreach ($_SESSION['tienda'] as $producto => $detalles) {
                        // Obtener la información del producto desde la base de datos
                        $productoInfo = obtenerInfoProductoDesdeBD($producto);

                        // Verificar si se obtuvo información del producto
                        if (!empty($productoInfo)) {
                            echo "<tr>";
                            // Descripción e Imagen
                            echo "<td>";
                            echo "<div class='descripcion-imagen'>";
                            echo "<img src='" . obtenerUrlImagen($conn, $producto) . "' alt='{$producto}' class='imagen-producto'>";
                            echo "<span>{$productoInfo['name']}</span>";
                            echo "</div>";
                            echo "</td>";

                            // Cantidad
                            echo "<td>";
                            // Aumentar
                            echo "<a class='aumentar' href='carrito.php?aumentar={$producto}'>+</a>";
                            echo " {$detalles['cantidad']}";
                            // Reducir
                            echo "<a class='reducir' href='carrito.php?reducir={$producto}'>-</a>";
                            echo "</td>";

                            // Eliminar
                            echo "<td><a class='eliminar' href='carrito.php?eliminar={$producto}'>x</a></td>";

                            // Precio desde la base de datos
                            $precioDesdeBD = $productoInfo["price"];
                            echo "<td>{$precioDesdeBD}</td>";

                            echo "</tr>";

                            // Calcular el total
                            $subtotal = $detalles['cantidad'] * $productoInfo["price"];
                            $total += $subtotal;
                        }
                    }

                    echo "</tbody>";
                    echo "</table>";

                    // Mostrar el total y el botón de pagar
                    echo "<div class='finalizar-compra'>";
                    echo "<h3>Total Compra:</h3>";
                    echo "<div class='monto'>$$total</div>";
                    echo "<form id='formularioPago' action='carrito.php' method='post'>";
                    echo "<input type='hidden' name='pagoRealizado' value='true'>";
                    echo "<button type='submit' class='btn-pagar'>Pagar</button>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<p>No hay productos en el carrito.</p>";
                }
                ?>


        </section>

    </section>
</div>

<script src="script.js"></script>
</body>
</html>
