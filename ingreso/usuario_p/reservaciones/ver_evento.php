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
  <title>Ver evento</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">  
  <form id="contact" action="ver.php" method="post">
    <h2 align="center"><?php echo $_SESSION['nombre_a_mostrar']." "; ?></h2>
    <h5>Ingresa los datos del evento</h5>
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
    <br>
    <h5 align="center">Día:
    <select name="dia">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option> 
        <option value="30">30</option> 
        <option value="31">31</option> 
      </select>
      </h5>
    <br>
    <h5>Hora de entrada:
    <select name="Hora_inicio">
        <option value="1">7:00</option>
        <option value="2">7:30</option>
        <option value="3">8:00</option>
        <option value="4">8:30</option>
        <option value="5">9:00</option>
        <option value="6">9:30</option>
        <option value="7">10:00</option>
        <option value="8">10:30</option>
        <option value="9">11:00</option>
        <option value="10">11:30</option>
        <option value="11">12:00</option>
        <option value="12">12:30</option>
        <option value="13">13:00</option>
        <option value="14">13:30</option>
        <option value="15">14:00</option>
        <option value="16">14:30</option>
        <option value="17">15:00</option>
        <option value="18">15:30</option>
        <option value="19">16:00</option>
        <option value="20">16:30</option>
        <option value="21">17:00</option>
        <option value="22">17:30</option>
        <option value="23">18:00</option>
        <option value="24">18:30</option>
        <option value="25">19:00</option>
        <option value="26">19:30</option>
        <option value="27">20:00</option>
        <option value="28">20:30</option>
        <option value="29">21:00</option> 
      </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Hora de salida:&nbsp;&nbsp;&nbsp;
    <select name="Hora_fin">
        <option value="2">7:30</option>
        <option value="3">8:00</option>
        <option value="4">8:30</option>
        <option value="5">9:00</option>
        <option value="6">9:30</option>
        <option value="7">10:00</option>
        <option value="8">10:30</option>
        <option value="9">11:00</option>
        <option value="10">11:30</option>
        <option value="11">12:00</option>
        <option value="12">12:30</option>
        <option value="13">13:00</option>
        <option value="14">13:30</option>
        <option value="15">14:00</option>
        <option value="16">14:30</option>
        <option value="17">15:00</option>
        <option value="18">15:30</option>
        <option value="19">16:00</option>
        <option value="20">16:30</option>
        <option value="21">17:00</option>
        <option value="22">17:30</option>
        <option value="23">18:00</option>
        <option value="24">18:30</option>
        <option value="25">19:00</option>
        <option value="26">19:30</option>
        <option value="27">20:00</option>
        <option value="28">20:30</option>
        <option value="29">21:00</option> 
      </select>
  </h5>
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