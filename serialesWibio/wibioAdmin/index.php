<!DOCTYPE html>
<html>
<head>
<title>Inicio sesion</title>
<meta charset="utf-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Administración Wibio</h3>

            
            <div class="form-outline mb-4">
           <img src="http://controlserial.wibio.mx/serialesWibio/Images/wibio_landing.png" 
           width="300" height="100">
            </div>

            <form method="post" action="">
            <div class="form-outline mb-4">
              <input type="text" name="usuario" id="typeEmailX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Usuario</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="contrasena" id="typePasswordX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Contraseña</label>
            </div>

         
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="enviar">Iniciar sesion</button>
</form>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

<?php
if (isset($_POST['enviar'])){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];


    if ( ($usuario == "admin" && $contrasena == "admin123/") 
    || ($usuario == "jorger" && $contrasena == "jorger123/")){
       header("Location: home.php");
    }
    else {
        echo "<script> alert('Usuario o contraseña incorrectos'); </script>";
    }
      

}

?>