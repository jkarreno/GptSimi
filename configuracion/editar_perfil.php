<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$ResPerfil=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perfiles WHERE Id = '".$_POST["idperfil"]."'"));

$cadena='<div class="c100 card">
            <h2>Editar Perfil</h2>
            <form name="feditperfil" id="feditperfil">
                <div class="c100">
                    <label class="l_form">Nombre perfil:</label>
                    <input type="text" name="nombre" id="nombre" value="'.$ResPerfil["Nombre"].'">
                </div>
                <div class="c100">';
$ResPermisos=mysqli_query($conn, "SELECT Modulo FROM permisos GROUP BY Modulo ORDER BY Modulo ASC");
while($RResPerm=mysqli_fetch_array($ResPermisos))
{
    $cadena.='<div class="c100" style="display: flex; flex-wrap: wrap;">
                    <h2>'.$RResPerm["Modulo"].'</h2>';
    $ResFuncion=mysqli_query($conn, "SELECT * FROM permisos WHERE Modulo = '".$RResPerm["Modulo"]."' ORDER BY Id ASC");
    while($RResFunc=mysqli_fetch_array($ResFuncion))
    {
        $cadena.='<div class="c30">
                    <label class="l_form">'.$RResFunc["Nombre"].':</label>
                    <ul class="tg-list">
                    <li class="tg-list-item">
                        <input class="tgl tgl-light" id="per_'.$RResFunc["Id"].'" name="per_'.$RResFunc["Id"].'" type="checkbox" value="1" '.(strpos($ResPerfil["Permisos"], '|'.$RResFunc["Id"].'|')!==false ? 'checked' : '').'>
                        <label class="tgl-btn" for="per_'.$RResFunc["Id"].'"></label>
                    </li>
                    </ul>
                </div>';
    }
    $cadena.='</div>';
}
$cadena.='      </div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="editperfil">
                    <input type="hidden" name="idperfil" id="idperfil" value="'.$ResPerfil["Id"].'">
                    <input type="submit" name="botaduser" id="botaduser" value="Guardar Cambios" onclick="cerrarmodal()">
                </div>
			</form>
        </div>';
    
echo $cadena;

?>

<script>
$("#feditperfil").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("feditperfil"));

	$.ajax({
		url: "configuracion/perfiles.php",
		type: "POST",
		dataType: "HTML",
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done(function(echo){
		$("#contenido2").html(echo);
	});
});
</script>

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>