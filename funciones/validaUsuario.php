<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "conecta.php";
$con = conecta();

$ban = 0;
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];

$pass_enc = md5($pass);

$sql = "SELECT * FROM clientes WHERE correo = '$correo' AND pass='$pass_enc' AND eliminado= 0 ";
$res = $con->query($sql);
$num = $res->num_rows;
$usuario = $res->fetch_array();

if ($num > 0) {
    session_start();
   
    $_SESSION['correo'] = $usuario['correo'];
    $_SESSION['nombre_usuario'] = $usuario['nombre'];
    $_SESSION['id_usuario']=$usuario['id'];
    $_SESSION['tipo_usuario']='c';

    $ban = 1;
    echo "$ban";
} else {
    echo "$ban";
}

mysqli_close($con);
?>
