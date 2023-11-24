<?php
include 'db_connection.php';

// Realizar consulta SQL para obtener productos
$sql = "SELECT * FROM tenis_snk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar productos
    while ($row = $result->fetch_assoc()) {
        echo "<div class='producto'>";
        echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";

        // Obtener el ID y las existencias del producto
        $producto_id = $row['ids'];
        $existencias = $row['cantidad_existencia'];

        // Puedes agregar más detalles según tu esquema de base de datos
        echo "<a href='tienda.php?producto=" . $producto_id . "&existencias=" . $existencias . "'>Agregar al carrito</a>";
        echo "</div>";
    }
} else {
    echo "No hay productos disponibles.";
}

// Cerrar conexión
$conn->close();
?>
