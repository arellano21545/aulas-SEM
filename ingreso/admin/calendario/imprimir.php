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

$year=$_SESSION['year_imp'];
$mes=$_SESSION['mes_imp'];
$aula_cons=$_SESSION['aula_cons_imp'];
$year_pass=$_SESSION['year_pass_imp'];
$mes_pass=$_SESSION['mes_pass_imp'];
$dias_mes=$_SESSION['dias_mes'];
$aula_pass=$_SESSION['aula_pass'];
//variables
#$year="2020";
#$mes="Enero";
//////////////////



require('fpdf.php');

//crear PDF
$pdf = new FPDF('L', 'mm', 'Letter');
$pdf-> SetMargins(5,10,4);
//contenido
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$cadena_enc=$mes." de ".$year;
$aula="Aula : ".strtoupper($aula_pass);
$pdf->Cell(0,5,$aula,0,0,'C');
$pdf->Ln();
$pdf->SetFillColor(0, 51, 102); // establece el color del fondo
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,5,$cadena_enc,1,0,'C', True);//con True el fondo si se dibuja
$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(0, 102, 153); // establece el color del fondo
$pdf->Cell(9,5,"H/D",1,0,'C', True);
$pdf->Cell(9,5,"7:00",1,0,'C', True);
$pdf->Cell(9,5,"7:30",1,0,'C', True);
$pdf->Cell(9,5,"8:00",1,0,'C', True);
$pdf->Cell(9,5,"8:30",1,0,'C', True);
$pdf->Cell(9,5,"9:00",1,0,'C', True);
$pdf->Cell(9,5,"9:30",1,0,'C', True);
$pdf->Cell(9,5,"10:00",1,0,'C', True);
$pdf->Cell(9,5,"10:30",1,0,'C', True);
$pdf->Cell(9,5,"11:00",1,0,'C', True);
$pdf->Cell(9,5,"11:30",1,0,'C', True);
$pdf->Cell(9,5,"12:00",1,0,'C', True);
$pdf->Cell(9,5,"12:30",1,0,'C', True);
$pdf->Cell(9,5,"13:00",1,0,'C', True);
$pdf->Cell(9,5,"13:30",1,0,'C', True);
$pdf->Cell(9,5,"14:00",1,0,'C', True);
$pdf->Cell(9,5,"14:30",1,0,'C', True);
$pdf->Cell(9,5,"15:00",1,0,'C', True);
$pdf->Cell(9,5,"15:30",1,0,'C', True);
$pdf->Cell(9,5,"16:00",1,0,'C', True);
$pdf->Cell(9,5,"16:30",1,0,'C', True);
$pdf->Cell(9,5,"17:00",1,0,'C', True);
$pdf->Cell(9,5,"17:30",1,0,'C', True);
$pdf->Cell(9,5,"18:00",1,0,'C', True);
$pdf->Cell(9,5,"18:30",1,0,'C', True);
$pdf->Cell(9,5,"19:00",1,0,'C', True);
$pdf->Cell(9,5,"19:30",1,0,'C', True);
$pdf->Cell(9,5,"20:00",1,0,'C', True);
$pdf->Cell(9,5,"20:30",1,0,'C', True);
$pdf->Cell(9,5,"21:00",1,0,'C', True);
$pdf->Ln();
///////////////////////////////////////////////////

$pdf->SetFillColor(227, 22, 5); // establece el color del fondo
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',6);
#$dias_mes=29;
#$aula_cons="reservaciones_b";
#$year_pass="2020";
#$mes_pass="2";
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
            $cadena_cortada=substr($nombre_event, 0, 6);
            for ($celdas=0; $celdas < 29; $celdas++)
            {   
                if($celdas==0)
                {
                    //echo "<td>$renglones</td>";
                    $ren_con=(string)$renglones;
                    $pdf->Cell(9,5,$ren_con,1,0,'C');
                }
                if(($hora_ini_event<=$celdas+1) && ($hora_fin_event>=$celdas+2))
                {
                    //echo "<td class='hoy'>$cadena_cortada</td>";
                    $pdf->Cell(9,5,$cadena_cortada,1,0,'C', True);

                }
                else
                {
                    //echo "<td>&nbsp;</td>";
                    $pdf->Cell(9,5," ",1,0,'C');
                }
                
            }       
        }
        else
        {   #mas de un registro
            $celdas_bloc=0;
            while ($datos = mysqli_fetch_array($resultado)) 
            {
                $nombre_event = $datos['nombre'];
                $id_event=$datos['id'];
                $hora_ini_event=$datos['hora_ini'];
                $hora_fin_event=$datos['hora_fin'];
                $cadena_cortada=substr($nombre_event, 0, 6);
                while ($celdas_bloc<$hora_fin_event-1)
                {
                    if($celdas_bloc==0)
                    {
                        //echo "<td>$renglones</td>";
                        $ren_con=(string)$renglones;
                        $pdf->Cell(9,5,$ren_con,1,0,'C');
                    }
                    if($hora_ini_event<=$celdas_bloc+1)
                    {
                        //echo "<td class='hoy'>$cadena_cortada</td>";
                        $pdf->Cell(9,5,$cadena_cortada,1,0,'C', True);
                    }
                    else
                    {
                        //echo "<td>&nbsp;</td>";
                        $pdf->Cell(9,5," ",1,0,'C');
                    }
                    $celdas_bloc++;
                }
            }
            while ($celdas_bloc<29) 
            {
                //echo "<td>&nbsp;</td>";
                $pdf->Cell(9,5," ",1,0,'C');
                $celdas_bloc++;
            }
        }
        
    }
    else
    {
        for ($celdas=0; $celdas < 30; $celdas++)
            {   
                if($celdas==0)
                {
                    //echo "<td>$renglones</td>";
                    $ren_con=(string)$renglones;
                    $pdf->Cell(9,5,$ren_con,1,0,'C');
                }
                else
                {
                    //echo "<td>&nbsp;</td>";
                    $pdf->Cell(9,5," ",1,0,'C');
                }
                
            }   
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    //////////////////////////
    $pdf->Ln();
}

///////////////////////////////////////////////////////





$pdf->Output();
//http://www.forosdelweb.com/f18/como-darle-color-relleno-celda-fpdf-1023417/
?>
