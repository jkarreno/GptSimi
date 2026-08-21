<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$cadena='<div class="c100 card">
            <h2>Nuevo usuario</h2>
            <form name="faduser" id="faduser">
                <div class="c30">
                    <label class="l_form">Nombre :</label>
                    <input type="text" name="nombre" id="nombre">
                </div>
                <div class="c30">
                    <label class="l_form">Telefono :</label>
                    <input type="text" name="telefono" id="telefono">
                </div>
                <div class="c30">
                    <label class="l_form">Correo Electrónico:</label>
                    <input type="text" name="correoe" id="correoe">
                </div>
                <div class="c30">
                    <label class="l_form">Usuario :</label>
                    <input type="text" name="usuario" id="usuario">
                </div>
                <div class="c30">
                    <label class="l_form">Contraseña :</label>
                    <input type="text" name="contrasena" id="contrasena">
                </div>
                <div class="c30">
                    <label class="l_form">Perfil :</label>
                    <select name="perfil" id="perfil">
                        <option value="0">Seleccione</option>';
$ResPerfiles=mysqli_query($conn, "SELECT * FROM perfiles ORDER BY Nombre ASC");
while($RResPer=mysqli_fetch_array($ResPerfiles))
{
    $cadena.='<option value="'.$RResPer["Id"].'">'.$RResPer["Nombre"].'</option>';
}
$cadena.='          </select>
                </div>
                <div class="c30" id="div_inactivo_1" style="display: none;"></div>
                <div class="c30" id="div_inactivo_2" style="display: none;"></div>
                <div class="c30" id="div_supervisor" style="display: none;">
                    <label class="l_form">Supervisor :</label>
                    <select name="supervisor" id="supervisor">
                        <option value="0">Seleccione</option>';
$ResSupervisores=mysqli_query($conn, "SELECT * FROM usuarios WHERE Perfil=3 ORDER BY Nombre ASC");
while($RResSup=mysqli_fetch_array($ResSupervisores))
{
    $cadena.='              <option value="'.$RResSup["Id"].'">'.$RResSup["Nombre"].'</option>';
}
$cadena.='          </select>
                </div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="addusuario">
                    <input type="submit" name="botaduser" id="botaduser" value="Agregar>>" onclick="cerrarmodal()">
                </div>
            </form>
            </div>';

echo $cadena;
?>

<script>
document.getElementById("perfil").addEventListener("change", function () {

    console.log("Valor seleccionado:", this.value);

    if (this.value == "2") {

        //console.log("MOSTRAR");

        document.getElementById("div_inactivo_1").style.display = "block";
        document.getElementById("div_inactivo_2").style.display = "block";
        document.getElementById("div_supervisor").style.display = "block";

    } else {

        //console.log("OCULTAR");

        document.getElementById("div_inactivo_1").style.display = "none";
        document.getElementById("div_inactivo_2").style.display = "none";
        document.getElementById("div_supervisor").style.display = "none";

    }

});

$("#faduser").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("faduser"));

	$.ajax({
		url: "configuracion/usuarios.php",
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