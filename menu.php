<?php
	session_start();
	include_once("config.php");
	include_once("zet/sessiones.php");
	set_time_limit(999999);
	if (!isset($_SESSION["usuario"]))
	{
		header("location:".GL_DIR_WS_HTTP_APP."index.php");
	}
	include_once(GL_DIR_FS_APP.'funciones/admi_con.php');
	include_once(GL_DIR_FS_APP.'funciones/admi_fun.php');
	$cn = conectar();

	mysqli_query($cn,"SET CHARACTER SET utf8");
	mysqli_query($cn,"SET NAMES utf8");

	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	$msgerror='';
	$nerror='';
	header('Content-Type: text/html; charset='.$vcolacion);
		$cnzet2=conectar();
		$vsql="select distinct a.dominio,b.nombre
		from men_perfilopcion a inner join men_dominio b on a.dominio=b.dominio
		where perfil='".$vperfil."' and a.dominio<>'99' and b.activo=1";
		#echo $vsql;
		$rs2=mysqli_query($cnzet2,$vsql);
	if(isset($_REQUEST['do'])){
		$_SESSION['do']=$_REQUEST['do'];
	}elseif(!isset($_SESSION['do'])){
		$row=mysqli_fetch_array($rs2,MYSQLI_ASSOC);
		$_SESSION['do']=$row['dominio'];
		mysqli_data_seek($rs2,0);
	}
	$nombredominio=nombredominio($_SESSION['do']);
	#include_once(GL_DIR_FS_APP . 'language/lang_PE.php')
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

    <title><?php echo GL_COMPANY?></title>
	<link rel="icon" href="<?php echo GL_DIR_WS_HTTP_APP?>zet/logo.ico">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $vcolacion?>"/>

	<!-- Revisar -->
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/animate.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/morris/morris.css" rel="stylesheet" />
	<!-- Fin Revisar -->

	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/font-awesome-animation.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/ajaxchosen.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/chosen.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/kalendar/kalendar.css" rel="stylesheet">
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/toastr/toastr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/scroll/nanoscroller.css">

	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/dropzone/dropzone.css" rel="stylesheet">
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
	<link href="<?php echo GL_DIR_WS_HTTP_APP?>plugins/checkbox/icheck.css" rel="stylesheet" />
	<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/jquery-2.1.0.js"></script>
	<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/bootstrap.min.js"></script>
	<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.jquery.js"></script>
	<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.ajaxaddition.jquery.js"></script>
	<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.jquery.js"></script>
	  <script type="text/javascript">
		  var http_app="<?php echo GL_HTTP_SERVER.$_SERVER['SCRIPT_NAME']?>/";
	  </script>
      <!--
<link rel="stylesheet" href="../themes.css?<?php echo date('dmYHis') ?>" />
<script type="text/javascript"  data-pace-options='{ "ajax": true,"document": true }' src="../pace.min.js?<?php echo date('dmYHis') ?>" ></script>-->

</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wPopupBack" id="divCapaWindowBack" style="opacity: 0.4;"></div>
<div id="load-backdrop"></div>
<!--#############################inicio modal#############################-->
<div class="modal " id="dmVentana" tabindex="-1" style="z-index: 9999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog" style="width: 55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×<?php //echo utf8_decode('×')?></button>
                <span id="modalheader"></span>
                </div>
                <div class="modal-body" id="modalbody" style="overflow: auto;min-height: 100px;;max-height: 500px;" >

                </div>
                <div class="modal-footer"  id="modalfooter">
                </div>
            </div>
        </div>
    </div>
    <!--#############################inicio modal#############################-->
<div class="modal" id="divCapaWindow"  tabindex="-8" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;z-index: 9005;background-color: #000000;opacity: 0.75">
  <div class="modal-header">
    <button type="button" class="close"  data-dismiss="modal" aria-hidden="true"  onClick="gHideWindowPopup('divCapaWindow')">�</button>
    <h3 id="divCapaWindowTitle"></h3>
  </div>
  <div class="modal-body" id="divCapaWindowContent">
  </div>
  <div class="modal-footer" id="divCapaWindowBotton">
  </div>
