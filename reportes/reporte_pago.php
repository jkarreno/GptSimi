<?php
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

require('../servicios/fpdf/fpdf.php');

$fecha = $_GET["fecha"];
$estado = $_GET["estado"];
$coordinador = $_GET["coordinador"];

$dias = [
    'Sunday'    => 'domingo',
    'Monday'    => 'lunes',
    'Tuesday'   => 'martes',
    'Wednesday' => 'miércoles',
    'Thursday'  => 'jueves',
    'Friday'    => 'viernes',
    'Saturday'  => 'sábado'
];

$dia = $dias[date('l', strtotime($fecha))];

$ResCorteDía = mysqli_query($conn, "SELECT s.Id, s.EstatusPago, s.Pago, s.FinServicio, su.NumSucursal, su.Nombre AS NombreSucursal
                                    FROM servicios AS s
                                    INNER JOIN sucursales AS su ON s.Sucursal = su.Id
                                    INNER JOIN usuarios AS u ON s.TecnicoAsignado = u.Id
                                    INNER JOIN usuarios AS c ON u.Supervisor = c.Id
                                    WHERE s.FinServicio IS NOT NULL
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) >= UNIX_TIMESTAMP('".$fecha." 00:00:00')
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) <= UNIX_TIMESTAMP('".$fecha." 23:59:59')
                                    AND ".($estado>0 ? "su.Estado = '".$estado."'" : "(su.Estado LIKE '%' OR su.Estado IS NULL)")."
                                    AND ".($coordinador>0 ? "c.Id = '".$coordinador."'" : "(c.Id LIKE '%' OR c.Id IS NULL)")) or die(mysqli_error($conn));

$totalconsultorios = mysqli_num_rows($ResCorteDía);

$ResTotalPago = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(s.Pago) AS TotalPago
                                    FROM servicios AS s
                                    INNER JOIN sucursales AS su ON s.Sucursal = su.Id
                                    INNER JOIN usuarios AS u ON s.TecnicoAsignado = u.Id
                                    INNER JOIN usuarios AS c ON u.Supervisor = c.Id
                                    WHERE s.FinServicio IS NOT NULL
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) >= UNIX_TIMESTAMP('".$fecha." 00:00:00')
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) <= UNIX_TIMESTAMP('".$fecha." 23:59:59')
                                    AND ".($estado>0 ? "su.Estado = '".$estado."'" : "(su.Estado LIKE '%' OR su.Estado IS NULL)")."
                                    AND ".($coordinador>0 ? "c.Id = '".$coordinador."'" : "(c.Id LIKE '%' OR c.Id IS NULL)")));

if($estado == 0)
{
    $NombreEstado = "TODOS";
}
else
{
    $ResNombreEstado = mysqli_fetch_array(mysqli_query($conn, "SELECT Estado FROM cat_estados WHERE Id = '".$estado."'"));
    $NombreEstado = $ResNombreEstado["Estado"];
}

if($coordinador == 0)
{
    $NombreCoordinador = "TODOS";
}
else
{
    $ResNombreCoordinador = mysqli_fetch_array(mysqli_query($conn, "SELECT Nombre FROM usuarios WHERE Id = '".$coordinador."'"));
    $NombreCoordinador = $ResNombreCoordinador["Nombre"];
}

//crear el nuevo archivo pdf
$pdf=new FPDF();

$pdf->SetAutoPageBreak(false);

//Agregamos la primer pagina
$pdf->AddPage();

