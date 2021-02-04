<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$procesogeneral = substr($codigo,0,4);
	$proceso = substr($codigo,4,4);
	$postulante = substr($codigo,8,7);	
	
	$nombreproceso = nombreproceso($proceso);
	$vsql = "call zyz_CAConstancia ('". $procesogeneral . "', '". $proceso . "','". $postulante . "','','','I')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$numerodocumento = $row["numerodocumento"];
			$apellidos = $row["apellidos"];
			$nombres = $row["nombres"];
			$escuela = $row["escuela"];
			$modalidad = $row["modalidad"];
			$puntaje = $row["puntaje"];
			$res = $row["res"];
			$resoluciongeneral = $row["resoluciongeneral"];
			$fechita = $row["fechita"];
			$responsable = $row["responsable"];
			$descripcion = $row["descripcion"];
			$moda = $row["moda"];
			mysqli_data_seek($rs,0);
		}	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>EXAMEN</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 12px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
.zet9 {
	font-size: 11px;
}
.zet16 {
	font-size: 16px;
	font-weight:bold;
}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight=0 marginwidth=0>
<table width="750" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20%" align="center">
        	<img src="../imageneszet/unat.png" width="120" />
        </td>
        <td align="center">
        	<span style="font-size:26px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas
            <br>
            "Daniel Hern&aacute;ndez Morillo"
            </span>
            <br>
            <span style="font-size:18px;">
            LEY DE CREACI&Oacute;N Nro. 29716
          </span>
            <br>
<span style="font-size:9px;">
            RESOLUCI&Oacute;N DEL CONSEJO DIRECTIVO Nro. 016-2019-SUNEDU/CD (RESOLUCI&Oacute;N DE LICENCIA INSTITUCIONAL)
<br>
RESOLUCI&Oacute;N DE COMISI&Oacute;N ORGANIZADORA Nro. 046-CO-UNAT (APROBACI&Oacute;N DEL REGLAMENTO GENERAL DE ADMISI&Oacute;N-2019-1)
<br>
RESOLUCIÓN DE COMISI&Oacute;N ORGANIZADORA Nro. <?php echo $resoluciongeneral ;?> (APROBACI&Oacute;N DEL MODELO DE CONSTANCIA DE INGRESO)
            </span>
        </td>
	</tr>
</table>
<br>
<br>
<br>
<table width="750">
	<tr>
    	<td align="center">
<span style="font-size:24px; font-weight:bold">
            CONSTANCIA DE INGRESO
            </span>
        </td>
    </tr>
    <tr>
    	<td align="center">
<span style="font-size:24px; font-weight:bold">
            <?php echo $descripcion;?>
            </span>
        </td>
    </tr>
</table>
<br>
<br>
<table width="750" border="0">
	<tr height="60">
    	<td align="center" width="20%">
        	<span style="font-size:16px; font-weight:bold">
            C&Oacute;DIGO DE POSTULANTE (DNI)
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php echo $numerodocumento; ?>
            </span>
        </td>
        <td width="20%" rowspan="3"  align="center">
        	<table width="80%" style="border:dotted">
            	<tr height="130">
                	<td width="100%">&nbsp;
                    	
                    </td>
                </tr>
            </table>
            FOTO
        </td>
    </tr>
    <tr height="60">
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold">
            NOMBRES
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php echo $nombres; ?>
            </span>
        </td>
    </tr>
    <tr height="60">
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold">
            APELLIDOS
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php echo $apellidos; ?>
            </span>
        </td>
    </tr>
    <tr height="60">
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold">
            CARRERA PROFESIONAL
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php echo $escuela; ?>
            </span>
        </td>
        <td rowspan="3"  align="center">
        	<table width="80%" style="border:dotted">
            	<tr height="130">
                	<td width="100%">&nbsp;
                    	
                    </td>
                </tr>
            </table>
            HUELLA DIGITAL
        </td>
    </tr>
    <tr height="60">
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold">
            MODALIDAD
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php echo $modalidad; ?>
            </span>
        </td>
    </tr>
    <?php 
	if($proceso<>'0014')
		{
			echo '<tr height="60">';
				echo '<td align="center">';
					echo '<span style="font-size:16px; font-weight:bold">';
					echo 'PUNTAJE';
					echo '</span>';
				echo '</td>';
				echo '<td>';
					echo '<span style="font-size:16px;">';
						echo $puntaje;
					echo '</span>';
				echo '</td>';
			echo '</tr>';			
		}
    ?>
    <tr height="60">
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold">
            RESOLUCI&Oacute;N Nro.
            </span>
        </td>
        <td>
        	<span style="font-size:16px;">
        	<?php 	
				echo $res;			
			?>
            </span>
        </td>
        <td  align="center">        
        </td>
    </tr>
</table>
<br>
<br>
<table width="750">
	<tr>
    	<td align="right">
        	<span style="font-size:16px;">
        	Pampas, <?php echo $fechita; ?>.
            </span>
        </td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="750">
	<tr>
		<td width="25%">
        	&nbsp;;
        </td>
		<td align="center" style="border-top-style:dotted; border-top-width:medium">
        	<span style="font-size:16px;">
        	<?php echo $responsable; ?>
            </span>
        </td>
		<td width="25%">&nbsp;
        	
        </td>
    </tr>
    <tr>
		<td>&nbsp;
        	
        </td>
		<td align="center">
        	<span style="font-size:14px; font-weight:bold">
        	DIRECTOR DE ADMISI&Oacute;N
            </span>
        </td>
		<td>&nbsp;
        	
        </td>
    </tr>
</table>

</body>
</html>