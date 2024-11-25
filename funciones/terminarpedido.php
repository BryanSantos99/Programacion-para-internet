<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

     require "conecta.php";
     $con = conecta();

     $id = $_GET['id'];
     $total = $_GET['total']; 

     $sql="UPDATE pedidos SET estado = 1 WHERE id=$id";
     $res = $con->query($sql);

     header('Location: ../ticket.php?id='.$id.'&total='.$total.'');
?>