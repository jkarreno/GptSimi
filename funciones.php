<?php
//session_start();

include ('conexion.php');

//require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

function leads($empresa)
{
	$cadena='<div class="c10 card_2" onclick="leads_mpio_dgo()" style="cursor: pointer;';if($empresa==1){$cadena.=' background-color: #0d2240;';}$cadena.='">
                <h2 class="revclientes">Municipio de Durango</h2>
            </div>
            <div class="c10 card_2" onclick="leads_mpio_ahome()" style="cursor: pointer;';if($empresa==9){$cadena.=' background-color: #0d2240;';}$cadena.='">
                <h2 class="revclientes">Municipio de AHOME</h2>
            </div>
            <div class="c10 card_2" onclick="leads_edo_qroo()" style="cursor: pointer;';if($empresa==16){$cadena.=' background-color: #0d2240;';}$cadena.='">
                <h2 class="revclientes">Estado de Quintana Roo</h2>
            </div>
            <div class="c10 card_2" onclick="leads_edo_son()" style="cursor: pointer;';if($empresa==21){$cadena.=' background-color: #0d2240;';}$cadena.='">
                <h2 class="revclientes">Estado de Sonora</h2>
            </div>
            <div class="c10 card_2" onclick="leads_mati()" style="cursor: pointer;';if($empresa==25){$cadena.=' background-color: #0d2240;';}$cadena.='">
                <h2 class="revclientes">Municipio de Atizapan</h2>
            </div>';

	return $cadena;
}

function generarCorreoAleatorio($dominio) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 10;
    $correo = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $correo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    
    return $correo . '@' . $dominio;
}

