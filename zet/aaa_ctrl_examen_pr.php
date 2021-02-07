<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXANEN VIRTUAL</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>         
<body>
    
    <nav class="">
        <h1>EXAMEN VIRTUAL UNAJMA PRUEBA</h1>
        <p class="msj-plagio"></p>
    </nav>

    <div class="examnen">
    
        <form>
            <input type="text" name="nombre_unajma" id="nombre_unajma" class="nombre_unajma" value="OSCCO POCCO ROY">
            <input type="text" name="dni_postulante" id="dni_unajma" class="dni_unajma" value="72073280">
        </form>
    
    </div>

        
    <script>

        //ALERT SWEETT
        function mensaje_al_postulante(){
            Swal.fire({
                title: 'No salga del examen!',
                text: '¿Deseas continuar con tu examen?',
                icon: 'warning',
                confirmButtonText: 'SI, ya no lo volveré a hacer.',
                footer: '<a href>Se registró una salida del postulate en el registro de la base de datos</a>'
            })
        }

        //CÓDIGO SUPERVISION ---------- EXAMEN UNAJMA - 2021 ----------------------------------------------------------------

        let dni;
        let nombre;
        let veces = 0 ; 
        let contador = 0;
        let contador_p = 0; // contador cambio pestaña
        let msj_plagio="";

        const URL_AJAX = "ctrl/ajax_p.php"

        //SI CAMBIA DE PESTAÑA EN LA MISMA PÁGINA ---------------------------------------------------------------------------
        function handleVisibilityChange() {
            if(contador_p >= 1){
                if (document.hidden) {			
                    msj_plagio = document.querySelector(".msj-plagio");
                    dni = document.querySelector(".dni_unajma").value;
                    nombre = document.querySelector(".nombre_unajma").value;
                    //nombre = document.querySelector(".nombre_unajma").innerHTML.trim();
                    tipo=1;
                    fetchKev('post',{proceso:'0015',dni,nombre,tipo},function(x){
                        console.log(x)

                        msj_plagio.innerHTML = "NO SALGA DE SU EXAMEN!! TP1";
                        mensaje_al_postulante();
                    }, URL_AJAX)
                } else  {
                    // startSimulation();
                    //console.log('NO CAMBIO LA PÁGINA')
                }
            }
            contador_p++;

        }
        document.addEventListener("visibilitychange", handleVisibilityChange, false);



        //SI MINIMIZA O CAMBIA EL NAVEGADOR -----------------------------------------------------------------------------------
        setInterval( checkPostulanteNav, 1000);
        function checkPostulanteNav() {
            if ( document.hasFocus() ) {
                // 3 SEGUNDOS FUERA DEL EXAMEN
                if(contador>=2){
                    msj_plagio = document.querySelector(".msj-plagio");
                    dni = document.querySelector(".dni_unajma").value;
                    nombre = document.querySelector(".nombre_unajma").value;
                    //nombre = document.querySelector(".nombre_unajma").innerHTML.trim();
                    tipo = 2;
                    fetchKev('post',{proceso:'0015',dni,nombre,tipo},function(x){
                        console.log(x)

                        msj_plagio.innerHTML = "NO SALGA DE SU EXAMEN!! TP2";
                        mensaje_al_postulante();
                        contador = 0;
                    }, URL_AJAX)
                }
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

    </script>
</body>
</html>