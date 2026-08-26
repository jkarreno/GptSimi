<?php
ob_start();
session_start(); 
//conecto con la base de datos 
include('conexion.php');
//include ('funciones.php');

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT u.Usuario,  u.Contrasenna, u.Perfil, u.Nombre, u.Id, p.Permisos
            FROM usuarios AS u
            INNER JOIN perfiles AS p ON u.Perfil = p.Id
            WHERE u.Usuario='".$_POST["user"]."' AND u.Contrasenna='".md5($_POST["pass"])."'"; 

//Ejecuto la sentencia 
$rs = mysqli_query($conn, $ssql); 

//vemos si el usuario y contrasea es vildo 
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
    $_SESSION["usuario"] = $Rowrs["Usuario"];
    $_SESSION["permisos"] = $Rowrs["Permisos"];
 //    sesion_register("usuario");
//    $usuario = $username;
    if (strpos($_SESSION["permisos"], '|10|') !== false) {
        header ("Location: pwa/principal_pwa.php"); 
    } else {
        header ("Location: principal.php"); 
    }

    //header ("Location: principal.php"); 
	
}else { 
    //si no existe le mando otra vez a la portada 
    header("Location: index.php"); 
} 
mysqli_free_result($rs); 
mysqli_close($conn); 
ob_end_flush();
?> 

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>

