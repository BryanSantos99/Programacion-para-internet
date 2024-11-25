<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "conecta.php";
    $con=conecta();

    $codigo=$_REQUEST['codigo'];
    $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
    $res=$con->query($sql);
    $ban=0;

    if ($res->num_rows>0){
        $ban=1;
        echo "$ban";
    }else{
        echo "$ban";
    }
    mysqli_close($con);




?>