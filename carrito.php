<?php
     session_start();
     if (!isset($_SESSION['correo'])) {
         header('Location:login.php');
         exit();
     }
?>
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
    <link rel="stylesheet" href="style/carrito.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <title>Carrito</title>
    <script>
        function actualizarCarrito(id_producto, cantidad){

            $.ajax({
                url: 'funciones/carritoAjaxUpdate.php',
                type: 'post',
                dataType: 'text',
                data: { id_producto: id_producto, cantidad: cantidad },
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
            <a href="contacto.php">Contacto</a>
            <?php
            echo '<a href="#">Carrito ('.$cantidad_productos .')</a>';
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
    <div class="container">
        <h1>Carrito de compras</h1>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Sub total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($productos_pedidos = $res2->fetch_array()) {
                    $id_producto = $productos_pedidos["id_producto"];
                    $sql3 = "SELECT * FROM productos WHERE id = $id_producto";
                    $res3 = $con->query($sql3);
                    $producto = $res3->fetch_array();
                
                    $nombre = htmlspecialchars($producto["nombre"], ENT_QUOTES, 'UTF-8');
                    $cantidad = (int)$productos_pedidos["cantidad"];
                    $costo = (float)$producto["costo"];
                    $subtotal = $costo * $cantidad;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td>$<?php echo number_format($costo, 2); ?></td>
                        <td>
                            <input onchange="actualizarCarrito(<?php echo $id_producto; ?>, this.value);" type="number" value="<?php echo $cantidad; ?>" min="1">
                        </td>
                        <td id="subtotal">$<?php echo number_format($subtotal, 2); ?></td>
                        <td><button class="btn btn-eli">Eliminar</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="actions">
            <a href="index.php" class="btn btn-re">&larr; Continuar Comprando</a>
            <div id="total">
                Total: $<span id="total"><?php echo number_format($total, 2); ?></span>
            </div>
            <a href="carrito2.php" class="btn btn-com">Continuar &rarr;</a>
        </div>
    </div>
</main>

    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>

