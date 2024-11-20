<html>
<head>
    <title>Listado de productos</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/menu.css">
    <style>
        .botonCrear,
.boton,
button.boton {
  display: inline-block;
  padding: 10px 20px;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 10px;
  border: none;
  cursor: pointer;
}

.botonCrear {
  background-color: #007bff;
}

.boton,
button.boton {
  background-color: #4CAF50;
}

.boton:hover,
.botonCrear:hover,
button.boton:hover {
  opacity: 0.9;
}

.boton-editar,
button.boton-editar { 
  background-color: #2196F3; 
}
    </style>
    <script>
        function eliminarProducto(idProducto) {
            if (confirm("¿Desea eliminar el producto con id " + idProducto + "?")) {
                $.ajax({
                    url: 'funciones/productos_elimina.php',
                    type: 'POST',
                    data: { id: idProducto },
                    success: function(response) {
                    if (response == 1) {
                        alert("Producto eliminado correctamente.");
                        $("#producto-" + idProducto).hide();
                    } else {
                        alert("No se pudo eliminar al empleado.");
                    }
                },
                error: function() {
                    alert("Hubo un error al intentar eliminar al producto.");
                    console.log(error);
                }
                });
            }
        }
        function editarProducto(idProducto) {
            window.location.href = 'productos_edita.php?id=' + idProducto;
        }
        function verProducto(idProducto) {
            window.location.href = 'productos_detalles.php?id=' + idProducto;
        }
    </script>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['correo'])) {
            header('Location: index.php');
            exit();
        }

    ?>
    <nav id="menu">
        <h1 id="titulo">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <ul id="menu-lista">
            <li class="menu-item"><a href="empleados_lista.php">Empleados</a></li>
            <li class="menu-item"><a href="#">Productos</a></li>
            <li class="menu-item"><a href="#">Promociones</a></li>
            <li class="menu-item"><a href="#">Pedidos</a></li>
            <li class="menu-item"><a href="funciones/salir.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <div class="contenedor">
        <?php
    
            require "funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT * FROM productos WHERE eliminado = 0";
            $res = $con->query($sql);
            $cantidad_productos = $res->num_rows;
        ?>
        <h1>Listado de Productos (<?php echo $cantidad_productos; ?>)</h1>
        
        <div class="tabla">
            <table>
                <div id="registros">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Costo</th>
                        <th>stock</th>
                        <th>Ver detalles</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </div>
                <div id="tuplas">
                    <?php
                        
                        while ($row = $res->fetch_array()) {
                            $id = $row["id"];
                            $nombre = $row["nombre"];
                            $costo = $row["costo"];
                            $codigo = $row["codigo"];
                            $stock = $row["stock"];
                            echo '<tr  id="producto-'.$id.'">';
                            echo "<td>$id</td>";
                            echo "<td>$nombre</td>";
                            echo "<td>$codigo</td>";
                            echo "<td>$costo</td>";
                            echo "<td>$stock</td>";
                            echo '<td><button class="boton" onclick="verEmpleado(' . $id . ')">Ver Detalles</button></td>'; 
                            echo '<td><button class="boton boton-editar" onclick="editarEmpleado(' . $id . ')">Editar Registro</button></td>';
                            echo '<td><button class="boton boton-eliminar" onclick="eliminarEmpleado(' . $id . ')">Eliminar Registro</button></td>';
                            echo "</tr>";
                        }
                    ?>
                </div>
            </table>
            <div class="registro">
            <a href="productos_alta.php" class="botonCrear">Crear nuevo registro</a>
            <a href="bienvenido.php" class="botonCrear">Volver al inicio</a>
        </div>
        </div>
    </div>
</body>
</html>