function enviar_notificacion($idnotificacion, $perfiles, $idcliente=NULL)
{
    global $conn;
    
    switch($idnotificacion)
    {
        case 1: 
            $subject = 'Nuevo lead registrado';
            $cuerpo = 'Espera que el promotor complete la información.'; 
            $idc = 'IdLead';
            break;
        case 2:
            $subject = 'Documentos enviados';
            $cuerpo = 'Un cliente ha validado documentos.'; 
            $idc = 'IdLead';
            break;
        case 3:
            $ResL = mysqli_fetch_array(mysqli_query($conn, "SELECT CONCAT(Nombre, ' ', Apellidos, ' ', Apellidosdos) AS Cliente FROM leads WHERE Id = '".$idcliente."' LIMIT 1"));
            $subject = 'Cliente validado';
            $cuerpo = 'El cliente '.$ResL["Cliente"].' ha sido validado por Recursos Humanos.'; 
            $idc = 'IdLead';
            break;
        case 4:
            $ResL = mysqli_fetch_array(mysqli_query($conn, "SELECT CONCAT(Nombre, ' ', Apellidos, ' ', Apellidosdos) AS Cliente FROM leads WHERE Id = '".$idcliente."' LIMIT 1"));
            $subject = 'Servicio Seleccionado';
            $cuerpo = 'El cliente '.$ResL["Cliente"].' ha seleccionado el servicio de interes.'; 
            $idc = 'IdLead';
            break;
        case 5:
            $ResL = mysqli_fetch_array(mysqli_query($conn, "SELECT CONCAT(Nombre, ' ', Apellidos, ' ', Apellidosdos) AS Cliente FROM leads WHERE Id = '".$idcliente."' LIMIT 1"));
            $subject = 'Propuesta Enviada';
            $cuerpo = 'Se enviaron las propuestas para el cliente '.$ResL["Cliente"].'.'; 
            $idc = 'IdLead';
            break;
        case 6:
            $ResL = mysqli_fetch_array(mysqli_query($conn, "SELECT CONCAT(Nombre, ' ', Apellidos, ' ', Apellidosdos) AS Cliente FROM leads WHERE Id = '".$idcliente."' LIMIT 1"));
            $subject = 'Propuesta Aceptada';
            $cuerpo = 'El cliente '.$ResL["Cliente"].' ha aceptado la propuesta.'; 
            $idc = 'IdLead';
            break;
        case 7:
            $ResL = mysqli_fetch_array(mysqli_query($conn, "SELECT CONCAT(Nombre, ' ', Apellidos, ' ', Apellidosdos) AS Cliente FROM leads WHERE Id = '".$idcliente."' LIMIT 1"));
            $subject = 'Contrato Listo';
            $cuerpo = 'La liga del contrato esta lista para el cliente '.$ResL["Cliente"].'.'; 
            $idc = 'IdLead';
            break;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;                                   //Enable SMTP authentication
        $mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //$mail->Host = 'email-smtp.us-east-1.amazonaws.com';
        //$mail->SMTPAuth = true;
        //$mail->Username = 'AKIAXYKJWMQT473X43XY';
        //$mail->Password = 'BGw2p6wzsmZZohX9Xo88ICLUw7Jl8TNwY54TF83P2fQg';
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->Port = 587;
        
        //Recipients
        $mail->setFrom('juan.carreno@whitefish.mx', 'Mesa de Control');

        if (is_array($perfiles))
        {
            foreach($perfiles AS $perfil)
            {
                $ResPerfiles = mysqli_query($conn, "SELECT Id, Nombre, CorreoE FROM usuarios WHERE Perfil = '".$perfil."' AND Compani ='".$_SESSION["compani"]."'");
                while($RResP = mysqli_fetch_array($ResPerfiles))
                {
                    if($RResP["CorreoE"]!=NULL)
                    {
                        $mail->addAddress($RResP["CorreoE"], $RResP["Nombre"]);//Add a recipient 
                    }

                    //insertamos en base de datos
                    mysqli_query($conn, "INSERT INTO notificaciones (IdUsuario, ".$idc.", Titulo, Mensaje, Fecha, Estatus, Compani) 
                                                VALUES ('".$RResP["Id"]."', '".$idcliente."', '".$subject."', '".$cuerpo."', '".time()."', '0', '".$_SESSION["compani"]."')");
                }
            }
        }
        else {
            $ResUsuario=mysqli_fetch_array(mysqli_query($conn, "SELECT Nombre, CorreoE, IdUsuario FROM Promotores WHERE Id='".$perfiles."' LIMIT 1"));

            $mail->addAddress($ResUsuario["CorreoE"], $ResUsuario["Nombre"]);//Add a recipient 

            //insertamos en base de datos
            mysqli_query($conn, "INSERT INTO notificaciones (IdUsuario, ".$idc.", Titulo, Mensaje, Fecha, Estatus, Compani) 
                                                    VALUES ('".$ResUsuario["IdUsuario"]."', '".$idcliente."', '".$subject."', '".$cuerpo."', '".time()."', '0', '".$_SESSION["compani"]."')");
        }

        
       
    
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $cuerpo;

        if($mail->send())
        {
            $respuesta.='1. Message has been sent';
        }
        else{
            $respuesta.='1.1. Menssage not sent';
        }
        
    } catch (Exception $e) {
        $respuesta="2. Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    return $respuesta;
}
function notificaciones()
{
    //session_start(); 
    global $conn;

    $numnot=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM notificaciones WHERE IdUsuario = '".$_SESSION["Id"]."' AND Estatus = '0'"));

    return $numnot;
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

function calcularEdad($valor) {
    // Validar longitud mínima para extraer la fecha
    if (strlen($valor) < 10) {
        return 0;
    }

    // Extraer la fecha de nacimiento (caracteres 5 al 10)
    $fecha = substr($valor, 4, 6);

    // Separar año, mes y día
    $anio = substr($fecha, 0, 2);
    $mes = substr($fecha, 2, 2);
    $dia = substr($fecha, 4, 2);

    // Validar mes y día
    if (!is_numeric($anio) || !is_numeric($mes) || !is_numeric($dia)) {
        return 0;
    }

    if ((int)$mes < 1 || (int)$mes > 12 || (int)$dia < 1 || (int)$dia > 31) {
        return 0;
    }

    // Determinar el siglo
    $anioCompleto = ($anio >= date('y')) ? '19' . $anio : '20' . $anio;

    // Verificar que la fecha sea válida
    if (!checkdate((int)$mes, (int)$dia, (int)$anioCompleto)) {
        return 0;
    }

    // Crear objetos de fecha
    $fechaNacimientoObj = date_create($anioCompleto . '-' . $mes . '-' . $dia);
    if (!$fechaNacimientoObj) {
        return 0;
    }

    $hoy = date_create();

    // Calcular la diferencia
    $diferencia = date_diff($fechaNacimientoObj, $hoy);

    return (int)$diferencia->format('%y');
}

function escribirLog($mensaje)
{
    $archivo = __DIR__ . '/logs/debug_solveshop_'.date("Ymd").'.log';

    $fecha = date('Y-m-d H:i:s');

    file_put_contents(
        $archivo,
        "[{$fecha}] {$mensaje}" . PHP_EOL,
        FILE_APPEND
    );
}

//Created with human intelligence by @jkarreno 2023 - 2024 - 2025 - 2026
//May the force be with you
//move your stars
//be prepared
?>