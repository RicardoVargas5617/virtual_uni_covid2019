<?php
	include('../funciones/admi_con.php');
	include('../funciones/admi_fun.php');	
	$cn = conectar();	
	$tipejo=$_POST["tipejo"];
	$cadena=$_POST["cadena"];
	if ($tipejo=='C')
		{
			$cadena=str_replace("'","''",$cadena);
			$vsql = $cadena;				
			$rs = mysqli_query($cn,$vsql)or die(mysqli_error($cn));		
		}
	else
		{
			$cadena=str_replace("'","''",$cadena);
			$vsql = $cadena;
			mysqli_query($cn,$vsql) or die (mysqli_error($cn));
		}
	echo $vsql;
	if ($tipejo=='C')
		{		
?>
<html>
<head>
<title>Revista</title>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</head>
<body>
<table width="600" border="1" bgcolor="#EAE2BB" align="center">
    <tr>
        <td align="center" class="footerzet">1</td>
        <td align="center" class="footerzet">2</td>
        <td align="center" class="footerzet">3</td>
        <td align="center" class="footerzet">4</td>
        <td align="center" class="footerzet">5</td>
    </tr>
    <?php 
    $contador = 0;
    while ($rsjk= mysqli_fetch_row($rs))
    { 
        $contador = $contador + 1;
        echo '<tr>';
            echo '<td align="center"> ';
                echo $rsjk[0];
            echo '</td>';
            echo '<td>';
                echo $rsjk[1];
            echo '</td>';			
            echo '<td>';
                echo $rsjk[2];
            echo '</td>';			
            echo '<td>';
                echo $rsjk[3];
            echo '</td>';			
            echo '<td>';
                echo $rsjk[4];
            echo '</td>';	
        echo '</tr>';			
    }
    ?>		  
</table>						
</body>
</html>
<?php
	}
?>