</div>


<div class="wPopupBack" id="divCapaWindowMSG" style="background-color: $#0000CC;z-index: 9999999999999999999999999999999">
            <!--<img src="images/preloader.gif"></img>Cargando...-->
            <div class="wrapper light_theme  fixed_header left_nav_fixed">
                <!--\\\\\\\ wrapper Start \\\\\\-->

                <div class="login_page">
                  <div class="error" id="dvmensaje" style="width:40%">
                        <i class="fa animated fa-spinner faa-spin"></i>
                        <h3>Procesando</h3>
                    </div>
                </div>
            </div>
</div>

<div class="wrapper" <?php echo $msgerror!=''?' style="display:none"':''?>>
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <?php #str_word_count();?>
      <div class="logo" style="display:block">
      <img src="<?php echo GL_DIR_WS_HTTP_APP?>imageneszet/unata.png" alt="Logo Instituci&oacute;n>
      </div>

      <div class="small_logo" style="display:none">
      <img src="<?php echo GL_DIR_WS_HTTP_APP?>images/logo_izquierda.png" alt="r-logo" /></div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <div style="color:red" class="msj-plagio">

      </div>
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
        <div class="top_left_menu">
          <ul>
            <li> <a href="javascript:void(0);" onclick="location.reload();"><i class="fa fa-repeat"></i></a> </li>
          </ul>
        </div>
      </div>
        <div class="top_left_bar">

        </div>
        <div class="top_right_bar" style="width: 800px;">

        <div class="user_admin dropdown" style="width: 380px;"> <a href="javascript:void(0);" data-toggle="dropdown">
        	<span class="user_adminname">MODULO: <?php echo $nombredominio; ?></span> <b class="caret"></b> </a>
          <ul class="dropdown-menu" style="width: 250px;">
            <div class="top_pointer"></div>
            <?php
				#while($row=mysqli_fetch_array($rs2,MYSQL_ASSOC))
				while ($rsjk2= mysqli_fetch_row($rs2))
				{
			?>
            	<li>
            		<a href="<?php echo GL_DIR_WS_HTTP_APP?>menu.php?do=<?php echo $rsjk2[0]?>">
                    <i class="fa fa-cogs"></i><?php echo $rsjk2[1]?>
            		</a>
            	</li>
			<?php }
			?>
          </ul>
        </div>


        <div class="user_admin dropdown" style="width: 320px;"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="<?php echo GL_DIR_WS_HTTP_APP?>images/siga.png" />
         <span class="user_adminname nombre_unajma">
		  <?php
		  	if (strlen(trim($nombrecompleto))<30){
				echo $nombrecompleto;
			}
			else
			{
		  		echo substr($nombrecompleto,0,25).'...';
			}
		  ?>
		  </span> <b class="caret"></b> </a>
          <ul class="dropdown-menu" style="width: 250px;">
            <div class="top_pointer"></div>
            <li> <a href="#"><i class="fa fa-id-card"></i><span class="dni_unajma dni_unajma_n1"><?=$_SESSION["persona"]?></span></a></li>
            <li> <a href="#"><i class="fa fa-id-card"></i><span class="dni_unajma dni_unajma_n2"><?=$_SESSION["usuario"]?></span></a></li>
            <li> <a href="#" onclick="cambioclave()" data-clave="true" data-target="#changeModal" data-toggle="modal" ><i class="fa fa-key"></i> Cambiar Contrase&ntilde;a</a> </li>
            <li> <a href="<?php echo GL_DIR_WS_HTTP_APP?>zet/index.php"><i class="fa fa-power-off"></i> Cerrar sesi&oacute;n</a> </li>

          </ul>
        </div>

      </div>
    </div>
      <div class="">
          <div class="top_left_bar">
              <div class="progress" style="display:none">0%</div>
          </div>
      </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\--><div class="left_nav">

      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="left_nav_slidebar">
          <?php
		  	require_once("opciones.php");
		  ?>
      </div>

    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <?php
            $navarray=array();
            $cantidad=0;
            if(isset($_REQUEST['nav'])) {
                #$nav = str_replace('ACUTE;','acute;',decode_base64($_REQUEST['nav']));
				$nav = base64_decode($_REQUEST['nav']);
                $navarray = explode(',', $nav);
                $cantidad=count($navarray);
            }
            ?>

          <h1 id="dvnavnombre">Principal</h1>
        </div>

        <div class="pull-left">
          <ol class="breadcrumb">
              <?php
			  		foreach ($navarray as $key=>$value){
			?>
            <li <?php echo ($cantidad==$key+1)?' class="active"':''?>>
			<?php echo ($value)?>
            </li>
              <?php }?>
          </ol>
        </div>
      </div>
        <?php if(!isset($_SERVER['PATH_INFO'])) {?>
      <div id="divFiltros" style="display:none;padding-left: 10px;padding-top: 1px;margin-top: -14px;margin-bottom: 1px;height: 36px !important;" class="pull-left breadcrumb_admin clear_both">
      </div>
        <?php }?>

      <div class="container clear_both padding_fix container-fluid" id="dvAreaTrabajo">
      	<?php
			require_once("contenido.php");
		?>
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
      </div>
      <div class="modal-body"> content </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"  src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/dropzone/dropzone.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/mask/jquery.mask.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.jquery.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.ajaxaddition.jquery.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/common-script.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/jquery.slimscroll.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/jquery.sparkline.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/sparkline-chart.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/graph.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/edit-graph.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/kalendar/kalendar.js" type="text/javascript"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/kalendar/edit-kalendar.js" type="text/javascript"></script>

