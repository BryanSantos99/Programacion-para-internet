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
    <link rel="stylesheet" href="style/productos.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="index.php">Home</a>
            <a href="#">Productos</a>
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
        <div id="titulo">
           <h1>Productos</h1>
        </div>
        <div id="productos">
            <?php
            for ($i = 1; $i <= 53; $i++){
                $sql = "SELECT * FROM productos LIMIT 6";
                $res = $con->query($sql);
                $row = $res->fetch_assoc();
                    $id = $row['id'];
                    $img = $row['archivo_n'];
                    $name = $row['nombre'];
                    $cod = $row['codigo'];
                    $pre = $row['costo'];
                    echo '<div class="producto" id="producto-'.$id.'"><br>';
                    echo '<img id="imgp'.$id.'" src="productosf/'.$img.'"><br>';
                    echo '<a href="#">'.$name.'</a><br>';
                    echo '<p>Codigo: '.$cod.'</p>';
                    echo '<p>$'.$pre.'</p>';
                    if (isset($_SESSION['correo'])) {
                        echo '<button>Agregar al carrito</button>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </main>
    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>
