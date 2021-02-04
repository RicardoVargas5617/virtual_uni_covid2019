<?php 
	$cn_pre = conectar();
	mysqli_query($cn_pre,"SET CHARACTER SET utf8");
	mysqli_query($cn_pre,"SET NAMES utf8");
					
	$vsql_pregunta = "call zyz_Admi_EstructuraPostulante ('". $persona . "','". $proceso . "','','','',0,'". $vescuela . "','A')";
	#echo $vsql_pregunta;
	$rs_pre = mysqli_query($cn_pre, $vsql_pregunta);
?>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
 html>body #sortable li { height: 1.5em; line-height: 1.2em; }
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid #c5c5c5;
    background: #f6f6f6;
    font-weight: normal;
    color: #454545;
}
  .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
  </style>
<table>
    <tr>
        <td>
            
            <a data-atras="SI" href="admi_examen.php?d=<?php echo $_REQUEST['d']?>&nav=<?php echo $nav?>"><i class="fa fa-mail-reply"></i> Regresar</a>
        </td>
    </tr>
</table>  
<?php
	echo '<div class="alert alert-warning">';
		echo '<strong style="font-size:14px">Aviso: </strong>';
		echo '<span style="font-size:13px">Arrastre la categor&iacute;a de pregunta a la posici&oacute;n que desea.</span>';
	echo '</div>';
  	echo '<ul id="sortable">';
	$contador = 0;
  	while ($rsjk_pre=mysqli_fetch_row($rs_pre))
		{
			  echo '<li class="ui-state-default" id="item'.$contador.'" data-id=';#id es la key del registro
			  echo $rsjk_pre[0];#este es el key
			  echo " data-pos='".$contador."'>";#el post el el orden de
			  echo $rsjk_pre[1];
			  echo '</li>';
			  $contador = $contador + 1;
		}
		mysqli_close($cn_pre);
	echo '</ul>';	
?> 

<script>
  $( function() {
  $( "#sortable" ).sortable({
    placeholder: "ui-state-highlight",
    stop: function(event, ui) {

      var itemOrder = $('#sortable').sortable("toArray");

      for (var i = 0; i < itemOrder.length; i++) {
        var pos=$("#"+itemOrder[i]).data('pos');
        var id=$("#"+itemOrder[i]).data('id');
        console.log("Position: "+pos+" Actual: " + i + " ID: " + itemOrder[i]+'-->'+id);
        $("#"+itemOrder[i]).data('pos',i)
        //if(i!=pos){
          $.ajax({
              url: '../zet/cambiarpuesto.php',
              method: 'POST',
              data: { ID: id, ordenantes: pos, ordernuevo: i }//aca se pagan los parametros
			  /*
			  $_post[ID]=varlor id
  			  $_post[ordenantes]=varlor id
			   $_post[ordernuevo]=varlor id
			  */
          });
        //}
      }
      <!--alert('Se reordeno la lista')-->
    }
  });

});
  </script>