<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/sparkline/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/sparkline/jquery.customSelect.min.js" ></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/sparkline/sparkline-chart.js"></script>
<!--<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/sparkline/easy-pie-chart.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/morris/morris.min.js" type="text/javascript"></script> -->
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/morris/raphael-min.js" type="text/javascript"></script>
<!--<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/morris/morris-script.js"></script> -->

  <script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/validation/jquery.validate.min.js"></script>



<!--<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/demo-slider/demo-slider.js"></script>-->
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/knob/jquery.knob.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/checkbox/icheck.js"></script>
  <script src="<?php echo GL_DIR_WS_HTTP_APP?>js/funciones.js?<?php echo date('His')?>"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/siga.js"></script>
  <script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/bootbox.min.js"></script>
  <script src="<?php echo GL_DIR_WS_HTTP_APP?>js/jPushMenu.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/side-chats.js"></script>
<!--<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/biblioteca.js"></script>-->
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/jquery.slimscroll.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/scroll/jquery.nanoscroller.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.jquery.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>js/chosen.ajaxaddition.jquery.js"></script>
<script type="text/javascript"  src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/input-mask/jquery.inputmask.min.js"></script>
<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/PDFObject/pdfobject.min.js"></script>

<script src="<?php echo GL_DIR_WS_HTTP_APP?>plugins/lightbox/js/lightbox.js"></script>

