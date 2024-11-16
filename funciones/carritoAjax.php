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

        $pedido = $res2->fetch_array();
        $id_pedido=$pedido['id'];

        $sql3 = "SELECT * FROM productos WHERE id = '$id_producto' AND eliminado = '0'";
        $res3 = $con->query($sql3);

        $producto = $res3->fetch_array();
        $precio_producto = $producto['costo'];

        $sql4 = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$id_pedido', '$id_producto', '1', '$precio_producto')";
        $res4 = $con->query($sql4);
    }
    echo " no puedo promgramar ";
?>