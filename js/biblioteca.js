var nav4 = window.Event ? true : false;
var fechaHoy = new Date();
var diasSemana = new Array("Domingo", "Lunes", "M&aacute;rtes", "Mi&eacute;rcoles", "Ju&eacute;ves", "Viernes", "S&aacute;bado");
var meses = new Array("Enero", "Febrero", "Marzo", "Abril","Mayo", "Junio", "Julio",
    "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");

function gBrowser() {
    
    var response = new Array('desconocido', '0');
    
    var is_safari = navigator.userAgent.toLowerCase().indexOf('safari/') > -1;
    var is_chrome= navigator.userAgent.toLowerCase().indexOf('chrome/') > -1;
    var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox/') > -1;
    var is_ie = navigator.userAgent.toLowerCase().indexOf('msie ') > -1;
 
    /* Detectando  si es Safari, vereis que en esta condicion preguntaremos por chrome ademas, esto es porque el
        la cadena de texto userAgent de Safari es un poco especial y muy parecida a chrome debido a que los dos navegadores
        usan webkit. */
 
    if (is_safari && !is_chrome ) { 
        /* Buscamos la cadena 'Version' para obtener su posicion en la cadena de texto, para ello
            utilizaremos la funcion, tolowercase() e indexof() que explicamos anteriormente */
        var posicion = navigator.userAgent.toLowerCase().indexOf('Version/');
 
        /* Una vez que tenemos la posición de la cadena de texto que indica la version capturamos la
            subcadena con substring(), como son 4 caracteres los obtendremos de 9 al 12 que es donde
            acaba la palabra 'version'. Tambien podraimos obtener la version con navigator.appVersion, pero
            la gran mayoria de las veces no es la version correcta. */
        var ver_safari = navigator.userAgent.toLowerCase().substring(posicion+9, posicion+12);
 
        // Convertimos la cadena de texto a float y mostramos la version y el navegador
        ver_safari = parseFloat(ver_safari);
        
        response = Array('safari', ver_safari);
    //alert('Su navegador es Safari, Version: ' + ver_safari);
    }
 
    //Detectando si es Chrome
    if (is_chrome ) {
        var posicion = navigator.userAgent.toLowerCase().indexOf('chrome/');
        var ver_chrome = navigator.userAgent.toLowerCase().substring(posicion+7, posicion+11);
        //Comprobar version
        ver_chrome = parseFloat(ver_chrome);
        response = Array('chrome', ver_chrome);
    }
 
    //Detectando si es Firefox
    if (is_firefox ) {
        var posicion = navigator.userAgent.toLowerCase().lastIndexOf('firefox/');
        var ver_firefox = navigator.userAgent.toLowerCase().substring(posicion+8, posicion+12);
        //Comprobar version
        ver_firefox = parseFloat(ver_firefox);
        response = Array('firefox', ver_firefox);
    }
 
    //Detectando Cualquier version de IE
    if (is_ie) {
        var posicion = navigator.userAgent.toLowerCase().lastIndexOf('msie ');
        var ver_ie = navigator.userAgent.toLowerCase().substring(posicion+5, posicion+8);
        //Comprobar version
        ver_chrome = parseFloat(ver_ie);
        response = Array('explorer', ver_ie);
    }
    
    return response;
}


/************************************************************************
 * function: gTrim()
 * 
 * Elimina los espacios en blanco de los dos lados en una cadena de 
 * caracteres
 * 
 * Parametros:
 * - cadena : Cadena a eliminar espacios en blanco 
 * 
 *************************************************************************/
function gTrim(cadena){   
    return cadena.replace(/^\s+|\s+$/g,"");
}

/************************************************************************
 * function: gPad()
 * 
 * Rellena una cadena con el caracter especificado.
 * 
 * Parametros:
 * - str            : La cadena
 * - len            : Tamaño como quedara la cadena.
 * - pad            : Caracter de relleno. Puede ser espacio en blanco.
 * - dir            : Lado por donde se rellenara la cadena, puede ser:
 *                    1 = Por la izquierda
 *                    2 = Por la derecha
 *                    3 = Por ambos lados   
 *                                        
 * Retorno          : La cadena con el relleno especificado.
 *************************************************************************/
function gPad(str, len, pad, dir){
    
    str = new String(str);
    
    var STR_PAD_LEFT = 1;
    var STR_PAD_RIGHT = 2;
    var STR_PAD_BOTH = 3;

    if (typeof(len) == "undefined") {
        var len = 0;
    }
    if (typeof(pad) == "undefined") {
        var pad = " ";
    }
    if (typeof(dir) == "undefined") {
        var dir = STR_PAD_RIGHT;
    }

    if (len + 1 >= str.length) {
        switch (dir){
            case STR_PAD_LEFT:
                str = Array(len + 1 - str.length).join(pad) + str;
                break;

            case STR_PAD_BOTH:
                var right = Math.ceil((padlen = len - str.length) / 2);
                var left = padlen - right;
                str = Array(left+1).join(pad) + str + Array(right+1).join(pad);
                break;

            default:
                str = str + Array(len + 1 - str.length).join(pad);
                break;

        }
    }
    return str;
}

/************************************************************************
 * function: gKeyAceptaSoloDigitos()
 * 
 * Valida que solo se ingresen numeros.
 * 
 * Parametros:
 * - evt     : El handler. 
 *                                          
 * Retorno   : True=Se acepta la pulsacion, False=Se ignora la pulsacion
 * 
 * Ejemplo: onkeypress="return (gKeyAceptaSoloDigitos(event));"
 * 
 *************************************************************************/
function gKeyAceptaSoloDigitos(evt){    
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;      
    var num = (key <= 13 || (key >= 48 && key <= 57)) ? true:false;
    return num ;
}

