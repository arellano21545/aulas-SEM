<?php 
	//id, user, password, nombre, privilegio
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$host_db="localhost";
	$usuario_db="root";
	$password_db="";
	$nombre_db="aulas";
	//conexion a la base de datos
	$conexion = mysqli_connect($host_db, $usuario_db, $password_db, $nombre_db);
	$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' and password='$password' ";
	$resultado = mysqli_query($conexion, $consulta);
	//validacion de usuarios
	$filas = mysqli_num_rows($resultado);

	if ($filas > 0) 
	{
		//sesion
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['password'] = $password;
		$_SESSION['host_db']=$host_db;
		$_SESSION['usuario_db']=$usuario_db;
		$_SESSION['password_db']=$password_db;
		$_SESSION['nombre_db']=$nombre_db;
		//consulta db
 		$conexion = mysqli_connect($host_db, $usuario_db, $password_db, $nombre_db);
  		$consulta = "SELECT id, nombre, privilegio FROM usuarios WHERE usuario='$usuario' and password='$password'"; 
  		$resultado = mysqli_query($conexion, $consulta);
  		$filas = mysqli_num_rows($resultado);
  		if($filas > 0) 
  		{
      		$datos = mysqli_fetch_array($resultado);
      		$id = $datos['id'];
      		$name = $datos['nombre'];
      		$privilegio=$datos['privilegio'];
      		$_SESSION['id']= $id;
      		$_SESSION['nombreusuario'] = $name;
      		$_SESSION['privilegio']=$privilegio;
  		} 
  		mysqli_free_result($resultado);
  		mysqli_close($conexion);
		header("location: ingreso/ingreso.php");//manda al ingreso de ususarios 1
	}
	else
  		{
    		header("location: errorconexion.html");
  		}
	mysqli_free_result($resultado);
	mysqli_close($conexion);
	//no protegido por sesion
?>