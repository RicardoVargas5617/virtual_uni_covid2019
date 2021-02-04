<?php
	$cn_zet = conectar();
	if (!isset($_POST["dni"]))
		{
			$mensaje = 'Se actualizaron las fotos';
			$pasa = 0;
		}
	else
		{
			$mensaje = 'Se grab&oacute; la informaci&oacute;n';
			$pasa = 1;
			$dni = $_POST["dni"];
			$per = $_POST["per"];
			$proceso = $_POST["proceso"];
			$codigo = $proceso.$dni;
		}

	if ($pasa == 1)
		{
			$zet = GL_DIR_FS_APP;	
			$max_size = 12000000;
			$status = "";
			$archivo = $_FILES['imgEst'];
			include(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');	
			#echo GL_DIR_FS_APP;
			#echo '<br>';
			#echo $destino= '../foto_ing_voucher/'.$dni.'.jpg';
			#exit;
			
			if ($archivo['size'] <= $max_size && $archivo['size'] > 0){
				########		
				// $rutadestino = $zet.'foto_voucher/thumb/';	
				// $destino= $zet.'/foto_voucher/'.$codigo.'.jpg';
				// $archivo1 = $_FILES['imgInp'];
				// #subirfoto_zet ($_FILES['imgInp'],$destino,$rutadestino);
				// include_once('admi_ing_subirfoto_1.php');
				########		
				$rutadestino = $zet.'foto_ing_firma/thumb/';	
				$destino= $zet.'/foto_ing_firma/'.$dni.'AP.jpg';
				$archivo3 = $_FILES['imgInp'];
				include_once('admi_ing_subirfoto_21.php');
				########
				########		
				$rutadestino = $zet.'foto_ing_firma/thumb/';	
				$destino= $zet.'/foto_ing_firma/'.$dni.'.jpg';
				$archivo2 = $_FILES['imgEst'];
				include_once('admi_ing_subirfoto_2.php');
				########
		
				#echo 'hola 1';
				if ($copied) {
					#####
					####maracar la subida
						#$vsql = "call zyz_CAConstancia (";	
						#$vsql = $vsql . " '0003',";
						#$vsql = $vsql . " '',";
						#$vsql = $vsql . " '". $per ."',";
						#$vsql = $vsql . " '',";
						#$vsql = $vsql . " '1',";
						#$vsql = $vsql . " 'F')";
						#echo $vsql;
						#exit;
						#$rs=mysqli_query($cn_zet, $vsql);
					#####
					#########
					$msg = 'Se subio el archivo correctamente.';
					json_encode(array('error'=>0,'mensaje'=>'Se grabo la informacion ingresada'));
					#echo 
				} else {
					$msg = 'Error!';
					json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #','mensaje'=>$msg));
					#echo 
				}
			}else {
				$msg = 'Tamano maximo es 2mb!';
				json_encode(array('error'=>1,'titulo'=>'Ocurrio un error #','mensaje'=>$msg));
				#echo;
			}	
		}
?>
<table>
    <tr>
        <td>            
            <a href="admi_inscripcion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>">
            <i class="fa fa-mail-reply"></i> 
            Regresar
            </a>
        </td>
    </tr>
    <tr>
    	<td>
        	<?php echo $mensaje;?>
        </td>
    </tr>
</table>



