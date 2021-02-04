<?php 
	include_once(GL_DIR_FS_APP.'funciones/admi_fun_admision.php');
	$cn_zuz = conectar();
	mysqli_query($cn_zuz,"SET CHARACTER SET utf8");
	mysqli_query($cn_zuz,"SET NAMES utf8");	
	$codigo = base64_decode(base64_decode($_GET["clave"]));
	$vsql = "call zyz_Admi_Pregunta ('". $codigo . "','','','1','2','3','4','5','6','7','8','9',0,0,'',0,0,'','M')";	
	#echo $vsql;
	$rs = mysqli_query($cn_zuz,	$vsql);	
	$rsjk = mysqli_fetch_row($rs);		
	$banco = $rsjk[0];
	$tipo = $rsjk[1];
	$subtipo = $rsjk[2];
	$descripcion = $rsjk[3];
	$observacion = $rsjk[4];
	$claveA = $rsjk[5];
	$claveB = $rsjk[6];
	$claveC = $rsjk[7];
	$claveD = $rsjk[8];
	$claveE = $rsjk[9];
	$respuesta = $rsjk[10];
	$motivo = $rsjk[11];
	$imagen = $rsjk[12];
	$activo = $rsjk[13];
	$canal = $rsjk[14];
	$contador = 0;
	
	$ver=$tipo.$subtipo;
	
	$nombretiposubtipo = nombretiposubtipo($ver);
	$vsqlrespuesta = "select valor, descripcion from admi_valor order by valor";
	$vsqlcanal = "select canal, descripcion from admi_canal order by canal desc";
?>
<form name="form" method="post" id="frmcronmod" action="admi_banco_grabarfoto.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" enctype="multipart/form-data">
<!-- onsubmit="grabar(this.id);return false;"-->
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_banco.php?d=<?php echo $_REQUEST['d']?>&nav= <?php echo $nav?>&subtipo=<?php echo $ver?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>							
<table class="table">
    <tr>
        <td width="13%">
            <strong>Tipo:</strong>								
        </td>
        <td>
        	<strong>
            <?php echo $nombretiposubtipo; ?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>C&oacute;digo:</strong>
        </td>
        <td>
            <?php echo $banco;?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Canal</strong>								
        </td>
        <td>
			<?php echo $canal; ?>
        </td>
    </tr>   												
    <tr>
        <td>
            <strong>Descripci&oacute;n:</strong>								
        </td>
        <td>
			<?php echo $descripcion; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Foto:</strong>								
        </td>
        <td>
			<input type='file' id="imgInp" name="imgInp" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto voucher" aria-describedby="imgInp-message" style=" border-radius: 0;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    color: #ffffff;
    background-color: #337ab7;
    border: 1px solid #ffffff;
">
			<img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" width="150" height="150px" />
        </td>
    </tr>    
    <tr>
        <td align="center" colspan="2">
            <input name="codigo" type="hidden" value="<?php echo $codigo;?>">	
            <input name="ver" type="hidden" value="<?php echo $ver;?>">	
            <input name="txtTipo" type="hidden" value="F">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
        </td>										  
    </tr>	
</table>
</form>
<script>
  $("#imgInp").change(function () {
    // C贸digo a ejecutar cuando se detecta un cambio de archivO
    readImage(this);
  });
  
 function readImage (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah').attr('src', e.target.result); // Renderizamos la imagen
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

