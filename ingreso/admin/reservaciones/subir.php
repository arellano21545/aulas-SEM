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
$aula=$_SESSION['sala'];
$dias_lista=$_SESSION['dias_lista'];
$nombre_us=$_SESSION['nombreusuario'];

$nombre=$_SESSION['nombre_evento'];
$descripcion=$_SESSION['descripcion'];
$hora_i=$_SESSION['hora_inicio'];
$hora_f=$_SESSION['hora_fin'];

switch ($aula) 
{
	case 'A':
		$aula_cons="reservaciones_a";
		break;
	case 'B':
		$aula_cons="reservaciones_b";
		break;	
	case 'C':
		$aula_cons="reservaciones_c";
		break;
	case 'D':
		$aula_cons="reservaciones_d";
		break;	
	default:
		$aula_cons="reservaciones_null";
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
for ($i=0; $i < sizeof($dias_lista); $i++) 
	{ 
		$id_c=generate_string($permitted_chars, 12);
		$parte_fecha=explode("/", $dias_lista[$i]);
		$mes_cam=(int)$parte_fecha[1];
		$mes_cam_str=(string)$mes_cam;
		$dia_cam=(int)$parte_fecha[0];
		$dia_con=(string)$dia_cam;
		$year_cam=(int)$parte_fecha[2];
		$year_con=(string)$year_cam;
		/*print_r($parte_fecha);
		echo $dia_con."<br>";
		echo $year_con."<br>";
		echo $mes_cam_str;*/
		//revisar si hay un evento en ese dia//
		//consulta db
	  	$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
	  	$consulta = "INSERT INTO $aula_cons (id, usuario, nombre, descripcion, year, mes, dia, hora_ini, hora_fin) VALUES ('$id_c','$nombre_us','$nombre','$descripcion','$year_con','$mes_cam_str','$dia_con','$hora_i','$hora_f')"; //inserta registros en la db
	  	$resultado = mysqli_query($conexion, $consulta);
	  	if ($resultado > 0) 
	  	{
	  		$exito=1;
	    	//echo "exito al subir";
	    	/*echo "<script type='text/javascript'>
				  alert('Reservación exitosa');
				  window.location= 'reservar.php'
				  </script>";*/
	  	}
	  	else
	  	{
	  		$exito=0;
	    	//echo "LO SENTIMOS, HUBO UN PROBLEMA CON TU REGISTRO :(";
	    	/*echo "<script type='text/javascript'>
				  alert('LO SENTIMOS, HUBO UN PROBLEMA CON TU REGISTRO :(');
				  window.location= 'reservar.php'
				  </script>";*/
	  	}
	  	mysqli_free_result($resultado);
	  	mysqli_close($conexion);
	}

	if($exito==1)
	{
		echo "<script type='text/javascript'>
				  alert('Reservación exitosa');
				  window.location= 'reservar.php'
				  </script>";
	}
	else
	{
		echo "<script type='text/javascript'>
				  alert('LO SENTIMOS, HUBO UN PROBLEMA CON TU REGISTRO :(');
				  window.location= 'reservar.php'
				  </script>";
	}
?>