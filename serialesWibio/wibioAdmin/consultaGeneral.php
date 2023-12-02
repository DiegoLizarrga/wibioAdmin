<!doctype html>
<html lang="en">
  <head>
  	<title>Consulta General</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/style.css">
  </head>


<?php
 	include_once "../Configuration/config.php";
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

        <table class="table table-bordered">
            <th>ID serial</th>
            <th>Serial</th>
            <th>Correo electrónico asociado</th>
            <th>Periocidad</th>
            <th>Fecha de creación</th>
            <th>Fecha de activación</th>
            <th>Fecha de expiración</th>
            <th>Estátus</th>




<?php 
$seriales = json_decode(file_get_contents(BASE_URL . "/API/consultaSeriales.php"));
foreach ($seriales as $row) {
    
    $p = "";
    $e = "";

    if ($row->periocidad == 1){
$p = "1 MES";
    } else  if ($row->periocidad == 2){
        $p = "2 MESES";
     }
    else  if ($row->periocidad == 3){
    $p = "3 MESES";
    }
     else  if ($row->periocidad == 4){
     $p = "6 MESES";
      }
      else  if ($row->periocidad == 5){
        $p = "1 AÑO";
         }

         if ($row->estatus == 1){
            $e = "CREADO";
                } else  if ($row->estatus == 2){
                    $e = "ACTIVO";
                 }
                else  if ($row->estatus == 3){
                $e = "EXPIRADO";
                }


    ?>

<tr>
<td> <?php echo $row->idSerial?> </td>
<td> <?php echo $row->serial?> </td>
<td> <?php echo $row->correo?> </td>
<td> <?php echo $p?> </td>
<td> <?php echo $row->fechaCreacion?> </td>
<td> <?php echo $row->fechaActivacion?> </td>
<td> <?php echo $row->fechaExpiracion?> </td>
<td> <?php echo $e?> </td>


</tr>


<?php
}
?>
     </table>         
      </div>
		</div>

    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/main.js"></script>
  </body>
</html>