<?php
ob_start();
session_start(); 
//conecto con la base de datos 
include('apps/conexion.php');
include ('funciones.php');

escribirLog("Intento de inicio de sesión con el usuario: ".$_POST["user"]." y la contraseña: ".$_POST["pass"]);

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE Usuario='".$_POST["user"]."' and Contrasenna='".md5($_POST["pass"])."'"; 

//Ejecuto la sentencia 
$rs = mysqli_query($conn, $ssql); 

//vemos si el usuario y contrase�a es v�ildo 
//si la ejecuci�n de la sentencia SQL nos da alg�n resultado 
//es que si que existe esa conbinaci�n usuario/contrase�a 
if (mysqli_num_rows($rs)!=0){ 
    //usuario y contrase�a v�lidos 
    $Rowrs=mysqli_fetch_array($rs);
    //defino una sesion y guardo datos 
    
    //session_register("autentificado"); 
    $_SESSION["autentificado"] = "SI"; 
    $_SESSION["perfil"] = $Rowrs["Perfil"];
    $_SESSION["nombre"] = $Rowrs["Nombre"];
    $_SESSION["Id"] = $Rowrs["Id"];
    $_SESSION["compani"] = $Rowrs["Compani"];
    $_SESSION["usuario"] = $Rowrs["Usuario"];
 //    sesion_register("usuario");
//    $usuario = $username;

    //bitacora
   mysqli_query($conn, "INSERT INTO bitacora (FechaHora, IdUser, Hizo, Compani) VALUES ('".time()."', '".$_SESSION["Id"]."', '1', '".$_SESSION["compani"]."')");

   escribirLog("Inicio de sesión exitoso para el usuario: ".$_SESSION["usuario"]);
	
    header ("Location: principal.php"); 
	
}else { 
    //si no existe le mando otra vez a la portada 
    header("Location: index.php"); 
} 
mysqli_free_result($rs); 
mysqli_close($conn); 
ob_end_flush();
?> 

<?php
//Created with human intelligence by @jkarreno 2023 - 2024
//May the force be with you
//move your stars
//always ready
?>