<script  type="text/javascript">
<?php
	#if($msgerror!='')
	#{
		echo '
		$("#dvmensaje").html(\'<div style="color: #FFFFFF;background: #9A0707;padding: 12px;"><i class="fa fa-exclamation-triangle faa-shake animated"></i><div style="font-size: 45px;">'.$nerror.'</div><h2 style="font-size: 20px;" class="bounceInLeft animated">'.str_replace("'","\'",$msgerror).'</h2></div>\');';
	#}
?>
</script>
    <script type="text/javascript">
        var m =0;
        function muestra_cargando(){
            $('.progress').width('0%');
            $('#divCapaWindowBack').show();
            $('.progress').delay(100).show("slow");
            $('.progress').width('30%');
            /*if(document.getElementById('divCapaWindowBack').style.display=='none' || document.getElementById('divCapaWindowBack').style.display==''){
                m=1;
                xajax.$('divCapaWindowBack').style.display='block';
            }*/
            setTimeout(function () {
                $('.progress').width('45%');
            },1000);

            setTimeout(function () {
              $('.progress').width('60%');
            },1500);
            setTimeout(function () {
              $('.progress').width('75%');
            },2000);
           // alert($('.progress').width());
            //xajax.$('divCapaCargando').style.display='block';
        }
        function oculta_cargando(){
            $('.progress').width('100%');
            //xajax.$('divCapaCargando').style.display='none';
            if(m==1){
                $('divCapaWindowBack').style.display='none';
                m=0;
            }
            $('.progress').delay(500).hide("slow");
            $('#divCapaWindowBack').delay(500).hide("slow");
            $('.progress').width('0%');
        }

        //xajax.loadingFunction = muestra_cargando;
        //xajax.doneLoadingFunction = oculta_cargando;


    </script>
    <script type="text/javascript">
        $(document).keydown(function(e){
            $(document).keydown(function(e){
                var llCtrlPress=0;
                if(e.keyCode==17){llCtrlPress=1};
                //alert(e.ctrlKey);
                if(e.keyCode==65 && e.ctrlKey){alert('exito')}
            });
        });

        $( "a[rel=nolink]" ).click(function( event ) {

          var mensaje = $(this).attr('data-mensaje');
          var url = $(this).attr('href');
          url=url.replace(".html", ".php");
          //alert(url);
          var obj=this;
          url="<?php echo GL_DIR_WS_HTTP_APP?>zet/"+url;
          bootbox.confirm(mensaje, function(result) {
           if(result==false){

             toastr.warning('Operacion cancelar!');

           }else{

			 //alert ("<?php echo GL_DIR_WS_HTTP_APP?>zet/"+url)
             grabarurl(url,{},obj);
           }
          });
          event.preventDefault();

        });
        $( "a[rel=link]" ).click(function( event ) {
            var url = $(this).attr('href');
            url.replace(".html", ".php");

                    grabarurl(url,{});
            event.preventDefault();

        });
       // validarllenador();
        $('input').attr("autocomplete","off");
        $('input[type=radio]').iCheck({checkboxClass:"icheckbox_square-blue",radioClass:"iradio_square-blue"});
        $('input[id*=fecha],input[id*=Fecha]').datepicker({
            weekStart: 1,
            keyboardNavigation: false,
            forceParse: false,
            daysOfWeekHighlighted: "1"
        }).attr('data-inputmask',"'alias': 'date'")
        $('input[id*=fecha],input[id*=Fecha]').mask('99/99/9999');
        $(function() { $('.mask').inputmask(); });
        $(".chosen-select").chosen({disable_search_threshold: 1});
function cambioclave(){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '<?php echo GL_DIR_WS_HTTP_APP?>frmchange.php', // the url where we want to POST
            contentType: "application/x-www-form-urlencoded",
            dataType: 'html', // what type of data do we expect back from the server
            encode: true,
            cache: false
        })
            .done(function (html) {
                $('body').append(html)
                //alert(1);
                $('#changeModal').modal({escapeClose: false,clickClose: false,},'show')
            })
        }
        $('.chosen-select').chosen();
        $('.input-daterange').datepicker();
        function ventanaSecundaria (URL){
   window.open(URL,"","width=800,height=500,scrollbars=yes")
}
        function recarga(form)
        {
        form.submit();
        }
    </script>
    <script src="<?php echo GL_DIR_WS_HTTP_APP?>ckeditor/ckeditor.js"></script>
    <script src="<?php echo GL_DIR_WS_HTTP_APP?>ckeditor/js/cargar.js?1"></script>
</body>
</html>