<?php
session_start();
include 'db_connection.php'; // Asegúrate de incluir la conexión a tu base de datos aquí
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>SneakerBoutique - Detalle del Producto</title>
</head>
<body>
<div class="contenedor">
    <?php
    include 'header.php';
    ?>
    <section class="contenedor-seccion">
        <?php
        // Verificar si se ha recibido un nombre de producto válido
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            // Obtener el nombre del producto desde el parámetro GET
            $nombre_producto = $_GET['name'];

            // Consultar la base de datos para obtener detalles del producto por nombre
            $query = "SELECT * FROM tenis_snk WHERE name = '$nombre_producto'";
            $result = $conn->query($query);

            // Verificar si se encontró el producto
            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();
                // Mostrar los detalles del producto obtenido de la base de datos
                echo "<h2>{$producto['name']}</h2>";
                echo "<p>{$producto['price']}</p>";
                echo "<img src='{$producto['image']}' alt='{$producto['name']}'>";
                // Mostrar otros detalles o contenido del producto si es necesario
            } else {
                echo "Producto no encontrado";
            }
        } else {
            echo "Nombre de producto no proporcionado";
        }
        ?>
    </section>
</div>
<script src="script.js"></script>
</body>
</html>
