<?php
include('../funciones/admi_con.php');
include('../funciones/admi_fun_admision.php');
$codigo = $_GET['codigo'];
generar_siga_zet($codigo);
$file='../exportar/siga.txt';
header("Content-disposition: attachment; filename=\"$file\"");
header("Content-type: application/octet-stream");
readfile($file);
?>