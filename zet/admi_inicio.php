<?php 
	#echo $proceso;
	if (!isset($proceso))
		{
			echo 'No tiene permisos';
			$exit;
		}

	#require_once("zet_seg.php");
	$cnzet = conectar();
	mysqli_query($cnzet,"SET CHARACTER SET utf8");
	mysqli_query($cnzet,"SET NAMES utf8");
	$vsql = "call zyz_MantenedorProceso_Calendario ('". $proceso . "', '1900-01-01','1900-01-01','','C')";	
	#echo $vsql;	
	$rs = mysqli_query($cnzet, $vsql);	
	$numeroregistros = mysqli_num_rows($rs); 
	
	if ($numeroregistros > 0)
		{
			$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			$fechainicio = $row["fechainicio"];
			$horainicio = $row["horainicio"];
			$fechafin = $row["fechafin"];
			$horafin = $row["horafin"];
			$mensaje = $row["mensaje"];
			mysqli_data_seek($rs,0);
		}	
	$nombreproceso = nombreproceso($proceso);
?>
<table width="100%">
	<tr>
    	<td align="center">
        	<span style="font-size:16px; font-weight:bold;">BIENVENIDO <?php echo $nombreproceso;?></span>
        </td>
    </tr>
    <tr>
    	<td>
        	<br>
            <?php echo $mensaje;?>
            <?php
				if($proceso === "0016"){
			?>
			 Recuerda que todo está siendo monitoriado. Para evitar ser anualado, cierre todos los programas ajenos al examen. <br>
			 No puede tener abierto ningún tipo de programas ofimáticos (No word, No excel, No pdf, . . .) <br>
			 Debe cerra facebook, whatsapp, messenger, o cualquier otro tipo de programa de mensajeria . . . <br>
			 No debes tener instalado programas remotos. Por ejemplo Any desk o Team Viewer, ni ningún otro programa del mismo tipo. <br>
			 No salga de sus examen. Una vez que das inicio con el examen, no debes cambiar de pestana, ni minimizar el examen, menos salir de el. <br>
			 Es obligatorio encender la camara del celular durante todo el examen. <br>
			 En el caso de que el supervisor lo requiera, debe activar el microfono del celular, para desarrollar la comunicación .
			 

			<?php
				}
			?>
			
        </td>
    </tr>
</table>
<?php

	if($proceso === "0000"){

	
?>
<!-- CDN'S PARA ALERTASUNAJMA -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
	setTimeout(() => {
        Swal.fire(
        'Comunicado Postulante Extraordinario.',
        `Estimado postulante al proceso de admisión EXTRAORDINARIO 2021-1, mencionarle que el día viernes 26 de febrero de 2021 a horas 04:40 p.m. se desarrollara un simulacro y prueba del examen de admisión virtual, para lo cual debe estar a partir de la hora indicada y en el caso de no haber recibido el correo con las instrucciones comunicarse con los siguientes números: 
        991828881, 
        913841534, 
        928145892, 
        916331094, 
        985951660
        `,
        'info'
        )
    }, 1500);
</script>

<?php

	}
	
?>