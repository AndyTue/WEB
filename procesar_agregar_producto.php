<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['product-name'];
    $price = $_POST['product-price'];
    $details = $_POST['product-description'];
    $category = $_POST['product-category'];

    // Manejar la imagen
    $image = $_FILES['product-image']['name'];
    $image_tmp = $_FILES['product-image']['tmp_name'];
    $image_folder = 'img/' . $image;

    // Mover la imagen a la carpeta
    move_uploaded_file($image_tmp, $image_folder);

    // Insertar datos en la base de datos con sentencia preparada
    $sql = "INSERT INTO tenis_snk (name, details, price, image, category) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $details, $price, $image, $category);

    // Verificar si la ejecución fue exitosa
    if ($stmt->execute()) {
        echo "Producto agregado con éxito";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>