$pdf->SetFillColor(204,204,204);
$pdf->SetY(10);
$pdf->SetX(10);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190,45,'',0,'C',1);
//titulo
$pdf->SetY(12);
$pdf->SetX(12);
$pdf->SetFont('Arial','',16);
$pdf->Cell(90,10,utf8_decode('CONSULTORIOS CONCLUIDOS'),0,0,'L');
//
$pdf->SetY(20);
$pdf->SetX(100);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,10,'Total:',0,0,'L');
//
$pdf->SetY(20);
$pdf->SetX(113);
$pdf->SetFont('Arial','',12);
$pdf->Cell(90,10,$totalconsultorios,0,0,'L');
//
$pdf->SetY(20);
$pdf->SetX(105);
$pdf->SetFont('Arial','',12);
$pdf->Cell(90,10,$dia.', '.fecha($fecha),0,0,'R');
//
$pdf->SetY(30);
$pdf->SetX(100);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,10,'Monto:',0,0,'L');
//
$pdf->SetY(30);
$pdf->SetX(115);
$pdf->SetFont('Arial','',12);
$pdf->Cell(90,10,'$ '.($ResTotalPago["TotalPago"]>0 && $ResTotalPago["TotalPago"]!==null ? number_format($ResTotalPago["TotalPago"], 2) : '0.00'),0,0,'L');
//
$pdf->SetY(30);
$pdf->SetX(105);
$pdf->SetFont('Arial','',12);
$pdf->Cell(90,10,date('h:i:s a', time()),0,0,'R');
//
$pdf->SetY(40);
$pdf->SetX(12);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'CORTE DE PAGO: ',0,0,'L');
//
$pdf->SetY(40);
$pdf->SetX(53);
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,10,'',1,0,'L');
//
$pdf->SetY(40);
$pdf->SetX(80);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'Zona: ',0,0,'L');
//
$pdf->SetY(40);
$pdf->SetX(95);
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,10,'5',0,0,'L');
//
$pdf->SetY(58);
$pdf->SetX(12);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'ESTADO: ',0,0,'R');
//
$pdf->SetY(58);
$pdf->SetX(40);
$pdf->SetFillColor(204,204,204);
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$NombreEstado,0,0,'C',1);
//
$pdf->SetY(70);
$pdf->SetX(12);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Coordinador: ',0,0,'R');
//
$pdf->SetY(70);
$pdf->SetX(40);
$pdf->SetFillColor(204,204,204);
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,10,$NombreCoordinador,0,0,'C',1);
//
$pdf->SetY(70);
$pdf->SetX(90);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Total: ',0,0,'R');
//
$pdf->SetY(70);
$pdf->SetX(120);
$pdf->SetFillColor(204,204,204);
$pdf->SetFont('Arial','',12);
$pdf->Cell(10,10,$totalconsultorios,0,0,'R',1);
//
$pdf->SetY(70);
$pdf->SetX(120);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Monto: ',0,0,'R');
//
$pdf->SetY(70);
$pdf->SetX(150);
$pdf->SetFillColor(204,204,204);
$pdf->SetFont('Arial','',12);   
$pdf->Cell(50,10,'$ '.($ResTotalPago["TotalPago"]>0 && $ResTotalPago["TotalPago"]!==null ? number_format($ResTotalPago["TotalPago"], 2) : '0.00'),0,0,'R',1);
//
//encabezados
$pdf->SetY(85);
$pdf->SetX(4);
$pdf->SetFillColor(204,204,204);
$pdf->SetDrawColor(000,000,000);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'No. Consultorio',1,0,'C',1);
$pdf->SetX(34);
$pdf->Cell(80,10,'Nombre de consultorio',1,0,'C',1);
$pdf->SetX(114);
$pdf->Cell(30,10,utf8_decode('Fecha Atención'),1,0,'C',1);
$pdf->SetX(144);
$pdf->Cell(30,10,'PAGO',1,0,'C',1);
$pdf->SetX(174);
$pdf->Cell(30,10,'Status Pago',1,0,'C',1);

while($RResCD=mysqli_fetch_array($ResCorteDía))
{
    $pdf->SetY($pdf->GetY() + 10);
    $pdf->SetX(4);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetDrawColor(000,000,000);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,10,$RResCD["NumSucursal"],1,0,'C',1);
    $pdf->SetX(34);
    $pdf->Cell(80,10,$RResCD["NombreSucursal"],1,0,'L',1);
    $pdf->SetX(114);
    $pdf->Cell(30,10,fechados(date("Y-m-d", explode("|", $RResCD["FinServicio"])[0])),1,0,'C',1);
    $pdf->SetX(144);
    $pdf->Cell(30,10,'$ '.($RResCD["Pago"]>0 && $RResCD["Pago"]!==null ? number_format($RResCD["Pago"], 2) : '0.00'),1,0,'R',1);
    $pdf->SetX(174);
    $pdf->Cell(30,10,$RResCD["EstatusPago"],1,0,'C',1);
}

$pdf->Output(); 

?>