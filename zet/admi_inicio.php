<?php 
	#echo $proceso;
	if (!isset($proceso))
		{
			echo 'No tiene permisos';
			$exit;
		}

	#require_once("zet_seg.php");
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$vsql = "call zyz_MantenedorProceso_Calendario ('". $proceso . "', '1900-01-01','1900-01-01','','C')";	
	#echo $vsql;	
	$rs = mysqli_query($cnzet, $vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$fechainicio = $row["fechainicio"];
			$horainicio = $row["horainicio"];
			$fechafin = $row["fechafin"];
			$horafin = $row["horafin"];
			$mensaje = $row["mensaje"];
			mysqli_data_seek($rs,0);
		}	
	$nombreproceso = nombreproceso($proceso);
?>
<table width="100%">
	<tr>
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold;">BIENVENIDO <?php echo $nombreproceso;?></span>
        </td>
    </tr>
    <tr>
    	<td>
        	<br>
            <?php echo $mensaje;?>
        </td>
    </tr>
</table>