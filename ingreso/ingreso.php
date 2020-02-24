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
  //explode() parte una cadena en base a un delimitador
  $cadena = explode(" " , $_SESSION['nombreusuario']);
  $_SESSION['nombre_a_mostrar']=$cadena[0]." ".$cadena[1];

  $opcion = $_SESSION['privilegio'];
  
  if ($opcion == 'admin') 
  {
    header('location: admin/opciones.php');
  }
  if($opcion == 'usuario_p')
  {
    header('location: usuario_p/opciones.php');
  } 
  if($opcion == 'usuario_e')
  {
    header('location: usuario_e/opciones.php');
  }
?>