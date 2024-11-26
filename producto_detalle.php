<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/productos_detalles.css">
    <link rel="stylesheet" href="style/productos_detalles2.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require "funciones/conecta.php";
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT * FROM productos WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['costo'];
        $stock = $row['stock'];
        $archivo_n = $row['archivo'];
        $con->close();  
    ?>
</body>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="#">Home</a>
            <a href="productos.php">Productos</a>
            <a href="contacto.php">Contacto</a>
            <?php
            if (!isset($_SESSION['correo'])) {
                echo '<a href="carrito.php">Carrito</a>';
            }else{
                echo '<a href="carrito.php">Carrito</a>';
            }
            ?>
            
            <?php
            if (!isset($_SESSION['correo'])) {
                echo '<a href="login.php">Iniciar Sesión</a>';
            } else {
                echo '<a href="funciones/salir.php">Cerrar Sesión</a>';
            }
            ?>
        </ul>
    </nav>
    <main>
    <div class="contenedor">
        <h1>Detalles del Producto</h1>
        <div class="detalles">
            <p class="registros"><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p class="registros"><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
            <p class="registros"><strong>Precio:</strong> <?php echo $precio; ?></p>
            <p class="registros"><strong>Stock:</strong> <?php echo $stock; ?></p>
            <p class="registros"><strong>Foto:</strong> <img src="productosf/<?php echo $archivo_n; ?>" alt="Foto del Producto"></p>
        </div>
        <a id="botonInicio" href="index.php">Volver al inicio</a>
    </div>
    </main>
    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</html>