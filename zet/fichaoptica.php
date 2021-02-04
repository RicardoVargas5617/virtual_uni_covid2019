<?php
foreach($_REQUEST as $key=>$valor)
{
    $$key=$valor;
}
?>
<form  name="frmSubirFichaOptica" id="frmSubirFichaOptica" class="form-horizontal porlets-content" method="post"  onsubmit="grabar(this.id);return false;" action="uploadfichaoptica.php" enctype="multipart/form-data">
    <input type="file" name="filfichaoptica" data-requerido="true" data-requerido-texto="Seleccione archivo a procesar">
    <input type="hidden" name="hidsede" value="<?php echo $sede?>">
    <input type="hidden" name="hidsemestre" value="<?php echo $semestre?>">
    <input type="hidden" name="hidfaseadmision" value="<?php echo $fase?>">
</form>