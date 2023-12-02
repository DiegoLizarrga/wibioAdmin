<?php

	include_once("config.php");
	
	class Database {

		private $host = DB_HOST;
		private $databaseName = DB_NAME;
		private $username = DB_USER;
		private $password = DB_PASSWORD;
		private $charset = DB_CHARSET;

		public $conn;

		public function getConnection()
		{

			$this->conn = null;
			try {

				$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->databaseName, $this->username, $this->password);
				$this->conn->exec("set names ".$this->charset);

			} catch (PDOException $exception) {

				echo "Error al conectar a la base de datos: ".$exception->getMessage();
			}

			return $this->conn;

		}
		
	}

?>