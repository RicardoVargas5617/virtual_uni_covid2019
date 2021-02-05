<?php
	$cn_zet = conectar(); 
	mysqli_query($cn_zet,"SET CHARACTER SET utf8");
	mysqli_query($cn_zet,"SET NAMES utf8");

	$d=$_SESSION['do'];
	$vsql = "call zoz_Usu ('". $persona . "', '". $usuario . "', '". $vperfil . "','". $d . "','". $proceso . "', '". $vtipo . "')";
	#echo $vsql;
	#exit;
	$rszet = mysqli_query($cn_zet, $vsql);
	//print_r($rszet);
	$cuenta = mysqli_num_rows($rszet);
	if ($cuenta > 0) {
		$moduloTMP = '';
		$menuTMP='';
		$i=1;
		while ($rsjk= mysqli_fetch_row($rszet))
			{
				if ($i==1)
					{
						$moduloTMP = $rsjk[4];	
						$menuTMP = $rsjk[6];
						echo '<ul>';
						#echo 'M&oacute;dulo '.$rsjk[3];
					}
				if ($moduloTMP <> $rsjk[4])
					{
						$moduloTMP = $rsjk[4];
						echo '</ul>';
						echo '<ul>';
						#echo 'M&oacute;dulo '.$rsjk[3];
					}

				#if ($menuTMP <> $rsjk[6])
				#	{	
				#		echo '</li>';					
				#	}
					
				if (($i==1) or ($menuTMP <> $rsjk[6]))
					{
						#echo '<br>';
						#echo $menuTMP;
						#echo $rsjk[6];
						if ($menuTMP <> $rsjk[6]){
							echo '</ul>';
							echo '</li>';		
						}
						$menuTMP = $rsjk[6];	
						echo '<li '.(($rsjk[6]==substr(@$_REQUEST['d'],0,8))?'class="left_nav_active theme_border" ':'').'>';
						echo '<a href="javascript:void(0);">';
						echo '<i class="fa fa-home"></i>';
							echo $rsjk[7];
							echo '<span class="left_nav_pointer">';
						echo '</span><span class="plus"><i class="fa fa-plus"></i></span>';
						echo '</a>';
							echo '<ul '.(($rsjk[6]==substr(@$_REQUEST['d'],0,8))?'class="opened" style="display: block;"':'style="display:none"').'>';
					}
				
				{
					echo '<li>';
					echo '<a href="'.GL_DIR_WS_HTTP_APP.'menu.php/';
					echo $rsjk[10];
					if ($rsjk[13]==1){
						echo '&code='.md5(md5($usuario));
					}
					else
					{
						echo '?code='.md5(md5($usuario));						
					}
					echo '&d='.$rsjk[8]. '&nav='.base64_encode($rsjk[9]);
					echo '">';
					echo '<span>&nbsp;</span> <i class="fa fa-circle theme_color"></i> <b class="'.($rsjk[8]==@$_REQUEST['d']?'theme_color':'').'">';
					echo $rsjk[9];
					echo '</b> </a>';
					echo '</li>';
				}				
				$i = $i + 1;
			}
		  }
		  #echo '</li>';
		  echo '</ul>';
?>
