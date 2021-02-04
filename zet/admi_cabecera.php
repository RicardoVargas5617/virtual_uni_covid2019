<?php
$navnuevo='';
$frmtitulo='';
foreach($_REQUEST as $key=>$valor){
$$key=$valor;
}
if(isset($_REQUEST['nav'])) {
$nav = base64_decode($_REQUEST['nav']);
$navarray = explode(',', $nav);

$cantidad=count($navarray);
$frmtitulo=$navarray[$cantidad-1];
$numarry=$cantidad==1?1:$cantidad-1;
$navarray=array_splice($navarray,0,$numarry);

$nav=implode(',',$navarray);
 $nav=base64_encode($nav);
}
else
{
	echo 'Se produjo un error';
	//exit;
}

?>
<div class="panel-heading">
    <h3 class="panel-title"> <i class="fa fa-th"></i>
     <?php echo ($frmtitulo)?>
    
    </h3>
</div>
