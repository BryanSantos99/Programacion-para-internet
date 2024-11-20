<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";
    $con = conecta();
    session_start();
    $id_cliente = $_SESSION['id_usuario'];
    $id_pedido = intval($_REQUEST['pedido']);
    $total =0;
    

    
    $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
    $res2 = $con->query($sql2);
    
    
    if (!$res2) {
        echo "Error en la actualización: " . $con->error;
    } else {
        while ($productos_pedidos = $res2->fetch_array()) {
            $id_producto = $productos_pedidos["id_producto"];
            $sql3 = "SELECT * FROM productos WHERE id = $id_producto";
            $res3 = $con->query($sql3);
            $producto = $res3->fetch_array();
             
            $cantidad = (int)$productos_pedidos["cantidad"];
            $costo = (float)$producto["costo"];
            $subtotal = $costo * $cantidad;
            $total += $subtotal;
        }
        echo $total;
    }
    
    mysqli_close($con);
 
?>