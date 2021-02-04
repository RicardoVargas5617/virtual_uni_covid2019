<?php 
	require_once("zet_seg.php");
	if (isset($_POST['cboPerfil'])) 
		{
			$perfil = $_POST["cboPerfil"];
			$dominio = $_POST["cboDominio"];
		}
	elseif (isset($_GET['codigo'])) 
		{
			$codigo = $_GET["codigo"];
			$perfil = substr($codigo,0,3);
			$dominio = substr($codigo,3,2);
		}
	else
		{
			$perfil = '007';
			$dominio = '01';	
		}
	$vsqlperfil = "select perfil, nombre from men_perfil where publico=0 order by nombre ";
	$vsqldominio = "select dominio, nombre from men_dominio order by nombre ";	
	$vsql = "call zyz_Man_PerfilOpcion ('". $perfil . "','". $dominio . "','','C')";
	#echo $vsql;		
	$rs = mysqli_query($cn,	$vsql);			
	$contador = 0;
?>
<form method="post">
<table width="100%">
    <tr>
        <td width="8%">
            <strong>Perfil:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboPerfil",$vsqlperfil,$perfil); ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>M&oacute;dulo:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboDominio",$vsqldominio,$dominio); ?>
        </td>											
    </tr>
</table>
</form>
<br>
<table class="table table-striped">
	<thead>
    <tr>
        <th width="15%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>																				
        <th width="10%" style="text-align: center">
            <a class="btn btn-default" href="admi_perfilopcion_nuevo.php?code=<?php md5(md5($usuario))?>&d=<?php echo $_REQUEST['d']?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>&codigo=<?php echo $perfil.$dominio ?>"><i class="fa fa-file-o"></i></a>
        </th>
    </tr>
    </thead>
    <?php									
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[1];
                echo '</td>';
                echo '<td align="left">';
                    echo $rsjk[2];
                echo '</td>';					
                echo '<td align="center">';	
					echo '<a class="btn btn-default" rel="nolink" href="admi_perfilopcion_eliminar.php?codigo='.$rsjk[0].$rsjk[1].'&d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i>';
                    echo '</a>';																								
                echo '</td>';																																													
            echo '</tr>';
        }
        mysqli_close($cn);
    ?>										
</table>
<script>$('#cboPerfil').css('width','100%')</script>
<script>$('#cboDominio').css('width','100%')</script>