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
    
    $sql5="UPDATE productos SET cantidad = $cantidad3 WHERE id_producto=$id_producto";
    $res5 = $con->query($sql5);

    $sql5="UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_producto=$id_producto";
    $res5 = $con->query($sql5);


    
    if (!$res5) {
        echo "Error en la actualización: " . $con->error;
    } else {
        echo "Actualización exitosa";
    }
    
    mysqli_close($con);
 
?>