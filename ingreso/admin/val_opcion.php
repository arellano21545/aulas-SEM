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
  if($opcion == 'reservar')
  {
    header('location: reservaciones/reservar.php');
  } 
  if($opcion == 'eliminar_rese')
  {
    header('location: reservaciones/eliminar.php');
  }
  if($opcion == 'agrega_user')
  {
    header('location: usuarios/opciones.php');
  }
  if($opcion == 'elimina_user')
  {
    header('location: usuarios/opciones.php');
  }
?>