<?php
  session_start();
  //error_reporting(0);
  $varsesion = $_SESSION['usuario'];
  //comprueba que haya una sesion iniciada
  if ($varsesion == null || $varsesion =  '') 
  {
    echo "USTED NO TIENE AUTORIZACIÓN";
    die();
  }

    $aula_pass=$_POST['aula'];
    $year_pass=$_POST['year'];
    $mes_pass=$_POST['mes'];
    $dia_pass=$_POST['dia'];
    $hora_entrada=$_POST['Hora_inicio'];
    $hora_salida=$_POST['Hora_fin'];

    $mes_con=(int)$mes_pass;
    $year_con=(int)$year_pass;
    $dia_con=(int)$dia_pass;
    $hora_i_con=(int)$hora_entrada;
    $hora_f_con=(int)$hora_salida;
    $mes_con_str=(string)$mes_con;
    $year_con_str=(string)$year_con;
    $dia_con_str=(string)$dia_con;
    $hora_entrada_str=(string)$hora_i_con;
    $hora_salida_str=(string)$hora_f_con;

    switch ($aula_pass) 
    {
      case 'a':
        $aula_cons="reservaciones_a";
        break;
      case 'b':
        $aula_cons="reservaciones_b";
        break;  
      case 'c':
        $aula_cons="reservaciones_c";
        break;
      case 'd':
        $aula_cons="reservaciones_d";
        break;  
      default:
        $aula_cons="reservaciones_null";
        break;
    }
    /*echo "aula_con: ".$aula_cons;

    echo "<br>mes ".$mes_con_str."<br>";
    echo "año ".$year_con_str."<br>";
    echo "dia: ".$dia_con_str."<br>";
    echo "hora inicio: ".$hora_entrada_str."<br>";
    echo "hora final: ".$hora_salida_str."<br>";*/


    /////////consulta la db//////////
      $conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
      $consulta = "SELECT usuario, nombre, descripcion FROM $aula_cons WHERE year='$year_con_str' and mes='$mes_con_str' and dia='$dia_con_str' and hora_ini='$hora_entrada_str' and hora_fin='$hora_salida_str'";
      $resultado = mysqli_query($conexion, $consulta);
      $filas = mysqli_num_rows($resultado);
      if($filas > 0)
      {
        $datos = mysqli_fetch_array($resultado);
        $nombre_event = $datos['nombre'];
        $nombre_usuario=$datos['usuario'];
        $descripcion=$datos['descripcion'];

        /*echo $nombre_event."<br>";
        echo $nombre_usuario."<br>";
        echo $descripcion."<br>";*/
        //ELIMINAR USUARIO
        //$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
      }
      else
      {
        //echo "NO encontrado";
        echo "<script type='text/javascript'>
              alert('Evento no encontrado');
              history.back();
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
  <form id="contact" action="ver_evento.php" method="post">
    <h2 align="center"><?php echo "Información del evento"; ?></h2>
    <br>
    <h2 align="left">Nombre del evento:</h2>
    <h3 align="left"><?php
    $tlargo = $nombre_event;
    $largomax = 50;
    $rompelinea = '<br>';
    $rompepalabras = TRUE;
    echo wordwrap($tlargo,$largomax,$rompelinea,$rompepalabras);
    ?></h3>
    <br>
    <h2 align="left">Descripción del evento:</h2>
    <h3 align="left"><?php 
    $tlargo = $descripcion;
    $largomax = 50;
    $rompelinea = '<br>';
    $rompepalabras = TRUE;
    echo wordwrap($tlargo,$largomax,$rompelinea,$rompepalabras);
    ?></h3>
    <br>
    <h2 align="left">Creador del evento:</h2>
    <h3 align="left"><?php echo $nombre_usuario; ?></h3>
    <br>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Regresar</button>
    </fieldset>
  </form>
</div>
<div class="container2" >
    <form id="reg" action="../salir.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">salir</button>
    </fieldset>
    </form>     
</div>
</body>
</html>