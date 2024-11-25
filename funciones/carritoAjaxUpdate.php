<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";
    $con = conecta();
    session_start();
    $id_cliente = $_SESSION['id_usuario'];
    $id_producto = intval($_REQUEST['id_producto']);
    $cantidad = intval($_REQUEST['cantidad']);
    $nueva_cantidad = 0;

    $sql8 = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND estado = '0' ";
    $res8 = $con->query($sql8);
    $pedido = $res8->fetch_array();
    $id_pedido = $pedido['id'];

    $sql6 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido' and id_producto='$id_producto'";
    $res6 = $con->query($sql6);
    $pedido_pro = $res6->fetch_array();
    $cantidad_pedido = intval($pedido_pro['cantidad']);

    if ($cantidad > $cantidad_pedido) {
        $nueva_cantidad = $cantidad - $cantidad_pedido;
    } else {
        $nueva_cantidad = $cantidad - $cantidad_pedido;;
    }

    $sql7 = "SELECT * FROM productos WHERE id = $id_producto";
    $res7 = $con->query($sql7);
    $producto = $res7->fetch_array();
    $stock = intval($producto['stock']);

    if ($nueva_cantidad < $stock) {
        $sql_stock = "UPDATE productos SET stock = stock - $nueva_cantidad WHERE id = '$id_producto'";
        $res_stock = $con->query($sql_stock);
        $sql5 = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_producto='$id_producto'";
        $res5 = $con->query($sql5);
    } else {
        echo "no hay stock";
    }

    if (!$res5) {
        echo "Error en la actualización: " . $con->error;
    } else {
        echo "Actualización exitosa";
    }

    mysqli_close($con);
?>