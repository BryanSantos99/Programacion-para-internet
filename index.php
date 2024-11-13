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
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="#">Home</a>
            <a href="productos.php">Productos</a>
            <a href="contacto.php">Contacto</a>
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
        <div id="promocion">
            <?php
                $sql = "SELECT * FROM promociones";
                $res = $con->query($sql);
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $img = $row['archivo'];
                    echo '<img src="promocionesf/' . $img . '" alt="Promoción">';
                }
            ?>
        </div>
        <div id="produ">
            <div id="productos">
            <?php
            for ($i = 1; $i <= 6; $i++){
                $sql = "SELECT * FROM productos LIMIT 6";
                $res = $con->query($sql);
                $row = $res->fetch_assoc();
                    $id = $row['id'];
                    $img = $row['archivo_n'];
                    $name = $row['nombre'];
                    $cod = $row['codigo'];
                    $pre = $row['costo'];
                    echo '<div class="producto" id="producto-'.$id.'"><br>';
                    echo '<a class ="imgproducto" href="https://www.google.com/"><img id="imgp'.$id.'" src="productosf/'.$img.'"></a><br>';
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
        </div>
    </main>
    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>
