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

  $usuario=$_POST['user'];

    /////////consulta la db//////////
      $conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
      $consulta = "SELECT id FROM usuarios WHERE usuario='$usuario'";
      $resultado = mysqli_query($conexion, $consulta);
      $filas = mysqli_num_rows($resultado);
      if($filas > 0)
      {
        //echo "encontrado";
        //ELIMINAR USUARIO
        //$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
        $consulta = "DELETE FROM usuarios WHERE usuario='$usuario'"; 
        $resultado = mysqli_query($conexion, $consulta);
        echo "<script type='text/javascript'>
              alert('Usuario eliminado');
              window.location= 'op_eliminar.php'
              </script>";
        die();
        mysqli_free_result($resultado);
        mysqli_close($conexion);
      }
      else
      {
        echo "<script type='text/javascript'>
              alert('Usuario no encontrado');
              history.back();
              </script>";
        die();
      }
     
?>