/************************************************************************
 * function: gKeyAceptaSoloDigitosPunto()
 * 
 * Valida que solo se ingresen numeros y un punto.
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True=Se acepta la pulsacion, False=Se ignora la 
 *                    pulsacion
 * 
 * Ejemplo: onkeypress="return (gKeyAceptaSoloDigitosPunto(event));"
 * 
 *************************************************************************/
function gKeyAceptaSoloDigitosPunto(evt){
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;    
    return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}

/************************************************************************
 * function: gKeyAceptaSoloAlfanumericos()
 * 
 * Valida que solo se ingresen numeros y letras.
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True=Se acepta la pulsacion, False=Se ignora la 
 *                    pulsacion
 *                    
 * Ejemplo          : onkeypress="return (gKeyAceptaSoloAlfanumericos(event));"
 *                     
 *                    
 *************************************************************************/
function gKeyAceptaSoloAlfanumericos(evt){
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;        
    return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 45);
}

/************************************************************************
 * function: gKeyAceptaSoloTelefono()
 * 
 * Valida que solo se caracteres para telefono.
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True=Se acepta la pulsacion, False=Se ignora la 
 *                    pulsacion
 *                    
 * Ejemplo          : onkeypress="return (gKeyAceptaSoloTelefono(event));"
 *                     
 *                    
 *************************************************************************/
function gKeyAceptaSoloTelefono(evt){
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;  
//    alert(key);
    return (key <= 13 || (key >= 48 && key <= 57) || key == 45 || key == 35 || key == 42 || key == 32 || key == 40 || key == 41 || key == 44 || key == 59);
}

/************************************************************************
 * function: gKeyAceptaSoloEmail()
 * 
 * Valida que solo se ingresen caracteres para mail
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True=Se acepta la pulsacion, False=Se ignora la 
 *                    pulsacion
 *                    
 * Ejemplo          : onkeypress="return (gKeyAceptaSoloEmail(event));"
 *                     
 *                    
 *************************************************************************/
function gKeyAceptaSoloEmail(evt){
    
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;        
//    alert(key);
    return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 45 || key == 64 || key == 95 || key == 46 || key == 44 || key == 59 || key == 32);
}

/************************************************************************
 * function: gKeyEnter()
 * 
 * Devuelve true/false si el usuario a pulsado la tecla <ENTER>
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True= Si se pulso la tecla enter, False=Caso contrario
 * 
 * Ejemplo          : onkeypress="if(gKeyEnter(event)) alert('Pulso enter, adelante');"
 * 
 * 
 *************************************************************************/
function gKeyEnter(evt){	
    var key = ('charCode' in evt) ? evt.which : evt.keyCode;        
    return (key == 13);
}

/************************************************************************
 * function: gKeyPress()
 * 
 * Devuelve el codigo de la tecla pulsada por el usuario
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : Codigo de la tecla
 * 
 * Ejemplo          : <input type="text" onkeypress="alert(gKeyPress(event));"/>
 * 
 * 
 *************************************************************************/
function gKeyPress(evt){	
    var key = ('charCode' in evt) ? evt.which : evt.keyCode;            
    return key;
}

/************************************************************************
 * function: gKeyAceptaSoloFechas()
 * 
 * Valida que solo se ingresen fechas.
 * 
 * Parametros:
 * - evt            : El handler.
 *                                        
 * Retorno          : True=Se acepta la pulsacion, False=Se ignora la 
 *                    pulsacion
 *************************************************************************/
function gKeyAceptaSoloFechas(evt){	
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;    
    return (key <= 13 || (key >= 48 && key <= 57) || key == 45 || key == 47);
}



/*************************************************************
 * function: gFechaActual()
 * 
 * Devuelve la fecha actual del sistema del cliente.  
 **************************************************************/
function gFechaActual(){
    var dd = fechaHoy.getDate();
    var fecha = diasSemana[fechaHoy.getDay()] + ", " + ((dd < 10) ? ("0" + dd) : ("" + dd)) + " de " +
    meses[fechaHoy.getMonth()] + " del";

    var yy = (fechaHoy.getYear() < 1000) ? (fechaHoy.getYear() + 1900) : fechaHoy.getYear();

    fecha = fecha + " " + yy;
	
    return fecha;
}
function gFechaHoraActual(){
    var dd = fechaHoy.getDate();
    var mm = fechaHoy.getMonth() + 1;
    var yy = fechaHoy.getYear();

    var hh =  fechaHoy.getHours();
    var mn = fechaHoy.getMinutes();

    dd =  (dd < 10) ? ("0" + dd) : ("" + dd);
    mm =  (mm < 10) ? ("0" + mm) : ("" + mm);

    hh =  (hh < 10) ? ("0" + hh) : ("" + hh);
    mn =  (mn < 10) ? ("0" + mn) : ("" + mn);

    yy = (fechaHoy.getYear() < 1000) ? fechaHoy.getYear() + 1900 : fechaHoy.getYear();

    var fecha = dd + "-" + mm + "-" + yy + " " + hh + ":" + mn;

    return fecha;
}
/************************************************************************
 * function: gDMA()
 * 
 * Convierte una fecha del formato AAAA-MM-DD al formato DD-MM-AAAA
 * 
 * Parametros:
 * - fechaAMD  : La fecha con el formato AAAA-MM-DD 
 * 
 *************************************************************************/
function gDMA(fechaAMD){
    var f = fechaAMD;
    if(fechaAMD.length >= 10){
        f = gCambiarSeparadorFecha(fechaAMD);
        f = fechaAMD.substring(8,10) + "-" + fechaAMD.substring(5,7) + "-" + fechaAMD.substring(0,4);
    }
    return f;
}

