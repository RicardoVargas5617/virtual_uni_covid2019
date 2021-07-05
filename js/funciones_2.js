function crearruta(nombre,url,orden) {
    
}
function crearselect(id,data) {
    $.each(data, function(k,v){
        $("#"+id).append("<option value=\""+k+"\">"+v+"</option>");
    }).removeAttr("disabled");
}
function grabar(id,obligatorio=[]){
    $("#dvmensaje").html('<i class="fa animated fa-spinner faa-spin"></i><h3>Cargando<span id="pt">0%</span></h3>');
   // $('#divCapaWindow').show("fast");
    $('.progress').show("slow");
    var error=0;
    $('.progress').width('16.5%');
    setTimeout(function(){$('.progress').width('33%')}, 100);
    var dataobj=$('#'+id).serializeArray();
    var errn=0;
    var errorval=0;
    var objfrm = [];
    var i=0;

    $('#divCapaWindowBack').show();

    $('input[data-requerido=true], select[data-requerido=true] ').each(function(i){
        var valor=$(this).val();
        i=i+1;
        //
        var texto=$(this).attr('data-requerido-texto');
        if(valor=='' || valor==null){
            errn=1;

            errorval=1;
           // if (!$(this).hasClass('validar-error')) {
           // i=i+1;
            setTimeout(function(){
                toastr.warning(texto,'Campo Obligatorio');
            },500 + ( i * 200 ));
           // }
                $(this).addClass('validar-error').delay(6000);

        }else {
            var clase=0;
            var maxchar = $(this).attr('maxlength');
            var minchar = $(this).attr('minlength');
            var lengthchar = $(this).attr('lengthchar');
            var number=$(this).attr('data-numero-entero');
            var decimal=$(this).attr('data-numero-decimal');
            var decleng=$(this).attr('data-decimal');
            var email=$(this).attr('data-email');
            var covalor=$(this).attr('data-covalor');

            if(covalor!==undefined){
                var ovalor=$('#'+covalor).val();
                if(ovalor!=valor) {
                    setTimeout(function () {

                        if (texto == undefined) {
                            texto = 'Error';
                        }

                        toastr.warning('<b>' + texto + '</b>: El valor ingresado es incorrecto no coincide ', 'Error de Valor');
                    }, 500 + ( i * 100 ));
                    clase = 1;
                    errn = 1;
                    errorval = 1;
                }
            }

            if(texto===undefined){
                texto='Error';
            }
            var t=0;
            if(email=='true') {
                var patron = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
                if(!patron.test(valor)){
                    // i=i+1;
                    setTimeout(function(){

                        if(texto==undefined){
                            texto='Error';
                        }

                        toastr.warning('<b>' + texto + '</b>: Correo electronico es incorrecto', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }
            if(minchar!==undefined){
                if (minchar > lengchar) {
                   // if (!$(this).hasClass('validar-error')) {
                    //i=i+1;
                    if(texto===undefined){
                        texto='Error';
                    }

                        setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tamaño minimo es de: ' + minchar + ' caracteres', 'Error de Campo');
                        },500 + ( i * 100 ));
                   // }
                    t=1;
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(maxchar!==undefined) {
                if (maxchar<lengchar && t==0) {
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tamaño Maximo es de: ' + maxchar + ' caracteres', 'Error de Campo');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(lengthchar!==undefined) {
                var lengchar = valor.length;
                if (lengthchar!=lengchar) {
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tiene que ser exacto de : ' + lengthchar + ' caracteres', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(decimal=='true'){

                decleng=decleng==undefined?2:decleng;

                var patron =new RegExp("^\\d+(\\.\\d{"+decleng+"})?$");
                if(!patron.test(valor)){
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales a ' + decleng + ' digitos', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }else{
                    var maxval = $(this).attr('maxvalor');
                    var minval = $(this).attr('minvalor');
                    if(maxval>valor && minval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales mayor a ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((minval<valor) && maxval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales menor igual a ' + minval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((valor<minval || valor>maxval) && maxval!==undefined && minval!==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales entre ' + minval + ' y ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                }
            }

            if(number=='true'){
                var patron = /^\d*$/;
                if(!patron.test(valor)){
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }else{
                    var maxval = $(this).attr('maxvalor');
                    var minval = $(this).attr('minvalor');
                    if((maxval>valor) && minval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros menor o igual a ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }

                    if((minval<valor) && maxval===undefined){
                        //i=i+1;
                        //alert('***'+texto+'<->'+minval+'<->'+valor)
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros mayor o igual a ' + minval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((valor<minval || valor>maxval) && maxval!==undefined && minval!==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros entre ' + minval + ' y ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        //}
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                }
            }
            if(clase==1) {

                    $(this).addClass('validar-error').delay(6000);

            }else{
                $(this).removeClass('validar-error').delay(6000);
            }

        }


    }).delay(600)

    for(var i in dataobj){
        var name=dataobj[i]['name'];
        var valor=dataobj[i]['value'];
        objfrm.push(name);
        //alert($.inArray(name,obligatorio));
        var pos=$.inArray(name,obligatorio);

        if(pos>=0){
           // alert('Puesto :'+pos+'->'+valor);
            if(valor==''){
                errorval=1;
                //$('#'+name)
            }
        }
    }
    var comun=$.map(objfrm,function(a){return $.inArray(a, obligatorio) < 0 ? null : a;});
    var comun2=$.map(obligatorio,function(a){return $.inArray(a, objfrm) >= 0 ? null : a;});
    if(comun2.length>0){
        errorval=1;
    }
    setTimeout(function(){$('.progress').width('66%')}, 100);
    if(errorval==0) {
       // alert('inicio');
        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: $('#' + id).attr('action'), // the url where we want to POST
                data: $('#' + id).serialize(), // our data object
                contentType: "application/x-www-form-urlencoded",
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                cache: false,
                statusCode: {
                    400: function () {
                        var error = 1;
                        $("#dvmensaje").html('<div style="color: #FFFFFF;background: #C78306;padding: 15px;"><i class="fa fa-exclamation-triangle faa-ring animated"></i><div class="">400</div><h2 class="bounceInLeft animated">Solicitud incorrecta</h2></div>');
                    },
                    401: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #5A041C;padding: 15px;"><i class="fa fa-exclamation-triangle faa-horizontal animated"></i><div class="">401</div><h2 class="bounceInLeft animated">No autorizado</h2></div>');
                    },
                    402: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #403D3D;padding: 15px;"><i class="fa fa-exclamation-triangle faa-vertical animated"></i><div class="">402</div><h2 class="bounceInLeft animated">Pago requerido</h2></div>');
                    },
                    403: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-pulse animated"></i><div class="">403</div><h2 class="bounceInLeft animated">Prohibido</h2></div>');
                    },
                    404: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-warning faa-flash animated"></i><div class="">404</div><h2 class="bounceInLeft animated">Page not found!</h2></div>');
                    },
                    500: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-shake animated"></i><div class="">500</div><h2 class="bounceInLeft animated">Internal Server Error</h2></div>');
                    }
                }
            })
            .done(function (data) {
                var titulo='';

                if(data['titulo']!== undefined) {
                    titulo = data['titulo'];
                }
                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");
                    $('.progress').width('80%');
                    toastr.info(data['mensaje'],titulo);
                   var href=$('a[data-atras=SI]').attr('href');

                    if(href!== undefined) {
                        window.location=href;
                    }else{
                        location.reload();
                    }

                } else {
                    //alert(3);
                    toastr.error(data['mensaje'],titulo);
                    $('#divCapaWindow').delay(2000).hide("slow");
                }
                /*$(':input','#'+id)
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');*/

                $('.progress').width('100%');
                $('.progress').delay(2000).hide("slow");
                $('.progress').delay(2000).width('3%');
               // $('#divCapaWindowBack').hide();
            })
            .always(function (data, textStatus, jqXHR) {
               // alert('always');
                var obj = jQuery.parseJSON(data);
                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");

                } else if (data['error'] == 1) {
                   // alert(3);
                    toastr.error(data['mensaje']);
                    $('#divCapaWindow').delay(500).hide("slow");
                } else if (data['error'] == 2) {
                    $('#divCapaWindow').delay(500).hide("slow");
                }
                $('.progress').width('80%');
            });
    }else{
        if(errn==0) {
            toastr.warning('Existen Campos Obligatorio');
        }
            setTimeout(function () {
                $('.progress').width('0%')
            }, 150);
       // $('#divCapaWindow').delay(500).hide("slow");
    }
    $('#divCapaWindowBack').hide();
}
function crearchosen(id){
    $('#'+id).ajaxChosen({
        dataType: 'json',
        type: 'POST',
        url:'search.php',
        data: {'id':'localizacion','te':te}
    },{
        loadingImg: '/cmocarrion/images/loading.gif'
    });
}

function grabarurl(url,dataobj){
    $("#dvmensaje").html('<i class="fa animated fa-spinner faa-spin"></i><h3>Cargando<span id="pt">0%</span></h3>');
    // $('#divCapaWindow').show("fast");
    $('.progress').show("slow");
    var error=0;
    $('.progress').width('16.5%');
    setTimeout(function(){$('.progress').width('33%')}, 100);
    //var dataobj=$('#'+id).serializeArray();
    var errorval=0;
    $('#divCapaWindowBack').show();
    setTimeout(function(){$('.progress').width('66%')}, 100);
    if(errorval==0) {
        // alert('inicio');
        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url, // the url where we want to POST
               // data: $('#' + id).serialize(), // our data object
                contentType: "application/x-www-form-urlencoded",
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                cache: false,
                statusCode: {
                    400: function () {
                        var error = 1;
                        $("#dvmensaje").html('<div style="color: #FFFFFF;background: #C78306;padding: 15px;"><i class="fa fa-exclamation-triangle faa-ring animated"></i><div class="">400</div><h2 class="bounceInLeft animated">Solicitud incorrecta</h2></div>');
                    },
                    401: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #5A041C;padding: 15px;"><i class="fa fa-exclamation-triangle faa-horizontal animated"></i><div class="">401</div><h2 class="bounceInLeft animated">No autorizado</h2></div>');
                    },
                    402: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #403D3D;padding: 15px;"><i class="fa fa-exclamation-triangle faa-vertical animated"></i><div class="">402</div><h2 class="bounceInLeft animated">Pago requerido</h2></div>');
                    },
                    403: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-pulse animated"></i><div class="">403</div><h2 class="bounceInLeft animated">Prohibido</h2></div>');
                    },
                    404: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-warning faa-flash animated"></i><div class="">404</div><h2 class="bounceInLeft animated">Page not found!</h2></div>');
                    },
                    500: function () {
                        var error = 1;
                        $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-shake animated"></i><div class="">500</div><h2 class="bounceInLeft animated">Internal Server Error</h2></div>');
                    }
                }
            })
            .done(function (data) {
                //alert(1);
                var titulo='';

                if(data['titulo']!== undefined) {
                    titulo = data['titulo'];
                }

                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");
                    $('.progress').width('80%');

                    toastr.info(data['mensaje'],titulo);
                    location.reload();
                } else {

                    toastr.error(data['mensaje'],titulo);
                    $('#divCapaWindow').delay(2000).hide("slow");
                }
                $('.progress').width('100%');
                $('.progress').delay(2000).hide("slow");
                $('.progress').delay(2000).width('3%');
                var eliminar=$('a[data-eliminar]').attr('data-eliminar');
                var linkurl=$(this).attr('data-enlace');
                //alert(this.id);
                if(eliminar!==undefined) {
                    var href = $('a[data-atras=SI]').attr('href');
                    //alert(href);
                    if (href !== undefined) {
                        window.location = href;
                    }
                }
               if(linkurl!==undefined && eliminar===undefined){
                    window.location = http_app+linkurl;
                }

                //alert(2);
            })
            .always(function (data, textStatus, jqXHR) {
                // alert('always');
                var obj = jQuery.parseJSON(data);
                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");

                } else if (data['error'] == 1) {
                    // alert(3);
                    toastr.error(data['mensaje']);
                    $('#divCapaWindow').delay(500).hide("slow");
                } else if (data['error'] == 2) {
                    $('#divCapaWindow').delay(500).hide("slow");
                }
                $('.progress').width('80%');
            });
    }else{
        //alert(3)
        toastr.warning('Existen Campos Obligatorio');
        setTimeout(function(){$('.progress').width('0%')}, 150);
    }
    $('#divCapaWindowBack').hide();
}
function grabarmultiple(id,obligatorio=[]){
    $("#dvmensaje").html('<i class="fa animated fa-spinner faa-spin"></i><h3>Cargando<span id="pt">0%</span></h3>');
    // $('#divCapaWindow').show("fast");
    $('.progress').show("slow");
    var error=0;
    $('.progress').width('16.5%');
    setTimeout(function(){$('.progress').width('33%')}, 100);
    var dataobj=$('#'+id).serializeArray();
    var errn=0;
    var errorval=0;
    var objfrm = [];
    var i=0;
    $('#divCapaWindowBack').show();

    $(id+' input[data-requerido=true], '+id+' select[data-requerido=true] ').each(function(i){
        var valor=$(this).val();
        i=i+1;
        //
        var texto=$(this).attr('data-requerido-texto');
        if(valor==''){
            errn=1;

            errorval=1;
            // if (!$(this).hasClass('validar-error')) {
            // i=i+1;
            setTimeout(function(){
                toastr.warning(texto,'Campo Obligatorio');
            },500 + ( i * 200 ));
            // }
            $(this).addClass('validar-error').delay(6000);

        }else {
            var clase=0;
            var maxchar = $(this).attr('maxlength');
            var minchar = $(this).attr('minlength');
            var lengthchar = $(this).attr('lengthchar');
            var number=$(this).attr('data-numero-entero');
            var decimal=$(this).attr('data-numero-decimal');
            var decleng=$(this).attr('data-decimal');
            var email=$(this).attr('data-email');
            var lengchar = valor.length;
            var t=0;
            if(email=='true') {
                var patron = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
                if(!patron.test(valor)){
                    // i=i+1;
                    setTimeout(function(){

                        if(texto==undefined){
                            texto='Error';
                        }

                        toastr.warning('<b>' + texto + '</b>: Correo electronico es incorrecto', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }
            if(minchar!==undefined){
                if (minchar > lengchar) {
                    // if (!$(this).hasClass('validar-error')) {
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tamaño minimo es de: ' + minchar + ' caracteres', 'Error de Campo');
                    },500 + ( i * 100 ));
                    // }
                    t=1;
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(maxchar!==undefined) {
                if (maxchar<lengchar && t==0) {
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tamaño Maximo es de: ' + maxchar + ' caracteres', 'Error de Campo');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(lengthchar!==undefined) {
                if (lengthchar!=lengchar) {
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Tiene que ser exacto de : ' + lengthchar + ' caracteres', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }
            }

            if(decimal=='true'){

                decleng=decleng==undefined?2:decleng;

                var patron =new RegExp("^\\d+(\\.\\d{"+decleng+"})?$");
                if(!patron.test(valor)){
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales a ' + decleng + ' digitos', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }else{
                    var maxval = $(this).attr('maxvalor');
                    var minval = $(this).attr('minvalor');
                    if(maxval>valor && minval===undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales mayor a ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((minval<valor) && maxval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales menor igual a ' + minval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((valor<minval || valor>maxval) && maxval!==undefined && minval!==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales entre ' + minval + ' y ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                }
            }

            if(number=='true'){
                var patron = /^\d*$/;
                if(!patron.test(valor)){
                    //i=i+1;
                    setTimeout(function(){
                        toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros', 'Error de Valor');
                    },500 + ( i * 100 ));
                    clase=1;
                    errn=1;
                    errorval=1;
                }else{
                    var maxval = $(this).attr('maxvalor');
                    var minval = $(this).attr('minvalor');
                    if(maxval>valor && minval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros mayor a ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }

                    if((minval<valor) && maxval==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros menor igual a ' + minval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                    if((valor<minval || valor>maxval) && maxval!==undefined && minval!==undefined){
                        //i=i+1;
                        setTimeout(function(){
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros entre ' + minval + ' y ' + maxval, 'Error de Valor');
                        },500 + ( i * 100 ));
                        //}
                        clase=1;
                        errn=1;
                        errorval=1;
                    }
                }
            }
            if(clase==1) {

                $(this).addClass('validar-error').delay(6000);

            }else{
                $(this).removeClass('validar-error').delay(6000);
            }

        }


    }).delay(600)

    for(var i in dataobj){
        var name=dataobj[i]['name'];
        var valor=dataobj[i]['value'];
        objfrm.push(name);
        //alert($.inArray(name,obligatorio));
        var pos=$.inArray(name,obligatorio);

        if(pos>=0){
            // alert('Puesto :'+pos+'->'+valor);
            if(valor==''){
                errorval=1;
                //$('#'+name)
            }
        }
    }
    var comun=$.map(objfrm,function(a){return $.inArray(a, obligatorio) < 0 ? null : a;});
    var comun2=$.map(obligatorio,function(a){return $.inArray(a, objfrm) >= 0 ? null : a;});
    if(comun2.length>0){
        errorval=1;
    }
    setTimeout(function(){$('.progress').width('66%')}, 100);
    if(errorval==0) {
        // alert('inicio');
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: $('#' + id).attr('action'), // the url where we want to POST
            data: $('#' + id).serialize(), // our data object
            contentType: "application/x-www-form-urlencoded",
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            cache: false,
            statusCode: {
                400: function () {
                    var error = 1;
                    $("#dvmensaje").html('<div style="color: #FFFFFF;background: #C78306;padding: 15px;"><i class="fa fa-exclamation-triangle faa-ring animated"></i><div class="">400</div><h2 class="bounceInLeft animated">Solicitud incorrecta</h2></div>');
                },
                401: function () {
                    var error = 1;
                    $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #5A041C;padding: 15px;"><i class="fa fa-exclamation-triangle faa-horizontal animated"></i><div class="">401</div><h2 class="bounceInLeft animated">No autorizado</h2></div>');
                },
                402: function () {
                    var error = 1;
                    $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #403D3D;padding: 15px;"><i class="fa fa-exclamation-triangle faa-vertical animated"></i><div class="">402</div><h2 class="bounceInLeft animated">Pago requerido</h2></div>');
                },
                403: function () {
                    var error = 1;
                    $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-pulse animated"></i><div class="">403</div><h2 class="bounceInLeft animated">Prohibido</h2></div>');
                },
                404: function () {
                    var error = 1;
                    $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-warning faa-flash animated"></i><div class="">404</div><h2 class="bounceInLeft animated">Page not found!</h2></div>');
                },
                500: function () {
                    var error = 1;
                    $("#dvmensaje").html('<button aria-hidden="true" class="close" type="button">×</button><div style="color: #FFFFFF;background: #9A0707;padding: 15px;"><i class="fa fa-exclamation-triangle faa-shake animated"></i><div class="">500</div><h2 class="bounceInLeft animated">Internal Server Error</h2></div>');
                }
            }
        })
            .done(function (data) {
                var titulo='';

                if(data['titulo']!== undefined) {
                    titulo = data['titulo'];
                }
                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");
                    $('.progress').width('80%');
                    toastr.info(data['mensaje'],titulo);
                    var href=$('a[data-atras=SI]').attr('href');
                    if(href!== undefined) {
                        window.location=href;
                    }else{
                        location.reload();
                    }

                } else {
                    //alert(3);
                    toastr.error(data['mensaje'],titulo);
                    $('#divCapaWindow').delay(2000).hide("slow");
                }
                /*$(':input','#'+id)
                 .not(':button, :submit, :reset, :hidden')
                 .val('')
                 .removeAttr('checked')
                 .removeAttr('selected');*/

                $('.progress').width('100%');
                $('.progress').delay(2000).hide("slow");
                $('.progress').delay(2000).width('3%');
                //alert(2);
            })
            .always(function (data, textStatus, jqXHR) {
                // alert('always');
                var obj = jQuery.parseJSON(data);
                if (data['error'] == 0) {
                    $('#divCapaWindow').delay(2000).hide("slow");

                } else if (data['error'] == 1) {
                    // alert(3);
                    toastr.error(data['mensaje']);
                    $('#divCapaWindow').delay(500).hide("slow");
                } else if (data['error'] == 2) {
                    $('#divCapaWindow').delay(500).hide("slow");
                }
                $('.progress').width('80%');
            });
    }else{
        if(errn==0) {
            toastr.warning('Existen Campos Obligatorio');
        }
        setTimeout(function () {
            $('.progress').width('0%')
        }, 150);
        $('#divCapaWindowBack').hide();
    }
}
function validarllenador() {
    var i=0;
    $('input[type=text]').change(
        function () {
          //  if ($(this).attr('type') != 'password') {
            $(this).val($(this).val().trim().toUpperCase());
            // }
        }
    );
    $('input[type=text]').focus(
        function () {
            var number = $(this).attr('data-numero-entero');
            var decimal = $(this).attr('data-numero-decimal');
            var decleng = $(this).attr('data-decimal');
            var d='';
            //alert(number+'-'+decimal+'-'+decleng+'-');
            if(number=='true' || decimal=='true' || decleng=='true'){
                d=0;
            }
           var exists= $(this).hasClass('validar-error');
            /*if(exists==true){
                $(this).val(d);
            }*/
        }
    );
    $('input[data-requerido=true], select[data-requerido=true] ').blur(

        function () {
            var clase = 0;
            var valor = $(this).val();
            i = i + 1;
          //  if ($(this).attr('type') != 'password') {
                $(this).val($(this).val().trim().toUpperCase());
          //  }
            var texto = $(this).attr('data-requerido-texto');
            if (valor == '') {
                errn = 1;
                clase = 1;
                errorval = 1;
                // if (!$(this).hasClass('validar-error')) {
                // i=i+1;
              ///  setTimeout(function () {
                    toastr.warning(texto, 'Campo Obligatorio');
               // }, 500 + ( i * 200 ));
                // }
                $(this).addClass('validar-error');

            } else {

                var maxchar = $(this).attr('maxlength');
                var minchar = $(this).attr('minlength');
                var lengthchar = $(this).attr('lengthchar');
                var number = $(this).attr('data-numero-entero');
                var decimal = $(this).attr('data-numero-decimal');
                var decleng = $(this).attr('data-decimal');
                var email = $(this).attr('data-email');
                var covalor = $(this).attr('data-covalor');
                var lengchar = valor.length;
                var t = 0;

                if(covalor!==undefined){
                    var ovalor=$('#'+covalor).val();
                    if(ovalor!=valor) {
                        setTimeout(function () {

                            if (texto == undefined) {
                                texto = 'Error';
                            }

                            toastr.warning('<b>' + texto + '</b>: El valor ingresado es incorrecto no coincide ', 'Error de Valor');
                        }, 500 + ( i * 100 ));
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    }
                }

                if(texto===undefined){
                    texto='Error';
                }
                if (email == 'true') {
                    var patron = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
                    if (!patron.test(valor)) {
                        // i=i+1;
                        //setTimeout(function () {

                            if (texto == undefined) {
                                texto = 'Error';
                            }

                            toastr.warning('<b>' + texto + '</b>: Correo electronico es incorrecto', 'Error de Valor');
                        //}, 500 + ( i * 100 ));
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    }
                }
                if (minchar !== undefined) {
                    if (minchar > lengchar) {
                        // if (!$(this).hasClass('validar-error')) {
                        //i=i+1;
                        // setTimeout(function () {
                            toastr.warning('<b>' + texto + '</b>: Tamaño minimo es de: ' + minchar + ' caracteres', 'Error de Campo');
                            //}, 500);
                        // }
                        t = 1;
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    }
                }

                if (maxchar !== undefined) {
                    if (maxchar < lengchar && t == 0) {
                        //i=i+1;
                        //setTimeout(function () {
                            toastr.warning('<b>' + texto + '</b>: Tamaño Maximo es de: ' + maxchar + ' caracteres', 'Error de Campo');
                            //}, 500);
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    }
                }

                if (lengthchar !== undefined) {
                    if (lengthchar != lengchar) {
                        //i=i+1;
                        //setTimeout(function () {
                            toastr.warning('<b>' + texto + '</b>: Tiene que ser exacto de : ' + lengthchar + ' caracteres', 'Error de Valor');
                            //}, 500 );
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    }
                }

                if (decimal == 'true') {

                    decleng = decleng === undefined ? 2 : decleng;

                    var patron = new RegExp("^\\d+(\\.\\d{" + decleng + "})?$");
                    if (!patron.test(valor)) {
                        //i=i+1;
                        //setTimeout(function () {
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales a ' + decleng + ' digitos', 'Error de Valor');
                            //}, 500);
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    } else {
                        var maxval = $(this).attr('maxvalor');
                        var minval = $(this).attr('minvalor');
                        if (maxval > valor && minval === undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales mayor igual a ' + maxval, 'Error de Valor');
                                //}, 500);
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                        if ((minval<valor) && maxval === undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales menor igual a ' + minval, 'Error de Valor');
                                //}, 500);
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                        if ((valor < minval || valor > maxval) && maxval !== undefined && minval !== undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros decimales entre ' + minval + ' y ' + maxval, 'Error de Valor');
                                //}, 500);
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                    }
                }

                if (number == 'true') {
                    var patron = /^\d*$/;
                    if (!patron.test(valor)) {
                        //i=i+1;
                        //setTimeout(function () {
                            toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros', 'Error de Valor');
                            //}, 500);
                        clase = 1;
                        errn = 1;
                        errorval = 1;
                    } else {
                        var maxval = $(this).attr('maxvalor');
                        var minval = $(this).attr('minvalor');
                        if ((maxval>valor) && minval === undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros mayor igual a ' + maxval, 'Error de Valor');
                                //}, 500);
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                        if ((minval<valor) && maxval === undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros menor o igual a ' + minval, 'Error de Valor');
                                // }, 500);
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                        if ((valor < minval || valor > maxval) && maxval !== undefined && minval !== undefined) {
                            //i=i+1;
                            //setTimeout(function () {
                                toastr.warning('<b>' + texto + '</b>: Solo se aceptan numeros enteros entre ' + minval + ' y ' + maxval, 'Error de Valor');
                            //}, 500);
                            //}
                            clase = 1;
                            errn = 1;
                            errorval = 1;
                        }
                    }
                }
            }
            if(clase==1) {
                $(this).removeClass('valido');
                $(this).addClass('validar-error');

            }else{
                $(this).removeClass('validar-error');
                $(this).addClass('valido');
            }
        });


}