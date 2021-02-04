<?php 
	$codigo = $_GET["codigo"];
	$proceso = substr($codigo,0,4);
	$estructura = substr($codigo,4,2);
	$modalidadadmision = substr($codigo,6,2);
	$nombreproceso = nombreproceso($proceso);
	$nombreescuela = nombreescuela($estructura);
	$nombremodalidad = nombremodalidadadmision($modalidadadmision);
	
	$contador = 0;
?>
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="adm_rep_carrera.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>&proceso=<?php echo $proceso?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table class="table">
	<tr>
    	<td width="8%">
        	<strong>Proceso:</strong>
        </td>
        <td>
        	<?php echo $nombreproceso; ?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Escuela:</strong>
        </td>
        <td>
        	<?php echo $nombreescuela; ?>
        </td>
    </tr>
    <tr>
    	<td>
        	<strong>Modalidad:</strong>
        </td>
        <td>
        	<?php echo $nombremodalidad; ?>
        </td>
    </tr>
</table>
<div class="alert alert-success">
	<span class="semi-bold">Opciones:</span>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_ingresante_car_imprimir.php?codigo=<?php echo $codigo ?>')">
        Padr&oacute;n general de ingresantes
        </a> 
    </li>
    <li class="list-group-item">
        <a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_ingresante_car_excel.php?codigo=<?php echo $codigo ?>')">
        Padr&oacute;n general de ingresantes (Excel)
        </a> 
    </li>
</ul>
<div class="alert alert-success">
	<span class="semi-bold">Instituto:</span>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_ingresante_car_imprimir_ins.php?codigo=<?php echo $codigo ?>')">
        Padr&oacute;n general de ingresantes
        </a> 
    </li>
    <li class="list-group-item">
        <a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/adm_ingresante_car_excel_ins.php?codigo=<?php echo $codigo ?>')">
        Padr&oacute;n general de ingresantes (Excel)
        </a> 
    </li>
</ul>
