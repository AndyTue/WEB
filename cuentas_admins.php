<?php
require("conection.php");

$sql = "SELECT COUNT(*) AS total_administradores FROM usuarios"; // Ajusta la consulta según tu base de datos y tabla de administradores

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_administradores = $row['total_administradores'];
} else {
    $total_administradores = 0;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        .btn {
            display: block;
            margin: 5%; /* Margen superior e inferior de 20px, centrado horizontalmente */
            margin-left: auto;
            text-align: center;
        }

        table {
            margin-bottom: 5%;
            border-collapse: collapse; /* Combinar los bordes de las celdas */
            width: 100%;
        }

        th, td {
            padding: 10px; /* Agregar relleno a las celdas */
            text-align: left; /* Alinear el texto a la izquierda */
            border: 1px solid #ddd; /* Agregar bordes a las celdas */
        }

        th {
            background-color: #f2f2f2; /* Color de fondo para las celdas de encabezado */
        }

        /* Estilos para los enlaces */
        a {
            color: #333; /* Cambia el color del texto de los enlaces */
            text-decoration: none; /* Elimina el subrayado de los enlaces */
        }

        a:hover {
            color: #555; /* Cambia el color al pasar el ratón por encima */
        }

        a:visited {
            color: #777; /* Cambia el color de los enlaces visitados */
        }
    </style>

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
                    <?php if ($total_administradores > 0) { ?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Nombre de Usuario</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                            <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            require("conection.php"); //conecta con la BD
                    
                            $sql = "SELECT *, rol FROM usuarios";
                            $result = $conn->query($sql);

                            $contador = 1; // Contador para mostrar la posición en lugar del ID

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $contador . "</td>"; // Mostrar el contador en lugar del ID
                                echo "<td>" . $row['usuario'] . "</td>";
                                echo "<td>" . $row['correo'] . "</td>";
                                echo "<td>". $row['rol'] . "</td>";
                                echo "<td><a href='editarusuario.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminarusuario.php?id=" . $row['id'] . "'>Eliminar</a></td>";
                                echo "</tr>";
                                $contador++;
                            }
                            ?>
                        </table>
                    <?php } else { ?>
                        <p>No hay usuarios registrados.</p>
                    <?php } ?>
                    <a href="registro_admin.html" class="btn">Registrar administrador</a>
                </div>
            </section>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
