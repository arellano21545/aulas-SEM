<?php
session_start();
error_reporting(0);
  $varsesion = $_SESSION['usuario'];
  //comprueba que haya una sesion iniciada
  if ($varsesion == null || $varsesion == '') 
  {
    echo "<script>
        alert('USTED NO TIENE AUTORIZACIÓN');
        window.location= '../../index.html'
        </script>";
    die();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Elimina usuario</title>
  <link rel="shortcut icon" href="icon/mate_fav.ico">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">  
  <form id="contact" action="eliminar.php" method="post">
    <h2 align="center">Eliminar usuario:</h2>
    <h5>Ingrese los siguientes datos</h5>
    <br>
    <fieldset>
      <input placeholder="Usuario" type="text" name="user" required autofocus>
    </fieldset>
    <hr>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Eliminar</button>
    </fieldset>
  </form>
</div>
<div class="container2" >
    <form id="reg" action="../opciones.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Regresar</button>
    </fieldset>
    </form>     
</div>
<div class="container3" >
    <form id="reg" action="../salir.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Salir</button>
    </fieldset>
    </form>     
</div>
</body>
</html>