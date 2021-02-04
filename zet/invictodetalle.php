<?php 
	$cn = conectar();	
	if (isset($_POST['cboSede'])) 
		{
			$sede = $_POST["cboSede"];
			$semestre = $_POST["cboSemestre"];
			$escuela = $_POST["cboEscuela"];	
		}
	$vsql = "select semestre, semestre from mae_semestre order by semestre desc";
	$vsql1 = "select sede, descripcion from mae_sede where activo = 1 order by descripcion";
	$vsql2 = "select estructura, descripcion from mae_estructura where activo=1 and nivel=3 order by descripcion";
	$contador = 0;
?>		
<form method="post">	
<table>
    <tr>
        <td>            
            <a data-atras="SI" href="reportesestadisticos.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>					
<table class="table">																																
	<tr>
        <td width="8%">
            <strong>Sede:</strong>
        </td>
        <td>
        <?php MostrarComboJuanc("cboSede",$vsql1,$sede); ?>
        </td>																																										
    </tr>	
    <tr>
        <td>
            <strong>Semestre:</strong>
        </td>
        <td>
          <?php MostrarComboJuanc("cboSemestre",$vsql,$semestre); ?>
        </td>														
    </tr>
    <tr>
        <td>
            <strong>Carrera:</strong>
        </td>
        <td>
          <?php MostrarComboJuanc("cboEscuela",$vsql2,$escuela); ?>
        </td>														
    </tr>																																
</table>
</form>
<div class="well">
	<span class="semi-bold">Opciones</span>
</div>
<?php
	$codigo=$sede.$semestre.$escuela;
?>
<ul class="list-group">
	<li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/imprimirmaestro_unidad.php?codigo=<?php echo $codigo?>')">
        Estad&iacute;sticas por curso
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/invictodetalleimprimir.php?codigo=<?php echo $codigo?>')">
        Importes programados (siguiente semestre)
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadistica_destacado.php?codigo=<?php echo $codigo?>')">
        Estudiantes destacados
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticadesaprobado.php?codigo=<?php echo $codigo?>')">
        Desaprobados durante el primer año de estudios
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticaingresante.php?codigo=<?php echo $codigo?>')">
        Relaci&oacute;n de ingresantes matriculados
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticainactivo.php?codigo=<?php echo $codigo?>')">
        Estad&iacute;sticas inactivo
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticacuarta.php?codigo=<?php echo $codigo?>')">
        Cursos por cuarta vez o m&aacute;s
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticatercera.php?codigo=<?php echo $codigo?>')">
        Cursos por tercera vez o m&aacute;s
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticapadron.php?codigo=<?php echo $codigo?>')">
        Padr&oacute;n de estudiantes
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadistica_foto.php?codigo=<?php echo $codigo?>')">
        Fotos de estudiantes matriculados
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticadireccion.php?codigo=<?php echo $codigo?>')">
        Direcciones de estudiantes (Excel)
        </a>   
    </li>
    <li class="list-group-item">
		<a href="javascript:ventanaSecundaria('<?php echo GL_DIR_WS_HTTP_APP?>zet/estadisticacolegio.php?codigo=<?php echo $codigo?>')">
        Estudidantes x colegio de procedencia
        </a>   
    </li>
</ul>
<script>$('#cboEscuela').css('width','40%')</script>