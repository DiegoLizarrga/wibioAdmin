<!doctype html>
<html lang="en">
  <head>
  	<title>Consulta Individual</title>
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

        <form action="" method="POST">
<label>Serial<label>
       <input name="serial" type="text"></input>

       
<button type="submit" name="submit">Aceptar</button>
</form>

<?php
if (isset($_POST['submit'])){
    
    $serial = $_POST['serial'];

    $arr = array(
        'serial'=>$serial,        
    );
    
    $obj=json_encode($arr);
    
    
    $opciones = array(
            'http'=>array(
                'method'=>'POST',
                'header'=>'Content-Type:application/x-www-form-urlencoded',
                'content'=>$obj
            )
        );
    
        $context = stream_context_create($opciones);
    
        $result = json_decode(file_get_contents( BASE_URL . "/API/consultaSerial.php", false, $context));
        $row = $result[0];

if ($row != null){
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
         $p = "4 MESES";
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
    


        echo '<br><br><b>ID de serial: </b>' . $row->idSerial . '<br>';
        echo '<b>Serial: </b>' . $row->serial . '<br>';
        echo '<b>Correo electrónico: </b>' . $row->correo . '<br>';
        echo '<b>Periocidad: </b>' . $p . '<br>';
        echo '<b>Estátus: </b>' . $e . '<br>';
        echo '<b>Fecha de creación: </b>' . $row->fechaCreacion . '<br>';
        echo '<b>Fecha de activación: </b>' . $row->fechaActivacion . '<br>';
        echo '<b>Fecha de expiración: </b>' . $row->fechaExpiracion . '<br>';
                  }
                  else {
                    echo "<script> alert('Serial no existente'); </script>";
                  }

}
?>



      </div>
		</div>

    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/main.js"></script>
  </body>
</html>