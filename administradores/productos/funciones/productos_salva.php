<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require "conecta.php";

    $con = conecta();

    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    $archivo_n = '';
    $archivo = '';

    $file_name = $_FILES['archivo']['name'];
    $file_tmp = $_FILES['archivo']['tmp_name'];
    $arreglo = explode(".", $file_name);
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $dir = "/Applications/XAMPP/xamppfiles/htdocs/Programacion-para-internet/productosf/";

    
    if (!is_writable($dir)) {
        die("Error: No se tienen permisos para escribir en el directorio $dir");
    }

    if (file_exists($file_tmp)) {
        $file_enc = md5_file($file_tmp);
        $fileName1 = "$file_enc.$ext";
    
        $full_path = $dir . $fileName1;
        if(copy($file_tmp, $full_path)){
            $archivo_n = $file_name;
            $archivo = $fileName1;
        }
    } else {
        die("Error: El archivo temporal no existe.");
    }

    $sql = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_n, archivo)
            VALUES('$nombre', '$codigo', '$descripcion', '$costo', '$stock', '$archivo_n', '$archivo')";

    $res = $con->query($sql);

    mysqli_close($con);
  
    header("Location: ../productos_lista.php");
?>
