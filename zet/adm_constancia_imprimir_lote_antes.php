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
	$proceso = $_GET['codigo'];
	$vsql = "call zyz_CAConstancia ('". $proceso . "', '','', 'C')";
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);		
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>" />
<title></title>
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
    while ($rsjk=mysqli_fetch_row($rs))
        {
            ImprimirConstanciaIngreso($rsjk[0],$rsjk[1],$rsjk[2]);
			echo '<span style="page-break-before:always;"></span>';
		}
?>
</body>
</html>