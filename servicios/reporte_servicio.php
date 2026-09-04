<?php
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$ResServicio = mysqli_fetch_array(mysqli_query($conn, "SELECT s.Id, su.NumSucursal, su.Nombre AS NombreSucursal, u.Nombre AS NombreTecnico, 
                                    s.FechaAsignacion, s.SemanaAtencion, s.FechaAtencion, ce.Estatus, ce.Color, 
                                    s.InicioServicio, s.FinServicio, s.Observaciones
                            FROM servicios AS s
                            LEFT JOIN sucursales AS su ON s.Sucursal = su.Id
                            LEFT JOIN usuarios AS u ON s.TecnicoAsignado = u.Id
                            LEFT JOIN cat_estatus AS ce ON s.Estatus = ce.Id
                            WHERE s.Id = '".$_GET["id"]."'"));

$inisios = explode("|", $ResServicio["InicioServicio"]);
$fechaatencion = fecha(date("Y-m-d", $inisios[0]));

require('fpdf/fpdf.php');

//crear el nuevo archivo pdf
$pdf=new FPDF();

$pdf->SetAutoPageBreak(false);

//Agregamos la primer pagina
$pdf->AddPage();

//posicion inicial y por pagina
$y_axis_initial = 25;

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(056,063,205);
$pdf->SetY(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','',8);
$pdf->SetLineWidth(1.2);
$pdf->MultiCell(190,280,'',1,'C',1);

//logo
$pdf->Image('../images/logo-4gp.jpg', 20, 20, 30);

//titulo
$pdf->SetY(20);
$pdf->SetX(70);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(90,10,utf8_decode('Mantenimiento de equipo de cómputo.'),0,0,'C');

//tecnico
$pdf->SetY(30);
$pdf->SetX(56);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,4,utf8_decode('Técnico: '),0,0,'L');
$pdf->SetX(75);
$pdf->SetFont('Arial','',12);
$pdf->Cell(70,4,utf8_decode($ResServicio["NombreTecnico"]),0,0,'L');

//consultorio
$pdf->SetY(35);
$pdf->SetX(56);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,4,utf8_decode('Consultorio: '),0,0,'L');
$pdf->SetX(85);
$pdf->SetFont('Arial','',12);
$pdf->Cell(70,4,utf8_decode($ResServicio["NumSucursal"] . ' - ' . $ResServicio["NombreSucursal"]),0,0,'L');

//fecha de atención
$pdf->SetY(40);
$pdf->SetX(56);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,4,utf8_decode('Fecha de Atención: '),0,0,'L');
$pdf->SetX(98);
$pdf->SetFont('Arial','',12);
$pdf->Cell(70,4,utf8_decode($fechaatencion),0,0,'L');

//observaciones
$pdf->SetY(45);
$pdf->SetX(56);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,4,utf8_decode('Observaciones: '),0,   0,'L');
$pdf->SetX(90);
$pdf->SetFont('Arial','',12);       
$pdf->Cell(90,4,utf8_decode($ResServicio["Observaciones"]),0,0,'L');

$Y = $pdf->GetY() + 10;

$ResImages = mysqli_query($conn, "SELECT * FROM cat_imagenes WHERE Orden < (SELECT MAX(Orden) FROM cat_imagenes) ORDER BY Orden ASC");

$imgsReporte = array(); $nombreImagenes = array();

while($RResI = mysqli_fetch_array($ResImages))
{
    if(file_exists('../pwa/files/'.$ResServicio["Id"].'_'.$RResI["Id"].'.jpg'))
    {
        $imgsReporte[] = '../pwa/files/'.$ResServicio["Id"].'_'.$RResI["Id"].'.jpg';
        $nombreImagenes[] = $RResI["Nombre"];
    }
}

$numImages = count($imgsReporte);
if (count($imgsReporte) % 2 != 0) {
    $numImages++;
}

$mitad = $numImages / 2;

$alturaPagina = 297;
$margenInferior = 15;

$espacioRestante = $alturaPagina - $pdf->GetY() - $margenInferior;

$filas = $espacioRestante / $mitad;


$i = 1; $j =  0;

foreach($imgsReporte as $img)
{
    if($i == 1)
    {
        $pdf->SetY($Y);
        $pdf->SetX(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(90,4,utf8_decode($nombreImagenes[$j]),0,0,'L');
        $pdf->Image($imgsReporte[$j], 20, $Y+4, 80, $filas - 10);
        $j++;
        $i++;
    }
    elseif($i == 2)
    {
        $pdf->SetY($Y);
        $pdf->SetX(110);
        $pdf->Cell(90,4,utf8_decode($nombreImagenes[$j]),0,0,'L');
        $pdf->Image($imgsReporte[$j], 110, $Y+4, 80, $filas - 10);
        $j++;
        $i=1;
        $Y=$Y + $filas;
    }

}

//Agregamos la segunda pagina
$pdf->AddPage();

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(056,063,205);
$pdf->SetY(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','',8);
$pdf->SetLineWidth(1.2);
$pdf->MultiCell(190,280,'',1,'C',1);

//titulo
$pdf->SetY(20);
$pdf->SetX(70);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(90,10,utf8_decode('Hoja de servicio'),0,0,'C');

$ResHS = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM cat_imagenes ORDER BY Orden DESC LIMIT 1"));

$pdf->Image('../pwa/files/'.$ResServicio["Id"].'_'.$ResHS["Id"].'.jpg', 15, 30, 180, 255);


$pdf->Output(); 

?>