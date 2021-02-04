<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <title>SUPER VISOR</title>
    </head>
    <body class="container">

        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">INGRESAR CÓDIGOS DE ESTUDIANTES EN EL FORMATO ESPECIFICADO</label>
                <input type="email" class="dnis form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="'70598957','222', '12345678'">
                <small id="emailHelp" class="form-text text-muted">Códigos de estudiantes!</small>
            </div>
        </form>

        <br>


        <div>            
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DNI</th>
                    <th scope="col">TIPO</th>
                    <th scope="col">FECHA</th>
                    </tr>
                </thead>
                <tbody class="resultados"> 
                    
                    <tr>
                        <th scope="row">0</th>
                        <td>ESPERANDO . . .</td>
                        <td>ESPERANDO . . .</td>
                        <td>ESPERANDO . . .</td>
                        <td>ESPERANDO . . .</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <script>
    //CÓDIGO SUPERV ---------- EMANE UNAJMA 2020 ----------------------------------------------------------------

    //SI CAMBIA DE PESTAÑA EN LA MISMA PÁGINA
    let resultados = document.querySelector(".resultados");
    // URL_AJAX = "./views/modules/pruebas/ajax2.php";
    URL_AJAX = "../ajax_s.php";
    let data_html=``;


    function handleVisibilityChange() {
        if (document.hidden) {

            //CONSULTANDO POSTULANTES
            let dnis1 = document.querySelector(".dnis").value.trim();
            fetchKev('post',{persona:'kevin',dnis: dnis1},function(x){
                console.log("PESTAÑA");                    
                // console.log(x) 
                data_html = ``;
                x.data.forEach((element)=>{
                    data_html += `
                        <tr>
                            <th scope="row">${element.id}</th>
                            <td>${element.nombre}</td>
                            <td>--</td>
                            <td>${element.tipo} </td>
                            <td>${element.fecha}</td>
                        </tr>
                    `;
                })
                resultados.innerHTML = data_html;
            }, URL_AJAX)

        } else  {
            //console.log('NO CAMBIO LA PÁGINA')
        }
    }
    document.addEventListener("visibilitychange", handleVisibilityChange, false);



    //SI MINIMIZA O CAMBIA EL NAVEGADOR
                    let contador = 0;
                    setInterval( checkPostulanteNav, 1000);
                    function checkPostulanteNav() {
                        
                        if ( document.hasFocus() ) {
                            // 3 SEGUNDOS FUERA DEL EXAMEN
                            if(contador>=2){
                                // alert("SALIÓ DEL NAVEGADOR")
                                //ENVIAR DATOS
                                let dnis2 = document.querySelector(".dnis").value.trim();
                                fetchKev('post',{persona:'kevin',dnis:dnis2},function(x){
                                    console.log("NAVEGADOR");
                                    data_html = ``;
                                    x.data.forEach((element)=>{
                                        data_html += `
                                            <tr>
                                                <th scope="row">${element.id}</th>
                                                <td>${element.nombre}</td>
                                                <td>--</td>
                                                <td>${element.tipo} </td>
                                                <td>${element.fecha}</td>
                                            </tr>
                                        `;
                                    })
                                    resultados.innerHTML = data_html;
                                    
                                }, URL_AJAX)
                            }
                            contador = 0;
                        } else {
                            contador++;
                            // console.log('SE SALIÓ DEL EXÁMEN')
                            
                        }
                    }


    //FETCH MODIFICADOS
    //-----------------------------

    /**
     * 
     * @param {String} meth Que puede ser 'POST' o 'GET'
     * @param {Object} jsonData Datos que se enviarán al servidor para que sena procesados
     * @param {Function} fnRquest Aquí se tratarán los datos devueltos del servidor
     */
    function fetchKev(meth, jsonData, fnRquest, urlProcess){
        let formData = new FormData();

        formData.append("data", JSON.stringify(jsonData));

        fetch(urlProcess,{
            method: meth,
            body: formData
        }).then( data => data.json())
        .then(data => {
            fnRquest(data);
        })
    }


    //FIN ----------------- CÓDIGO SUPERV ---------- EMANE UNAJMA 2020 ----------------------------------------------------------------

</script>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>