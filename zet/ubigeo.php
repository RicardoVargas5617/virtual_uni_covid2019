<?php
include_once '../funciones/admi_con.php';
$cn=conectar();
foreach ($_REQUEST as $key=>$valor){
    $$key=$valor;
}
$vsql="SELECT $nombre,descripcion FROM mae_ubigeo WHERE 
        departamento='$dep' ";
        if($nombre!='provincia') {
           $vsql.= "and provincia='$prov' ";
        }else{
            $vsql.= "and provincia<>'00' ";
        }
        if($nombre!='distrito'){
            $vsql.=" and distrito='$dist'";
        }else{
            $vsql.=" and distrito<>'00'";
        }
 $vsql.=" order by 2";
       /* if($nombre=='distrito'){
            echo $vsql;
        }*/
$rs=mysqli_query($cn,$vsql);
$data=array();
$i=0;
while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC)){
    $data[$row[$nombre]]=$row['descripcion'];
}
asort($data);
echo json_encode($data);