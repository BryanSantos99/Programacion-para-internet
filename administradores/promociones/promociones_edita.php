<!DOCTYPE html>
<html lang="es">
<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require "funciones/conecta.php";
    $con = conecta();

    $id = $_GET['id']; 

    $sql = "SELECT * FROM promociones WHERE id = '$id'";
    $res = $con->query($sql);
    $row = $res->fetch_array();

    $nombre = $row['nombre'];
    $archivo = $row['archivo'] ?? '';
    

    mysqli_close($con);

?>
<head>
    <meta charset="UTF-8">
    <title>Promociones_Edita</title>
    <link rel="stylesheet" href="style/empleados_alta.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
   
    <script>
        function recibe() {
        
            var nombre = $('#nombre').val();
            var archivo = $('#archivo').val();

            $('#mensaje').show();
            if (nombre === "") {
                console.log("Faltan campos");
                $('#mensaje').html('Faltan Campos Por Llenar');
                setTimeout(function () {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                }, 5000);
            } else {
                console.log("Enviando formulario");
                document.getElementById('form01').submit();
            }
        }

       
    </script>
</head>

<body>
<nav id="menu">
    <h1 id="titulo">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <ul id="menu-lista">
       
            <li class="menu-item"><a href="../empleados/empleados_lista.php">Empleados</a></li>
            <li class="menu-item"><a href="../productos/productos_lista.php">Productos</a></li>
            <li class="menu-item"><a href="promociones_lista.php">Promociones</a></li>
            <li class="menu-item"><a href="#">Pedidos</a></li>
            <li class="menu-item"><a href="funciones/salir.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <div id="contenedorPrincipal">
        <h1>Formulario Editar Promociones</h1>
        <div id="formulario">
            <form id="form01" method="POST" action="funciones/promociones_update.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" class="campos" placeholder="Ingresa el Nombre" value="<?php echo $nombre; ?>"><br>

                <label for="archivo">Archivo actual:</label><br>
                <img src="../../promocionesf/<?php echo $archivo; ?>" alt="Imagen actual" style="max-width: 200px;"><br>

                <label for="archivo">Cambiar archivo:</label><br>
                <input type="file" id="archivo" name="archivo" accept="image/*"><br><br>

                <input type="button" id="enviarBoton" value="Enviar" onclick="recibe();">
                <div id="mensaje"></div>
            </form>
        </div>
        <button id="regresarBoton" onClick="window.location.href='promociones_lista.php'">Regresar</button>
        <a id="botonInicio" href="../bienvenido.php">Volver al inicio</a>
    </div>
</body>

</html>
