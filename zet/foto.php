<?php 
	$codigozet = base64_decode(base64_decode($_GET['cc']));
	$proceso = $_GET['proceso'];
	$numerodocumento = substr($codigozet,0,10);
	$sede = substr($codigozet,10,2);
	$escuela = substr($codigozet,12,2);
	$curricula = substr($codigozet,14,2);
?>
<table>
    <tr>
        <td width="50%" align="left">                                                    
            <?php 
					echo '<a href="adm_inscripcion.php?proceso='.$proceso;
					echo '&code='.md5(md5($usuario));
					echo '&d='.$_REQUEST['d'];
					echo '&nav='.$nav;
					echo '" data-atras="SI"><i class="fa fa-mail-reply"></i> Regresar</a>';
            ?>  																				
        </td>
    </tr>
</table>
<table class="table">																														
    <tr>
        <td width="8%">
            <strong>Dni:</strong>														
        </td>
        <td>
            <?php echo $numerodocumento ?>														
        </td>
        <td rowspan="6" width="20%" align="center" valign="center">
            <?php 
                mostrarfoto_zet_local($numerodocumento);
				#echo $numerodocumento;
            ?>	
        </td>
    </tr>
</table>
<?php
	#$dni=''; 
	if (strlen($numerodocumento)<>8){
		echo '<div class="alert alert-danger">';
			echo '<span class="semi-bold">El DNI es incorrecto, ingrese a datos del estudiante y actualice.</span>';
		echo '</div>';
	}
	else
	{
?>
<div class="alert alert-info">
	<span class="semi-bold">Caracter&iacute;sticas:</span><br>
    -  	Dimensiones: 240 x 288 pixeles.<br>
    -	Resoluci&oacute;n: 300dpi.<br>
 	-   Tama&ntilde;o: del 40 a 50 kb.<br>
    -	Sin sellos ni enmendaduras.<br>
	- 	Prohibido im&aacute;genes escaneadas.<br>
    -	La imagen debe enfocarse en el rostro del estudiante a partir de los hombros. No mostrar medio cuerpo.<br>
</div>
<form action="foto_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" class="form-group col-lg-12" method="post" id="grado" name="frmFotoGrado" enctype="multipart/form-data" onsubmit="return true;">
<table> 
	<tr>
		<td>
			<header class="dark col-lg-12 fa-hover">
			<div class="panel-heading">
				<h3 class="panel-title"> <i class="fa fa-leaf"></i>
					Subir Imagen
				</h3>
			</div>
			</header>
			<div class="form-group col-lg-12"></div>
				<div class="form-group col-lg-12">
					<br>
					<input type="hidden" name="cc" value="<?php echo base64_encode(base64_encode($codigozet))?>" />
                    <input type="hidden" name="dni" value="<?php echo $dni; ?>" />
                    <input type="hidden" name="proceso" value="<?php echo $proceso; ?>" />
					<input type="file" name="archivo" id="archivo">
					<button type="submit" class="btn btn-success"><i class="icon-white icon-upload"></i>Subir Archivo</button>
					<div class="form-group col-lg-12">
						<span class="label label-info" style="font-size: 11px">Ancho:700px - Alto: 450px</span>
					</div>
				</div>
				<br>
				<div class="form-group col-lg-12" id="dvArchivo">                    
					<div class="row-fluid col-lg-12 animation" style="background:none">
						<div class=" col-lg-7" id="dvloading font-animation" style="display:none">
							<i class="fa fa-spinner faa-spin animated"></i>
							Subiendo archivo <span class="label label-warning" id="dvporcentaje">0%</span>
						</div>
					<div id="dvstatus" class="col-lg-5" style="font-size: 20px;"></div>
				</div>
				<!--<img src="" id="imgArchivo">-->
				<output id="imgArchivo"></output>
			</div>
		</td>
	</tr>
</table>
</form>
<?php
	}
?>
<style>
.thumb {
	height: 300px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}
</style>

<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/uniform/js/jquery.uniform.bundled.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/jquery.form.js"></script>
<script type="text/javascript">
    $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href','../plugins/uniform/css/aristo.css') );
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')){
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
					document.getElementById("imgArchivo").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    //document.getElementById("imgArchivo").src = e.target.result
                };
            })(f);
            //console.log(reader.readAsDataURL(f));
			reader.readAsDataURL(f);
        }
    }
    //document.getElementById('archivo').addEventListener('change', archivo, false);
	document.getElementById('archivo').addEventListener('change', archivo, false);
    (function() {
        var bar = $('.bar');
        $("input[type='file']").uniform();
        var percent = $('#dvporcentaje');
        var status = $('#dvstatus');
        $('#frmFotoGrado').ajaxForm({
            beforeSend: function() {
                status.empty();
                if($('#archivo').val()==''){
                    alert('Nesesita seleccionar un archivo');
                    return false;
                }
                //$('#progresssubir').show();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
                $('#dvloading').show();
                console.log(percentVal, position, total);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
                $('#dvloading').hide();
            }
        });


    })();

    $('#uniform-archivo').css('width','72%');
</script>

