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
        function actualizarCarrito(id_producto, cantidad,pedido){
            if (cantidad==0) {
                eliminarProducto(id_producto,pedido);
                consultar_total(pedido);
            }else{
            $.ajax({
                url: 'funciones/carritoAjaxUpdate.php',
                type: 'post',
                dataType: 'text',
                data: { id_producto: id_producto, cantidad: cantidad },
                success: function(res) {
                    console.log(res);
                    consultar_subtotal(res,id_producto);
                    consultar_total(pedido);
                },
                error: function(res) {
                    console.log("error",res);
                    $('#mensaje').html('Error archivo no encontrado').show();
                    setTimeout(function() {
                        $('#mensaje').html('').hide();
                    }, 5000);
                }
            });
        }
        }
        function consultar_subtotal(c,id){
            
            $.ajax({
            url: 'funciones/updatesubtotal.php',
            data:{cantidad:c,id:id},
            type: 'POST',
            dataType: 'text',
            success: function(data) {
                console.log(data);
            document.getElementById("subtotal-"+id).innerHTML ='$'+data;
            
            }, error: function(data){
                data=0
                document.getElementById("subtotal-"+id).innerHTML ='$'+data;
            }

            });

        }
        function consultar_total(pedido){
            $.ajax({
            url: 'funciones/updatTotal.php',
            data:{pedido:pedido},
            type: 'POST',
            dataType: 'text',
            success: function(data) {
            document.getElementById("total").innerHTML = data;
            },error: function(data){
                data=0
                document.getElementById("total").innerHTML ='$'+data;
            }

            });

        }
        function eliminarProducto(id,pedido) {
    
            var cantidad = $('#cantidad-'+id).val();

            if (confirm("¿Desea eliminar el Producto con id " + id + "?")) {
                $.ajax({
                    url: 'funciones/eliminarCarrito.php',
                    type: 'POST',
                    data: { id: id ,cantidad:cantidad},
                    success: function(response) {
                        if (response) {
                            console.log(response);
                            $("#producto-"+id).hide();
                            consultar_total(pedido);
                           
                        }else{
                            document.getElementById("subtotal-"+id).innerHTML ='$'+cantidad;
                        }
                    },
                    error: function() {
                        alert("Hubo un error al intentar eliminar al producto.");
                        console.log(error);
                    }
                });
            } else {
                return;
            }
        }
    </script>
</head>
<body>
    <?php
        
        $sql = "SELECT * FROM pedidos WHERE id_cliente = '".$_SESSION['id_usuario']."' AND estado = 0";
        $res = $con->query($sql);
        if (!$res || $res->num_rows == 0) {
            $id_pedido = null;
            $cantidad_productos = 0;
            $res2 = null;
        } else {
            $pedido = $res->fetch_array();
            $id_pedido = $pedido["id"];
            
            $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
            $res2 = $con->query($sql2);
           
            $cantidad_productos = $res2->num_rows;
        }
        

    ?>
    <nav>
        <h1 id="logo">logo</h1>
        <ul>
            <a href="index.php">Home</a>
            <a href="productos.php">Productos</a>
            <a href="contacto.php">Contacto</a>
            <?php
            echo '<a href="#">Carrito</a>';
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
    <?php
        $total = 0;
        if ($res2 != null){
        if  ($cantidad_productos >0){
            ?>
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
                        <tr  id="producto-<?php echo $id_producto; ?>">
                            <td><?php echo $nombre; ?></td>
                            <td>$<?php echo number_format($costo, 2); ?></td>
                            <td>
                                <input id="cantidad-<?php echo $id_producto; ?>" onchange="actualizarCarrito(<?php echo $id_producto; ?>, this.value,<?php echo $id_pedido; ?>);" type="number" value="<?php echo $cantidad; ?>" min="1">
                            </td>
                            <td id="subtotal-<?php echo $id_producto; ?>">$<?php echo $subtotal; ?></td>
                            <td><button class="btn btn-eli" onclick="eliminarProducto(<?php echo $id_producto; ?>,<?php echo $id_pedido; ?>)">Eliminar</button></td>
                        </tr>
                    <?php } ?>
                
              
            </tbody>
        </table>

        <div class="actions">
            <a href="index.php" class="btn btn-re">&larr; Continuar Comprando</a>
            <div class="total">Total: <span id="total">$<?php echo $total; ?></span></div>
            
            <a href="carrito2.php" class="btn btn-com">Continuar &rarr;</a>
        
    </div>
    <?php }else{
        echo '<h1 class="vc">Carrito vacío</h1>';
    } }else {
            echo '<h1 class="vc">Carrito vacío</h1>';
            } ?>
</main>

    <footer>
        <p id="derechos">@Derechos reservados</p>
    </footer>
</body>
</html>

