<?php 
	require_once("zet_seg.php");
	$cn = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$titulo = 'Supervisor';

	$vsql = "call zyz_Man_Supervisor ('". $codigo ."','1','2','3',0,'4','M')";
	
	$rs = mysqli_query($cn, $vsql);
	$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
	$codigo = $row["supervisor"];
	$nombrecompleto = $row["nombrecompleto"];
	$email = $row["email"];
	$celular = $row["celular"];
	$clavel = $row["clavel"];
	$activo = $row["activo"];
	//echo $fechanacimiento;
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="admi_supervisor.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i>
    	</a>        
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  
  <div class="porlets-content">
    <form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="admi_supervisor_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $codigo; ?>">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Nombre completo:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $nombrecompleto;?>" name="txtNombreCompleto" id="txtNombreCompleto" data-requerido="true" data-requerido-texto="Apellidos y Nombres">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $email;?>" name="txtEmail" id="txtEmail" data-requerido="true" data-requerido-texto="Email">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Celular:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $celular;?>" name="txtCelular" id="txtCelular" data-requerido="true" data-requerido-texto="Celular">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Clave:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $clavel;?>" name="txtClavel" id="txtClavel">
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
			<input name="txtDni" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
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