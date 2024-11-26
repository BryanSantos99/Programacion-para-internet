<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Producto_alta</title>
    <link rel="stylesheet" href="./style/productos_alta.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
    <script>
    var confirm = 1;

    function recibe() {
        var nombre = $('#nombre').val();
        var codigo = $('#codigo').val();
        var descripcion = $('#descripcion').val();
        var costo = $('#costo').val();
        var stock = $('#stock').val();
        var archivo = $('#archivo').val();
        
        $('#mensaje').show();
        if ((nombre === "" || codigo === "" || descripcion === "" || costo === "" || stock === "" || archivo === "") && confirm === 1) {
            console.log("Faltan campos");
            mostrarMensaje('#mensaje', 'Faltan Campos Por Llenar');
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

    function mostrarMensaje(elemento, mensaje) {
        $(elemento).html(mensaje).show();
        setTimeout(function () {
            $(elemento).html('').hide();
        }, 5000);
    }
</script>

</head>

<body>
    <?php
        session_start();
    ?>
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
        <h1>Formulario de Alta de Producto</h1>
        <div id="formulario">
            <form id="form01" method="POST" action="funciones/productos_salva.php" enctype="multipart/form-data">
                <label for="nombre">Nombre del Producto:</label><br>
                <input type="text" id="nombre" name="nombre" class="campos" placeholder="Ingresa el Nombre del Producto"><br>

                <label for="codigo">Código:</label><br>
                <input type="text" id="codigo" name="codigo" class="campos" onblur="coodigoAjax()" placeholder="Ingresa el Código del Producto"><br>
                <div id="mensajeCorreo"></div>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" class="campos" placeholder="Ingresa la descripción del Producto"></textarea><br>

                <label for="costo">Costo:</label><br>
                <input type="text" id="costo" name="costo" class="campos" placeholder="Ingresa el costo del Producto"><br>

                <label for="stock">Stock:</label><br>
                <input type="number" id="stock" name="stock" class="campos" placeholder="Ingresa el stock del Producto"><br>

                <label for="archivo">Archivo:</label><br>
                <input type="file" id="archivo" name="archivo" accept="image/*" required><br><br>
                
                

                <input type="button" id="enviarBoton" value="Enviar" onclick="recibe();">
                <div id="mensaje"></div>
            </form>
        </div>
        <button id="regresarBoton" onClick="window.location.href='productos_lista.php'">Regresar</button>
        <a id="botonInicio" href="bienvenido.php">Volver al inicio</a>
    </div>
</body>

</html>
