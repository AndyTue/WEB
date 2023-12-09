<?php
session_start();
include 'db_connection.php';

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
    $stmt->fetch();
    $stmt->close();

    // Retornar la URL de la imagen
    return $rutaCarpeta . $imagen;
}

// Función para obtener el nombre del producto específico para cada producto
function obtenerNombreProducto($conn, $producto) {
    // Consultar la base de datos para obtener el nombre del producto
    $query = "SELECT name FROM tenis_snk WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $producto);
    $stmt->execute();
    $stmt->bind_result($nombreProducto);
    $stmt->fetch();
    $stmt->close();

    // Retornar el nombre del producto
    return $nombreProducto;
}

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

// Verificar si se proporciona el parámetro 'agregarAlCarrito' y es válido
if (isset($_GET['agregarAlCarrito'])) {
    $productoAgregar = $_GET['agregarAlCarrito'];

    // Agregar lógica para agregar al carrito según tus necesidades
    // ...

    // Después de agregar al carrito, eliminarlo de la lista de favoritos
    if (isset($_SESSION['favoritos'][$productoAgregar])) {
        // Agregar lógica para agregar al carrito según tus necesidades
        // ...

        // Eliminar de la lista de favoritos
        unset($_SESSION['favoritos'][$productoAgregar]);
        header('Location: favoritos.php');
        exit;
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
    <title>SneakerBoutique - Favoritos</title>
</head>
<body>
<div class="contenedor">
    <?php
    include 'header.php';
    ?>

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
                    echo "<th>Imagen</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Eliminar</th>";
                    echo "<th>Añadir al Carrito</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach ($_SESSION['favoritos'] as $producto => $detalles) {
                        echo "<tr>";
                        // Imagen
                        echo "<td>";
                        echo "<img src='" . obtenerUrlImagen($conn, $producto) . "' alt='{$producto}' class='imagen-producto'>";
                        echo "</td>";

                        // Nombre
                        echo "<td>";
                        echo obtenerNombreProducto($conn, $producto);
                        echo "</td>";

                        // Eliminar
                        echo "<td><a class='eliminar' href='favoritos.php?eliminar=$producto'>Eliminar</a></td>";

                        // Añadir al Carrito
                        echo "<td><a class='eliminar' href='favoritos.php?agregarAlCarrito=$producto'>Añadir al Carrito</a></td>";

                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No hay productos en la lista de favoritos.</p>";
                }
                ?>
            </div>
        </section>
    </section>

    <script src="script.js"></script>
</body>
</html>