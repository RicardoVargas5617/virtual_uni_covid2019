<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="gb18030">
    
    <title>UNIVERSIDAD NACIONAL JOSE MARIA ARGUEDAS</title>
    <link rel="icon" href="logo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous">
    </script>
</head>

<body background="../images/fondo.jpg">

                    <table width="100%">
                    <tr>
                    <td align="center">
                    <img src="../images/logo.png" alt="Logo" width="100"/>
                    <strong>UNIVERSIDAD NACIONAL JOS&Eacute; MAR&Iacute;A ARGUEDAS</strong>
                    </td>
                    </tr>
                    </table>

<br>
<br>
   
<form action="pregrabar.php" method="post" id="grado" name="frmFotoGrado" enctype="multipart/form-data" onsubmit="return true;" >
   <center><h3>INSCR&IacuteBETE EXAMEN DE ADMISI&Oacute;N VIRTUAL</h3><h4 style="font-size:22px;">2020 - II</h4> </center> 
<table  width ="550"border="0" align="center" cellpadding="3" cellspacing="0" class="table-borderless ">

	<tr>
    	<td width="32%">
        	<strong>
            DNI
            </strong>        
        </td>
        <td>
        	<input   type="text" name="txtDni" id="txtDni" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="8"  placeholder="Ingresar dni" aria-describedby="txtnombre-message">
        </td>    
    </tr>

	<tr>
    	<td>
        	<strong>
            Apellido Paterno:
            </strong>        
        </td>
        <td>
        	<input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="30"  placeholder="Ingresar apellido paterno" aria-describedby="txtnombre-message">
        </td>    
    </tr>  
	<tr>
    	<td>
        	<strong>
            Apellido Materno:
            </strong>        
        </td>
        <td>
        	<input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="30"  placeholder="Ingresar apellido materno" aria-describedby="txtnombre-message">
        </td>    
    </tr> 
    <tr>
    	<td>
        	<strong>
            Nombres:
            </strong>        
        </td>
        <td>
        	<input type="text" name="txtNombres" id="txtNombres" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="30"  placeholder="Ingresar nombres" aria-describedby="txtnombre-message">
        </td>    
    </tr>   
    <tr>
    	<td>
        	<strong>
            Email:
            </strong>        
        </td>
        <td>
        	<input type="text" name="txtEmail" id="txtEmail" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="50"  placeholder="Ingresar email" aria-describedby="txtnombre-message">
        </td>    
    </tr>  
    <tr>
    	<td>
        	<strong>
            Celular:
            </strong>        
        </td>
        <td>
        	<input type="text" name="txtCelular" id="txtCelular" class="form-control validar" autocomplete="off" autocapitalize="words"  value="" maxlength="12"  placeholder="Ingresar celular" aria-describedby="txtnombre-message">
        </td>    
    </tr>        
	<tr>
    	<td>
        	<strong>
            Foto voucher:
            </strong>        
        </td>
        <td>     
        	<input type='file' id="imgInp" name="imgInp" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto voucher" aria-describedby="imgInp-message" style=" border-radius: 0;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    color: #ffffff;
    background-color: #337ab7;
    border: 1px solid #ffffff;
">
			<img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" width="150" height="150px" />
        </td>    
    </tr>
    <tr>
    	<td>
        	<strong>
            Foto estudiante:
            </strong>        
        </td>
        <td>     
        	<input type='file' id="imgEst" name="imgEst" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto estudiante" aria-describedby="imgInp-message" style=" border-radius: 0;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    color: #ffffff;
    background-color: #337ab7;
    border: 1px solid #ffffff;
">
			<img id="blah1" src="https://via.placeholder.com/150" alt="Tu imagen" width="150px" height="150px" style=""/>
        </td>    
    </tr>
    <tr>
    	<td>
        	<strong>
            Foto dni:
            </strong>        
        </td>
        <td>     
        	<input type='file' id="imgDni" name="imgDni" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto dni" aria-describedby="imgDni-message" style=" border-radius: 0;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    color: #ffffff;
    background-color: #337ab7;
    border: 1px solid #ffffff;
