<?php

//Importamos las cabeceras necesarias 
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Request-With");

//Importamos los archivos de base de datos y clase de instancia
	include_once "../Configuration/database.php";
	include_once "../Models/SerialModel.php";

//Instanciamos la clase de base de datos y accedemos al método de conexión
	$objDatabase = new Database();
	$db = $objDatabase->getConnection();

	//Instanciamos la clase de Shriners
	$objSerial = new SerialModel($db);

    $data = json_decode(file_get_contents("php://input"));

	//Asignamos la data recuperada del consumo de la API a los atributos del objeto
    $serial = $data->serial;

//Obtenemos la data del consumo de la API
$stmt = $objSerial->getSerial($serial);
	$rowCount = $stmt->rowCount();
	

			//Si el número de filas es mayor a 0. Se inicializa un array, se importa la fila actual a la tabla de símbolos, se asocia la data importada con nombres de atributo dentro de un array y se agrega al array principal. Finalmente se convierte a JSON y se arroja un código de estado 200.
	if ($rowCount == 1) {

		$arrSeriales = array();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

			extract($row);

			$e = array(
					"idSerial" => $idSerial,
					"serial" => $serial,
					"correo" => $correo,
					"periocidad" => $periocidad,
					"estatus" => $estatus,
					"fechaCreacion" => $fechaCreacion,
					"fechaExpiracion" => $fechaExpiracion,
					"fechaActivacion" => $fechaActivacion
					
			); 

			array_push($arrSeriales, $e);
			
		

		echo json_encode($arrSeriales);
		http_response_code(200);

		//De lo contrario, se arrojará un mensaje de error y un código de estado 404.		
		
	} else {

		echo json_encode(
			array("message"=>"No se encontró el código.")
		);
		http_response_code(404);
		
	}
?>