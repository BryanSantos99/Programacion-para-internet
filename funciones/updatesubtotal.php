<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";
    $con = conecta();
    session_start();
    $id_cliente = $_SESSION['id_usuario'];
    $id_producto = intval($_REQUEST['id']);
    $cantidad = intval($_REQUEST['cantidad']);
    

    
    $sql="SELECT * FROM pedidos_productos WHERE id_producto=$id_producto";
    $res = $con->query($sql);
    
    
    if (!$res) {
        echo "Error en la actualización: " . $con->error;
    } else {
        $p_p = $res->fetch_assoc();
        $cantidad=floatval($p_p['cantidad']);
        $precio=floatval($p_p['precio']);
        
        if ($cantidad > 0 && $precio > 0) {
            $subtotal=$cantidad*$precio;
            echo $subtotal;
        } else {
            echo "Cantidad o precio no válidos.";
        }
    }
    
    mysqli_close($con);
 
?>