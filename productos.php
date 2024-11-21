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
    <?php
        
        $sql = "SELECT * FROM pedidos WHERE estado = 0";
        $res = $con->query($sql);
        $pedido = $res->fetch_array();
        $id_pedido=$pedido["id"];
        
        $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
        $res2 = $con->query($sql2);
        $pedido_producto = $res2->fetch_array();
        $cantidad_productos = $res2->num_rows;

    ?> 
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/productos.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <title>Document</title>
</head>
<body>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="index.php">Home</a>
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
        <div id="titulo">
           <h1>Productos</h1>
        </div>
        <div id="produ">
        <div id="productos">
            <?php
    
            $sql = "SELECT * FROM productos WHERE eliminado = 0";
            $res = $con->query($sql);
            while($row = $res->fetch_assoc()){
                    $id = $row['id'];
                    $img = $row['archivo_n'];
                    $name = $row['nombre'];
                    $cod = $row['codigo'];
                    $pre = $row['costo'];
                    echo '<div class="producto" id="producto-'.$id.'"><br>';
                    echo '<a class ="imgproducto" href="google.com"><img id="imgp'.$id.'" src="productosf/'.$img.'"></a><br>';
                    echo '<a href="#">'.$name.'</a><br>';
                    echo '<p>Codigo: '.$cod.'</p>';
                    echo '<p>$'.$pre.'</p>';
                    if (isset($_SESSION['correo'])) {
                        echo '<button onclick="agregarCarrito('.$id.')">Agregar al carrito</button>';
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
