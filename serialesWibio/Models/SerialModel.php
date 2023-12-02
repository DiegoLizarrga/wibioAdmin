<?php

	require_once("../Configuration/config.php");




	   function makeSerial() {
		$serial = "";
		for ($i = 1; $i<=16; $i++){
		$serial .= assign_rand_value(rand(1,36));
		
		}
		return $serial;
		
		}
		
		
		
		
		
			 function assign_rand_value($num) {
		
					// accepts 1 - 36
					switch($num) {
						case "1"  : $rand_value = "A"; break;
						case "2"  : $rand_value = "B"; break;
						case "3"  : $rand_value = "C"; break;
						case "4"  : $rand_value = "D"; break;
						case "5"  : $rand_value = "E"; break;
						case "6"  : $rand_value = "F"; break;
						case "7"  : $rand_value = "G"; break;
						case "8"  : $rand_value = "H"; break;
						case "9"  : $rand_value = "I"; break;
						case "10" : $rand_value = "J"; break;
						case "11" : $rand_value = "K"; break;
						case "12" : $rand_value = "L"; break;
						case "13" : $rand_value = "M"; break;
						case "14" : $rand_value = "N"; break;
						case "15" : $rand_value = "O"; break;
						case "16" : $rand_value = "P"; break;
						case "17" : $rand_value = "Q"; break;
						case "18" : $rand_value = "R"; break;
						case "19" : $rand_value = "S"; break;
						case "20" : $rand_value = "T"; break;
						case "21" : $rand_value = "U"; break;
						case "22" : $rand_value = "V"; break;
						case "23" : $rand_value = "W"; break;
						case "24" : $rand_value = "X"; break;
						case "25" : $rand_value = "Y"; break;
						case "26" : $rand_value = "Z"; break;
						case "27" : $rand_value = "0"; break;
						case "28" : $rand_value = "1"; break;
						case "29" : $rand_value = "2"; break;
						case "30" : $rand_value = "3"; break;
						case "31" : $rand_value = "4"; break;
						case "32" : $rand_value = "5"; break;
						case "33" : $rand_value = "6"; break;
						case "34" : $rand_value = "7"; break;
						case "35" : $rand_value = "8"; break;
						case "36" : $rand_value = "9"; break;
					}
					return $rand_value;
				}

	class SerialModel {



		
		//Conexión
		private $conn;

		//Tabla de la BD a utilizar
		private $table = TABLA_SERIAL;

		//Columnas de la tabla de la base de datos
		public $idSerial;

		public $serial;
		public $correo;

		//1.- 1 mes 
		//2.- 2 meses
		//3.- 3 meses
		//4.- 6 meses
		//5.- 12 meses

		public $periocidad;
		public $fechaActivacion;

//1.-Creado
//2.-Activo
//3.-Expirado
		public $estatus;

		public $fechaCreacion;
		public $fechaExpiracion;
		


		


		//Establecer conexión con la BD
		public function __construct($db) {

			$this->conn = $db;

		}


		public function expirarSeriales(){
			date_default_timezone_set('America/Mazatlan');
			$today = date('Y-m-d',time());

			$consultaSQL = "UPDATE " . $this->table . " SET estatus = 3 WHERE estatus = 2 AND '$today' > fechaExpiracion";
			$stmt = $this->conn->prepare($consultaSQL);
			$stmt->execute();
		}	

		public function getSeriales() {

			$sql = "SELECT * FROM ".$this->table."";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;

		}

		public function getSerial($serial) {

			$sql = "SELECT * FROM ".$this->table . " WHERE serial = '$serial'";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;

		}

		

		public function setSerial($n) {

			for ($i = 1; $i<=$n; $i++){

			date_default_timezone_set('America/Mazatlan');
			$today = date('Y-m-d',time());
			$emptyDate = date('Y-m-d', 0);
			$serial = makeSerial();
			$correo = "correo@dominio.com";
			$estatus = 1;

			while (true){
				$sql = "SELECT * FROM ".$this->table . " WHERE serial = '$serial'";
			$stmt = $this->conn->prepare($sql);
			 $stmt->execute();
			 $count = $stmt->rowCount();
			 if ($count > 0){
				$serial = makeSerial();
			 } else {
				break;
			 }
			}



			$consultaSQL = "INSERT INTO " . $this->table . " (serial, correo, periocidad, fechaActivacion, estatus,
            fechaCreacion, fechaExpiracion) VALUES (:serial, :correo, :periocidad, :fechaActivacion, :estatus, :fechaCreacion,
            :fechaExpiracion) ";

			$stmt = $this->conn->prepare($consultaSQL);

			
			$stmt->bindParam(":serial", $serial);
				$stmt->bindParam(":correo", $correo);
			$stmt->bindParam(":periocidad", $this->periocidad);
					$stmt->bindParam(":fechaActivacion", $emptyDate);
				$stmt->bindParam(":estatus", $estatus);
			$stmt->bindParam(":fechaCreacion", $today);
			$stmt->bindParam(":fechaExpiracion", $emptyDate);
			
				$stmt->execute();
			}
		}

		


		public function redeemSerial($serial, $correo) {

			date_default_timezone_set('America/Mazatlan');
			$today = date('Y-m-d',time());
			$consultaLogin = "SELECT * FROM ". $this->table . " WHERE serial = '$serial' AND estatus = 1";
            $stmtLogin = $this->conn->prepare($consultaLogin);
			$stmtLogin->execute();

			$dataRow = $stmtLogin->fetch(PDO::FETCH_ASSOC);

			if ($dataRow!=null){

				$p = $dataRow['periocidad'];
				if ($p == 1){
					$ts = strtotime($today . "+ 1 months");
				}
				else if ($p == 2){
					$ts = strtotime($today . "+ 2 months");
				}
				else if ($p == 3){
					$ts = strtotime($today . "+ 3 months");
				}
				else if ($p == 4){
					$ts = strtotime($today . "+ 6 months");
				}
				else if ($p == 5){
					$ts = strtotime($today . "+ 12 months");
				}
				$date = date('Y-m-d',$ts);


				$consultaSQL = "UPDATE " . $this->table . " SET correo = '$correo', estatus = 2, fechaActivacion = '$today', fechaExpiracion 
				= '$date' WHERE serial = '$serial'";

				$stmt = $this->conn->prepare($consultaSQL);
				$stmt->execute();			
            return $p;
			}

			else {
				return 0;
			}
		
		}

		





	}

?>