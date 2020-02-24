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
    $nombre=$_POST['nombre_evento'];

    $mes_con=(int)$mes_pass;
    $year_con=(int)$year_pass;
    $mes_con_str=(string)$mes_con;
    $year_con_str=(string)$year_con;


    echo "mes".$mes_con_str."<br>";
    echo "año".$year_con_str."<br>";
    echo "nombre: ".$nombre."<br>";

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
    //echo "aula_con: ".$aula_cons;


    /////////consulta la db//////////
      $conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
      $consulta = "SELECT id FROM $aula_cons WHERE year='$year_con_str' and mes='$mes_con_str' and nombre='$nombre'";
      $resultado = mysqli_query($conexion, $consulta);
      $filas = mysqli_num_rows($resultado);
      if($filas > 0)
      {
        //echo "encontrado";
        //ELIMINAR USUARIO
        //$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
        $consulta = "DELETE FROM $aula_cons WHERE nombre='$nombre' and year='$year_con_str' and mes='$mes_con_str'"; 
        $resultado = mysqli_query($conexion, $consulta);
        echo "<script type='text/javascript'>
              alert('Evento eliminado');
              window.location= 'eliminar.php'
              </script>";
        die();
        mysqli_free_result($resultado);
        mysqli_close($conexion);
      }
      else
      {
        echo "<script type='text/javascript'>
              alert('Evento no encontrado');
              history.back();
              </script>";
        die();
      }

    
    
?>