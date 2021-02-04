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
		

		$ruta='../';

		$file = trim($ruta).'imagesalumno/'.$dni.".jpg";
		$filezet = trim($ruta).'imagesalumno/'.$dni.".JPG";
		$file1 = trim($ruta).'imagesalumno/'.$dni.".jpg";
		$filezet1 = trim($ruta).'imagesalumno/'.$dni.".JPG";	
		$file2 = trim($ruta).'imagesalumno/nodisponible.jpg';
		if (file_exists($file))
			{
				$filezet1 = '../imagesalumno/'.$numerodocumento.".jpg";
				$foto = '<img src="'.$filezet1.'" width="80" border="1">';
			}
		elseif (file_exists($filezet))
			{
				$filezet2 = '../imagesalumno/'.$numerodocumento.".JPG";
				$foto = '<img src="'.$filezet2.'" width="80"  border="1">';
			}		
		else
			{
				$filezet3 = '../imagesalumno/nodisponible.jpg';
				$foto = '<img src="'.$filezet3.'" width="80"  border="1">';	
			}
		
	include '../mpdf/mpdf.php';
	#$mpdf = new mPDF('','A6',0,'',5,0,0,0,0,0, 'H');
	#$mpdf = new mPDF('','A6',0,'',15,15,10,6,9,9, 'L');
	$mpdf = new mPDF("utf-8", array(54, 85),0,'',0,0,0,0,0,0, 'L');
	#$mpdf = new mPDF(['mode' => 'utf-8', 'format' => [54, 85]]);


$mpdf->showImageErrors = true;
$mpdf->mirrorMargins = true;

stream_context_set_default(
    array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        )
    )
);

$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$vcolacion.'" />
<title>CARNE</title>
<style>
body,th,td,p {
	background-color: #FFFFFF; font-size : 10px; font-family: Arial, Verdana, Helvetica, sans-serif;
	}
</style>
</head>
<body leftmargin=0 topmargin=0 bgcolor="#ffffff" marginheight="0" marginwidth="0">
<table width="320" border="0">
	<tr>
    	<td width="30%" align="center">
        	<img src="../imageneszet/logocepre.jpg" width="70">
        </td>
        <td style="background-color:#6A1306" align="center">
        	<span style="font-size:7px; color:#E6A544; font-weight:bold;">
        	CENTRO PREUNIVERSITARIO<br>
            Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas<br>
            DANIEL HERN&Aacute;NDEZ MORILLO
            </span>
        </td>
    </tr>
	<tr>
    	<td align="center">'.
			$foto.
        '</td>
        <td>
			<table width="260" border="0">
			<div style="position:absolute;height:100%;width:100%;">
			<img src="../imageneszet/unat_fondo.png" style="width:100%;height:100%">
			</div> 
            	<tr>
                	<td>    
						<strong style="font-size:8px">C&Oacute;DIGO</strong>
						<br>
						<span style="font-size:9px">'.$dni.'</span>
						<br>
						<strong style="font-size:8px">APELLIDOS</strong>
						<br>
						<span style="font-size:9px">'.$apellidopaterno.'&nbsp;'.$apellidopaterno.'</span>
						<br>           
						<strong style="font-size:8px">NOMBRES</strong>
						<br>
						<span style="font-size:9px">'.$nombre.'</span>
						<br>
						<strong style="font-size:8px">CARRERA PROFESIONAL</strong>
						<br>
						<span style="font-size:9px">'.$nombreescuela.'</span>
						<br>
						<strong style="font-size:8px">MODALIDAD</strong>
						<br>
						<span style="font-size:9px">'.$descripcionmoda.'</span>
					</td>
                </tr>
            </table>
        </td>
    </tr>
	<tr>
    	<td colspan="2" style="background-color:#6A1306">
        	<table border="0" width="320" cellpadding="0" cellspacing="0">
            	<tr>
                	<td style="background-color:#6A1306">
                    	<span style="font-size:13; font-weight:bold; color:#E6A544">CARN&Eacute; CPUNAT</span>
                    </td>
                    <td align="right" style="background-color:#6A1306">
                    	<span style="font-size:9px; font-weight:bold; color:#E6A544">CICLO INTENSIVO 2020-I</span>
                    </td>
                </tr>
            </table>            
        </td>
    </tr>
</table>
<span style="page-break-before:always;"></span>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="../imageneszet/carne_posterior.jpg" width="300">';
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle($dni);
$mpdf->Output($dni.'.pdf','I');
ob_end_clean();
?>