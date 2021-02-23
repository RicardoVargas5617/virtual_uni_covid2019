<?php

    /*===========================================
	|  Datos del servidor - Data of the server  |
	===========================================*/
	const SERVER="localhost";
	const DB="admision_zet"; // admision_zet - unajmadm_prueba
	const USER="admision_zet"; // admision_zet - unajmadm_prueba
	const PASS="carlsen2020"; // carlsen2020 - npHl;Y540,ni


	// Solo modificar la siguiente línea en caso el gestor de base de datos no sea MySQL
	//Only modify the following line in case the database manager is not MySQL
	const SGBD="mysql:host=".SERVER.";dbname=".DB;

    class ExamenVirtual{
        
        private $proceso = '0019'; //0012
        private $bool_StdP = true; //Estado del proeso. Determina si se utiliza el valor del proceso de la clase

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
         * Insertando datos de postulante que cambio página
         */
        public function insertar_cambio($dni, $nombre, $tipo, $proceso){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }

            $query1 = "INSERT INTO control_ventana (id, dni, nombre, fecha_hora, proceso, tipo, anio) VALUES (NULL, '$dni','$nombre',CURRENT_TIMESTAMP, '$proceso', '$tipo', '2021')";
			$resInsrt1 = ExamenVirtual::ejecutar_una_consulta($query1);
            return 0;
        }

        /**
         * Funcion que trae a los estudiantes de un supervisor
         */
        public function traer_estudiantes($dni_supervisor, $proceso){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }
        
            $query = "SELECT p.numerodocumento, p.nombrecompleto, p.proceso 
                        FROM adm_proceso_ambiente as a 
                        INNER JOIN adm_proceso_distribucion as b 
                        ON a.ambiente = b.ambiente AND a.proceso = b.proceso 
                        INNER JOIN adm_proceso_postulante as p 
                        ON b.postulante = p.postulante AND b.proceso = p.proceso 
                        WHERE a.proceso = '$proceso' AND a.supervisor = '$dni_supervisor'";
            $result = ExamenVirtual::ejecutar_una_consulta($query);
            $eval = false;
            $data = [];
            if($result->rowCount() >= 1){
                $eval = true;
                while($registro = $result->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $registro;
                }
            }

            return ['eval'=>$eval,'data'=>$data];
        }

        /**
         * Trae Dnis y las veces que el postulante cambio de ventana
         */
        public function traer_dni_veces($dnis, $proceso){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }
            
            $dnis_q = "";
            foreach ($dnis as $dni) {
                $dnis_q .= "'{$dni}',";
            }
            $dnis_q .= "'fin'";
            //$dnis_q = " '73621295','77060703', '77021912', 'fin'";

            $query = "SELECT dni, COUNT(*) as veces_c 
                        FROM control_ventana 
                        WHERE dni IN ($dnis_q) 
                        AND proceso = '$proceso' GROUP BY dni ORDER BY veces_c DESC";
            $result = ExamenVirtual::ejecutar_una_consulta($query);
            $eval = false;
            $data = [];
            if($result->rowCount() >= 1){
                $eval = true;
                while($registro = $result->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $registro;
                }
            }
            return ['eval'=>$eval,'data'=>$data];
        }

        /**
         * 
         */
        public function traer_postulante_detalles($dni, $proceso){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }
            
            $query = "SELECT * FROM control_ventana WHERE dni LIKE '%$dni%' AND proceso = '$proceso' ORDER BY fecha_hora desc LIMIT 50";
            // $query = "SELECT * FROM supervision WHERE dni IN ($dnis) ORDER BY fecha desc";
            $result = ExamenVirtual::ejecutar_una_consulta($query);
            
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

        public function Devuelve_procesoActual(){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }
            return $proceso;
        }


        public function traer_programas_postulante($dni, $proceso){
            if($this->bool_StdP){
                $proceso = $this->proceso;
            }else{
                $proceso = empty($proceso)? $this->proceso : $proceso;
            }
            
            $query = "SELECT * FROM control_programas WHERE dni LIKE '%$dni%' ORDER BY fecha_registro desc LIMIT 1";
            
            $result = ExamenVirtual::ejecutar_una_consulta($query);
            
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

        /**
         * 
         */
        public function test_response(){
            return "response it's OK!!";
        }

    }


?>