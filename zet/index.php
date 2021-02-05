<?php
	session_start();
	session_unset();
	session_destroy();
	if (isset($_GET['mensaje']))
		{
			$mensaje = $_GET['mensaje'];	
      $pasa=1;	
		}
	else
		{
			$mensaje = '';
			$pasa=0;
		}	
	if (isset($_GET['nivel'])) 
		{
			$nivel = $_GET['nivel'];		
		}	
	else
		{
			$nivel = "P";		
		}			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admisi&oacute;n</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../css/animate.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="logo.ico">

<style>
/* Ubica el card del login */
.lock_content{
  margin-top:100px;
}
</style>
<script>
</script>
</head>
<body style="background-color:#333">

<!--<body style="background-image:url(../imageneszet/fondo.jpg)">-->
<div class="wrapper">
        
  <div class="lock_page">
  <div class="lock_content">
  <div class="lock_image">
  	<img src="../images/logo_ingreso.jpg" alt="lock" width="120"/>
    <br/>
    <span style="font-weight:bold">ADMISI&Oacute;N - UNAJMA</span>
  </div>	
  <form role="form" class="form-horizontal" method="post" action="admi_val.php?code=<?php echo md5(rand())?>">
  	  <div class="form-group">        
        <div class="col-sm-10">

            <?php
              // CONTROLA QUE EL MENSAJE DE ERROR DE USUSARIO Y CONTRASENA SE MUESTRE PARA EL USUARIO
              if(isset($_GET['mensaje'])){
            ?>
              <div class="container mt-5 m-5">
                <div class=" alert alert-warning aviso-oca" role="alert">
                  <strong>Aviso! </strong> <?php echo $mensaje;?>
                </div>
              </div>
            <?php
              }
            ?>

          	<select name="cboNivel" class="col-lg-12">
            	<option value="P" <?php if ($nivel == 'P') {echo 'selected';} ?>>Postulante</option>									                <option value="D" <?php if ($nivel == 'D') {echo 'selected';} ?>>Supervisor</option>															
                <option value="S" <?php if ($nivel == 'S') {echo 'selected';} ?>>Administrativo</option>
			</select>
        </div>
      </div>
      <div class="form-group">        
        <div class="col-sm-10">
          <input type="text" placeholder="Usuario" id="txtUsuario" name="txtUsuario" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">
          <input type="password" placeholder="Password" id="txtPassword" name="txtPassword" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class=" col-sm-10">
          <div class="checkbox checkbox_margin">           
              <a href="index.html">
              <button class="btn btn-default pull-right" type="submit">Ingresar</button>
              </a>
          </div>
        </div>
      </div>
  </form>
 </div>
 </div>
</div>


  <script>
    setTimeout(() => {
      let aviso = document.querySelector(".aviso-oca");
      aviso.style.display = "none";
    }, 5000);
  </script>

</body>
</html>
