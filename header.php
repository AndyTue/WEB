<?php


// Función para verificar si el usuario ha iniciado sesión
function usuarioAutenticado() {
    return isset($_SESSION['token']); // Verificar la existencia del token en la sesión
}
?>

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

    <?php if(usuarioAutenticado()): ?>
        <!-- Si el usuario está autenticado, mostrar el botón de Cerrar Sesión -->
        <form action="logout.php" method="post"> <!-- Reemplaza esto con tu lógica real para cerrar sesión -->
            <button type="submit" class="btn-longin">Cerrar Sesión</button>
        </form>
    <?php else: ?>
        <!-- Si el usuario no está autenticado, mostrar el botón de Iniciar Sesión -->
        <a href="login.php" class="btn-longin">Iniciar Sesión</a>
    <?php endif; ?>

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