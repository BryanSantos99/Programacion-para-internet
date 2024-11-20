<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $asunto = htmlspecialchars($_POST['asunto']);

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo electrónico es inválido.";
        exit;
    }

  
    $destinatario = "bryansantosgarcia41@gmail.com";
    $contenido = "Nuevo mensaje de contacto:\n\n";
    $contenido .= "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n";
    $contenido .= "Asunto: $asunto\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

   
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "Correo enviado con éxito.";
    } else {
        echo "Error al enviar el correo.";
    }
    header('Location: ../contacto.php');
}
?>
