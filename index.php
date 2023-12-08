<?php
session_start();
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
    <?php
    include 'header.php';
    ?>
    <!-- ENCABEZADO PRINCIPAL: LOGO MENU CARRITO -->

    <section class="contenedor-seccion">
        <div class="fondo-seccion"></div>

        <section id="inicio" class="inicio">
            <div class="col">
                <h2 class="titulo-inicio">Encuentra las zapatillas <br>
                    que buscas al mejor precio</h2>
                <div class="buscador">
                    <input type="text" placeholder="Qué estas buscando?">
                    <span class="btn-buscar"><i class="fa-solid fa-magnifying-glass"></i></span>
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
            <div class="fila">
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis1"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>
                    <a href="producto1.php">
                        <div class="contenido">
                            <div class="fondo orange">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/air.png" alt="">
                            <h2>Air Force 1 High'07</h2>
                            <h2>$2,899</h2>
                        </div>
                    </a>

                </div>
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis2"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>

                    <a href="producto2.html">
                        <div class="contenido">
                            <div class="fondo blue">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/hippie.png" alt="">
                            <h2>Nike Space Hippie</h2>
                            <h2>$2,300</h2>
                        </div>
                    </a>
                </div>
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis3"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>

                    <a href="#">
                        <div class="contenido">
                            <div class="fondo green">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/jordan.png" alt="">
                            <h2>Air Jordan 1 Hihg</h2>
                            <h2>$4,599</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="fila">
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis4"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>

                    <a href="#">
                        <div class="contenido">
                            <div class="fondo green">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/blazer.png" alt="">
                            <h2>Nike Blazer Mid'77 Vintage</h2>
                            <h2>$2,599</h2>
                        </div>
                    </a>
                </div>
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis5"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>

                    <a href="#">
                        <div class="contenido">
                            <div class="fondo orange">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/crater.png" alt="">
                            <h2>Nike Crater Impact</h2>
                            <h2>$2,300</h2>
                        </div>
                    </a>
                </div>
                <div class="col fondo-dots">
                    <header>
                        <span class="like"><a href="favoritos.php?producto=tenis1"><i class="fa-solid fa-heart"></i></a></span>
                        <span class="cart"><a href="carrito.php?producto=tenis6"><i class="fa-solid fa-bag-shopping"></i></a></span>
                    </header>

                    <a href="#">
                        <div class="contenido">
                            <div class="fondo blue">
                                <div class="circulo"></div>
                            </div>
                            <img src="img/dunk.png" alt="">
                            <h2>Nike Dunk Low Retro</h2>
                            <h2>$2,600</h2>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </section>
</div>

<script src="script.js"></script>
</body>
</html>
