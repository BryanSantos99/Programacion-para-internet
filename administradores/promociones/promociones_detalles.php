<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="style/empleados_detalles.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
    <?php
        require "funciones/conecta.php";
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $id = $_GET['id'];
        $con = conecta();
        $sql = "SELECT * FROM promociones WHERE id = '$id'";
        $res = $con->query($sql);
        $row = $res->fetch_array();
        $nombre = $row['nombre'];
        $archivo_n = $row['archivo'];
        $con->close();
    ?>

</head>
<body>
    <?php
        session_start();
    ?>
<nav id="menu">
    <h1 id="titulo">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <ul id="menu-lista">
            <li class="menu-item"><a href="../empleados/empleados_lista.php">Empleados</a></li>
            <li class="menu-item"><a href="../productos/productos_lista.php">Productos</a></li>
            <li class="menu-item"><a href="promociones_lista.php">Promociones</a></li>
            <li class="menu-item"><a href="../pedidos/pedidos_lista.php">Pedidos</a></li>
            <li class="menu-item"><a href="../funciones/salir.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <div class="contenedor">
        <h1>Detalles de la Promoción</h1>
        <div class="detalles">
            <p class="registros"><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p class="registros"><strong>Foto:</strong> <img src="../../promocionesf/<?php echo $archivo_n; ?>" alt="Foto del producto"></p>
        </div>
        <a href="promociones_lista.php">Volver a la lista</a>
        <a id="botonInicio" href="../../bienvenido.php">Volver al inicio</a>
    </div>
</body>
</html>