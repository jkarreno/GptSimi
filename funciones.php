<?php
//session_start();

include ('conexion.php');

//require 'vendor/autoload.php';

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

function fecha($fecha)
{
    $mes='';
    
    if(isset($fecha))
    {
        switch($fecha[5].$fecha[6])
        {
            case '01'; $mes='Enero'; break;
            case '02'; $mes='Febrero'; break;
            case '03'; $mes='Marzo'; break;
            case '04'; $mes='Abril'; break;
            case '05'; $mes='Mayo'; break;
            case '06'; $mes='Junio'; break;
            case '07'; $mes='Julio'; break;
            case '08'; $mes='Agosto'; break;
            case '09'; $mes='Septiembre'; break;
            case '10'; $mes='Octubre'; break;
            case '11'; $mes='Noviembre'; break;
            case '12'; $mes='Diciembre'; break;
        }
    
        $fechanew=$fecha[8].$fecha[9].' - '.$mes.' - '.$fecha[0].$fecha[1].$fecha[2].$fecha[3];
    
        return $fechanew;
    }
    else
    {
        return '';
    }
}

function fechados($fecha)
{
	switch($fecha[5].$fecha[6])
	{
		case '01'; $mes='Ene'; break;
		case '02'; $mes='Feb'; break;
		case '03'; $mes='Mar'; break;
		case '04'; $mes='Abr'; break;
		case '05'; $mes='May'; break;
		case '06'; $mes='Jun'; break;
		case '07'; $mes='Jul'; break;
		case '08'; $mes='Ago'; break;
		case '09'; $mes='Sep'; break;
		case '10'; $mes='Oct'; break;
		case '11'; $mes='Nov'; break;
		case '12'; $mes='Dic'; break;
	}
	
	$fechanew=$fecha[8].$fecha[9].' - '.$mes.' - '.$fecha[2].$fecha[3];
	
	return $fechanew;
}

function mes($mesn)
{
   switch($mesn)
	{
		case '01'; $mes='Enero'; break;
		case '02'; $mes='Febrero'; break;
		case '03'; $mes='Marzo'; break;
		case '04'; $mes='Abril'; break;
		case '05'; $mes='Mayo'; break;
		case '06'; $mes='Junio'; break;
		case '07'; $mes='Julio'; break;
		case '08'; $mes='Agosto'; break;
		case '09'; $mes='Septiembre'; break;
		case '10'; $mes='Octubre'; break;
		case '11'; $mes='Noviembre'; break;
		case '12'; $mes='Diciembre'; break;
	}
	
	return $mes;
}
function fecha_vencimiento($fechainicio, $periodo, $tipo)
{
   if ($tipo=='S')
   {
      $dias = $periodo * 7;

      $fechavencimiento = date("Y-m-d",strtotime($fechainicio."+ ".$dias." days")).' 23:59:59'; 
   }
   elseif($tipo=='Q')
   {
      $dias = $periodo * 15;

      $fechavencimiento = date("Y-m-d",strtotime($fechainicio."+ ".$dias." days")).' 23:59:59'; 

      //calcula el ultimo día de mes
      $anioActual = $fechavencimiento[0].$fechavencimiento[1].$fechavencimiento[2].$fechavencimiento[3];
      $mesActual = $fechavencimiento[5].$fechavencimiento[6];
      $cantidadDias = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);

      if($fechavencimiento[8].$fechavencimiento[9]<=15)
      {
         $fechavencimiento=$fechavencimiento[0].$fechavencimiento[1].$fechavencimiento[2].$fechavencimiento[3].'-'.$fechavencimiento[5].$fechavencimiento[6].'-15 23:59:59';
      }
      elseif($fechavencimiento[8].$fechavencimiento[9]>15 AND $fechavencimiento[8].$fechavencimiento[9]<=$cantidadDias)
      {
         $fechavencimiento=$fechavencimiento[0].$fechavencimiento[1].$fechavencimiento[2].$fechavencimiento[3].'-'.$fechavencimiento[5].$fechavencimiento[6].'-'.$cantidadDias.' 23:59:59';
      }
   }
   elseif($tipo=='M')
   {
      $mes = $periodo % 12;
      $anio = floor($periodo / 12);

      $fechavencimiento = date("Y-m-d",strtotime($fechainicio."+ ".$anio." years + ".$mes." months")).' 23:59:59'; 
   }

   return $fechavencimiento;
}
function randomColor(){
 $str = "#";
 for($i = 0 ; $i < 6 ; $i++){
 $randNum = rand(0, 15);
 switch ($randNum) {
 case 10: $randNum = "A"; 
 break;
 case 11: $randNum = "B"; 
 break;
 case 12: $randNum = "C"; 
 break;
 case 13: $randNum = "D"; 
 break;
 case 14: $randNum = "E"; 
 break;
 case 15: $randNum = "F"; 
 break; 
 }
 $str .= $randNum;
 }
 return $str;
}

