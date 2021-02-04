<?php 
	$cnzoz = conectar();
	if (isset($_POST['cboDominio'])) 
		{
			$dominio = $_POST["cboDominio"];
			$menu = $_POST["cboMenu"];
		}
	elseif (isset($_GET['dominio'])) 
		{
			$dominio = $_GET["dominio"];
			$menu = $_GET["menu"];
		}
	else
		{
			$dominio = '01';
			$menu='001';	
		}
	$vsqldominio = "select dominio, nombre from men_dominio order by nombre";	
	$vsqlmenu = "select menu, nombre from men_menuprincipal where dominio=$dominio order by nombre";
	echo $vsqlmenu;
	echo '<br>';

	$rs = mysqli_query($cnzoz, $vsqlmenu);
	$num= mysqli_num_rows($rs); 	
	if ($num==0)
		{
			#$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$menu='000';
			#$nombreciclo = 	nombreciclo($row["ciclo"]);
			#$creditosextras =  $row["creditosextras"];
			#mysqli_data_seek($rs,0);
		}	
	elseif ($num==1)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$menu=$row["menu"];;
			#$nombreciclo = 	nombreciclo($row["ciclo"]);
			#$creditosextras =  $row["creditosextras"];
			#mysqli_data_seek($rs,0);
		}	
	echo $num;
	echo '<br>';
	echo $menu;
				
	$vsql = "call zyz_CAMantenedorOpciones ('$dominio','001','$menu','','','','','',0,0,0,'C')";	
	#echo $vsql;
	$rs = mysqli_query($cn,	$vsql);			
	$contador = 0;
?>
<form method="post">
<table>
    <tr>
        <td>            
            <a href="administracionusuarios.php?code=<?php echo md5(md5($usuario))?>&d=<?php echo $_GET['d']?>&nav=<?php echo $nav?>" data-atras="SI"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td width="8%">
            <strong>Dominio:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboDominio",$vsqldominio,$dominio); ?>
        </td>											
    </tr>
    <tr>
        <td>
            <strong>Menu:</strong>
        </td>
        <td>
            <?php MostrarComboJuanc("cboMenu",$vsqlmenu,$menu); ?>
        </td>											
    </tr>
</table>
</form>
<table class="table table-bordered"> 
	<thead>
    <tr>
        <th width="8%" style="text-align: center">
            <strong>C&oacute;digo</strong>
        </th>
        <th style="text-align: center">
            <strong>Descripci&oacute;n</strong>
        </th>
        <th width="7%" style="text-align: center">
            <strong>Activo</strong>
        </th>											
        <th width="10%" style="text-align: center">
        	<?php 
				if ($menu<>'000')
					{
						echo '<a class="btn btn-default" href="mantenedormenunuevo.php?d=';
						echo $_REQUEST['d'];
						echo '&dominio=';
						echo $dominio.'001',$menu;
						echo '&nav=';	
						echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo');
						echo '">';
						echo '<i class="fa fa-file-o"></i></a>';
					}
			?>
            <!--<a class="btn btn-default" href="mantenedormenunuevo.php?d=<?php echo $_REQUEST['d']?>&dominio=<?php echo $dominio.'001'.$menu?>&nav=<?php echo base64_encode(base64_decode($_REQUEST['nav']).',Nuevo')?>"><i class="fa fa-file-o"></i></a>-->
        </th>
    </tr>
    </thead>
    <?php							
    while ($rsjk=mysqli_fetch_row($rs))
        {
            $contador = $contador + 1;						
            echo '<tr>';
                echo '<td align="center">';
                    echo $rsjk[0];
                echo '</td>';
                echo '<td align="left">';
                    echo '<a href="mantenedormenumodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'">'.substr($rsjk[1],0,50).'</a>';
                echo '</td>';						
                echo '<td align="center">';
                    if ($rsjk[2]==1){
                        echo '<span class="blue_bg bg_space">';
                        echo 'Activo';
                        echo '</span>';
                    }
                    else
                    {
                        echo '<span class="red_bg bg_space">';
                        echo 'Inactivo';
                        echo '</span>';
                    }
                echo '</td>';													
                echo '<td align="center">';													
                    echo '<a class="btn btn-default" href="mantenedormenumodificar.php?d='. $_REQUEST['d'].'&nav='.base64_encode(base64_decode($_REQUEST['nav']).',Modificar').'&clave='.$rsjk[0].'"><i class="fa fa-edit"></i></a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-default" rel="nolink" href="mantenedormenueliminar.php?d='. $_REQUEST['d'].'&nav='.$_REQUEST['nav'].'&clave='.$rsjk[0].'" data-mensaje="Esta seguro de eliminar el registro?"><i class="fa fa-ban"></i></a>';
                    echo '</a>';																									
                echo '</td>';																																													
            echo '<tr>';
        }
        mysqli_close($cn);
    ?>										
</table>