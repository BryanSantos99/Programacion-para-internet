<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";
    $con = conecta();
    session_start();
    $id_cliente = $_SESSION['id_usuario'];
    $id_producto = $_REQUEST['id_producto'];
    $fecha_actual = date('Y-m-d');

    $sql = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND estado = '0' ";
    $res = $con->query($sql);
    $num = $res->num_rows;

    if ($num==0) {

        $sql = "INSERT INTO pedidos (fecha, id_cliente) VALUES ('$fecha_actual', '$id_cliente')";
        $res = $con->query($sql);

        $sql2 = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND estado = '0' ";
        $res2 = $con->query($sql2);
        
        $sql3 = "SELECT * FROM productos WHERE id = '$id_producto' AND eliminado = '0'";
        $res3 = $con->query($sql3);

        $producto = $res3->fetch_array();
        $precio_producto = $producto['costo'];

        $sql6 = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND estado = '0' ";
        $res6 = $con->query($sql6);
        $pedido = $res6->fetch_array();
        $id_pedido=$pedido['id'];

        $sql4 = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$id_pedido', '$id_producto', '1', '$precio_producto')";
        $res4 = $con->query($sql4);
        
       

    } else {
        $pedido = $res->fetch_array();
        $id_pedido=$pedido['id'];
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido=  $id_pedido  AND id_producto = $id_producto";
        $res = $con->query($sql);
        $num_producto = $res->num_rows;
        if($num_producto<1){
            
            $sql3 = "SELECT * FROM productos WHERE id = '$id_producto' AND eliminado = '0'";
            $res3 = $con->query($sql3);

            $producto = $res3->fetch_array();
            $precio_producto = $producto['costo'];

            $sql4 = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$id_pedido', '$id_producto', '1', '$precio_producto')";
            $res4 = $con->query($sql4);
            
            $sql_stock = "UPDATE productos SET stock = stock - 1 WHERE id = '$id_producto'";
            $con->query($sql_stock);
        }else{
            
            $sql5="UPDATE pedidos_productos SET cantidad = cantidad + 1 WHERE id_producto=$id_producto";
            $res5 = $con->query($sql5);
            $sql_stock = "UPDATE productos SET stock = stock - 1 WHERE id = '$id_producto'";
            $con->query($sql_stock);
            if (!$res5) {
                echo "Error al actualizar la cantidad: " . $con->error; 
            }
        }
    }
    echo $id_pedido;
    mysqli_close($con);
?>