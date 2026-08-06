<?php
//Inicio la sesion 
session_start();

include('apps/conexion.php');

$f = $_SESSION["compani"];

if(isset($_GET["session"]))
{
	//bitacora
mysqli_query($conn, "INSERT INTO bitacora (FechaHora, IdUser, Hizo, Compani) VALUES ('".time()."', '".$_SESSION["Id"]."', '21', '".$_SESSION["compani"]."')");
}
else
{
	//bitacora
	mysqli_query($conn, "INSERT INTO bitacora (FechaHora, IdUser, Hizo, Compani) VALUES ('".time()."', '".$_SESSION["Id"]."', '22', '".$_SESSION["compani"]."')");
}

session_destroy();
header("Location: index.php?f=".$_GET["f"].""); 
?>

<?php
//Created with human intelligence by @jkarreno 2023 - 2024
//May the force be with you
//move your stars
//always ready
?>