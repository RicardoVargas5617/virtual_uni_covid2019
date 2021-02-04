<?php

    include_once('ExamenVirtual.php');
    
    $data = json_decode($_POST['data']);

    if(isset($data->peticion)){
        
        $obj = new ExamenVirtual();

        if($data->peticion === 'LP'){
            $data_dni = $data->dni_postulantes;
            $res = $obj->traer_dni_veces($data_dni, '0015');
            echo json_encode($res['data']);
        }
        elseif ($data->peticion === 'LPD') {
            # code...
            $dni_pd = $data->dni_pd;
            $res = $obj->traer_postulante_detalles($dni_pd, '0015');
            echo json_encode($res['data']);
        }
        
    }else{
        echo json_encode("error, no existe peticion");
    }



?>