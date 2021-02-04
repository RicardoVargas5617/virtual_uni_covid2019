<?php
	$proceso = base64_decode(base64_decode($_GET['codigo']));
	$departamento = "09";
	$provincia = "07";
	$distrito = "01";
	$vsqlescuelamodalidad = "call zyz_CAMantenedorVacante ('". $proceso . "', '','',0,1,'D')";
	$vsqltipocolegio = "select tipocolegio, descripcion from adm_tipocolegio order by descripcion";	
	$vsqltipodocumento = "select tipodocumento, descripcion from mae_tipodocumento where activo=1 order by descripcion";
	$vsqlsexo = "select sexo, descripcion from adm_sexo where activo=1 order by descripcion";
	$tipodocumento='01';
	$sexo='M';
	include_once('../funciones/admi_con.php');
	include_once('../funciones/admi_fun.php');
	#echo date('YmdHis');
?>
<html>
<head>
    <link rel="icon" href="../unat.ico">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/font-awesome-animation.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/animate.css" rel="stylesheet" type="text/css" />
    <link href="../css/ajaxchosen.css" rel="stylesheet" type="text/css" />
    <link href="../css/chosen.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/admin.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="../plugins/kalendar/kalendar.css" rel="stylesheet">
    <link href="../plugins/toastr/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/scroll/nanoscroller.css">
    <link href="../plugins/morris/morris.css" rel="stylesheet" />
    <link href="../plugins/lightbox/css/lightbox.css" rel="stylesheet" />
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="../plugins/checkbox/icheck.css" rel="stylesheet" />
    <script src="../js/jquery-2.1.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/chosen.jquery.js"></script>
    <script src="../js/chosen.ajaxaddition.jquery.js"></script>
    <script src="../js/chosen.jquery.js"></script>
    <script src="../plugins/toastr/toastr.min.js"></script>
    <script src="../js/funciones.js"></script>
    <style type="text/css">
    .wPopup{
      background: white; /*background: #F0F0F0;*/
      width:400px;
      height:250px;
      border:solid 2px    #990000;
      position: fixed;
      top:50%;
      left:50%;
      margin-left: -200px;
      margin-top: -125px;
      display: none;
      z-index: 5001;
    }
    .wPopupBack{
      vertical-align:middle;
      position:fixed;
      display:none;
      top:0px;
      left:0px;
      width:100%;
      height:100%;
      filter:alpha(opacity=0); /*IE*/
      opacity:.93;/*FF*/
      background-color:black;
      z-index: 5000;
    }

    .wPopup div#divCapaWindowContent{padding: 5px 5px;}

    .QOverlay {
      background-color: #000000;
      z-index: 9999;
    }

    .QLoader {
      background-color: #CCCCCC;
      height: 1px;
    }

    #sliderconsultorio .slider-track-high {
      background: #337ab7;
    }
    .slider-handle{
      background: #337ab7;
    }
    .progress {
        text-align: center;
        width: 0%;
        margin: 0%;
        height: 5px;
        z-index: 5001;
        transition: width .3s;
        opacity:.93;
        background: rgba(25,10,62,1);
        background: -moz-linear-gradient(top, rgba(25,10,62,1) 0%, rgba(25,10,62,1) 31%, rgba(246,246,246,1) 79%, rgba(255,255,255,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(25,10,62,1)), color-stop(31%, rgba(25,10,62,1)), color-stop(79%, rgba(246,246,246,1)), color-stop(100%, rgba(255,255,255,1)));
        background: -webkit-linear-gradient(top, rgba(25,10,62,1) 0%, rgba(25,10,62,1) 31%, rgba(246,246,246,1) 79%, rgba(255,255,255,1) 100%);
        background: -o-linear-gradient(top, rgba(25,10,62,1) 0%, rgba(25,10,62,1) 31%, rgba(246,246,246,1) 79%, rgba(255,255,255,1) 100%);
        background: -ms-linear-gradient(top, rgba(25,10,62,1) 0%, rgba(25,10,62,1) 31%, rgba(246,246,246,1) 79%, rgba(255,255,255,1) 100%);
        background: linear-gradient(to bottom, rgba(25,10,62,1) 0%, rgba(25,10,62,1) 31%, rgba(246,246,246,1) 79%, rgba(255,255,255,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#ffffff', GradientType=0 );
    }
  </style>
</head>
<body>
<table class="table">
	<tr>
		<td width="10%" align="center">
        	<img src="../imageneszet/unat.png" width="60" />
        </td>
        <td align="center">
        	<span style="font-size:24px; font-weight:bold">Universidad Nacional Jos&eacute; Mar&iacute;a Arguedas</span>
            <br>
            <span style="font-size:16px; font-weight:bold">FORMULARIO DE PRE-INSCRIPCI&Oacute;N</span>
            
        </td>
	</tr>
</table>
<tr>
<table class="table">
	<tr>
    	<td>
        <font color="#990000">
    	<span style="font-size:16px; font-weight:bold;">
   		Luego de realizar la pre-inscripci&oacute;n, ac&eacute;rquese obligatoriamente a la Oficina de Admisi&oacute;n de la UNAT, ubicada en la Plaza de Armas de Pampas para formalizar el proceso de inscripci&oacute;n.
        </span>
        </font>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td>   
        	<!--data-atras="SI"-->          
            <a href="adm_preins.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<br>
<form  name="form" method="post" id="frmcronmod" action="adm_preinscripcion_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>">
<!-- onSubmit="grabar(this.id);return false";-->
<table class="table">
    <tr>
        <td width="15%">
            <strong>Escuela - Modalidad:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboEscuelaModalidad",$vsqlescuelamodalidad,'','Si'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>DNI:</strong>								
        </td>
        <td>
            <input name="txtNumeroDocumento" id="txtNumeroDocumento" type="text" value="" style="width: 15%" data-requerido="true" data-numero-entero="true" data-requerido-texto="Nro. Documento" maxlength="8">
        </td>
    </tr>	    
    <tr>
        <td>
            <strong>Apellido paterno:</strong>								
        </td>
        <td>
            <input name="txtApellidoPaterno" id="txtApellidoPaterno" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Paterno">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Apellido materno:</strong>								
        </td>
        <td>
            <input name="txtApellidoMaterno" id="txtApellidoMaterno" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Materno">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Nombres:</strong>								
        </td>
        <td>
            <input name="txtNombre" id="txtNombre" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Nombres">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Fec. Nacimiento:</strong>								
        </td>
        <td>
            <input name="txtFechaNacimiento" id="txtFechaNacimiento" type="text" value="" style="width: 20%" data-requerido="true" data-requerido-texto="Fecha Nacimiento" maxlength="10">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Sexo:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboSexo",$vsqlsexo,$sexo,'Si'); ?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Celular/Fijo:</strong>								
        </td>
        <td>
            <input name="txtTelefono" id="txtTelefono" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Celular">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Email:</strong>								
        </td>
        <td>
            <input name="txtEmail" id="txtEmail" type="text" value="" style="width: 60%" data-requerido="true" data-requerido-texto="Email">
        </td>
    </tr>		
    <tr>
        <td>
            <strong>Colegio procedencia:</strong>								
        </td>
        <td>
            <input name="txtColegio" id="txtColegio" type="text" value="" style="width: 85%" data-requerido="true" data-requerido-texto="Colegio">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Recibo Pago:</strong>								
        </td>
        <td>
            <input name="txtReciboPago" id="txtReciboPago" type="text" value="" style="width: 15%" data-requerido="true" data-requerido-texto="Recibo Pago" maxlength="16">
        </td>
    </tr>																																				
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo $proceso;?>">	
            <input name="postulante" type="hidden" value="">								
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
</table>
</form>
<script>
$('#cboEscuelaModalidad').css('width','100%');
</script>
</body>
</html>