/************************************************************************
 * function: gAMD()
 * 
 * Convierte una fecha del formato DD-MM-AAAA al formato AAAA-MM-DD
 * 
 * Parametros:
 * - fechaAMD  : La fecha con el formato DD-MM-AAAA
 * 
 *************************************************************************/
function gAMD(fechaDMA){
    var f = "";
    if(fechaDMA.length == 10){
        f = gCambiarSeparadorFecha(fechaDMA);
        f = fechaDMA.substring(6,10) + "-" + fechaDMA.substring(3,5) + "-" + fechaDMA.substring(0,2);
    }

    return f;
}
/************************************************************************
 * function: gCambiarSeparadorFecha()
 * 
 * Cambia el caracter separador de fechas por guion (-)
 * 
 * Parametros:
 * - fecha  : Fecha a cambiar
 * 
 *************************************************************************/
function gCambiarSeparadorFecha(fecha){
    var d = new String(fecha);
    d = d.replace("/","-");
    d =  d.replace("/","-");
    return d;
}

/*************************************************************
 * function: gAbrirVentana()
 * 
 * Permite abrir una ventana popup sin dimensiones 
 **************************************************************/
 function gAbrirVentana(url, nombreVentana, width, height){
    var params = "";    
    
    if(gBrowser().indexOf("firefox")==0){            
        params += " directories=no,";    
        params += " scrollbars=yes,";
        params += " resizable=yes";        
    }
    else{
        params += " directories=no,";    
        params += " scrollbars=auto";        
    }
    
    if(width==undefined){
        width = gResolucionPantalla(1);
    }
    else{
         width = (width==0 ? 950 : width);
    }
    
     if(height==undefined){
        height = gResolucionPantalla(2);
    }
    else{
         height = (height==0 ? gResolucionPantalla(2) : height);
    }       
     
    params += ",top=0,left=0,width=" + width + ",height=" + height;
    
    var newwin=window.open(url,nombreVentana,params);
    if (window.focus) {
        newwin.focus();
    }
    return false;
}
 /*
function gAbrirVentana(url, nombreVentana){
    var params = "";
    params += " directories=no,";    
    params += " scrollbars=auto";

    var newwin=window.open(url,nombreVentana,params);
    if (window.focus) {
        newwin.focus();
    }
    return false;
}*/

/************************************************************************
 * function: gAbrirVentanaFull()
 * 
 * Permite abrir una ventana popup con las dimensiones de la pantalla
 * 
 * Parametros:
 * - url            : La direccion url
 * - nombreVentana  : Nombre de la ventana
 * 
 *************************************************************************/
function gAbrirVentanaFull(url, nombreVentana){
    var width = gResolucionPantalla(1);
    var height = gResolucionPantalla(2);
	
    var w = window.open(url, nombreVentana, "directories=NO,menubar=NO,location=NO,resizable = YES,status=NO,width=" + width + ",height=" + height + ",scrollbars=YES");
    w.moveTo(0, 0);
    w.focus();
    return true;
}


/************************************************************************
 * function: gAbrirVentanaModal()
 * Abre una ventana estilo Modal.
 * 
 * Parametros:
 * - url            : Url de la pagina
 * - nombreVentana  : Nombre de la ventana
 * - ancho          : Ancho de la ventana
 * - alto           : Alto de la ventana
 * 
 * El quinto parametro es opcional, sirve para fijar la posicion inicial
 * de la ventana, puede elegir entre estos:
 * 
 * 1= Arriba a la izquierda
 * 2= Arriba a la derecha
 * 3= Abajo a la izquierda
 * 4= Abajo a la derecha 
 *                    
 * Retorno          : Ninguno
 *************************************************************************/
function gAbrirVentanaModal(url, nombreVentana, ancho, alto){
    var left   = 0;
    var top    = 0;
    
    ancho = !ancho? gObtenerAnchoVentana() : ancho;
    alto = !alto? gObtenerAltoVentana() : alto;
        
    if(arguments.length == 4){      
        left   = (gObtenerAnchoVentana()  - ancho)/2;
        top    = (gObtenerAltoVentana() - alto)/2;
        top = top - 50;
    }
    else if(arguments[4] == 2){
        left = (gObtenerAnchoVentana()  - ancho);
    }
    else if(arguments[4] == 3){
        top = (gObtenerAltoVentana() - alto);
    }
    else if(arguments[4] == 4){
        left = (gObtenerAnchoVentana()  - ancho);
        top = (gObtenerAltoVentana() - alto);
    }
    
    var params = "dialogTop=" + top + "px;dialogLeft=" + left +"px;dialogWidth=" + ancho + " px;dialogHeight=" + alto + "px;center=yes;help=no;directories=no;scroll=no;status=no;";
    objNewWindow = window.showModalDialog(url, nombreVentana, params);
}

function gAbrirVentana2(url, width, height, center, resize, name){	
    var left   = 1;
    var top    = 1;
    if(center){
        left   = (screen.width  - width)/2;
        top    = (screen.height - height)/2;
    }

    var params = "width="+width+", height="+height;
    params += ", top="+top+", left="+left;
    params += ", directories=no";
    params += ", location=no";
    params += ", menubar=no";
    params += ", resizable=" + resize;
    params += ", scrollbars=yes";
    params += ", status=no";
    params += ", toolbar=no";
    var newwin=window.open(url,name, params);
    if (window.focus) {
        newwin.focus()
    }    
    if(arguments.length==7){
        height = height - 35;
        newwin.document.writeln('<body>');
        newwin.document.writeln('<style>h1{font-size:10pt;font-weight:bold;}*{font-family:Arial;font-size:8pt;}</style>');
        newwin.document.writeln('<div style="border:solid 1px #999;background-color:#ccc;padding:5px;height:'+ height + 'px;margin:2px;">');
        newwin.document.writeln(arguments[6]);
        newwin.document.writeln('</div>');
        newwin.document.writeln('</body>'); 
    }
    
    return false;
}


