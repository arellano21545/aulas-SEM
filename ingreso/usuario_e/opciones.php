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
  <title>Opciones</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">  
  <form id="contact" action="val_opcion.php" method="post">
    <h2 align="center">Bienvenido <?php echo $_SESSION['nombre_a_mostrar']." "; ?></h2>
    <h5>Elige una opción</h5>
    <br>
    <h5 align="center">
    <select name="opcion">
        <option value="ver">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ver calendario</option>
        <option value="ver_rese">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Información de reservación</option>
        <!--<option value="agrega_user">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agregar usuario</option>
        <option value="elimina_user">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar usuario</option>-->
    </select></h5>
    <br>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Enviar</button>
    </fieldset>
  </form>
</div>
<div class="container2" >
    <form id="reg" action="salir.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Salir</button>
    </fieldset>
    </form>     
</div>
</body>
</html>
