<?php 
	session_start();
	//error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	//comprueba que haya una sesion iniciada
  	if ($varsesion == null || $varsesion ==  '') 
  	{
    	echo "USTED NO TIENE AUTORIZACIÓN";
    	die();
  	}
  	session_destroy();
    echo "<script>
        alert('Regresa pronto ;D');
        window.location= '../../index.html'
        </script>";
    die();
	//header("location:../../index.html");
?>