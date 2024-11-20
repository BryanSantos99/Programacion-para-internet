<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header('Location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="empleados/style/main.css">
</head>
<body>
    <nav id="menu">
    <h1 id="titulo">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <ul id="menu-lista">
       
            <li class="menu-item"><a href="empleados/empleados_lista.php">Empleados</a></li>
            <li class="menu-item"><a href="productos/productos_lista.php">Productos</a></li>
            <li class="menu-item"><a href="#">Promociones</a></li>
            <li class="menu-item"><a href="#">Pedidos</a></li>
            <li class="menu-item"><a href="empleados/funciones/salir.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    
</body>
</html>