/************************************************************************
 * function: gResolucionPantalla()
 * 
 * Obtiene la resolucion de uno de los ejes de la pantalla
 * 
 * Parametros:
 * - eje            : Eje (1=Ancho, 2=Alto) 
 * 
 *************************************************************************/
function gResolucionPantalla(eje){
    var screenW = 480;
    var screenH = 640;
    if (parseInt(navigator.appVersion)>3) {
        screenW = screen.availWidth - 10;
        screenH = screen.availHeight - 40;
    }
    else if (navigator.appName == "Netscape" && parseInt(navigator.appVersion)==3 && navigator.javaEnabled()){
        var jToolkit = java.awt.Toolkit.getDefaultToolkit();
        var jScreenSize = jToolkit.getScreenSize();
        screenW = jScreenSize.availWidth;
        screenH = jScreenSize.availHeight;
    }

    var resolucion = screenW;

    if(eje == 2){
        resolucion = screenH;
    }
	
    return resolucion;
}

/************************************************************************
 * function: gObtenerAnchoVentana()
 * 
 * Obtiene el ancho en pixeles de la ventana actual.
 *  
 * Retorno: Numero de pixeles 
 *************************************************************************/
function gObtenerAnchoVentana(){
    var viewportwidth;
    if (typeof window.innerWidth != 'undefined'){
        viewportwidth = window.innerWidth;
    }
    else if (typeof document.documentElement != 'undefined'
        && typeof document.documentElement.clientWidth !=
        'undefined' && document.documentElement.clientWidth != 0){       
        viewportwidth = document.documentElement.clientWidth;
    }
    else{
        viewportwidth = document.getElementsByTagName('body')[0].clientWidth;
    }
    return viewportwidth;
}

/************************************************************************
 * function: gObtenerAltoVentana()
 * 
 * Obtiene el alto en pixeles de la ventana actual.
 *  
 * Retorno: Numero de pixeles 
 *************************************************************************/
function gObtenerAltoVentana(){
    var viewportheight;
    if (typeof window.innerHeight != 'undefined'){
        viewportheight = window.innerHeight;
    }
    else if (typeof document.documentElement != 'undefined'
        && typeof document.documentElement.clientHeight !=
        'undefined' && document.documentElement.clientHeight != 0){       
        viewportheight = document.documentElement.clientHeight;
    }
    else{
        viewportheight = document.getElementsByTagName('body')[0].clientHeight;
    }
    return viewportheight;
}

/************************************************************************
 * function: gCentrarCapa()
 * 
 * Centra una capa en la ventana actual, se requiere que la capa tenga asignado
 * un ancho y alto.
 * 
 * Parametros:
 * - id            : Id de la capa
 * 
 *************************************************************************/
function gCentrarCapa(id){
    var layer =  document.getElementById(id);
    if(layer){
        var ws = gResolucionPantalla(1);
        var hs = gResolucionPantalla(2);

        var w = indexOfNumberResolution(document.getElementById(id).style.width);
        var h = indexOfNumberResolution(document.getElementById(id).style.height);

        document.getElementById(id).style.left = (parseFloat(ws) / 2) - (parseFloat(w) / 2) + "px";
        document.getElementById(id).style.top = (parseFloat(hs) / 2) - (parseFloat(h) / 2) + "px";
    }
}
function indexOfNumberResolution(stringValue){
    if(trim(stringValue)!="")
        return stringValue.substring(0, (stringValue.length - (stringValue.lastIndexOf("px"))) + 1 );
    else
        return "0";
}

/************************************************************************
 * function: gOcultarMostrarCapa()
 * 
 * Muestra u oculta una capa.
 * 
 * Parametros:
 * - id   : Id de la capa
 * - flag : true/false, mostrar/ocultar
 * 
 *************************************************************************/
function gOcultarMostrarCapa(id, flag){
    if (document.getElementById){
        var d = document.getElementById(id);        
        (flag)? (d.style.display = "block") : (d.style.display = "none");
    }
}


/************************************************************************
 * function: gEsFechaCorrecta
 * Evalua una fecha y devuelve verdadero si la fecha es correcta.
 * 
 * Parametros:
 * - fecha           : Fecha a evaluar
 * - mostrarMsgError : Si es true, se muestra el mensaje de error
 * 
 *************************************************************************/
function gEsFechaCorrecta(fecha){
    var objFecha= new String(fecha)
    var mostrarMsgError = (arguments.length==1 ? true : mostrarMsgError);
    
    if(objFecha.length != 10 && arguments.length==1){
        if(mostrarMsgError){
            alert("La fecha debe tener 10 caractéres.");
        }
        return false;
    }
    objFecha = gCambiarSeparadorFecha(fecha);       

    var Ano = new String(objFecha.substring(objFecha.lastIndexOf("-")+1,objFecha.length))
    var Mes = new String(objFecha.substring(objFecha.indexOf("-")+1,objFecha.lastIndexOf("-")))
    var Dia = new String(objFecha.substring(0,objFecha.indexOf("-")))
    
    if (Ano.length == 0 || isNaN(Ano) || Ano.length<4 || parseFloat(Ano)<1900){        
        if(mostrarMsgError){
            alert('Año inválido');
        }        
        return false
    }
    if (Mes.length == 0 || isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12){
        if(mostrarMsgError){
            alert('Mes inválido');
        }
        return false
    }    
    if (Dia.length == 0 || isNaN(Dia) || parseInt(Dia, 10)<1 || parseInt(Dia, 10)>31){
        if(mostrarMsgError){
            alert('Día inválido');
        }
        return false
    }              
    if (Mes==4 || Mes==6 || Mes==9 || Mes==11) {
        if (Dia>30) {
            if(mostrarMsgError){
                alert('Día incorrecto')
            }
            return false
        }
    }
    var diasFeb = 28;    
    if ((Ano % 4 == 0) && ((Ano % 100 != 0) || (Ano % 400 == 0))){ 
        diasFeb = 29;
    }    
    if (Mes==2 && Dia > diasFeb) {
        if(mostrarMsgError){
            alert('Día incorrecto')
        }
        return false        
    }
    

    return true;
}

