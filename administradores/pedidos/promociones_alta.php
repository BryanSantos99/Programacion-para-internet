<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empleado_alta</title>
    <link rel="stylesheet" href="./style/empleados_alta.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
    <script>
    var confirm = 1;

    function recibe() {
        var nombre = $('#nombre').val();
       

        $('#mensaje').show();
        if ((nombre === ""|| archivo === "")) {
            console.log("Faltan campos");
            mostrarMensaje('#mensaje', 'Faltan Campos Por Llenar');
        } else {
            console.log("Enviando formulario");
            document.getElementById('form01').submit();
        }
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
            <li class="menu-item"><a href="../productos/productos_lista.php">Productos</a></li>
            <li class="menu-item"><a href="../promociones/promociones_lista.php">Promociones</a></li>
            <li class="menu-item"><a href="pedidos_lista.php">Pedidos</a></li>
            <li class="menu-item"><a href="../funciones/salir.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    <div id="contenedorPrincipal">
        <h1>Formulario</h1>
        <div id="formulario">
            <form id="form01" method="POST" action="funciones/promociones_salva.php" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" class="campos" placeholder="Ingresa tu Nombre"><br>
                <input type="file" id="archivo" name="archivo" accept="image/*" required><br><br>
                <input type="button" id="enviarBoton" value="Enviar" onclick="recibe();">
                <div id="mensaje"></div>
            </form>
        </div>
        <button id="regresarBoton" onClick="window.location.href='promociones_lista.php'">Regresar</button>
        <a id="botonInicio" href="../bienvenido.php">Volver al inicio</a>
    </div>
</body>

</html>
