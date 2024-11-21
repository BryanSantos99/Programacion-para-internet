<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require "funciones/conecta.php";
        $con = conecta();

        $id = $_GET['id']; 

        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id'";
        $res = $con->query($sql);
        $row2 = $res->fetch_array();
        $id_cliente = $row2['id_cliente'];
        $id = $row2['id'];

        $sql = "SELECT * FROM clientes WHERE id = '$id_cliente'";
        $res = $con->query($sql);
        $row = $res->fetch_array();

        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $correo = $row['correo'];
        

        mysqli_close($con);

    ?>
</head>
<body>
    
</body>
</html>