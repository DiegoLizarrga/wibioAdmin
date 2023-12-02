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

//Obtenemos la data del consumo de la API
	$data = json_decode(file_get_contents("php://input"));

	//Asignamos la data recuperada del consumo de la API a los atributos del objeto
    $serial = $data->serial;
    $correo = $data->correo;

   
	if ($p = $objSerial->redeemSerial($serial,$correo)) {

		echo json_encode(
			array("periocidad"=> $p)
		);
		//echo "Código de estado de la respuesta del servidor a la petición: ".http_response_code(200).".";
	} else {

		echo json_encode(
			array("periocidad"=> 0)
		);
	}

?>