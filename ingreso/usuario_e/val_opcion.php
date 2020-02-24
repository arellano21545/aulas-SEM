<?php 
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['usuario'];
  //comprueba que haya una sesion iniciada
  if ($varsesion == null || $varsesion ==  '') 
  {
    echo "<script>
        alert('USTED NO TIENE AUTORIZACIÓN');
        window.location= '../index.html'
        </script>";
    die();
  }

  $opcion = $_POST['opcion'];
  
  if ($opcion == 'ver') 
  {
    header('location: calendario/op_calendario.php');
  } 
  if($opcion == 'ver_rese')
  {
    header('location: reservaciones/ver_evento.php');
  }
?>