/************************************************************************
 * function: gFechaDiff
 * Compara dos fecha y devuelve el numero de dias entre ambas.
 * 
 * Parametros:
 * - fechaMax   : Fecha maxima
 * - fechaMin   : Fecha minima
 * 
 *************************************************************************/
function gFechaDiff(fechaMax, fechaMin){
    fechaMax = gCambiarSeparadorFecha(fechaMax);
    fechaMin = gCambiarSeparadorFecha(fechaMin);
    
    var date1 = new myDate(fechaMax);
    var date2 = new myDate(fechaMin);

    var myDate1 = new Date(date1.year, date1.month, date1.day);
    var myDate2 = new Date(date2.year, date2.month, date2.day);
    
    // resta fechas y redondea
    var diferencia = myDate1.getTime() - myDate2.getTime();
    var days = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    
    return days;
}
function myDate(cadena) {      
    var separador = "/";
    
    if (cadena.indexOf('-') != -1) {
        separador = "-";
    }

    //Separa por dia, mes y anio
    var posi1 = 0
    var posi2 = cadena.indexOf(separador, posi1 + 1);
    var posi3 = cadena.indexOf(separador, posi2 + 1);
    this.day = cadena.substring(posi1, posi2);
    this.month = cadena.substring(posi2 + 1, posi3);
    this.year = cadena.substring(posi3 + 1, cadena.length);    
}

/************************************************************************
         * function: gFormExisteValor
         * Devuelve True/False si existe el valor en la propiedad "Value" de un 
         * array de controles(cajas de textos,hidden, etc.)
         * 
         * Parametros:
         * - form           : Id del formulario
         * - objBuscar      : Nombre del objeto en donde buscar. 
         *                    Por ej. 'txtCodigos[]', 'txtFechaProgramacion[]'
         * - criterioBuscar : Valor a buscar en los control/es.             
         *                    
         * Retorno          : True: Existe, False=No existe
         * 
         *************************************************************************/
function gFormExisteValor(form, objBuscar, criterioBuscar){
    var f = document.getElementById(form);
    if(f.elements.length){
        if(f.elements.length>0){
            var obj = f.elements[objBuscar];    
            if(obj != undefined){
                if(obj.length == undefined){                    
                    return (obj.value == criterioBuscar);
                }
                else{                    
                    for(var i=0;i<obj.length;i++){
                        if(gTrim(obj[i].value) == gTrim(criterioBuscar))                     
                            return true;
                    }
                }
            }
        }
    }
    else{
        return false;
    }
    return false;
}


/************************************************************************
         * function: gFormTodosValoresIguales
         * Devuelve True un el mismo valor existe en la propiedad "Value" de 
         * todos el array de controles (cajas de textos,hidden, etc.)
         * O false caso contrario.
         * 
         * Parametros:
         * - form           : Id del formulario
         * - objBuscar      : Nombre del objeto en donde buscar. 
         *                    Por ej. 'txtCodigos[]', 'txtFechaProgramacion[]'
         * - criterioBuscar : Valor a buscar en los control/es.             
         *                    
         * Retorno          : True: Existe en todos, False=No
         * 
         *************************************************************************/
function gFormTodosValoresIguales(form, objBuscar, criterioBuscar){
    var f = document.getElementById(form);
    if(f.elements.length){
        if(f.elements.length>0){
            var obj = f.elements[objBuscar];    
            if(obj != undefined){
                if(obj.length == undefined){                    
                    return (obj.value == criterioBuscar);
                }
                else{     
                    var c=0;
                    for(var i=0;i<obj.length;i++){
                        if(gTrim(obj[i].value) == gTrim(criterioBuscar)){                     
                            c++;
                        }                            
                    }
                    return (c == obj.length);
                }
            }
        }
    }
    else{
        return true;
    }
    return true;
}

/************************************************************************
         * function: gFormBuscarIndiceObjeto()
         * Devuelve el indice del objeto si existe el valor en la propiedad "Value" de un 
         * array de controles(cajas de textos, etc.)
         * 
         * Parametros:
         * - form           : Id del formulario
         * - objBuscar      : Nombre del objeto en donde buscar. 
         *                    Por ej. 'txtCodigos[]', 'txtFechaProgramacion[]'
         * - criterioBuscar : Valor a buscar en los control/es.             
         *                    
         * Retorno          : Indice del objeto donde se encontro el valor,
         *                    O un valor negativo en el caso no exista. 
         *************************************************************************/
function gFormBuscarIndiceObjeto(idForm, objBuscar, criterioBuscar){
    var f = document.getElementById(idForm);    
    if(f.elements.length){
        if(f.elements.length>0){
            var obj = f.elements[objBuscar];
            if(obj != undefined){
                if(obj.length == undefined){
                    if(gTrim(obj.value)==criterioBuscar){
                        return 0;
                    }
                    else{
                        return -2; // no hay array, el objeto es unico
                    }
                }
                else {
                    for(var i=0;i<obj.length;i++){                    
                        if(gTrim(obj[i].value) == gTrim(criterioBuscar))
                            return i; // el indice donde se encontro
                    }
                }
            }
        }
    }
    else{
        return -2; /* no es un array de controles, el objeto es unico*/
    }
    return -1; /* no existe */
}

