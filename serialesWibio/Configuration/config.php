<?php

	
	//const BASE_URL = "http://192.168.1.90/serialesWibio";
    const BASE_URL = "http://controlserial.wibio.mx/serialesWibio";


	const API = BASE_URL."/API";
	const MODEL = BASE_URL."/Models";
	const CONTROLLER = BASE_URL."/Controllers";
	const VIEW = BASE_URL."/Views";
	//Zona horaria
	date_default_timezone_set('America/Mazatlan');

	const DB_HOST = "localhost";
	const DB_NAME = "erp_wibio";
	const DB_USER = "triplesroot";
	const DB_PASSWORD = "1n!pas123";
	const DB_CHARSET = "utf8";

	
/*
	const DB_HOST = "localhost";
	const DB_NAME = "serial";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";
*/
	//Nombre de tablas
	const TABLA_SERIAL = "serial";
	
?>