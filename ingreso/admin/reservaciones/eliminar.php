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
  <title>Eliminar</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">  
  <form id="contact" action="elimina.php" method="post">
    <h2 align="center"><?php echo $_SESSION['nombre_a_mostrar']." "; ?></h2>
    <h5>Ingresa los datos del evento a eliminar</h5>
    <br>
    <h5 align="center">AULA
    <select name="aula">
        <option value="a">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</option>
        <option value="b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</option>
        <option value="c">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C</option>
        <option value="d">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D (A+B)</option>
    </select></h5>
    <br>
    <h5 align="center">AÑO
    <select name="year">
        <option value="2020">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2020</option>
        <option value="2021">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2021</option>
        <option value="2022">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2022</option>
        <option value="2023">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2023</option>
        <option value="2024">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2024</option>
    </select></h5>
    <br>
    <h5 align="center">MES
    <select name="mes">
        <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enero</option>
        <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Febrero</option>
        <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Marzo</option>
        <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abril</option>
        <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mayo</option>
        <option value="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Junio</option>
        <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Julio</option>
        <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agosto</option>
        <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Septiembre</option>
        <option value="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Octubre</option>
        <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Noviembre</option>
        <option value="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diciembre</option>
    </select></h5>
    <fieldset>
      <input placeholder="Nombre del evento" type="text" name="nombre_evento" required autofocus>
    </fieldset>
    <br>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Enviar</button>
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