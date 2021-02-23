<?php

    include_once('ExamenVirtual.php');
    
    $data = json_decode($_POST['data']);

    if(isset($data->peticion)){
        
        $obj = new ExamenVirtual();

        if($data->peticion === 'LP'){
            $data_dni = $data->dni_postulantes;
            $res = $obj->traer_dni_veces($data_dni, '0019');
            echo json_encode($res['data']);
        }
        elseif ($data->peticion === 'LPD') {
            # code...
            $dni_pd = $data->dni_pd;
            $res = $obj->traer_postulante_detalles($dni_pd, '0019');
            echo json_encode($res['data']);
        }
        elseif ($data->peticion === 'CP') {
            # code...
            $dni_cp = $data->dni;
            $res = $obj->traer_programas_postulante($dni_cp, '0019');
            echo json_encode($res['data']);
            // echo json_encode(['dni'=>$data->dni, 
            //                 'v_abiertas'=>"word <br> paint <br> chrome",
            //                 'pinv_enproceso'=>"word <br> paint",
            //                 'tp_enproceso'=>"edge <br> viewre <br> so", 
            //                 'tp_instalados'=>"edge <br> tools <br> ect <br> etc",
            //                 'fecha_registro'=>"hoy"]);
        }
        
    }else{
        echo json_encode("error, no existe peticion");
    }



?>