/************************************************************************
         * function: gFormSeleccionarItem
         * Busca un valor en un control SELECT y se ubica en esa posicion.
         * 
         * Parametros:
         * - idSelect      : Id del objeto SELECT
         * - value         : Valor a buscar en el objeto SELECT  
         * 
         *************************************************************************/
function gFormSeleccionarItem(idSelect, value){
    if(document.getElementById(idSelect) != undefined) {
        var list = document.getElementById(idSelect);
        if(list.type == "select-one") {
            var numelements	= list.length ;
            var encontrado=false;
            for (i=0;i<numelements;i++){
                if(list.options[i].value == value){
                    document.getElementById(idSelect).selectedIndex = i;
                    encontrado = true;
                    break;
                }
            }
            
            if(!encontrado && arguments.length==3) document.getElementById(idSelect).selectedIndex = 0;
        }
    }
}

/************************************************************************
         * function: gFormCheckBoxExisteUnItemSeleccionado
         * Devuleve True/False si al menos un CHECKBOX de un array de CHECKBOXS
         * esta seleccionado.
         * 
         * Parametros:
         * - idForm         : Nombre del formulario
         * - nombreCheckBox : Nombre del objeto CHECKBOX, ej. chkEstados[], chkIds[]
         * 
         * Retorno: True   = Si hay al menos un objeto checkbox seleccionado
         *          False  = No hay nada seleccionados
         * 
         *************************************************************************/
function gFormCheckBoxExisteUnItemSeleccionado(nombreForm, nombreCheckBox) {
    if(!document.forms[nombreForm]) return false;
    var objCheckBoxes = document.forms[nombreForm].elements[nombreCheckBox];
    if(!objCheckBoxes) return false;

    var countCheckBoxes = objCheckBoxes.length;

    if(!countCheckBoxes){
        if(objCheckBoxes.checked) return true;
    }
    else{
        var TotalOn = 0;
        for(var i = 0; i < countCheckBoxes; i++){
            if(objCheckBoxes[i].checked){
                TotalOn++;
                break;
            }
        }
		
        if (TotalOn >= 1) return true;
        else return false;
    }
}
/************************************************************************
 * function: gTablaEliminarFilas()
 * Elimina todas las filas de la tabla.
 * 
 * Parametros:
 * - idTabla        : Id de la tabla
 * 
 *************************************************************************/
function gTablaEliminarFilas(idTabla){
    var t = document.getElementById(idTabla);
    if(t){
        var rows = t.rows;
        while(rows.length)
            t.deleteRow(rows.length-1);
    }
}

/************************************************************************
 * function: gEliminarOptions()
 * Elimina todos los items de un SELECT
 * 
 * Parametros:
 * - idSelect       : Id del SELECT
 * 
 *************************************************************************/
function gEliminarOptions(idSelect){
    var lst =document.getElementById(idSelect);
    if(lst){
        for(var i= lst.options.length-1;i>=0;i--)
            lst.remove(i);      
    }
}

/************************************************************************
* function: gRound()
* Redondea un numero, por defecto con dos decimales.
* 
* Parametros:
* - numero     : Numero a redondear.
* - decimales  : Numero de decimales.
* 
*************************************************************************/
function gRound(numero, decimales) {
    decimales = (!decimales ? 2 : decimales);
    var n = Math.round(numero * Math.pow(10, decimales))/Math.pow(10, decimales);
    var nn = n.toFixed(decimales);
    return nn;
}
function erpRound2(n,dec) {
    n = parseFloat(n);
    if(!isNaN(n)){
        if(!dec) dec= 2;
        var factor= Math.pow(10,dec);
        return Math.floor(n*factor+((n*factor*10)%10>=5?1:0))/factor;
    }else{
        return n;
    }
}

/************************************************************************
 * function: gRedimensionarCapa()
 * Redimensiona la altura de un objeto segun la resolucion de la pantalla
 * considerando un margen en el lado superior o inferior.
 * 
 * Parametros:
 * - idCapa : Id de la objeto (DIV, IFRAME, etc.)
 * - margen : Pixeles para el margen que se utilizara para descontar el alto
 *            de la pantalla.
 * 
 *************************************************************************/
function gRedimensionarCapa(idCapa, margen){
    var h = gObtenerAltoVentana();    
    var hg = parseFloat(h) - margen;    
    if(document.getElementById(idCapa))
        document.getElementById(idCapa).style.height= hg + "px";   
}
/************************************************************************
* function: gEsCasillaActiva()
* Verifica si la casilla esta activado y devuelve 1 si esta marcado o
* 0 sino esta marcado.
* 
* Parametros:
* - idCasilla : Id de la casilla.
* 
* Retorno: 1=La casilla esta activa, 0=La casilla esta desactivada
*************************************************************************/
function gEsCasillaActiva(idCasilla){
    if(!document.getElementById(idCasilla)){
        alert("El objeto no existe.\ngVerificaCasilla()");
    }   
    return document.getElementById(idCasilla).checked? "1" : "0";
}
/************************************************************************
* function: gRemoverOpcionesLista()
* Elimina todos los elementos del SELECT.
* 
* Parametros:
* - idSelect   : Id del objeto SELECT.
* 
*************************************************************************/
function gRemoverOpcionesLista(idSelect){
    var lst =document.getElementById(idSelect);
    if(lst){
        for(var i= lst.options.length-1;i>=0;i--)
            lst.remove(i);      
    }
}

