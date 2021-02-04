<?php
	require_once("zet_seg.php");
?>
<div class="alert alert-success">
	<span class="semi-bold">Administrar:</span>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <a href="perfil.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Perfiles')?>">Perfiles</a>
    </li>
    <li class="list-group-item">
        <a href="perfilopcion.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Opciones por perfil')?>">Opciones por perfil</a>
    </li>
</ul>
<div class="alert alert-success">
	<span class="semi-bold">Base:</span>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <a href="mantenedordominio.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Dominio')?>">Dominio</a>
    </li>
</ul>