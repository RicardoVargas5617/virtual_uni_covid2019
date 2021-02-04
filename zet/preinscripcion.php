<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous">
</script>
<form action="#" name="frmformulario" id="frmformulario" method="post" accept-charset="utf-8">
	<table width="600" border="1">
    	<tr>
        	<td width="30%">
				<div class="form-group row">
				    <label class="col-form-label col-lg-5 col-sm-12">DNI:</label>
            </td>
            <td>
				    <div class="col-lg-7 col-md-9 col-sm-12">
           
					<input type="text"   name="txtDni" id="txtDni" class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Ingresar dni..." aria-describedby="txtnombre-message">
					</div>
				</div>
            </td>
        </tr>
        <tr>
        	<td>
	<div class="form-group row">
				    <label class="col-form-label col-lg-5 col-sm-12">Imagen</label>
				    <div class="col-lg-7 col-md-9 col-sm-12">
           </td>         
           <td>        
					<input type='file' id="imgInp" name="imgInp"  class="form-control validar" autocomplete="off" autocapitalize="words"  value=""  placeholder="Seleccione foto..." aria-describedby="imgInp-message">
					<img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" width="100px" height="100px" />
					</div>
	</div>
    		</td>
        </tr>
        <tr>
            <td colspan="2">
				<button type="button" class="submit" name="cboenviar">Enviar</button>
			</td>
        </tr>
	</table>
</form>
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

</script>