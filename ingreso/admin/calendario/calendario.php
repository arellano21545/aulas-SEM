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
$aula_pass=$_POST['aula'];
$year_pass=$_POST['year'];
$mes_pass=$_POST['mes'];
$indice_mes=(int)$mes_pass;
$year_most=(int)$year_pass;
# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");
//El numero de celdas depende de el mes
//	para 31=>929 para 28=>839
#$celdas=929;
//$num_renglones=31;
/*
echo $month."<br>";
echo $year."<br>";
echo $diaActual;
*/ 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

$dias_mes = cal_days_in_month(CAL_GREGORIAN, $indice_mes, $year_most); // 31
//echo "dias del mes: ".$dias_mes."<br>";

 
$meses=array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
/////////////////////////////consulta la db///////////////////////////////
	//consultar la db
	#se debe saber el año y el mes que se desea consultar
	//$year_pass='2020';
	//$mes_pass='1';
	//$last_cell=$diaSemana+$ultimoDiaMes;
	// hacemos un bucle hasta 42, que es el máximo de valores que puede
	// haber... 6 columnas de 7 dias
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
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<title>CALENDARIO</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<style>
		#calendar {
			font-family:Arial;
			font-size:15px;
		}
		#calendar caption {
			text-align:center;
			padding:1px 3px;
			background-color:#003366;
			color:#fff;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:400px;
		}
		#calendar td {
			text-align:center;
			padding:0.4px 0.4px;
			background-color:silver;
		}
		#calendar .hoy {
			background-color:red;
			text-align: center;
			font-size: 11px;
		}
	</style>
</head>
<body>
<!--tabla de 30x31 || 30x28-->
<table id="calendar">
	<caption><?php echo $meses[$indice_mes-1]." ".$year_most ?></caption>
	<tr>
		<th>Hora<br>/Día</th><th>7:00</th><th>7:30</th><th>8:00</th><th>8:30</th>
		<th>9:00</th><th>9:30</th><th>10:00</th><th>10:30</th>
		<th>11:00</th><th>11:30</th><th>12:00</th><th>12:30</th>
		<th>13:00</th><th>13:30</th><th>14:00</th><th>14:30</th>
		<th>15:00</th><th>15:30</th><th>16:00</th><th>16:30</th>
		<th>17:00</th><th>17:30</th><th>18:00</th><th>18:30</th>
		<th>19:00</th><th>19:30</th><th>20:00</th><th>20:30</th><th>21:00</th>
	</tr>
	<tr bgcolor="silver">
	<?php
	for ($renglones=1; $renglones <= $dias_mes; $renglones++) 
	{
		//////////////////////////
		// Consulta la DB para construir el calendario
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT id, nombre, hora_ini, hora_fin FROM $aula_cons WHERE year='$year_pass' and mes='$mes_pass' and dia='$renglones' ORDER BY hora_ini";
		$resultado = mysqli_query($conexion, $consulta);
		$filas = mysqli_num_rows($resultado);
		if($filas > 0) 
		{  
			if($filas<2)
			{	
				$datos = mysqli_fetch_array($resultado);
				$nombre_event = $datos['nombre'];
				$id_event=$datos['id'];
				$hora_ini_event=$datos['hora_ini'];
				$hora_fin_event=$datos['hora_fin'];
				for ($celdas=0; $celdas < 29; $celdas++)
				{	
					if($celdas==0)
						echo "<td>$renglones</td>";
					if(($hora_ini_event<=$celdas+1) && ($hora_fin_event>=$celdas+2))
					echo "<td class='hoy'>$nombre_event</td>";
					else
						echo "<td>&nbsp;</td>";
					
				}		
			}
			else
			{	#mas de un registro
				$celdas_bloc=0;
				while ($datos = mysqli_fetch_array($resultado)) 
				{
					$nombre_event = $datos['nombre'];
					$id_event=$datos['id'];
					$hora_ini_event=$datos['hora_ini'];
					$hora_fin_event=$datos['hora_fin'];
					while ($celdas_bloc<$hora_fin_event-1)
					{
						if($celdas_bloc==0)
							echo "<td>$renglones</td>";
						if($hora_ini_event<=$celdas_bloc+1)
						echo "<td class='hoy'>$nombre_event</td>";
						else
							echo "<td>&nbsp;</td>";	
						$celdas_bloc++;
					}
				}
				while ($celdas_bloc<29) 
				{
					echo "<td>&nbsp;</td>";
					$celdas_bloc++;
				}
			}
			
		}
		else
		{
			for ($celdas=0; $celdas < 30; $celdas++)
				{	
					if($celdas==0)
						echo "<td>$renglones</td>";
					else
						echo "<td>&nbsp;</td>";
					
				}	
		}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		//////////////////////////
		echo "</tr><tr>";
	}
?>
</tr>
</table>
<div class="container" >
    <form id="reg" action="op_calendario.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Regresar</button>
    </fieldset>
    </form>     
</div>
<div class="container" >
    <form id="reg" action="../salir.php" method="post" align="center">
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Salir</button>
    </fieldset>
    </form>     
</div>
</body>
</html>