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
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<title>USUARIOS</title>
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
		<th>USUARIO</th><th>CONTRASEÑA</th><th>NOMBRE</th><th>PRIVILEGIO</th><th>CORREO</th>
	</tr>
	
	<?php
		//////////////////////////
		// Consulta la DB para construir el calendario
		$conexion = mysqli_connect($_SESSION['host_db'], $_SESSION['usuario_db'], $_SESSION['password_db'], $_SESSION['nombre_db']);
		$consulta = "SELECT * FROM usuarios";
		$resultado = mysqli_query($conexion, $consulta);
		
		while ($datos = mysqli_fetch_array($resultado)) 
		{?>
		<tr bgcolor="silver">
			<td><?php echo $datos['usuario']; ?></td>
			<td><?php echo $datos['password']; ?></td>
			<td><?php echo $datos['nombre']; ?></td>
			<td><?php echo $datos['privilegio']; ?></td>
			<td><?php echo $datos['correo']; ?></td>
		</tr>
		<?php
		}
		?>
</table>
<div class="container" >
    <form id="reg" action="../opciones.php" method="post" align="center">
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