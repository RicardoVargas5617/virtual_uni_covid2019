<?php 
	require_once("zet_seg.php");
	$codigo = $_GET["codigo"];
	$perfil = substr($codigo,0,3);
	$dominio = substr($codigo,3,2);
	$vsql = "call zyz_Man_PerfilOpcion ('". $perfil . "','". $dominio . "','','N')";	
	$opcion="";	
	$titulo = 'Opciones por perfil';
	$nombreperfil = nombreperfil($perfil);		
	$contador = 0;
?>
<div class="row">
  <div class="block-web">
  <div class="header">
  	<div class="actions"> 
        <a data-atras="SI" href="admi_perfilopcion.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&codigo=<?php echo $codigo;?>">
        <i class="fa fa-mail-reply"></i>
    	</a>
    </div>
    <h5 class="content-header"><?php echo $titulo;?></h5>
  </div>
  <div class="porlets-content">
    <form  name="form" class="form-horizontal row-border" method="post" id="frmcronmod" action="admi_perfilopcion_grabar.php?d=<?php echo $_GET['d']?>&nav=<?php echo $_GET['nav']?>" onsubmit="grabar(this.id);return false;">
      <div class="form-group">
        <label class="col-sm-3 control-label">Perfil:</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="Disabled Input" disabled="" value="<?php echo $nombreperfil;?>">
        </div>
      </div><!--/form-group--> 
      
      <div class="form-group">
        <label class="col-sm-3 control-label">Descripci&oacute;n:</label>
        <div class="col-sm-9">
        <?php MostrarComboZet("cboOpcion",$vsql,$opcion,'Si'); ?>
        </div>
      </div><!--/form-group--> 

      <div class="bottom">
        	<input name="hidCodigo" type="hidden" value="<?php echo $codigo;?>">
            <input name="txtTipo" type="hidden" value="A">
            <input name="cmdGrabar" type="submit" value="Agregar" class="btn btn-primary">	
      </div><!--/form-group-->
    </form>
  </div><!--/porlets-content-->
  </div>
</div>
<script>$('#cboOpcion').css('width','100%')</script>
