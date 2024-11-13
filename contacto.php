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
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="index.php">Home</a>
            <a href="productos.php">Productos</a>
            <a href="#">Contacto</a>
            <a href="#">Carrito</a>
            <?php
            if (!isset($_SESSION['correo'])) {
                echo '<a href="#">Iniciar Sesión</a>';
            } else {
                echo '<a href="logout.php">Cerrar Sesión</a>';
            }
            ?>
        </ul>
    </nav>
    <main>
        <div id="contenedor">
            <form action="" method="get">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre"><br>
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo">
                <button type="submit">Enviar</button>
            </form>
        </div>
    </main>
    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>
