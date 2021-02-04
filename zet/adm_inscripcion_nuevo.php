<?php 
	$proceso = $_GET["proceso"];
	$departamento = "03";
	$provincia = "02";
	$distrito = "01";
	$vsqlescuelamodalidad = "call zyz_CAMantenedorVacante ('". $proceso . "', '','',0,1,'D')";
	$vsqltipocolegio = "select tipocolegio, descripcion from adm_tipocolegio order by descripcion";	
	$vsqltipodocumento = "select tipodocumento, descripcion from mae_tipodocumento where activo=1 order by descripcion";
	$vsqlsexo = "select sexo, descripcion from adm_sexo where activo=1 order by descripcion";
	$vsqltipopago = "select tipopago, descripcion from adm_tipopago where activo=1 order by descripcion";
	$vsqltipoprocedencia = "select tipoprocedencia, descripcion from adm_tipoprocedencia where activo=1 order by descripcion";
	$tipodocumento='01';
	$tipocolegio='01';
	$sexo='M';
	$vsqldepartamento="SELECT departamento,descripcion FROM mae_ubigeo WHERE provincia='00' AND distrito='00' order by 2";
	$vsqlprovincia="SELECT provincia,descripcion FROM mae_ubigeo WHERE departamento='$departamento' AND provincia<>'00' AND distrito='00' order by 2";
	$vsqldistrito="SELECT distrito,descripcion FROM mae_ubigeo WHERE departamento='$departamento' AND provincia='$provincia' AND distrito<>'00' order by 2";
	$vsqlmoda = "select moda, descripcion from adm_moda order by descripcion";
	$vsqlturno = "select turno, descripcion from adm_turno order by descripcion";
	$nombreproceso = nombreproceso($proceso);
?>
<form  name="form" method="post" id="frmcronmod" action="adm_inscripcion_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_inscripcion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="15%">
            <strong>Proceso:</strong>
        </td>
        <td>
            <?php echo $nombreproceso?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Escuela - Modalidad:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboEscuelaModalidad",$vsqlescuelamodalidad,'','Si'); ?>
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
            <input name="txtFechaNacimiento" id="txtFechaNacimiento" type="text" value="" style="width: 20%" data-requerido="true" data-requerido-texto="Fecha Nacimiento">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Tipo documento:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoDocumento",$vsqltipodocumento,$tipodocumento,'Si'); ?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Nro. documento:</strong>								
        </td>
        <td>
            <input name="txtNumeroDocumento" id="txtNumeroDocumento" type="text" value="" style="width: 15%" data-requerido="true" data-requerido-texto="Nro. Documento" maxlength="8">
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
    <!--	
    <tr>
    	<td>
        	<strong>Departamento</strong>        
        </td>
       	<td>
			<?php MostrarCombo2("cboDepartamento",$vsqldepartamento,$departamento); ?>
        </td>
    </tr>
    <tr>
       	<td>
       		<strong>Provincia</strong>
        </td>
       	<td>
			<?php MostrarCombo2("cboProvincia",$vsqlprovincia,$provincia); ?>
        </td>
    </tr>
    <tr>
       	<td>
        	<strong>Distrito</strong>
        </td>
       	<td>
			<?php MostrarCombo2("cboDistrito",$vsqldistrito,$distrito); ?>
        </td>
    </tr>
    -->
 	<tr>
        <td>
            <strong>Direcci&oacute;n:</strong>								
        </td>
        <td>
            <input name="txtDireccion" id="txtDireccion" type="text" value="" style="width: 60%">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Celular/Fijo:</strong>								
        </td>
        <td>
            <input name="txtTelefono" id="txtTelefono" type="text" value="" style="width: 60%">
        </td>
    </tr>	
    <!--
    <tr>
        <td>
            <strong>Celular:</strong>								
        </td>
        <td>
            <input name="txtCelular" id="txtCelular" type="text" value="" style="width: 60%">
        </td>
    </tr>				
	-->
    <tr>
        <td>
            <strong>Email:</strong>								
        </td>
        <td>
            <input name="txtEmail" id="txtEmail" type="text" value="" style="width: 60%">
        </td>
    </tr>	
	<!--
    <tr>
        <td>
            <strong>Veces UNAJMA:</strong>								
        </td>
        <td>
            <input name="txtVecesUnj" id="txtVecesUnj" type="text" value="1" style="width: 15%" data-requerido="true" data-requerido-texto="Veces UNJ" maxlength="8">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Veces Otra:</strong>								
        </td>
        <td>
            <input name="txtVecesOtra" id="txtVecesOtra" type="text" value="0" style="width: 15%" data-requerido="true" data-requerido-texto="Veces Otra" maxlength="8">
        </td>
    </tr>	
    -->
	<tr>
    	<td>
        	<strong>
            Apoderado:
            </strong>        
        </td>
        <td>
        	<input name="txtApoderado" id="txtApoderado" type="text" value="<?php echo $apoderado?>" style="width: 60%">
        </td>    
    </tr> 
    <tr>
        <td>
            <strong>Tipo colegio:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoColegio",$vsqltipocolegio,$tipocolegio,'Si'); ?>
        </td>
    </tr>
