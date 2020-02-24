<?PHP
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

$sala=$_POST['sala'];
$nombre=$_POST['nombre_evento'];
$descripcion = $_POST['descripcion'];
$fecha_inicio= $_POST['fecha_i'];
$fecha_fin= $_POST['fecha_f'];
$dias=$_POST['dias_multi'];
$hora_i= $_POST['Hora_inicio'];
$hora_f= $_POST['Hora_fin'];

//echo "el tipo de la hora i es".gettype($hora_i);
/*echo $sala.'<br>';
echo $nombre."<br>";
echo $descripcion."<br>";
echo $fecha_inicio."<br>";
echo $fecha_fin."<br>";
echo $dias."<br>";
echo $hora_i."<br>";
echo $hora_f."<br>";*/
$hora_i_ent=(int)$hora_i;
$hora_f_ent=(int)$hora_f;
//Comprobar horas del evento//
if($hora_i_ent>=$hora_f_ent)
{
	echo "<script type='text/javascript'>
    alert('Revisa la hora del evento');
	history.back();
	</script>";
}
//comprobar fechas del evento//
$f_ini=1;
$f_fin=1;
$f_dias=1;
if($fecha_inicio==null)
$f_ini=0;
if($fecha_fin==null)
$f_fin=0;
if($dias==null)
$f_dias=0;
if (($f_ini==0 && $f_fin==0)&&($f_dias==0)) 
{
	echo "<script type='text/javascript'>
    alert('Por favor selecciona una fecha');
	history.back();
	</script>";
}
if (($f_ini==1 && $f_fin==1)&&($f_dias==1)) 
{
	echo "<script type='text/javascript'>
    alert('Revisa las fechas del evento, no puedes tener fechas seguidas y No seguidas al mismo tiempo');
	history.back();
	</script>";
}
if (($f_ini==1 && $f_fin==0)||($f_ini==0 && $f_fin==1)) 
{
	echo "<script type='text/javascript'>
    alert('Revisa las fechas seguidas del evento');
	history.back();
	</script>";
}

