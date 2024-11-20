<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";
    $con = conecta();
    session_start();
    $id_cliente = $_SESSION['id_usuario'];
    $id_pedido_producto = intval($_REQUEST['id']);


    
    $sql="SELECT cantidad precio FROM pedidos_productos WHERE id_producto=$id_producto";
    $res = $con->query($sql);
    $p_p = $res->fetch_assoc();
    $cantidad=floatval($p_p['cantidad']);
    $precio=floatval($p_p['precio']);
    $total=$cantidad*$precio;
    
    if (!$res5) {
        echo "Error en la actualización: " . $con->error;
    } else {

        echo $total;
    }
    
    mysqli_close($con);
 
?>