<tr>
		<td align="left">
        	<strong>Departamento Colegio:</strong>
        </td>
		<td>
			<?php MostrarCombo2("cboDepartamentoColegio",$vsqldepartamento,$departamentocolegio)?>
        </td>
	</tr>
	<tr>
			<td align="left">
            	<strong>Provincia Colegio:</strong>
            </td>
			<td>
				<?php MostrarCombo2("cboProvinciaColegio",$vsqlprovincia,$provinciacolegio); ?>
             </td>
	</tr>
	<tr>
			<td align="left">
            	<strong>Distrito Colegio:</strong>
            </td>
			<td>
				<?php MostrarCombo2("cboDistritoColegio",$vsqldistrito,$distritocolegio); ?>
            </td>
	</tr>        	     
    <!--
    <tr>
        <td>
            <strong>Tipo Procedencia:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoProcedencia",$vsqltipoprocedencia,'','Si'); ?>
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Tipo Pago:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoPago",$vsqltipopago,'','Si'); ?>
        </td>
    </tr>

    <tr>
        <td>
            <strong>Modalidad:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboModa",$vsqlmoda,'','Si'); ?>
        </td>
    </tr>
    -->		
    <tr>
        <td>
            <strong>Colegio procedencia:</strong>								
        </td>
        <td>
            <input name="txtColegio" id="txtColegio" type="text" value="" style="width: 85%" data-requerido="true" data-requerido-texto="Colegio">
        </td>
    </tr>
    <!--
    <tr>
        <td>
            <strong>Recibo Pago:</strong>								
        </td>
        <td>
            <input name="txtReciboPago" id="txtReciboPago" type="text" value="" style="width: 15%" data-requerido="true" data-requerido-texto="Recibo Pago" maxlength="16">
        </td>
    </tr>
    -->
	<tr>
        <td>
            <strong>A&ntildeo egreso:</strong>								
        </td>
        <td>
            <input name="txtAnioEgreso" id="txtAnioEgreso" type="text" value="<?php echo date('Y')?>" style="width: 10%" data-requerido="true" data-requerido-texto="Año egreso" maxlength="4">
        </td>
    </tr> 
	<tr>
		<td align="left">
        	<strong>Departamento Procedencia:</strong>
        </td>
		<td>
			<?php MostrarCombo2("cboDepartamentoProcedencia",$vsqldepartamento,$departamentoprocedencia)?>
        </td>
	</tr>
	<tr>
			<td align="left">
            	<strong>Provincia Procedencia:</strong>
            </td>
			<td>
				<?php MostrarCombo2("cboProvinciaProcedencia",$vsqlprovincia,$provinciaprocedencia); ?>
             </td>
	</tr>
	<tr>
			<td align="left">
            	<strong>Distrito Procedencia:</strong>
            </td>
			<td>
				<?php MostrarCombo2("cboDistritoProcedencia",$vsqldistrito,$distritoprocedencia); ?>
            </td>
	</tr>    
    <tr>
        <td>
            <strong>Promedio colegio:</strong>								
        </td>
        <td>
            <input name="txtCertificado" id="txtCertificado" type="text" value="0" style="width: 10%">
        </td>
    </tr>  	
    <!--	
    <tr>
        <td>
            <strong>Pago 1:</strong>								
        </td>
        <td>
            <input name="txtPago1" id="txtPago1" type="text" value="0" style="width: 10%">
        </td>
    </tr> 
    <tr>
        <td>
            <strong>Pago 2:</strong>								
        </td>
        <td>
            <input name="txtPago2" id="txtPago2" type="text" value="0" style="width: 10%">
        </td>
    </tr> 			
	<tr>
        <td>
            <strong>Turno:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTurno",$vsqlturno,'M','Si'); ?>
        </td>
    </tr>	
    -->																																						
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
<script>$('#cboEscuelaModalidad').css('width','100%')</script>
<script>$('#cboDepartamento').css('width','100%')</script>
<script>$('#cboProvincia').css('width','100%')</script>
<script>$('#cboDistrito').css('width','100%')</script>
<script>$('#cboModa').css('width','60%')</script>
<script>
    function crearselectubigeo(id,data) {
        $("#" + id).html('');
        $("#" + id).html('<option value=\"\">SELECCIONAR..</option>');
        $.each(data, function(k,v){
            $("#"+id).append("<option value=\""+k+"\">"+v+"</option>");
        })
        $("#"+id).each(function() {
            // Obtencion del elemento seleccionado
            var valorSeleccionado = $(this).val();

            // Aplicacion del orden alfabetico
            $(this).html($("option", $(this)).sort(function(a, b) {
                return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
            }));

            // Reestablecimiento de la opción seleccionada previamente
            $(this).val('');
        });
    }
    function cargarubigeo(id,de,pr,di,nombre) {
        param={dep:de,prov:pr,dist:di,nombre:nombre};
        $.ajax({
            url: '../zet/ubigeo.php',
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            data: param, // our data object
            contentType: "application/x-www-form-urlencoded",
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            cache: false
        }).done(function (data) {
            crearselectubigeo(id,data)

        });
    }
    $('#cboDepartamento').change(
       function () {
           cargarubigeo('cboProvincia',this.value,'00','00','provincia')
           crearselect('cboDistrito',{})
       }
    )
    $('#cboProvincia').change(
        function () {
            cargarubigeo('cboDistrito',$('#cboDepartamento').val(),this.value,'00','distrito')
        }
    )
 	$('#cboDepartamentoColegio').change(
       function () {
           cargarubigeo('cboProvinciaColegio',this.value,'00','00','provincia')
           crearselect('cboDistritoColegio',{})
       }
    )
    $('#cboProvinciaColegio').change(
        function () {
            cargarubigeo('cboDistritoColegio',$('#cboDepartamentoColegio').val(),this.value,'00','distrito')
        }
    )	
	
	
    $('#cboDepartamentoProcedencia').change(
        function () {
            cargarubigeo('cboProvinciaProcedencia',this.value,'00','00','provincia')
            crearselect('cboDistrito',{})
        }
    )
    $('#cboProvinciaProcedencia').change(
        function () {
            cargarubigeo('cboDistritoProcedencia',$('#cboDepartamentoProcedencia').val(),this.value,'00','distrito')
        }
    )
</script>