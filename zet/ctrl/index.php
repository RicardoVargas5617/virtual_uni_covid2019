<?php

    include_once('ExamenVirtual.php');

    $dni_supervisor = $_GET['sp'];

    $obj = new ExamenVirtual();
    
    $res = $obj->traer_estudiantes($dni_supervisor, '0011');

    //var_dump($res['data']);


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>SUPERVISIÓN - UNAJMA</title>

    <style>

        .contenido{
            height:80vh;
        }
    
    </style>
</head>
<body>

    <header class="bg-secondary py-2">
    </header>

    <nav class="container bg-light py-3">
        <div class="row">
            <div class="col-md-2">
                <input type="button" value="Recargar Lista" onclick="Obtener_postulantes_reg1();" class="btn btn-outline-dark"> 
            </div>
            <div class="col-md-10 text-center lead">
                <h3>SUPERVISION UNAJMA EXAMEN VIRTUAL</h3>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>LISTA DE ESTUDIANTES</h3>
                <div class="overflow-auto contenido">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">DNI</th>
                                <th scope="col">ESTUDIANTE</th>
                                <th scope="col"># VECES</th>
                                <th scope="col">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="result_reg1 small">
                            <?php
                                $num_es = 0;
                                foreach ($res['data'] as $element) {
                                    # code...
                                    $num_es++;
                                    echo "
                                        <tr>
                                            <th scope='row'>{$num_es}</th>
                                            <td>{$element[numerodocumento]}</td>
                                            <td>{$element[nombrecompleto]}</td>
                                            <td>
                                                <button type='button' class='btn btn-primary'>
                                                    Cambios <span class='badge badge-danger'>0</span>
                                                    <span class='sr-only'>veces cambios ventana</span>
                                                </button>
                                            </td>
                                            <td><button type='button' class='btn btn-outline-info' onclick='alert(\"click\");'>Detalles</button></td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="col-md-4">
                <h3>DETALLES DE ESTUDIANTES</h3>
                <div class="overflow-auto contenido">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">TIPO</th>
                            </tr>
                        </thead>
                        <tbody class="result_reg2 small">
                            <tr>
                                <th scope='row'>1</th>
                                <td>12/13/20 3:00:00</td>
                                <td>
                                    <span class="badge badge-info">1</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3></h3>
        <div class="">
                
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>





    <script>
        // VARIABLES GLOBALES
        const URL_AJAX = 'ajax_s.php';
        let data_postulante = []
        let dni_postulantes = [];
        let datos_POST = '<?php echo json_encode($res['data']); ?>';
        const datos_origen_post = JSON.parse(datos_POST);


        //console.log(datos_origen_post);
        array_data_postulante();
        //console.log(dni_postulantes);
        //console.log(data_postulante);
        

        //FUNCIONES ------------------------------
            function Obtener_postulantes_reg2(dni_pd){
                // console.log(dni_pd);
                let peticion = 'LPD';
                fetchKev('post',{peticion, dni_pd},function(x){
                    console.log(x);
                    let cont_hmtl=``;
                    let reg2_html = document.querySelector(".result_reg2");
                    let num_list = 0;
                    x.forEach(element => {
                        num_list++;
                        cont_hmtl +=`
                            <tr>
                                <th scope='row'>${num_list}</th>
                                <td>${element.fecha_hora}</td>
                                <td>
                                    <span class="badge badge-info">${element.tipo}</span>
                                </td>
                            </tr>
                        `;
                    });

                    reg2_html.innerHTML = cont_hmtl;
                }, URL_AJAX)
            }


            function Obtener_postulantes_reg1(){
                let peticion = 'LP';
                fetchKev('post',{peticion, dni_postulantes},function(x){
                    console.log(x) 
                    
                    let dni
                    let reg1_html = document.querySelector(".result_reg1");
                    let pl_html = ``;
                    let num_es=0;
                    x.forEach(reg_post => {
                        num_es++;
                        dnix = `${reg_post.dni}-K`;
                        // console.log(data_postulante[dnix]);
                        pl_html +=`
                            <tr>
                                <th scope='row'>${num_es}</th>
                                <td>${data_postulante[dnix].numerodocumento} </td>
                                <td>${data_postulante[dnix].nombrecompleto}</td>
                                <td>
                                    <button type='button' class='btn btn-primary'>
                                        Cambios <span class='badge badge-danger'>${reg_post.veces_c}</span>
                                        <span class='sr-only'>veces cambios ventana</span>
                                    </button>
                                </td>
                                <td><button type='button' class='btn btn-outline-info' onclick='Obtener_postulantes_reg2(\"${data_postulante[dnix].numerodocumento}\");'>Detalles</button></td>
                            </tr>
                        `; 
                        
                    });
                    reg1_html.innerHTML = pl_html;

                }, URL_AJAX)
            }

            //datos estructurados
            function array_data_postulante(){
                let dni;
                datos_origen_post.forEach(element => {
                    dni_postulantes.push(element.numerodocumento); //array DNI postulantes
                    dni = String(element.numerodocumento)+'-K';
                    data_postulante[dni] = { 
                        nombrecompleto: element.nombrecompleto,
                        numerodocumento: element.numerodocumento,
                        proceso: element.proceso 
                    }
                });
                return null;
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