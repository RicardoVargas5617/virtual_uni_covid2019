<?php 
	require_once("zet_seg.php");
	$cn = conectar();
	$codigo = base64_decode(base64_decode($_GET['codigo']));
	$per = substr($codigo,0,8);
	$tra = substr($codigo,8,8);
	$titulo = 'Usuario';

	$vsql = "call zyz_Man_Usuario ('". $per ."','". $tra ."','','','',0,'','','','',0,'1900-01-01','','','','','','','','','','F')";
	
	$rs = mysqli_query($cn, $vsql);
	$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
	$personazet = $row["persona"];
	$trabajador = $row["trabajador"];
	$sede = $row["sede"];
	$escuela = $row["estructura"];
	$perfil = $row["perfil"];
	$activo = $row["activo"];
	
	$apellidopaterno = $row["apellidopaterno"];
	$apellidomaterno = $row["apellidomaterno"];
	$primernombre = $row["primernombre"];
	$segundonombre = $row["segundonombre"];
	$nombrecompleto = $apellidopaterno.' '.$apellidomaterno;
	$varon = $row["varon"];
	//echo $varon;
	$fechanacimiento = $row["fechanacimiento"];
	$email = $row["email"];
	$telefono = $row["telefono"];
	$celular = $row["celular"];
	$tipodocumento = $row["tipodocumento"];
	$direccion = $row["direccion"];

	$numerodocumento = $row["numerodocumento"];
	$vsqlsede = "select sede, descripcion from mae_sede where activo=1 order by descripcion";
	$vsqlescuela = "select estructura, descripcion from mae_estructura order by descripcion";
	$vsqltipotrabajador = "select tipotrabajador, descripcion from per_tipotrabajador order by descripcion";
	$vsqlcargo = "select cargo, descripcion from per_cargo order by descripcion";
	$vsqlnivel = "select nivel, descripcion from men_nivel order by descripcion";
	$vsqlperfil = "select perfil, nombre from men_perfil where publico=0 order by nombre";
	$vsqlniveleducativo = "select niveleducativo, descripcion from mae_niveleducativo order by descripcion";
	$vsqlestadocivil = "select estadocivil, descripcion from mae_estadocivil order by descripcion";
	$vsqltipodocumento = "select tipodocumento, descripcion from mae_tipodocumento order by descripcion";	
	$vsqltipovia = "select tipovia, descripcion from mae_tipovia order by descripcion";
	$vsqltipozona = "select tipozona, descripcion from mae_tipozona order by descripcion";
	$vsqlpais = "select pais, descripcion from mae_pais order by descripcion";
	//echo $fechanacimiento;
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="admi_usuario.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i>
    	</a>
        <?php
        echo '<a data-eliminar="NO" rel="nolink" href="admi_usuario_reiniciar.php?cod='.md5(md5($usuario)).'&d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&codigo='.base64_encode(base64_encode($codigo)).'" data-mensaje="Esta seguro de reiniciar la clave?">';
		echo '<i class="fa fa-bolt"></i>';
		echo '</a>';	
        ?>
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  <div class="porlets-content">
    <form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="admi_usuario_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
      <div class="form-group">
        <label class="col-sm-3 control-label">C&oacute;digo:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $per; ?>">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Apellido Paterno:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $apellidopaterno;?>" name="txtApellidoPaterno" id="txtApellidoPaterno" data-requerido="true" data-requerido-texto="Apellido Paterno">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Apellido Materno:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $apellidomaterno;?>" name="txtApellidoMaterno" id="txtApellidoMaterno" data-requerido="true" data-requerido-texto="Apellido Materno">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Primer Nombre:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $primernombre;?>" name="txtPrimerNombre" id="txtPrimerNombre" data-requerido="true" data-requerido-texto="Primer Nombre">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Segundo Nombre:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $segundonombre;?>" name="txtSegundoNombre" id="txtSegundoNombre">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Perfil:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboPerfil",$vsqlperfil,$perfil,'Si'); ?>
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
        <?php MostrarComboZet("cboEscuela",$vsqlescuela,$escuela,'Si'); ?>
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
        <input type="text" class="form-control" value="<?php echo $numerodocumento;?>" name="txtNumeroDocumento" id="txtNumeroDocumento" data-requerido="true" data-requerido-texto="Numero Documento" maxlength="8">
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
        <input type="text" class="form-control" value="<?php echo $email;?>" name="txtEmail" id="txtEmail" data-requerido="true" data-requerido-texto="Email">
        </div>
      </div><!--/form-group--> 
      
       <div class="form-group">
        <label class="col-sm-3 control-label">Tel&eacute;fono:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $telefono;?>" name="txtTelefono" id="txtTelefono" data-requerido="true" data-requerido-texto="Telefono">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Celular:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $celular;?>" name="txtCelular" id="txtCelular" data-requerido="true" data-requerido-texto="Celular">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Direcci&oacute;n:</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $direccion;?>" name="txtDireccion" id="txtDireccion" data-requerido="true" data-requerido-texto="Celular">
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
			<input name="codigo" type="hidden" value="<?php echo $codigo;?>">
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