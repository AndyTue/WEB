<?php
include 'db_connection.php';
session_start();
// Define un arreglo asociativo con los nombres de visualización correspondientes a cada producto
$nombresVisualizacion = array(
    'tenis1' => 'Air Force 1 High´07',
    'tenis2' => 'Nike Space Hippie',
    'tenis3' => 'Air Jordan 1 Hihg',
    'tenis4' => 'Nike Blazer Mid´77 Vintage',
    'tenis5' => 'Nike Crater Impact',
    'tenis6' => 'Nike Dunk Low Retro'
    // Agrega más productos según sea necesario
);
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
        <form action="../Proyecto/login.php">
            <button class="btn-longin">Iniciar Sesión</button>
        </form>
        <div id="nav-responsive">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="carrito">
            <a href="carrito.php">
                    <span class="icono-carrito">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <?php
                        session_start();
                        ?>

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
                // Comprobar si la sesión no está iniciada antes de intentar iniciarla
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }



                // Verificar si se proporciona el parámetro 'producto' y es válido
                if (isset($_GET['producto'])) {
                    $producto = $_GET['producto'];

                    // Verificar si la variable de sesión específica para el producto existe
                    if (!isset($_SESSION['tienda'][$producto])) {
                        // Agregar el producto con cantidad 1 y precio
                        $_SESSION['tienda'][$producto] = array('cantidad' => 1, 'precio' => obtenerPrecioPorProducto($producto));
                    } else {
                        // Incrementar la cantidad del producto
                        $_SESSION['tienda'][$producto]['cantidad']++;
                    }

                    // Redirigir después de agregar el producto para evitar repetir la acción al actualizar
                    header('Location: carrito.php');
                    exit;
                }

                // Verificar si se proporciona el parámetro 'eliminar' y es válido
                if (isset($_GET['eliminar'])) {
                    $productoEliminar = $_GET['eliminar'];

                    // Verificar si la variable de sesión específica para el producto existe
                    if (isset($_SESSION['tienda'][$productoEliminar])) {
                        // Eliminar definitivamente el producto
                        unset($_SESSION['tienda'][$productoEliminar]);

                        // Redirigir después de eliminar el producto para evitar repetir la acción al actualizar
                        header('Location: carrito.php');
                        exit;
                    }
                }

                // Verificar si se proporciona el parámetro 'aumentar' y es válido
                if (isset($_GET['aumentar'])) {
                    $productoAumentar = $_GET['aumentar'];

                    // Verificar si la variable de sesión específica para el producto existe
                    if (isset($_SESSION['tienda'][$productoAumentar])) {
                        // Aumentar la cantidad del producto
                        $_SESSION['tienda'][$productoAumentar]['cantidad']++;

                        // Redirigir después de aumentar el producto para evitar repetir la acción al actualizar
                        header('Location: carrito.php');
                        exit;
                    }
                }

                // Verificar si se proporciona el parámetro 'reducir' y es válido
                if (isset($_GET['reducir'])) {
                    $productoReducir = $_GET['reducir'];

                    // Verificar si la variable de sesión específica para el producto existe
                    if (isset($_SESSION['tienda'][$productoReducir])) {
                        // Reducir la cantidad del producto
                        $_SESSION['tienda'][$productoReducir]['cantidad']--;

                        // Eliminar el producto si la cantidad llega a cero o menos
                        if ($_SESSION['tienda'][$productoReducir]['cantidad'] <= 0) {
                            unset($_SESSION['tienda'][$productoReducir]);
                        }

                        // Redirigir después de reducir el producto para evitar repetir la acción al actualizar
                        header('Location: carrito.php');
                        exit;
                    }
                }

                // Función para obtener el precio por producto
                function obtenerPrecioPorProducto($producto) {
                    // Define un arreglo asociativo con los precios de cada producto
                    $precios = array(
                        'tenis1' => 270,
                        'tenis2' => 319,
                        'tenis3' => 134,
                        'tenis4' => 179,
                        'tenis5' => 190,
                        'tenis6' => 134
                    );

                    // Retorna el precio correspondiente al producto
                    return isset($precios[$producto]) ? $precios[$producto] : 0;
                }

                // Verificar si se oprimió el botón de Pagar y si hay productos en el carrito
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
                        echo "<tr>";
                        // Descripción e Imagen
                        echo "<td>";
                        echo "<div class='descripcion-imagen'>";
                        echo "<img src='" . obtenerNombreImagen($producto) . "' alt='{$producto}' class='imagen-producto'>";
                        echo "<span>{$nombresVisualizacion[$producto]}</span>";
                        echo "</div>";
                        echo "</td>";


                        // Cantidad
                        echo "<td>";
                        // Aumentar
                        echo "<a class='aumentar' href='carrito.php?aumentar=$producto'>+</a>";
                        echo " {$detalles['cantidad']}";
                        // Reducir
                        echo "<a class='reducir' href='carrito.php?reducir=$producto'>-</a>";
                        echo "</td>";

                        // Eliminar
                        echo "<td><a class='eliminar' href='carrito.php?eliminar=$producto'>x</a></td>";

                        // Precio
                        echo "<td>{$detalles['precio']}</td>";

                        echo "</tr>";

                        // Calcular el total
                        $subtotal = $detalles['cantidad'] * $detalles['precio'];
                        $total += $subtotal;
                    }

                    echo "</tbody>";
                    echo "</table>";

                    // Mostrar el total y el botón de pagar
                    echo "<div class='finalizar-compra'>";
                    echo "<h3>Total Compra:</h3>";
                    echo "<div class='monto'>$$total</div>";
                    echo "<button class='btn-pagar' onclick=\"location.href='login.php'\">Pagar</button>";
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-pagar'])) {
                        // Verificar si se presionó el botón y ejecutar una función o código aquí
                    }


                    echo "</div>";
                } else {
                    echo "<p>No hay productos en el carrito.</p>";
                }




                // Función para obtener el nombre de la imagen específica para cada producto
                function obtenerNombreImagen($producto) {
                    // Ruta de la carpeta de imágenes
                    $rutaCarpeta = 'img/';
                    // Puedes mantener un array asociativo con los nombres de las imágenes correspondientes a cada producto
                    $imagenes = array(
                        'tenis1' => 'air.png',
                        'tenis2' => 'hippie.png',
                        'tenis3' => 'jordan.png',
                        'tenis4' => 'blazer.png',
                        'tenis5' => 'crater.png',
                        'tenis6' => 'dunk.png',
                        // Agrega más productos según sea necesario
                    );

                    // Retorna el nombre de la imagen correspondiente al producto
                    return isset($imagenes[$producto]) ? $rutaCarpeta . $imagenes[$producto] : '';
                }
                ?>



        </section>

    </section>
</div>

<script src="script.js"></script>
</body>
</html>