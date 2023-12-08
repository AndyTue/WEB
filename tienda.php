<?php
session_start();
include 'db_connection.php';

// Obtener todas las categorías disponibles
$categorias_result = $conn->query("SELECT DISTINCT category FROM tenis_snk");
$categorias = array();
while ($categoria_row = $categorias_result->fetch_assoc()) {
    $categorias[] = $categoria_row['category'];
}

$categorias = array_unique($categorias); // Eliminar duplicados

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
        <header>
            <div class="logo-titulo">
                <a href="index.php">
                    <i class="fa-regular fa-circle-dot"></i>
                    <h1>SneakerBoutique</h1>
                </a>
            </div>
            <nav id="nav">
                <a href="index.php">Inicio</a>
                <a href="tienda.php" class="selected">Tienda</a>
             <!--   <a href="blog.html">Blog</a>-->
                <a href="contacto.php">Contacto</a>
                <a href="login.html">Iniciar sesión</a>
                <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </nav>
            <div id="nav-responsive">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="carrito">
                <a href="carrito.php"><!--Debe marcar el numero de productos dentro del carrito-->
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
                    <strong><span class="link-blanco">Inicio</span> / Tienda</strong>
                </div>
                <div class="centro">
                    <h2>Tienda</h2>
                </div>
                <!-- Agrega el atributo data-category a cada categoría -->
                <div class="col busqueda">
                    <strong>Resultados (1-6)</strong> 
                    <select id="filtro-categoria">
                        <option value="todos">Todos los productos</option>
                        <option value="caballero">Caballero</option>
                        <option value="dama">Dama</option>
                        <option value="niño">Niño</option>
                    </select>
                </div>
            </div>

            <section id="productos" class="productos">
                    <h2 class="subtitulo-seccion">Tienda</h2><br><br><br><br><br><br>

                    <?php
                // Recorrer manualmente las categorías y mostrar productos
                foreach ($categorias as $categoria) {
                    ?>
                    <h3><?php echo $categoria; ?></h3>
                    <div class="fila" data-category="<?php echo strtolower($categoria); ?>">
                        <?php
                        // Obtener productos para la categoría actual
                        $productos_result = $conn->query("SELECT * FROM tenis_snk WHERE category = '$categoria'");
                        
                        // Verificar si hay productos disponibles
                        if ($productos_result->num_rows > 0) {
                            while ($producto = $productos_result->fetch_assoc()) {
                                ?>
                                <div class="col fondo-dots">
                                    <header>
                                        <span class="like"><a href="favoritos.php?producto=<?php echo $producto['id']; ?>"><i class="fa-solid fa-heart"></i></a></span>
                                        <span class="cart"><a href="carrito.php?producto=<?php echo $producto['id']; ?>"><i class="fa-solid fa-bag-shopping"></i></a></span>
                                    </header>
                                    <a href="#">
                                        <div class="fondo <?php echo $producto['category']; ?>">
                                            <div class="circulo"></div>
                                        </div>
                                        <div class="contenido">
                                            <img src="img/<?php echo $producto['image']; ?>" alt="">
                                            <h2><?php echo $producto['name']; ?></h2>
                                            <h2>$<?php echo $producto['price']; ?></h2>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        } else {
                            // Mostrar un mensaje o contenido alternativo si no hay productos
                            ?>
                            <div class="col">
                                <p>No hay productos disponibles en esta categoría.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </section>
        </section>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Agrega un evento de cambio al menú desplegable
        document.getElementById("filtro-categoria").addEventListener("change", filtrarProductos);
        
        // Llama a la función de filtrado al cargar la página
        filtrarProductos();
    });

    function filtrarProductos() {
        // Obtiene el valor seleccionado en el menú desplegable
        var categoriaSeleccionada = document.getElementById("filtro-categoria").value;

        // Obtiene todos los elementos de productos
        var productos = document.querySelectorAll(".productos .fila");

        // Itera sobre cada producto y muestra u oculta según la categoría seleccionada
        productos.forEach(function(producto) {
            var categoriaProducto = producto.dataset.category.toLowerCase();

            if (categoriaSeleccionada === "todos" || categoriaSeleccionada === categoriaProducto) {
                producto.style.display = "flex"; // Muestra el producto
            } else {
                producto.style.display = "none"; // Oculta el producto
            }
        });
    }
</script>

    <script src="script.js"></script>
</body>
</html>
