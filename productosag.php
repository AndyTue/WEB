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
            <a href="dashboard.html" class="selected">Inicio</a>
            <a href="productosag.php" >Productos</a>
            <a href="registro_admin.html">Administradores</a>
            <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
        </nav>
        <div id="nav-responsive">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="carrito">
            </a>
        </div>
    </header>

    <section class="contenedor-seccion">
        <div class="fondo-seccion"></div>
        <div class="header-seccion">
            <div class="col">
                <strong><span class="link-blanco">Administrador</span> / Inicio</strong>
            </div>
            <div class="centro">
                <h2>Administrador</h2>
            </div>
        </div>

        <section class="detalle-producto">
            <div class="fila">
                <section class="add-products">
                    <form enctype="multipart/form-data" action="procesar_agregar_producto.php" method="post">
                        <label for="product-name">Nombre del Producto:</label>
                        <input type="text" id="product-name" name="product-name" required>

                        <label for="product-price">Precio del Producto:</label>
                        <input type="number" id="product-price" name="product-price" step="0.01" required>

                        <label for="product-image">Imagen del Producto:</label>
                        <input type="file" id="product-image" name="product-image" accept="image/*" required>

                        <label for="product-description">Descripción del Producto:</label>
                        <textarea id="product-description" name="product-description" rows="4" required></textarea>

                        <label for="product-category">Categoría del Producto:</label>
                        <select id="product-category" name="product-category" required>
                            <option value="Caballero">Caballero</option>
                            <option value="Dama">Dama</option>
                            <option value="Niño">Niño</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>

                        <button type="submit">Agregar Producto</button>
                    </form>
                    <!--aquí debo poner el mensaje de agregado con exito-->
                </section>
            </div>
            <h2 class="subtitulo-seccion">Productos agregados</h2>

            <section id="productos" class="productos">
                <div class="fila">
                    <?php
                    include 'db_connection.php';
                    // Consulta para obtener los productos distintos
                    $result = $conn->query("SELECT DISTINCT * FROM tenis_snk");

                    // Verificar si hay productos
                    if ($result->num_rows > 0) {
                        // Recorrer los resultados y mostrar cada producto
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col fondo-dots">
                                <div class="contenido">
                                    <div class="fondo orange">
                                        <div class="circulo"></div>
                                    </div>
                                    <img src="img/<?php echo $row['image']; ?>" alt="">
                                    <h2><?php echo $row['name']; ?></h2>
                                    <h2>$<?php echo $row['price']; ?></h2>

                                    <!-- Modificado para usar un botón -->
                                    <form method="get" action="eliminar_producto.php" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn-eliminar-prod">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // Mostrar un mensaje si no hay productos
                        echo "No hay productos agregados";
                    }
                    ?>
                </div>
            </section>

        </section>
    </section>
</div>

<script src="script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-eliminar-prod');
        var mensajeProductoAgregado = document.getElementById('mensajeProductoAgregado');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                var confirmacion = confirm('¿Estás seguro de que quieres eliminar este producto?');
                if (!confirmacion) {
                    event.preventDefault(); // Evitar la eliminación si no se confirma
                } else {
                    mensajeProductoAgregado.style.display = 'block';
                    setTimeout(function () {
                        window.location.href = 'dashboard.html';
                    }, 2000); // Puedes ajustar el tiempo según tus preferencias
                }
            });
        });
    });
</script>
</body>
</html>