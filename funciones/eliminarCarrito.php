<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "conecta.php";
    $con = conecta();

    $id = $_POST['id'];


    
    $sql = "DELETE FROM pedidos_productos WHERE id_producto = $id";
        $res = $con->query($sql);

        if ($res) {
            
            echo 1;
        } else {
            echo 0;
        }
   

    mysqli_close($con);
?>
