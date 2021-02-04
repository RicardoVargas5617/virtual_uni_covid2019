<?php  

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];


$destinatario = "gianmarcogarcia@unat.edu.pe";
$asunto = "hola de admision usuario: hoyoy contraseña:wfwefwefwe";

$carta = "De: $nombre \n";
$carta .= "Correo: $correo \n";
$carta .= "Telefono: $telefono \n";
$carta .= "Mensaje: $mensaje";



mail($destinatario, $asunto, $carta);
header('Location:index.php');
?>

