<?php
	session_start();
	if (!isset($_SESSION["usuario"]))
	{
		header("location:noautorizado.php");
	}			
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');
	$cn = conectar();
	$codigo = $_GET['codigo'];
	$proceso = substr($codigo,0,4);
	$postulante = substr($codigo,4,7);	
	
	$nombreproceso = nombreproceso($proceso);
	$macro = nombremacro($proceso);
	$vsql = "call zyz_CAMantenedorPre ('". $proceso . "', '". $postulante . "','','','','','','1900-01-01','','','','','','','','G')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);	
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
			$dni = $row["numerodocumento"];
			$sexo = $row["sexo"];
			$email = trim($row["email"]);
			$telefono = $row["telefono"];
			$recibopago = $row["recibopago"];
			$colegio =  $row["colegio"];
			$fecharegistro =  $row["fecharegistro"];
			mysqli_data_seek($rs,0);
		}
	
	$dia = substr($fecharegistro,0,2);
	$mes = substr($fecharegistro,3,2);
	$anio = substr($fecharegistro,6,4);
	
	$nombremes = nombremes($mes);
	$fecha = 'Pampas, '.$dia.' de '.$nombremes.' del '.$anio;
	$nombreproceso = nombreproceso($proceso);	
	$altura = 30;
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
<?php 
	$reporte = 'FICHA DE PRE-INSCRIPCION';
	require ('cabecera_admision1.php')
?>
<br>
<br>
<table width="750">
	<tr height=<?php echo $altura;?>>
    	<td align="left" width="35%">
        	<strong>CARRERA PROFESIONAL A LA QUE POSTULA:</strong>
        </td>
        <td>
        	<?php echo $nombreescuela;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>MODALIDAD:</strong>
        </td>
        <td>
        	<?php echo $nombremodalidad;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>APELLIDO PATERNO:</strong>
        </td>
        <td>
        	<?php echo $apellidopaterno;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>APELLIDO MATERNO:</strong>
        </td>
        <td>
        	<?php echo $apellidomaterno;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>NOMBRE:</strong>
        </td>
        <td>
        	<?php echo $nombre;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>FECHA NACIMIENTO:</strong>
        </td>
        <td>
        	<?php echo $fechanacimiento;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>NRO. DNI:</strong>
        </td>
        <td>
        	<?php echo $dni;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>SEXO:</strong>
        </td>
        <td>
        	<?php echo $sexo;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>TELEFONO:</strong>
        </td>
        <td>
        	<?php echo $telefono;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>EMAIL:</strong>
        </td>
        <td>
        	<?php echo $email;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>NOMBRE COLEGIO:</strong>
        </td>
        <td>
        	<?php echo $colegio;?>
        </td>
    </tr>
    <tr height=<?php echo $altura;?>>
    	<td align="left">
        	<strong>NUMERO RECIBO DE PAGO:</strong>
        </td>
        <td>
        	<?php echo $recibopago;?>
        </td>
    </tr>
</table>
<br>
<table width="750">
	<tr>
    	<td align="right">
        	<?php echo $fecha?>
        </td>
        <td width="10%">
        	&nbsp
        </td>
    </tr>
</table>
<br>
<table width="750" border="0">
	<tr>
    	<td width="10%">&nbsp;
        	
        </td>
        <td width="15%" valign="bottom">
        	_____________________________________
        </td>
        <td width="5%">&nbsp;
        	
        </td>
        <td width="15%">
        	<table width="100%" border="1" style="border-style:solid">
            	<tr>
                	<td height="120">&nbsp;
                    	
                    </td>
                </tr>
            </table>
        </td>
        <td>&nbsp;
        	
        </td>
    </tr>
    <tr>
    	<td>&nbsp;
       		
        </td>
        <td align="center">
       		<strong>Firma del postulante</strong>
        </td>
        <td>&nbsp;
       		
        </td>
        <td align="center">
       		<strong>Indice derecho</strong>
        </td>
    </tr>
</table>
</body>
</html>