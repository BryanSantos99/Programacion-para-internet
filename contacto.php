<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        require "funciones/conecta.php";
        $con = conecta();
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/contacto.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Document</title>
</head>
<body>
<?php
        
        $sql = "SELECT * FROM pedidos WHERE estado = 0";
        $res = $con->query($sql);
        $pedido = $res->fetch_array();
        $id_pedido=$pedido["id"];
        
        $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
        $res2 = $con->query($sql2);
       
        $cantidad_productos = $res2->num_rows;

    ?>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="index.php">Home</a>
            <a href="productos.php">Productos</a>
            <a href="#">Contacto</a>
            <?php
            echo '<a href="carrito.php">Carrito</a>';
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
        <div id="contenedor">
            <form action="funciones/enviarcorreo.php" method="get">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre"><br>
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo">
                <label for="Asunto">Asunto:</label>
                <input type="text" name="asunto" id="asunto"><br>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </main>
    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>
