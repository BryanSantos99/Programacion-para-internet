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

    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $res = $con->query($sql);
    $row = $res->fetch_array();

    $nombre = $row['nombre'];
    $codigo = $row['codigo'];
    $descripcion = $row['descripcion'];
    $costo = $row['costo'];
    $stock = $row['stock'];
    $archivo = $row['archivo'] ?? '';
    

    mysqli_close($con);

?>
<head>
    <meta charset="UTF-8">
    <title>Empleado_Edita</title>
    <link rel="stylesheet" href="style/empleados_alta.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
   
    <script>
        function recibe() {
        
            var nombre = $('#nombre').val();
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();
            var archivo = $('#archivo').val();

            $('#mensaje').show();
            if (nombre === "" || codigo === "" || descripcion === "" || costo === "" || stock === "") {
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

        function coodigoAjax() {
            var codigoA = $('#codigo').val();

            $.ajax({
                url: 'funciones/codigoAjax.php',
                type: 'post',
                dataType: 'text',
                data: 'codigo=' + codigoA,
                success: function (res) {
                    console.log(res);
                    $('#mensajeCorreo').show();
                    if (res == 1) {
                        $('#mensajeCorreo').html('Codigo ' +codigoA+ ' Ya Registrado ');
                        setTimeout(function () {
                            $('#mensajeCorreo').html('');
                            $('#mensajeCorreo').hide();
                        }, 5000);
                        $('#codigo').val('');
                    } else {
                        $('#mensajeCorreo').hide();
                    }
                },
                error: function (res) {
                    console.log("Error en el sistema");
                    $('#mensajeCorreo').html('Error en el sistema');
                    setTimeout(function () {
                        $('#mensajeCorreo').html('');
                        $('#mensajeCorreo').hide();
                    }, 5000);
                }
            });
        }
    </script>
</head>

<body>
<nav id="menu">
    <h1 id="titulo">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <ul id="menu-lista">
            <li class="menu-item"><a href="../empleados/empleados_lista.php">Empleados</a></li>
            <li class="menu-item"><a href="productos_lista.php">Productos</a></li>
            <li class="menu-item"><a href="../promociones/promociones_lista.php">Promociones</a></li>
            <li class="menu-item"><a href="../pedidos/pedidos_lista.php">Pedidos</a></li>
            <li class="menu-item"><a href="../funciones/salir.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <div id="contenedorPrincipal">
        <h1>Formulario Editar Producto</h1>
        <div id="formulario">
            <form id="form01" method="POST" action="funciones/productos_update.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" class="campos" placeholder="Ingresa el Nombre" value="<?php echo $nombre; ?>"><br>

                <label for="codigo">Código:</label><br>
                <input type="text" id="codigo" name="codigo" class="campos" placeholder="Escribe el código" value="<?php echo $codigo; ?>" onblur="coodigoAjax()" value="<?php echo $codigo; ?>"><br>
                <div id="mensajeCorreo"></div>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" class="campos" placeholder="Ingresa la descripción"><?php echo $descripcion; ?></textarea><br>

                <label for="costo">Costo:</label><br>
                <input type="text" id="costo" name="costo" class="campos" placeholder="Ingresa el costo" value="<?php echo $costo; ?>"><br>

                <label for="stock">Stock:</label><br>
                <input type="number" id="stock" name="stock" class="campos" placeholder="Ingresa el stock" value="<?php echo $stock; ?>"><br>

                <label for="archivo">Archivo actual:</label><br>
                <img src="../../productosf/<?php echo $archivo; ?>" alt="Imagen actual" style="max-width: 200px;"><br>

                <label for="archivo">Cambiar archivo:</label><br>
                <input type="file" id="archivo" name="archivo" accept="image/*"><br><br>

                <input type="button" id="enviarBoton" value="Enviar" onclick="recibe();">
                <div id="mensaje"></div>
            </form>
        </div>
        <button id="regresarBoton" onClick="window.location.href='productos_lista.php'">Regresar</button>
        <a id="botonInicio" href="../bienvenido.php">Volver al inicio</a>
    </div>
</body>

</html>