function dias_pasados($fecha_inicial,$fecha_final)
{
$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
$dias = abs($dias); $dias = floor($dias);
return $dias;
}

function fecha_bit($fecha)
{
   switch($fecha[5].$fecha[6])
	{
		case '01'; $mes='Ene'; break;
		case '02'; $mes='Feb'; break;
		case '03'; $mes='Mar'; break;
		case '04'; $mes='Abr'; break;
		case '05'; $mes='May'; break;
		case '06'; $mes='Jun'; break;
		case '07'; $mes='Jul'; break;
		case '08'; $mes='Ago'; break;
		case '09'; $mes='Sep'; break;
		case '10'; $mes='Oct'; break;
		case '11'; $mes='Nov'; break;
		case '12'; $mes='Dic'; break;
	}

   $fechanew=$fecha[8].$fecha[9].'-'.$mes.'-'.$fecha[2].$fecha[3].'<br />'.$fecha[11].$fecha[12].$fecha[13].$fecha[14].$fecha[15].$fecha[16].$fecha[17].$fecha[18];

   return $fechanew;
}

function getFirstDayWeek($week, $year)
{
    $dt = new DateTime();
    $return['start'] = $dt->setISODate($year, $week)->format('Y-m-d');
    $return['end'] = $dt->modify('+6 days')->format('Y-m-d');
    return $return;
}

function deleteAllFilesInFolder($folderPath) {
    // Verificar si la carpeta existe
    if (!is_dir($folderPath)) {
        die("La carpeta especificada no existe.");
    }

    // Obtener todos los archivos y carpetas en la carpeta especificada
    $files = scandir($folderPath);

    foreach ($files as $file) {
        // Ignorar los directorios especiales '.' y '..'
        if ($file != '.' && $file != '..') {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

            // Verificar si es un archivo o una carpeta
            if (is_file($filePath)) {
                // Eliminar el archivo
                unlink($filePath);
            } elseif (is_dir($filePath)) {
                // Llamar recursivamente para eliminar todos los archivos dentro de la subcarpeta
                deleteAllFilesInFolder($filePath);
                // Eliminar la subcarpeta vacía
                rmdir($filePath);
            }
        }
    }
}

function generarCodigoAleatorio() {
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    // Generar un código aleatorio de 4 caracteres
    do {
        $codigo = '';
        for ($i = 0; $i < 4; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
    } while ($codigo === '0000'); // Evitar que el código sea "0000"

    return $codigo;
}

function esJson($string) {
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
}

function permisos($perfil, $key)
{
    if($perfil == 1) {
        return true; // El perfil 1 tiene todos los permisos
    }

    else {
        include('conexion.php');

        $sql = "SELECT Id FROM permisos WHERE Key = '$key'";
        $result = mysqli_fetch_array(mysqli_query($conn, $sql));

        if (strpos($_SESSION["permisos"], '|' . $result['Id'] . '|') !== false) {
            return true; // El perfil tiene el permiso
        } else {
            return false; // El perfil no tiene el permiso
        }
    }
}

//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>