<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
        font-family: 'Courier New', Courier, monospace;
        width: 300px;
        margin: 0 auto;
        padding: 10px;
        margin-top:20px;
        background-color: #f7f7f7;
        color: #333;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h3 {
        text-align: center;
        margin: 5px 0;
    }

    .ticket-header, .ticket-footer {
        
        text-align: center;
        border-bottom: 1px dashed #ddd;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .ticket-body {
        margin-top:20px;
        margin-bottom: 10px;
    }

    .ticket-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .ticket-info span {
        font-size: 12px;
    }

    .ticket-footer {
        border-top: 1px dashed #ddd;
        padding-top: 5px;
    }

    .important {
        font-weight: bold;
    }

    a {
        display: block;
        text-align: center;
        text-decoration: none;
        color: #007bff;
        margin-top: 10px;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "funciones/conecta.php";
$con = conecta();

$id = $_GET['id'];
$total = $_GET['total'];
echo $id;
$sql = "SELECT * FROM pedidos WHERE id = '$id'";
$res = $con->query($sql);
if ($res && $row2 = $res->fetch_array()) {
    $id_cliente = $row2['id_cliente'];
} else {
    echo "Pedido no encontrado.";
    exit;
}

$sql = "SELECT * FROM clientes WHERE id = '$id_cliente'";
$res = $con->query($sql);
if ($res && $row2 = $res->fetch_array()) {
    $nombre = $row2['nombre'];
    $apellidos = $row2['apellidos'];
    $correo = $row2['correo'];
} else {
    echo "Cliente no encontrado.";
    exit;
}
mysqli_close($con);

?>
<body>
   
<div class="ticket-header">
    <h2>Nombre de la Tienda</h2>
    <p>Dirección: Calle Ejemplo 123</p>
    <p>Teléfono: (555) 123-4567</p>
</div>

<div class="ticket-body">
    <div class="ticket-info">
        <span>ID Pedido:</span>
        <span class="important"><?= $id; ?></span>
    </div>
    <div class="ticket-info">
        <span>Cliente:</span>
        <span><?= $nombre . " " . $apellidos; ?></span>
    </div>
    
    <div class="ticket-info">
        <span>Correo:</span>
        <span><?= $correo; ?></span>
    </div>
</div>
<div class="ticket-info">
        <span>Total:</span>
        <span><?= "$" . $total; ?></span>
</div>
<div class="ticket-footer">
    <p>¡Gracias por su compra!</p>
    <p>Visítenos pronto.</p>
</div>
    <a href="index.php">Regresar</a>
</body>
</html>