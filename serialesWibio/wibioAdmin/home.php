<!doctype html>
<html lang="en">
  <head>
  	<title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/style.css">
  </head>


<?php
 
?>


  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
        <ul class="list-unstyled components mb-5">
        <li class="active">
            <a href="home.php">Inicio</a>
          </li>
          <li>
              <a href="crearSerial.php">Crear seriales</a>
          </li>
          <li>
            <a href="consultaGeneral.php">Consulta General</a>
          </li>
          <li>
            <a href="consultaIndividual.php">Consulta Individual</a>
          </li>
          <li>
            <a href="index.php">Cerrar sesión</a>
          </li>
        
        </ul>

        <div class="footer">
        	<p>
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados TechFi. <i class="icon-heart" aria-hidden="true"></i> 
					</p>
        </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

          </div>
        </nav>

        <h2 class="mb-4">!Bienvenido/a, Admin. Wibio! </h2>
       
        <?php 
        //Importamos los archivos de base de datos y clase de instancia
        include_once "../Configuration/database.php";
        include_once "../Models/SerialModel.php";
      
      //Instanciamos la clase de base de datos y accedemos al método de conexión
        $objDatabase = new Database();
        $db = $objDatabase->getConnection();
      
        //Instanciamos la clase de Shriners
        $objSerial = new SerialModel($db);
        $objSerial->expirarSeriales();
        ?>
      </div>
		</div>

    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/main.js"></script>
  </body>
</html>