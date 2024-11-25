<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "conecta.php";
    $con = conecta();

    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    
  
    
    $file_name = $_FILES['archivo']['name'];
    $file_tmp = $_FILES['archivo']['tmp_name'];
    
    $sql = "SELECT * FROM promociones WHERE id = '$id'";
    $res = $con->query($sql);
    $row = $res->fetch_assoc();
    $archivo = $row['archivo'];

    if($file_name != ""){
        $arreglo = explode(".", $file_name);
        $len = count($arreglo);
        $ext = $arreglo[$len-1];
        $dir = "/Applications/XAMPP/xamppfiles/htdocs/Programacion-para-internet/promocionesf/";
        
        $nuevo_nombre = md5_file($file_tmp) . "." . $ext;
        $ruta_destino = $dir . $nuevo_nombre;
        
        if(copy($file_tmp, $dir.$nuevo_nombre)){
            $archivo = $nuevo_nombre;
            $archivo_n = $file_name;
            $sql = "UPDATE promociones SET nombre = '$nombre',archivo = '$archivo_n' WHERE id = '$id'";
            $res = $con->query($sql);
        } else {
            echo "Error al subir el archivo.";
            exit;
        }
    } else {
        $sql = "UPDATE promociones SET nombre = '$nombre' WHERE id = '$id'";
        $res = $con->query($sql);
    }

    mysqli_close($con);

    
?>