/************************************************************************
* function: gValidarEmail()
* Valida el ingreso correcto de un correo.
* 
* Parametros:
* - email: texto que se validara
* 
*************************************************************************/
function gValidarEmail(email) {
    /*if (gTrim(email)!=""){*/
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {        
        alert("La dirección de email es incorrecta.");
        return false;
    }        
    /*}*/
    return true;
}

/************************************************************************
 * function: gPHPSerialize()
 * Permite serializar un objeto array para que pueda ser colocado en el value
 * de un control y enviado mediante xajax/post/get
 * 
 * Parametros:
 * - arr: El array
 * 
 *************************************************************************/
function gPHPSerialize(arr){
    var res = "";
    if (typeof(arr) == 'object') {
        if (arr instanceof Array) {
            res = 'a:'+arr.length+':{';
            for(i=0; i<arr.length; i++){
                var sVal = "" + arr[i];
                res += 'i:'+i+';s:'+sVal.length+':"'+sVal+'";';
            }

            res += '}';
        }
    }

    return res;
}


/************************************************************************
* function: gGetValueList()
* Devuelve el valor del item seleccionado de un objeto lista (SELECT).
* 
* Parametros:
* - oObject: El objeto SELECT
* 
* Retorno: El valor del item. Si no existe o no hay ningun elemento
* seleccionado devuelve vacio. 
* 
*************************************************************************/
function gGetValueList(oObject){
    if(document.getElementById(oObject) == undefined) return "";

    var idx = document.getElementById(oObject).selectedIndex;
    if(idx >=0){
        return document.getElementById(oObject).options[idx].value;
    }
    else
        return "";
}

/************************************************************************
* function: gGetTextList()
* Devuelve el texto del item seleccionado de un objeto lista (SELECT).
* 
* Parametros:
* - oObject: El objeto SELECT
* 
* Retorno: El texto del item seleccionado. Si no existe o no hay ningun elemento
* seleccionado devuelve vacio. 
* 
*************************************************************************/
function gGetTextList(oObject){
    if(document.getElementById(oObject) == undefined) return "";
	
    var idx = document.getElementById(oObject).selectedIndex;
    if(idx >=0)
        return document.getElementById(oObject).options[idx].text;
    else
        return "";
}

/************************************************************************
* function: gGetInputText()
* Devuelve el texto ingresado en una caja de texto (input type='TEXT').
* 
* Parametros:
* - oObject: El objeto input type='TEXT'
* 
* Retorno: El texto ingresado
* 
*************************************************************************/
function gGetInputText(oObject){
    if(document.getElementById(oObject) == undefined) return "";
    return document.getElementById(oObject).value;
}

function gSetInputText(oObject, value){
    if(document.getElementById(oObject) != undefined) {
        document.getElementById(oObject).value = value;
    }
}

/* function: getElemento()
 * Devuelve el objeto segun el nombre ingresado .
 * 
 * Parametros:
 * - Nombre : El Nombre del objeto input id='txt_nombre'
 * 
 * Retorno: El Objeto
 * 
*************************************************************************/
function getElemento(Nombre){
    try{
        return document.getElementById(Nombre);
    }
    catch(e){
        alert('No existe el objeto ' + Nombre + '.');
    }
}

/* function: gPedirNumero()
 * 
 * Abre un cuadro de dialogo para solicitar el ingreso de una cantidad o precio.
 * Valida que se ingrese un numero mayor igual a 1.
 * 
 * Parametros:
 * - mensaje               : El mensaje a mostrar
 * - numeroPredeterminado  : El numero predeterminado que aparecera.
 * - Hay un tercer parametro es opcional y sirve para indicar un numero maximo.
 * 
 *   Ejemplos:  
 *   gPedirNumero('Ingrese un numero:');        // ingresar un numero mayor a 1
 *   gPedirNumero('Ingrese un numero:', 20);    // valor predeterminado 20
 *   gPedirNumero('Ingrese un numero:', 1, 10); // entre 1 y 10
 *   
 * Retorno: El numero ingresado.
 * 
*************************************************************************/
function gPedirNumero(mensaje, numeroPredeterminado){
    try{
        numeroPredeterminado = !numeroPredeterminado ? 0 : numeroPredeterminado;
        
        var sNumber = prompt(mensaje, numeroPredeterminado);
        if(sNumber == undefined || isNaN(sNumber)) return -1;

        var dNumber = parseFloat(sNumber);

        if(arguments.length==3){
            if(dNumber > parseFloat(arguments[2]) || dNumber<=0){
                alert("El dato ingresado no es correcto, ingrese un número entre 1 y " + parseFloat(arguments[2]) + ".");
                return -1;
            }
        }
        return dNumber;
    }
    catch(ex){
        alert(ex.toString());
    }    
}


/* function: gFormatoNumero()
 * 
 * Dar formato a un numero.
 * 
 * Parametros:
 * - num               : El numero
 * - prefix            : El prefijo, puede ser un simbolo de moneda. 
 * 
 * Ejemplos:  
 * gFormatoNumero(1250);
 * gFormatoNumero(1250, 'S/');
 *   
 * Retorno: El numero ingresado.
 * 
*************************************************************************/
function gFormatoNumero(num,prefix){
    prefix = prefix || '';
    num += '';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '';
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + ',' + '$2');
    }
    var ret = prefix + splitLeft + splitRight;
    var r = ret.split(".");
   
    if(r.length == 1)
        ret = ret + ".00";
    else if(r.length == 2 && r[1].length==1)
        ret = ret + "0";

    return ret;
}
function gImprimir(){
    if (!window.print){
        alert("Su navegador no soporta Imprimir. Actualize su navegador.\n")
        return
    }
    window.print()
}


