<?php
	require_once("zet_seg.php");
?>
<div class="alert alert-success">
	<span class="semi-bold">Maestros:</span>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=03&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Sedes')?>">Sedes</a>
    </li>
    <!--
    <li class="list-group-item">
        <a href="mantenedorfacultad.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Facultades')?>">Facultad</a>
    </li>
    -->
    <li class="list-group-item">
        <a href="mantenedorescuela.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Carreras profesionales')?>">Carreras Profesionales</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorcurricula.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Curriculas')?>">Curriculas</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorcurso.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Curso')?>">Cursos</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorsemestre.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Semestre')?>">Semestre</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorparametrosgenerales.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Parametros')?>">Parametros generales</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorlocal.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Locales')?>">Locales</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedorambiente.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Ambientes')?>">Ambientes</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=04&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Departamento academico')?>">Departamento acad&eacutemico</a>
    </li>
    <!--
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=01&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Categoria curso')?>">Categoria curso</a>
    </li>
    -->
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=05&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Condicion alumno')?>">Condici&oacute;n alumno</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=06&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Dedicacion docente')?>">Dedicaci&oacute;n docente</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=25&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Grado academico')?>">Grado acad&eacute;mico</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=15&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Categoria docente')?>">Categor&iacute;a docente</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=07&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Modalidad ingreso')?>">Modalidad de ingreso</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=08&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Modalidad de estudio')?>">Modalidad de estudio</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=09&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de ambiente')?>">Tipo de ambiente</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=10&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de dictado')?>">Tipo de dictado</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=11&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de evaluación')?>">Tipo de evaluaci&oacute;n</a>
    </li>
    <!--
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=12&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de institucion')?>">Tipo de instituci&oacute;n</a>
    </li>
    -->
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=13&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de preparacion')?>">Tipo de preparaci&oacute;n</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=14&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de resolucion')?>">Tipo de resoluci&oacute;n</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=16&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de colegio')?>">Tipo de colegio</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=17&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo de procedencia')?>">Tipo de procedencia</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=18&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Categoria alumno')?>">Categor&iacute;a alumno</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=19&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Estado civil')?>">Estado civil</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=20&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo documento')?>">Tipo documento</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=21&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nivel educactivo')?>">Nivel educativo</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=22&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo via')?>">Tipo v&iacute;a</a>
    </li>
    <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=23&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo zona')?>">Tipo zona</a>
    </li>
     <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=24&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Cargo')?>">Cargo</a>
    </li>
         <li class="list-group-item">
        <a href="mantenedormaestro.php?code=<?php echo md5(md5($usuario))?>&codigo=37&d=<?php echo $_GET['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Tipo Ocupacion')?>">Tipo Ocupaci&oacute;n</a>
    </li>
</ul>