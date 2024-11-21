<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        require "funciones/conecta.php";
        $con = conecta();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <title>Document</title>
    <script>
        function agregarCarrito(id_producto){
            console.log(id_producto,"puto");
            $.ajax({
            url: 'funciones/carritoAjax.php',
            type: 'post',
            dataType: 'text',
            data: {id_producto:id_producto},
            success: function(res) {
              console.log(res);
            },
            error: function() {
              console.log("error");
              $('#mensaje').html('Error archivo no encontrado').show();
              setTimeout(function() {
                $('#mensaje').html('').hide();
              }, 5000);
            }
          });
        }
    </script>
</head>
<body>
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
           
                $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT 6";
                $res = $con->query($sql);
                while($row = $res->fetch_assoc()){
                    $id_producto = $row['id'];
                    $img = $row['archivo_n'];
                    $name = $row['nombre'];
                    $cod = $row['codigo'];
                    $pre = $row['costo'];
                    echo '<div class="producto" id="producto-'.$id_producto.'"><br>';
                    echo '<a class ="imgproducto" href="https://www.google.com/"><img id="imgp'.$id_producto.'" src="productosf/'.$img.'"></a><br>';
                    echo '<a href="#">'.$name.'</a><br>';
                    echo '<p>Codigo: '.$cod.'</p>';
                    echo '<p>$'.$pre.'</p>';
                    if (isset($_SESSION['correo'])) {
                        echo '<button onclick="agregarCarrito('.$id_producto.')">Agregar al carrito</button>';
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
