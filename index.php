<?php
    session_start();
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
                <a href="login.html">Iniciar sesión</a>
                <a href="favoritos.php">Favoritos</a>
                <!-- icono cerrar menu responsive -->
                <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </nav>
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

        // Iterar sobre los productos y mostrar/ocultar según la palabra clave
        for (var i = 0; i < productos.length; i++) {
            var nombreProducto = productos[i].getElementsByTagName('h2')[0].innerText.toLowerCase();

            // Verificar si la palabra clave está presente en el nombre del producto
            if (nombreProducto.includes(palabraClave)) {
                productos[i].style.display = 'block';  // Mostrar el producto
            } else {
                productos[i].style.display = 'none';   // Ocultar el producto
            }
        }
    }
    </script>

</body>
</html>
