<?php

    function generar_codigo_u($codigo_sistema){
        $codigo_num = substr($codigo_sistema, -5);
        $digito_para = genera_digito($codigo_num);
        $codigo = $codigo_num . obtener_caracter($digito_para);        
        return "{$codigo}";
    }

    function genera_digito($codigo){
        $codigo = str_split($codigo);
        $suma=0;
        foreach ($codigo as $num){
            $suma += intval($num);
        }
        $num_para = $suma*19;
        return substr($num_para,-1);;
    }


    function obtener_caracter($num_caracter){
        $char="A";
        switch ($num_caracter) {
            case '0':
                $char="A";
                break;            
            case '1':
                $char="B";
                break;
            case '2':
                $char="C";
                break;
            case '3':
                $char="D";
                break;
            case '4':
                $char="E";
                break;
            case '5':
                $char="F";
                break;
            case '6':
                $char="G";
                break;
            case '7':
                $char="H";
                break;
            case '8':
                $char="I";
                break;
            case '9':
                $char="J";
                break;

            default:
                # code...
                $char = "K";
                break;
        }

        return $char;
    }


?>