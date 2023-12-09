<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <style>
        /* Estilos para posicionar el formulario por encima */
        .formulario {
            position: relative;
            z-index: 1; /* Ajusta el valor de z-index según sea necesario */
            /* Agrega más estilos si es necesario */
        }

        /* Estilos para las cajas de respuesta */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
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
                <a href="index.php" class="selected">Inicio</a>
                <a href="productos.html">Productos</a>
                <a href="registro_admin.html">Administradores</a>
                <span id="close-responsive">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </nav>
            <div id="nav-responsive">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="carrito"></div>
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

            <section id="cuentas" class="dashboard">
                <div class="col fondo-dots">
                    <div class="formulario">
                        <?php
                        include('conection.php');
                        if (!empty($_GET['id'])) { 
                        ?>
                            <p>Los datos almacenados actualmente son:</p>
                            <?php  
                            $consulta = "SELECT *, rol FROM usuarios where ID=" . $_GET['id'];

                            $hazconsulta = mysqli_query($conn, $consulta) or die("No se pudo acceder a la BD");
                            $resul = mysqli_fetch_array($hazconsulta);
                            ?>

                            <form action="cambiardatos.php" method="post">

                                <input type="hidden" name="id" value="<?= $resul['id'] ?>">
                                <div class="form-group">
                                    <label for="nombreUsuario">Nombre de usuario:</label>
                                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?= $resul['usuario'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" class="form-control" id="contraseña" name="contrasena" value="<?= $resul['contrasena'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="correo">Correo electrónico</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= $resul['correo'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for= "rol">Rol:</label>
                                    <input type="text" class="form-control" id="rol" name="rol" value="<?= $resul['rol'] ?>">
                                </div>
                                <input type="submit" value="Guardar">

                            </form>
                            <?php
                            } else {
                            ?>
                                <p>No fue seleccionado algún registro para modificar.</p>
                            <?php } ?>
                    </div>
                </div>            
            </section>
        </section>
    </div>
</body>
</html>