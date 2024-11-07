<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        require "funciones/conecta.php";
        $con = conecta();
        session_start()
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <h1>logo</h1>
        <ul>
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </ul>
    </nav>
    <main>
        <div id="promocion">
            <?php
                $sql = "SELECT * FROM promociones WHERE id = FLOOR(1 + RAND() * (10 - 1 + 1))";
                $res = $con->query($sql);
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $img = $row['archivo'];
                } else {
                    $img = null;
                }
            ?>
            <img src="promocionesf/<?php echo $img ?>" alt="">
        </div>
        <div id="productos">
            <?php
                for ($i=0; $i < 6; $i++) { 
                    $sql = "SELECT * FROM productos WHERE id = FLOOR(1 + RAND() * (6 - 1 + 1))";
                    $res = $con->query($sql);
                    $row = $res->fetch_assoc();
                    $id = $row['id'];
                    $img = $row['archivo_n'];
                    $name = $row['nombre'];
                    $cod = $row['codigo'];
                    $pre = $row['costo'];
                    echo '<div class="productos" id="producto-'.$id.'"><br>';
                    echo '<img src="productosf/'.$img.'"><br>';
                    echo '<a href="#">'.$name.'</a><br>';
                    echo '<p>Codigo:'.$cod.'</p><br>';
                    echo '<p>$'.$pre.'</p><br>';
                    if (isset($_SESSION['correo'])) {
                        echo '<botton>Agregar al carrito</botton>';
                    }
                }
            ?>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>