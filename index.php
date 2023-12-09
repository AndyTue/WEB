<?php
include 'db_connection.php';
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
    <!-- ENCABEZADO PRINCIPAL: LOGO MENU CARRITO -->
    <?php
    include 'header.php';
    ?>

    <section class="contenedor-seccion">
        <div class="fondo-seccion"></div>

        <section id="inicio" class="inicio">
            <div class="col">
                <h2 class="titulo-inicio">Encuentra las zapatillas <br>
                    que buscas al mejor precio</h2>
                <div class="buscador">
                    <input type="text" id="inputBusqueda" placeholder="Qué estás buscando?">
                    <span class="btn-buscar" onclick="buscarProductos()"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>


            </div>
            <div class="col derecha">
                <div class="contenedor-img">
                    <img src="img/blazer2.png" alt="">
                </div>
            </div>
        </section>

        <!-- PRODUCTOS -->
        <section id="productos" class="productos">
            <h2 class="subtitulo-seccion">Nuevos Lanzamientos</h2>

            <div class="fila">
                <?php
                // Consulta para obtener todos los productos agregados
                $result = $conn->query("SELECT * FROM tenis_snk");

                // Verificar si hay productos
                if ($result->num_rows > 0) {
                    // Recorrer los resultados y mostrar cada producto
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col fondo-dots producto">
                            <header>
                                <span class="like"><a href="favoritos.php?producto=<?php echo $row['id']; ?>"><i class="fa-solid fa-heart"></i></a></span>
                                <span class="cart"><a href="carrito.php?producto=<?php echo $row['id']; ?>"><i class="fa-solid fa-bag-shopping"></i></a></span>
                            </header>
                            <a href="#">
                                <div class="contenido">
                                    <div class="fondo orange <?php echo $row['category']; ?>">
                                        <div class="circulo"></div>
                                    </div>
                                    <img src="img/<?php echo $row['image']; ?>" alt="">
                                    <h2><?php echo $row['name']; ?></h2>
                                    <h2>$<?php echo $row['price']; ?></h2>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    // Mostrar un mensaje si no hay productos agregados
                    echo "No hay productos agregados";
                }
                ?>
            </div>
            <!-- Mensaje de no hay productos relacionados -->
            <div class="subtitulo-seccion" id="mensajeNoProductos" style="display: none;">
                <p>Lo sentimos, no hay productos relacionados.</p>
            </div>
        </section>
    </section>
</div>

<script src="script.js"></script>

<script>
    function buscarProductos() {
        // Obtener el valor ingresado en el campo de búsqueda
        var palabraClave = document.getElementById('inputBusqueda').value.toLowerCase();

        // Obtener la lista de productos
        var productos = document.getElementsByClassName('producto');

        // Obtener el elemento del mensaje
        var mensajeNoProductos = document.getElementById('mensajeNoProductos');

        // Inicializar una variable para rastrear si se encuentra algún producto
        var seEncontroProducto = false;

        // Iterar sobre los productos y mostrar/ocultar según la palabra clave
        for (var i = 0; i < productos.length; i++) {
            var nombreProducto = productos[i].getElementsByTagName('h2')[0].innerText.toLowerCase();

            // Verificar si la palabra clave está presente en el nombre del producto
            if (nombreProducto.includes(palabraClave)) {
                productos[i].style.display = 'block';  // Mostrar el producto
                seEncontroProducto = true;
            } else {
                productos[i].style.display = 'none';   // Ocultar el producto
            }
        }

        // Mostrar u ocultar el mensaje según si se encontró algún producto
        mensajeNoProductos.style.display = seEncontroProducto ? 'none' : 'block';
    }
</script>


</body>
</html>