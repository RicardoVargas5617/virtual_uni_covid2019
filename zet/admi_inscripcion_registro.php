<?php 
	$cn_zet = conectar();
	$proceso = $_GET["proceso"];
	$departamento = "09";
	$provincia = "07";
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
	
	$vsql = "call zyz_Admi_GrabarPre ('". $persona . "','','','','','','','','',0,0,'D')";	
	#echo $vsql;
	$rs_postulante = mysqli_query($cn_zet,	$vsql);	
	$num= mysqli_num_rows($rs_postulante); 	
	if ($num > 0)
		{
			$row = mysqli_fetch_array($rs_postulante, MYSQLI_ASSOC);
			$apellidopaterno = $row["apellidopaterno"];
			$apellidomaterno = $row["apellidomaterno"];
			$nombre = $row["nombres"];
			$email = $row["email"];
			$celular = $row["celular"];
			$dni = $row["dni"];
			$clavel = $row["clavel"];
			mysqli_data_seek($rs_postulante,0);
		}
	else
		{
			$registro=0;
		}	
	#echo $vsql;

?>
<form  name="form" method="post" id="frmcronmod" action="admi_inscripcion_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="admi_inscripcion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
    <tr>
        <td width="15%">
            <strong>Proceso:</strong>
        </td>
        <td>
        	<strong>
            <?php echo $nombreproceso?>
            </strong>
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
            <strong>Dni:</strong>
        </td>
        <td>
        	<strong>
            <?php echo $dni?>
            </strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Apellido paterno:</strong>								
        </td>
        <td>
            <input name="txtApellidoPaterno" id="txtApellidoPaterno" type="text" value="<?php echo $apellidopaterno?>" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Paterno">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Apellido materno:</strong>								
        </td>
        <td>
            <input name="txtApellidoMaterno" id="txtApellidoMaterno" type="text" value="<?php echo $apellidomaterno?>" style="width: 60%" data-requerido="true" data-requerido-texto="Apellido Materno">
        </td>
    </tr>
    <tr>
        <td>
            <strong>Nombres:</strong>								
        </td>
        <td>
            <input name="txtNombre" id="txtNombre" type="text" value="<?php echo $nombre;?>" style="width: 60%" data-requerido="true" data-requerido-texto="Nombres">
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
            <input name="txtTelefono" id="txtTelefono" type="text" value="<?php echo $celular?>" style="width: 60%">
        </td>
    </tr>	
    <tr>
        <td>
            <strong>Email:</strong>								
        </td>
        <td>
            <input name="txtEmail" id="txtEmail" type="text" value="<?php echo $email?>" style="width: 60%">
        </td>
    </tr>	
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
            <strong>Tipo colegio:</strong>								
        </td>
        <td>
            <?php MostrarComboZet("cboTipoColegio",$vsqltipocolegio,$tipocolegio,'Si'); ?>
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
            <strong>A&ntildeo egreso:</strong>								
        </td>
        <td>
            <input name="txtAnioEgreso" id="txtAnioEgreso" type="text" value="<?php echo date('Y')-1?>" style="width: 10%" data-requerido="true" data-requerido-texto="Año egreso" maxlength="4">
        </td>
    </tr>  																																									
    <tr>
        <td align="center" colspan="2">
            <input name="proceso" type="hidden" value="<?php echo $proceso;?>">
            <input name="txtReciboPago" type="hidden" value="<?php echo $clavel;?>">	
            <input name="postulante" type="hidden" value="">
            <input name="dni" type="hidden" value="<?php echo $dni;?>">	
            <input name="pre" type="hidden" value="<?php echo $persona;?>">								
            <input name="txtTipo" type="hidden" value="J">
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
            cargarubigeo('cboProvincia',this.value,'01','01','provincia')
            crearselect('cboDistrito',{})
        }
    )
    $('#cboProvincia').change(
        function () {
            cargarubigeo('cboDistrito',$('#cboDepartamento').val(),this.value,'01','distrito')
        }
    )
</script>