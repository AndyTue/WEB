<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Consulta para obtener el nombre del archivo de imagen
    $get_image_name = $conn->prepare("SELECT image FROM tenis_snk WHERE id = ?");
    $get_image_name->bind_param("i", $product_id);
    $get_image_name->execute();
    $get_image_name_result = $get_image_name->get_result();

    if ($get_image_name_result->num_rows > 0) {
        $image_name = $get_image_name_result->fetch_assoc()['image'];

        // Eliminar la imagen del servidor
        $image_path = 'img/' . $image_name;
        unlink($image_path);

        // Eliminar el producto de la base de datos
        $delete_product = $conn->prepare("DELETE FROM tenis_snk WHERE id = ?");
        $delete_product->bind_param("i", $product_id);

        if ($delete_product->execute()) {
            echo "Producto eliminado con éxito";
        } else {
            echo "Error al eliminar el producto: " . $delete_product->error;
        }

        $delete_product->close();
    } else {
        echo "No se encontró el producto";
    }

    $get_image_name->close();
    $conn->close();
} else {
    echo "Parámetros inválidos";
}
?>
