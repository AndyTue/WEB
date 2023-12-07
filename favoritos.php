<?php
include 'db_connection.php';

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

// Iniciar sesión
session_start();

// Verificar si se proporciona el parámetro 'producto' y es válido
if (isset($_GET['producto'])) {
    $producto = $_GET['producto'];

    // Verificar si la variable de sesión específica para el producto existe
    if (!isset($_SESSION['favoritos'][$producto])) {
        // Agregar el producto a la lista de favoritos
        $_SESSION['favoritos'][$producto] = array();
    }

    // Redirigir después de agregar el producto para evitar repetir la acción al actualizar
    header('Location: favoritos.php');
    exit;
}

// Verificar si se proporciona el parámetro 'eliminar' y es válido
if (isset($_GET['eliminar'])) {
    $productoEliminar = $_GET['eliminar'];

    // Verificar si la variable de sesión específica para el producto existe
    if (isset($_SESSION['favoritos'][$productoEliminar])) {
        // Eliminar definitivamente el producto de la lista de favoritos
        unset($_SESSION['favoritos'][$productoEliminar]);

        // Redirigir después de eliminar el producto para evitar repetir la acción al actualizar
        header('Location: favoritos.php');
        exit;
    }
}

// HTML para mostrar la lista de favoritos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>SneakerBoutique - Favoritos</title>
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
            <form action="login.php">
                <button class="btn-longin">Iniciar Sesión</button>
            </form>
            <!-- icono menu responsive -->
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
                    <h2>Mis Favoritos</h2>
                </div>
                <div class="col busqueda">
                    
                </div>
            </div>
            

            <section class="mi-carrito">
                <div class="productos-carrito">
                    <?php
                    // Verificar si hay productos en la lista de favoritos
                    if (!empty($_SESSION['favoritos'])) {
                        echo "<table class='carrito-table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Descripción</th>";
                        echo "<th>Eliminar</th>";
                        echo "<th>Añadir al Carrito</th>"; 
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach ($_SESSION['favoritos'] as $producto => $detalles) {
                            echo "<tr>";
                            // Descripción e Imagen
                            echo "<td>";
                            echo "<div class='descripcion-imagen'>";
                            echo "<img src='" . obtenerNombreImagen($producto) . "' alt='{$producto}' class='imagen-producto'>";
                            echo "<span>{$nombresVisualizacion[$producto]}</span>";
                            echo "</div>";
                            echo "</td>";

                            // Eliminar
                            echo "<td><a class='eliminar' href='favoritos.php?eliminar=$producto'>x</a></td>";

                            // Añadir al Carrito
                            echo "<td><a class='eliminar' href='favoritos.php?agregarAlCarrito=$producto'>+</a></td>";

                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No hay productos en la lista de favoritos.</p>";
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
                </div>
            </section>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>
