<?php

    /*===========================================
	|  Datos del servidor - Data of the server  |
	===========================================*/
	const SERVER="localhost";
	const DB="admision_test"; // unajmadm_prueba
	const USER="admision_test"; //unajmadm_prueba
	const PASS="admision_test"; //npHl;Y540,ni


	// Solo modificar la siguiente línea en caso el gestor de base de datos no sea MySQL
	//Only modify the following line in case the database manager is not MySQL
	const SGBD="mysql:host=".SERVER.";dbname=".DB;

    class mainModel{
            
        /* Funcion para conectar a la BD - Function to connect to DB */
        public function ConnectDB(){
            $link= new PDO(SGBD,USER,PASS);//array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            $link->exec("set names utf8");
            return $link;
        }

        /* Funcion para ejecutar una consulta simple - Function to execute a simple query */
        public function ejecutar_una_consulta($query){
            $response=self::ConnectDB()->prepare($query);
            $response->execute();
            return $response;
        }

        /**
         * 
         */
        public function insert_tbl($dni, $nombre, $tipo){
            $query1 = "INSERT INTO supervision (id, dni, nombre, tipo, anio, fecha) VALUES (NULL, '$dni','$nombre', '$tipo', '2020', CURRENT_TIMESTAMP)";
			$resInsrt1 = mainModel::ejecutar_una_consulta($query1);
            return 0;
        }

        /**
         * 
         */
        public function obtener_tbl(){
            $query = "SELECT * FROM supervision";
            $result = mainModel::ejecutar_una_consulta($query);
            
            $eval = false;
            $data = [];

            if($result->rowCount() >= 1){
                $eval=true;
                while($user_fla = $result->fetch(PDO::FETCH_ASSOC)){
                    // var_dump($user_fla);
                    $data[] = $user_fla;
                }             
            }
            return ['eval'=>$eval, 'data'=>$data];
            
        }
        
        public function test_response(){
            return "response it's OK!!";
        }

    }





    $obj = new mainModel();

    $data = json_decode($_POST['data']);
    $insrt = $obj->insert_tbl($data->dni,$data->nombre,$data->tipo);

    // $datos = $obj->obtener_tbl();

    // var_dump($datos['data'])

    echo json_encode("GUARDANDO REGISTRO...\nFALTA POSTULANTE DNI:" . $data->nombre . $data->dni);

?>