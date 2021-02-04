<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cnzet = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);	
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	$vsql = "call zyz_CAMantenedorPostulante ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','',0,0,'','','','','','','',0,0,0,0,0,'00','00','00','','',0,0,'','1','2','3','4','5','6','7','G')";	
	#echo $vsql;
	$rs = mysqli_query($cnzet,	$vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$postulante = $row["postulante"];
			$nombremodalidad = $row["nombremodalidadadmision"];
			$nombreescuela = $row["nombreescuela"];
			$apellidopaterno = $row["apellidopaterno"];
			$apellidomaterno = $row["apellidomaterno"];
			$nombre = $row["nombre"];
			$fechanacimiento = $row["fechanacimiento"];
			$nombreadmision = $row["nombreadmision"];
			$numerodocumento = $row["numerodocumento"];
			$dni = $row["numerodocumento"];
			$sexo = $row["sexo"];
			$direccion = $row["direccion"];
			$domicilio = $row["direccion"];
			$celular = $row["telefono"];
			$email = trim($row["email"]);
			$telefono = $row["telefono"];
			$recibopago = $row["recibopago"];
			$tipocolegio = $row["tipocolegio"];
			$certificado = $row["certificado"];	
			$fecharegistro =  $row["fecharegistro"];
			$anioegreso =  $row["anioegreso"];
			$colegio =  $row["colegio"];
			$nombredepartamento =  $row["nombredepartamento"];
			$nombreprovincia =  $row["nombreprovincia"];
			$nombredistrito =  $row["nombredistrito"];
			$descripcionmoda =  $row["descripcionmoda"];			
			mysqli_data_seek($rs,0);
		}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title>POSTULANTES</title>
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
<table width="200" border="0">
	<tr>
    	<td width="60">
        	<img src="../imageneszet/logocepre.jpg" width="60">
        </td>
        <td style="background-color:#6A1306" align="center">
        	<span style="font-size:6px; color:#E6A544; font-weight:bold;">
        	CENTRO PREUNIVERSITARIO<br>
            Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas<br>
            DANIEL HERN&Aacute;NDEZ MORILLO
            </span>
        </td>
    </tr>    
    <tr>
    	<td align="center">
            <?php mostrarfoto_zet_local_carne($dni);?>
        </td>        
        <td>
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="70%">                    	
                        <strong>C&Oacute;DIGO</strong>
                        <br>
                        <span style="font-size:9px"><?php echo $dni;?></span>
                        <br>
                        <strong>APELLIDOS</strong>
                        <br>
                        <span style="font-size:9px"><?php echo $apellidopaterno;?>&nbsp;<?php echo $apellidopaterno;?></span>
                        <br>           
                        <strong>NOMBRES</strong>
                        <br>
                        <span style="font-size:9px"><?php echo $nombre;?></span>
                        <br>
                        <strong>CARRERA PROFESIONAL</strong>
                        <br>
                        <span style="font-size:9px"><?php echo $nombreescuela;?></span>
                        <br>
                        <strong>MODALIDAD</strong>
                        <br>
                        <span style="font-size:9px"><?php echo $descripcionmoda;?></span>
                    </td>
                    <td>
                    	<img src="../imageneszet/unat.png" width="70" border="0">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td colspan="2" style="background-color:#6A1306">
        	<table border="0" width="100%">
            	<tr>
                	<td style="background-color:#6A1306">
                    	<span style="font-size:18px; font-weight:bold; color:#E6A544">CARN&Eacute; CPUNAT</span>
                    </td>
                    <td align="right" style="background-color:#6A1306">
                    	<span style="font-size:12px; font-weight:bold; color:#E6A544">CICLO INTENSIVO 2020-I</span>
                    </td>
                </tr>
            </table>            
        </td>
    </tr>
</table>
<span style="page-break-before:always;"></span>
<table width="300">
	<tr>
    	<td>
        	<img src="../imageneszet/carne_posterior.jpg" width="300">
        </td>
    </tr>
</table>
</body>
</html>