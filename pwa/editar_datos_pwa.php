<?php

//Inicio la sesion 
$tiempoSesion = 3 * 60 * 60;
ini_set('session.gc_maxlifetime', $tiempoSesion);
ini_set('session.cookie_lifetime', $tiempoSesion);

session_start();

include ("../conexion.php");
include ("../funciones.php");

$ResUsuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM usuarios WHERE Id = '".$_SESSION["Id"]."' LIMIT 1"));

switch($_POST["dato"])
{
    case 'phone': $label='Teléfono'; $dato=$ResUsuario["Telefono"]; break;
}


$cadena='<form name="feditdatos" id="feditdatos" method="POST" action="perfil.php">
            <div class="c100">
                <label class="l_form">'.$label.'</label>
                <input type="text" name="valordato" id="valordato" value="'.$dato.'">
            </div>

            <div class="c100">
                <input type="hidden" name="id" id="id" value="'.$_SESSION["Id"].'">
                <input type="hidden" name="hacer" id="hacer" value="guardadato">
                <input type="hidden" name="dato" id="dato" value="'.$_POST["dato"].'">
                <input type="submit" class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" name="botsenddato" id="botsenddato" value="Guardar">
            </div>
        </form>';

echo $cadena;

?>
