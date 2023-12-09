
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


        <section class="contenedor-seccion">
            <div class="fondo-seccion"></div>
            <div class="header-seccion">
                <div class="col">
                    <strong><span class="link-blanco">Inicio</span> / Contacto</strong>
                </div>
                <div class="centro">
                    <h2>Contacto</h2>
                </div>
                <div class="col busqueda">
                    <strong> </strong> 
                </div>
            </div>

            <section class="contacto">
                <div class="fila">
                    <div class="col">
                        <form action="">
                            <input type="text" placeholder="Nombre">
                            <input type="text" placeholder="Correo">
                            <textarea name="" id="" placeholder="Mensaje"></textarea>
                            <button class="btn-contacto">Enviar</button>
                        </form>
                    </div>
                    <div class="col derecha">
                        <h2>CONTACTANOS <br>AHORA</h2>
                        <img src="img/nikeContacto.png" alt="">
                    </div>
                </div>
            </section>

        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>