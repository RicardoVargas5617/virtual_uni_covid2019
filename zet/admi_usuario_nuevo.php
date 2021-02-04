<?php 
	require_once("zet_seg.php");
	$cn = conectar();
	$titulo = 'Usuario';
	$activo = 1;
	$varon = 1;
	$sede = '01';
	$tipodocumento = '01';
	$fechanacimiento = date('d/m/Y');
	
	$vsqlsede = "select sede, descripcion from mae_sede where activo=1 order by descripcion";
	$vsqlescuela = "select estructura, descripcion from mae_estructura order by descripcion";
	$vsqlperfil = "select perfil, nombre from men_perfil where publico=0 order by nombre";
	$vsqltipodocumento = "select tipodocumento, descripcion from mae_tipodocumento order by descripcion";	
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="admi_usuario.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i>
    	</a>
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  <div class="porlets-content">
    <form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="admi_usuario_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="Autom&aacute;tico">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Apellido Paterno:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtApellidoPaterno" id="txtApellidoPaterno" data-requerido="true" data-requerido-texto="Apellido Paterno">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Apellido Materno:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtApellidoMaterno" id="txtApellidoMaterno" data-requerido="true" data-requerido-texto="Apellido Materno">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Primer Nombre:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtPrimerNombre" id="txtPrimerNombre" data-requerido="true" data-requerido-texto="Primer Nombre">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Segundo Nombre:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtSegundoNombre" id="txtSegundoNombre">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Perfil:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboPerfil",$vsqlperfil,'','Si'); ?>
        </div>
      </div><!--/form-group--> 

      <div class="form-group">
        <label class="col-sm-3 control-label">Sede:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboSede",$vsqlsede,$sede,'Si'); ?>
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Escuela:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboEscuela",$vsqlescuela,'','Si'); ?>
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Tipo Documento:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboTipoDocumento",$vsqltipodocumento,$tipodocumento,'Si'); ?>
        </div>
      </div><!--/form-group--> 

      <div class="form-group">
        <label class="col-sm-3 control-label">Numero Documento:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtNumeroDocumento" id="txtNumeroDocumento" data-requerido="true" data-requerido-texto="Numero Documento" maxlength="8">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha Nacimiento:</label>
        <div class="col-sm-2">
        <!--<input type="text" class="form-control mask" data-inputmask="'alias': 'date'"  value="<?php echo $fechanacimiento;?>" name="txtFechaNacimiento" id="txtFechaNacimiento" data-requerido="true" data-requerido-texto="Fecha Nacimiento">-->        
        <input type="text" value="<?php echo $fechanacimiento;?>" name="txtFechaNacimiento" id="txtFechaNacimiento" data-requerido="true" data-requerido-texto="Fecha Nacimiento">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtEmail" id="txtEmail" data-requerido="true" data-requerido-texto="Email">
        </div>
      </div><!--/form-group--> 
      
       <div class="form-group">
        <label class="col-sm-3 control-label">Tel&eacute;fono:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtTelefono" id="txtTelefono" data-requerido="true" data-requerido-texto="Telefono">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Celular:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtCelular" id="txtCelular" data-requerido="true" data-requerido-texto="Celular">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Direcci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="txtDireccion" id="txtDireccion" data-requerido="true" data-requerido-texto="Celular">
        </div>
      </div><!--/form-group--> 
      
	  <div class="form-group">
        <label class="col-sm-3 control-label">Var&oacute;n:</label>
        <div class="col-sm-9">
        	<div class="checkbox">
            	<label>
                <input name="chkVaron" type="checkbox" id="chkVaron" onclick="this.value=gEsCasillaActiva(this.id);" value="<?php echo $varon?>" <?php if ($varon==1) {echo "checked";} ?>>
                <span class="custom-checkbox"></span>
                </label>
            </div>  
        </div>
      </div><!--/form-group--> 

	  <div class="form-group">
        <label class="col-sm-3 control-label">Activo:</label>
        <div class="col-sm-9">
        	<div class="checkbox">
            	<label>
                <input name="chkActivo" type="checkbox" id="chkActivo" onclick="this.value=gEsCasillaActiva(this.id);" value="<?php echo $activo?>" <?php if ($activo==1) {echo "checked";} ?>>
                <span class="custom-checkbox"></span>
                </label>
            </div>  
        </div>
      </div><!--/form-group--> 

      <div class="bottom">
			<input name="codigo" type="hidden" value="">
            <input name="txtTipo" type="hidden" value="N">
            <input name="cmdGrabar" type="submit" value="Grabar" class="btn btn-primary">
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>
<script>$('#cboSede').css('width','100%')</script>
<script>$('#cboEscuela').css('width','100%')</script>
<script>$('#cboPerfil').css('width','100%')</script>
<script>$('#cboTipoDocumento').css('width','100%')</script>
<script>
function gEsCasillaActiva(idCasilla) {
    if (!document.getElementById(idCasilla)) {
        alert("El objeto no existe.\ngVerificaCasilla()");
    }
    return document.getElementById(idCasilla).checked ? "1" : "0";
}
</script>