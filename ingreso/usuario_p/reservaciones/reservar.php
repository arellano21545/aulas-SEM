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
  <title>Reserva aula</title>
  <link rel="shortcut icon" href="icon/mate_fav.ico">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="../bootstrap/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/bootstrap-datepicker.min.js"></script>
  <script src="../js/bootstrap-datepicker.es.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
  <script>
    $(document).ready(function() {
    $('#datepicker').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "dd/mm/yyyy",
        daysOfWeekHighlighted: "6",
        datesDisabled: ['31/08/2017'],
        language: 'es'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
    });
  </script>

</head>
<body>
<div class="container">  
  <form id="contact" action="reservacion.php" method="post">
    <h2 align="center">Reservar aula</h2>
    <h5>Ingrese los siguientes datos</h5>
    <br>
    <h5>SALA:
    <select name="sala">
        <option value="A">Sala A</option>
        <option value="B">Sala B</option>
        <option value="C">Sala C</option>
        <option value="D">Sala D (A+B)</option>
    </select></h5>
    <hr>
    <fieldset>
      <input placeholder="Nombre del evento" type="text" name="nombre_evento" required autofocus>
    </fieldset>
    <fieldset>
      <textarea placeholder="Descripción del evento (opcional)" name="descripcion"></textarea>
    </fieldset>
    <hr>
    <h6>Seleccione la fecha para usar el aula:
    <br>
    <br>
    <!--<div id="fechas_seg">
    Desde: 
    <input  type="date" name="fecha_i">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Hasta: 
    <input  type="date" name="fecha_f">
    </div>-->
    <div class="input-group date form-group" id="datepicker">
    <input type="text" class="form-control" id="Dates" name="dias_multi" placeholder="Seleccionar días" required />
    <span class="input-group-addon"></span>
    </div>
    </h6>
    <br>
    <!--
    <script type="text/javascript">
            document.getElementById('fechas_seg').style.display='none';
            void0
    </script>
    <script type="text/javascript">
            document.getElementById('datepicker').style.display='none';
            void0
    </script>
    -->
    <h3>
    <!--<a href="javascript:document.getElementById('fechas_seg').style.display='block';document.getElementById('datepicker').style.display='none';void0">&nbsp;&nbsp;&nbsp;&nbsp;Fechas seguidas</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:document.getElementById('datepicker').style.display='block';document.getElementById('fechas_seg').style.display='none';void0">Fechas</a>-->
    </h3>
    <hr>
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
      <hr>
      <br>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Reservar</button>
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