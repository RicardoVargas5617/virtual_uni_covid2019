<?php
    
    include_once('ExamenVirtual.php');
    
    $data = json_decode($_POST['data']);
    $dni = $data->dni;
    $nombre = $data->nombre;
    $tipo = $data->tipo;
    $proceso = $data->proceso;


    $obj = new ExamenVirtual();
    
    //insertando cambiode ventana
    $obj->insertar_cambio($dni, $nombre, $tipo, $proceso);
    
    echo json_encode("response 333 ->" . $data->dni);

?>