">
			<img id="blah2" src="https://via.placeholder.com/150" alt="Tu imagen" width="150px" height="150px" style=""/>
        </td>    
    </tr>
	<tr>
    	<td colspan="2" align="center">
        	<br>
            <button type="button" class="submit" style="background-color: #337ab7; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;">
					<span class="bigger-110">Registrarse <i class="fa fa-forward"></i></span>
					<!--<i class="ace-icon fa fa-arrow-right icon-on-right"></i>-->
			</button>
            <br>
        </td>    
    </tr>     
</table>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
<script>
$('button.submit').off('click').on('click',function () {
                $('b.error').remove();
                var estado=true;
                $( ".validar" ).each(function( index ) {
                    var attr=$(this).attr('aria-describedby');
                    var valor=$(this).val()
                    //alert(valor)

                    if($(this).data('type')!=undefined) {
                        alert($(this).data('type')+'<=>'+this.id+'<=>'+valor)
                        if (valor == '' || valor=='NULL') {
                            if($(this).data('type')=='number'){alert('NO');console.log(this)}
                            estado=false;
                            $(this).addClass('is-invalid');
                            $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Requerido</b>");
                        }else{
                            $(this).removeClass('is-invalid');
                        }
                        // alert($(this).data('type'))
                        switch ($(this).data('type')) {
                            case 'email':

                                // console.log($(this))
                               // alert((/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(valor)))
                                if(!(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(valor))){
                                    //  alert('SI')
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de correo incorrecto</b>");
                                }
                                break;
                            case 'url':
                                if(!(/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[\/?#]\S*)?$/i.test(valor))){
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de URL incorrecto</b>");
                                }
                                break;
                            case 'date':
                                if(!/Invalid|NaN/.test(new Date(valor).toString())){
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de Fecha incorrecto</b>");
                                }
                                break
                            case 'dateISO':
                                if(!(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(valor))){
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de fecha incorrecto</b>");
                                }
                                break;
                            case 'number':
                                alert((/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(valor)))
                                if(!(/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(valor)) || valor==''){
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de numerico incorrecto</b>");
                                }
                                break;
                            case 'digits':
                                if(!( /^\d+$/.test(valor))){
                                    estado=false;
                                    $(this).addClass('is-invalid');
                                    $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Formato de numero incorrecto</b>");
                                }
                                break;
                        }
                        if($(this).data('minlength')!==undefined) {
                            var r = t.isArray(e) ? e.length : this.getLength(e, n);
                            return this.optional(n) || r >= i
                        }
                        if($(this).data('maxlength')!==undefined) {
                            var r = t.isArray(e) ? e.length : this.getLength(e, n);
                            return this.optional(n) || r <= i
                        }
                        if($(this).data('rangelength')!==undefined) {
                            var r = t.isArray(e) ? e.length : this.getLength(e, n);
                            return this.optional(n) || r >= i[0] && r <= i[1]
                        }
                        if($(this).data('min')!==undefined) {
                            return this.optional(e) || t >= n
                        }
                        if($(this).data('max')!==undefined) {
                            return this.optional(e) || t <= n
                        }
                        if($(this).data('range')!==undefined) {
                            return this.optional(e) || t >= n[0] && t <= n[1]
                        }
                        if(estado){
                            $(this).addClass('is-valid');
                        }
                    }else{
                        //console.log(valor)
                        if (valor == '' || valor===null) {
                            estado=false;
                            $(this).addClass('is-invalid');
                            $(this).after("<b id='" + attr + "' class='error invalid-feedback'>Requerido</b>");
                        }else{
                            $(this).removeClass('is-invalid');
                        }
                        if(estado){
                            $(this).addClass('is-valid');
                        }
                    }
                });
				if(estado){
					$('form').submit();
				}
            })


function readImage (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah').attr('src', e.target.result); // Renderizamos la imagen
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage(this);
  });
  
 function readImage1 (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah1').attr('src', e.target.result); // Renderizamos la imagen
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgEst").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage1(this);
  });
  
  function readImage2 (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah2').attr('src', e.target.result); // Renderizamos la imagen
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgDni").change(function () {
    // Código a ejecutar cuando se detecta un cambio de archivO
    readImage2(this);
  });

</script>