function ImprimirSeleccion(tamare){


    	
					var ventana = window.open("popimpr","divCapaWindow2");
					var contenido = "<html>";
					contenido = contenido +'<head><link rel="stylesheet" type="text/css" media="all" href="css/reporte_border.css"/>';
					contenido= contenido +"</head><body onload='window.print();window.close();'>" + document.getElementById(tamare).innerHTML + "</body></html>";
					ventana.document.open();
					ventana.document.write(contenido);
					 ventana.document.close();
}


 function gImprimirCapa(id,titulo,w,h) {
    if(w==''){
        w=700;
    }
    if(h==''){
        h=300;
    }
    
    var js='<script type="text/javascript">';    
    js +='var tbls = document.getElementById("bd").getElementsByTagName("table");';
    js +='for(i=0;i<tbls.length;i++){if(tbls[i].className=="bordered-table" || tbls[i].className=="bordered-table zebra-striped") tbls[i].className="rptdetails_horz"};';
    js +='</script>';
    
    var ventana = window.open("","");
    var contenido = '<html>';
    contenido = contenido +'<link rel="stylesheet" type="text/css" media="all" href="css/report.css"/>';
    contenido = contenido +'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    contenido = contenido +'<title>'+titulo+'</title>';
    contenido = contenido +'</head><body onload=\'window.print();window.close();\'><div style="width:720px;">';
    contenido = contenido + document.getElementById(id).innerHTML + "</div>" + "" + "</body></html>";
    document.getElementById(id).style.display="block";
    ventana.document.open();
    ventana.document.write(contenido); 
    ventana.document.close();
}

function LimpiaContenedor(){
    //document.getElementById('detalleejemplar').innerHTML = '';
    //document.getElementById('myModalLabel').innerHTML = 'cargando......';

}
function display(id){
    var obj=document.getElementById(id);
    var estado=obj.style.display;
    if(estado=='none'){
        obj.style.display='block';
    }else{
        obj.style.display='none';
    }
}
function agregar(id,contenido){
    $('#'+id).append(contenido);
    // alert(id);
    //  contenido="<table class=\"bordered-table\" style=\"margin-bottom:5px;margin-left:30px\"><tr><td  style=\"width:1px\">@</td><td  style=\"width:250px\">fixed length control field</td><td><input  id=\"txt000\"  name=\"txt000\" onclick=\"funcion(txt000)\" type=\"text\" /></td></tr></table>";
    //var campo=document.getElementById(id);
    //var valor=campo.innerHTML;
    // alert(contenido);
    //campo.innerHTML=valor+contenido;
    // alert(valor+contenido);
}

function activarcodigobarra(id){
    document.getElementById(id).disabled=!document.getElementById(id).disabled;
}
function activarcheck(id,valor){
    document.getElementById(id).disabled=valor==1? false:true;
}
function unificar(destino,tipo,texto,paginas,cantidad,tipocat){
    var origen=prompt('Ingreso el codigo del ejemplar!','');

    if(origen==null){
        alert('Operación Cancelada');
    }else
    if(origen.length!=11 ){
        alert('Tamaño de codigo es incorrecto');
        setTimeout("unificar('"+destino+"')",'100');
    }else if(origen==destino){
        alert('El codigo origen no puede ser igual al codigo de destino');
        setTimeout("unificar('"+destino+"')",'100');
    }else{
        xajax__unificarejemplar(origen,destino,tipo,texto,paginas,cantidad,tipocat);
//		xajax__interfazinicial(tipo,texto,paginas,cantidad,tipo);
    }
}

function numerocorrelativo(tipomaterial){

    if(document.getElementById('txt082[p][1]')==null){
        alert("Tipo de material no es valido");
    }else{
        var escuela=document.getElementById('txt952[k][1]').value.substring(0,3);
        var local=document.getElementById('txt952[a][1]').value.substring(0,4);
        var presignatura=document.getElementById('txt082[p][1]').value.substring(0,6);
        var nombreescuela=document.getElementById('txt952[k][1]').value.substring(3,100);
        var nombrelocal=document.getElementById('txt952[a][1]').value.substring(4,100);
        var nombrepresignatura=document.getElementById('txt082[p][1]').value.substring(3,100);
        if(escuela==''){
            alert('Seleccione una escuela');
        }else if(local==''){
            alert('Seleccione un local');
        }else if(presignatura==''){
            alert('Seleccione una presignatura');
        }else{
            xajax__agregarcorrelativo(local,escuela,tipomaterial,presignatura,nombreescuela,nombrelocal,nombrepresignatura);
        }


    }
}
function CirculacionDevolucionBuscar(){
    var value=document.getElementById('txt_nombrecompleto').value;

    if(value==""){
        alert("Ingrese el Codigo de Barra");
        FocusIn('txt_nombrecompleto');
    }else{
        xajax__interfazCirculacionDevolucionBuscar(value);
    }
}
function imprimirbiblioteca(id) {

    var contenido = '<html>';
    contenido=contenido+'<link type="text/css" rel="stylesheet" href="theme/css/bootstrap.css" >';
    contenido=contenido+'<link type="text/css" rel="stylesheet" href="theme/css/bootstrap-responsive.css" >';

    contenido=contenido+'<body onload="window.print();window.close();" style="margin: 0; padding-top: 0;" >'+document.getElementById(id).innerHTML+'</body>';
    contenido=contenido+'</html>';

    var ventana = window.open("","","width=800,height=600");
    ventana.document.open();
    ventana.document.write(contenido);
    ventana.document.close();

}