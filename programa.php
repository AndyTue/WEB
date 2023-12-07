<!DOCTYPE htmL>
<html lang='es'>
    <head>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="estilo.css" type="text/CSS">
        <title>Estructura básica de una página web en HTMLS</title>
  

    </head>
    <body>
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

    <aside>
        <p>Bienvenido</p>
    </aside>
    <header>
        <nav>
            <ul>
                <li><a href='listaUsuarios.php'>Lista usuarios</a></li>
                <li><a href='registro.html'>Registra usuario</a></li>

            </ul>
        </nav>
    </header>
    </body>
</html>