if($f_dias==1)
{
	//fechas no seguidas
	$dias_lista = explode("," , $dias);
	//echo "los dias en lista son <br>";
	//print_r($dias_lista);
	//echo "<br>la longitud del array es: ".sizeof($dias_lista);
	//$reg_fecha=explode("/", $dias_lista[0]);
	/*echo "<br>la fecha partida es <br>";
	print_r($reg_fecha);
	echo "<br>";
	$mes_cam=(int)$reg_fecha[1];
	echo $mes_cam;
	echo "<br>";
	echo gettype($mes_cam);
	echo "<br>";
	$mes_cam_str=(string)$mes_cam;
	echo "mes en str: ".$mes_cam_str;
	echo "<br>la longitud del array es: ".sizeof($reg_fecha);*/
	//////////////////////////sala A//////////////////////
	if($sala=='A')
	{	
		$permitido=1;
		//////comprobar nombre///////////////
		/////////consulta la db//////////
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT id FROM reservaciones_a WHERE nombre='$nombre'";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);
		if($filas > 0) 
		{
			$cadena_mostrar="Ya hay una reservación con este nombre en la sala A";
			echo "<script type='text/javascript'>
			  	  alert('$cadena_mostrar');
			  	  history.back();
			  	  </script>";
			  	  die();
			$permitido=0;
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		//////////////////////////
		//////////////////////////////////////////
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_a WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala A";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							$permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala A";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_d WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
	}

	///////////sala B/////////////////////
	if($sala=='B')
	{	
		$permitido=1;
		//////comprobar nombre///////////////
		/////////consulta la db//////////
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT id FROM reservaciones_b WHERE nombre='$nombre'";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);
		if($filas > 0) 
		{
			$cadena_mostrar="Ya hay una reservación con este nombre en la sala B";
			echo "<script type='text/javascript'>
			  	  alert('$cadena_mostrar');
			  	  history.back();
			  	  </script>";
			  	  die();
			$permitido=0;
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		//////////////////////////
		//////////////////////////////////////////
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_b WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala B";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala B";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_d WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
	}

	///////////Sala C//////////////////////
	if($sala=='C')
	{	
		$permitido=1;
		//////comprobar nombre///////////////
		/////////consulta la db//////////
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT id FROM reservaciones_c WHERE nombre='$nombre'";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);
		if($filas > 0) 
		{
			$cadena_mostrar="Ya hay una reservación con este nombre en la sala C";
			echo "<script type='text/javascript'>
			  	  alert('$cadena_mostrar');
			  	  history.back();
			  	  </script>";
			  	  die();
			$permitido=0;
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		//////////////////////////
		//////////////////////////////////////////
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_c WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala C";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala C";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
	}

	////////////////////////sala D////////////////////////////
	if($sala=='D')
	{	
		$permitido=1;
		//////comprobar nombre///////////////
		/////////consulta la db//////////
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT id FROM reservaciones_d WHERE nombre='$nombre'";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);
		if($filas > 0) 
		{
			$cadena_mostrar="Ya hay una reservación con este nombre en la sala D";
			echo "<script type='text/javascript'>
			  	  alert('$cadena_mostrar');
			  	  history.back();
			  	  </script>";
			  	  die();
			$permitido=0;
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		//////////////////////////
		//////////////////////////////////////////
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_a WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala A";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala A";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_b WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala B";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala B";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
		for ($i=0; $i < sizeof($dias_lista); $i++) 
		{ 
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
			/////////consulta la db//////////
			$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
			$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM reservaciones_d WHERE year='$year_con' and mes='$mes_cam_str' and dia='$dia_con'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			if($filas > 0) 
			{  
				//echo "SI hay reservaciones.<br>";
				if($filas < 2)
				{
					//hay una reservacion en ese dia
					$datos = mysqli_fetch_array($resultado);
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					//echo "hora_ini ".$hora_ini_event."<br>";
					//echo "hora_fin ".$hora_fin_event."<br>";
					$hora_ini_event_ent=(int)$hora_ini_event;
					$hora_fin_event_ent=(int)$hora_fin_event;
					//evento antes de la reservacion
					if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
					{
						//echo "evento antes de la reservacion PERMITIDO";
						$permitido=1;
					}
					else
					{
						//evento despues de la reservacion
						if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
						{
							//echo "evento despues de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
							echo "<script type='text/javascript'>
							  	  alert('$cadena_mostrar');
							  	  history.back();
							  	  </script>";
							  	  die();
							  	  $permitido=0;
							//echo "se empalma";
						}
					}
				}
				else
				{
					//encontro más de un día
					while ($datos = mysqli_fetch_array($resultado)) 
					{
						$nombre_event = $datos['nombre'];
						$id_event=$datos['id'];
						$hora_ini_event=$datos['hora_ini'];
						$hora_fin_event=$datos['hora_fin'];
						$hora_ini_event_ent=(int)$hora_ini_event;
						$hora_fin_event_ent=(int)$hora_fin_event;
						//evento antes de la reservacion
						if(($hora_i_ent<$hora_ini_event_ent)&&($hora_f_ent<=$hora_ini_event_ent))
						{
							//echo "evento antes de la reservacion PERMITIDO";
							$permitido=1;
						}
						else
						{
							//evento despues de la reservacion
							if(($hora_i_ent>=$hora_fin_event_ent)&&($hora_f_ent>$hora_fin_event_ent))
							{
								//echo "evento despues de la reservacion PERMITIDO";
								$permitido=1;
							}
							else
							{
								$cadena_mostrar="Ya hay una reservación en este horario para el día ".$dias_lista[$i]."en la sala D";
								echo "<script type='text/javascript'>
								  alert('$cadena_mostrar');
								  history.back();
								  </script>";
								  die();
								  $permitido=0;
								//echo "se empalma";
							}
						}
					}
				}

			}
			mysqli_free_result($resultado);
			mysqli_close($conexion);
			//////////////////////////
		}
	}
	if($permitido==1)
	{
		$_SESSION['sala']=$sala;
		$_SESSION['nombre_evento']=$nombre;
		$_SESSION['descripcion']=$descripcion;
		$_SESSION['dias_lista']=$dias_lista;
		$_SESSION['hora_inicio']=$hora_i_ent;
		$_SESSION['hora_fin']=$hora_f_ent;
		header('location: subir.php');
		/*echo "<script>
        alert('subiendo registros');
        window.location= 'subir.php'
        </script>";*/
	}
	
}

?>