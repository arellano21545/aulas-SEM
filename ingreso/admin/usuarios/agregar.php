<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
//comprueba que haya una sesion iniciada
if ($varsesion == null || $varsesion == '') 
{
echo "<script>
    alert('USTED NO TIENE AUTORIZACIÓN');
    window.location= '../../../index.html'
    </script>";
die();
}
$privilegio_num=$_POST['privilegio'];
$nombre=$_POST['nombre_user'];
$usuario=$_POST['user'];
$pass=$_POST['password'];
$correo=$_POST['correo'];

switch ($privilegio_num) 
{
	case '1':
		$privilegio="usuario_e";
		break;
	case '2':
		$privilegio="usuario_p";
		break;
	case '0':
		$privilegio="admin";
		break;
	default:
		$privilegio="sin_privilegio";
		break;
}



$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#$%&';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
$id_c=generate_string($permitted_chars, 12);

	  /////////consulta la db//////////
      $conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
      $consulta = "SELECT id FROM usuarios WHERE usuario='$usuario'";
      $resultado = mysqli_query($conexion, $consulta);
      $filas = mysqli_num_rows($resultado);
      if($filas > 0)
      {
      	echo "<script type='text/javascript'>
              alert('Lo siento ese nombre de usuario no está disponible...!');
              history.back();
              </script>";
        die();  
      }
      else
      {
      	//consulta db
	  	$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
	  	$consulta = "INSERT INTO usuarios (id, usuario, password, nombre, privilegio, correo) VALUES ('$id_c','$usuario','$pass','$nombre','$privilegio','$correo')"; //inserta registros en la db
	  	$resultado = mysqli_query($conexion, $consulta);
	  	if ($resultado > 0) 
	  	{
	  		echo "<script type='text/javascript'>
					  alert('Usuario agregado');
					  window.location= 'op_agregar.php'
					  </script>";
	  	}
	  	else
	  	{
	  		echo "<script type='text/javascript'>
					  alert('LO SENTIMOS, HUBO UN PROBLEMA CON TU REGISTRO :(');
					  window.location= 'op_agregar.php'
					  </script>";
	  	}
      }
  	mysqli_free_result($resultado);
  	mysqli_close($conexion);
	////////
?>