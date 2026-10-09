<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$ResSucursal=mysqli_query($conn, "SELECT * FROM sucursales WHERE Id='".$_POST["id"]."'");
$RResSucursal=mysqli_fetch_array($ResSucursal);

$cadena='<div class="c100 card">
            <h2>Editar sucursal</h2>
            <form name="fedsucursal" id="fedsucursal">
                <div class="c30">
                    <label class="l_form">Num. Sucursal :</label>
                    <input type="text" name="num_sucursal" id="num_sucursal" value="'.$RResSucursal["NumSucursal"].'">
                </div>
                <div class="c30">
                    <label class="l_form">Nombre :</label>
                    <input type="text" name="nombre" id="nombre" value="'.$RResSucursal["Nombre"].'">
                </div>
                <div class="c30">
                    <label class="l_form">Responsable :</label>
                    <input type="text" name="responsable" id="responsable" value="'.$RResSucursal["Responsable"].'">
                </div>
                <div class="c60">
                    <label class="l_form">Dirección :</label>
                    <input type="text" name="direccion" id="direccion" value="'.$RResSucursal["Direccion"].'">
                </div>
                <div class="c30">
                    <label class="l_form">Estado :</label>
                    <select name="estado" id="estado">
                        <option value="0">Seleccione un estado</option>';
$ResEstados =mysqli_query($conn, "SELECT * FROM cat_estados ORDER BY Estado ASC");
while($RResEstados = mysqli_fetch_array($ResEstados))
{
    $cadena.='          <option value="'.$RResEstados["Id"].'"'.($RResEstados["Id"] == $RResSucursal["Estado"] ? ' selected' : '').'>'.$RResEstados["Estado"].'</option>';
}
$cadena.='          </select>
                </div>
                <div class="c30">
                    <label class="l_form">Teléfono :</label>
                    <input type="text" name="telefono" id="telefono" value="'.$RResSucursal["Telefono"].'">
                </div>
                <div class="c30">
                    <label class="l_form">Correo Electrónico :</label>
                    <input type="text" name="correoe" id="correoe" value="'.$RResSucursal["CorreoE"].'">
                </div>
                <div class="c30">
                    <label class="l_form">Zona :</label>
                    <input type="text" name="zona" id="zona" value="'.$RResSucursal["Zona"].'">
                </div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="editsucursal">
                    <input type="hidden" name="id_sucursal" id="id_sucursal" value="'.$RResSucursal["Id"].'">
                    <input type="submit" name="botedsucursal" id="botedsucursal" value="Editar>>" onclick="cerrarmodal()">
                </div>
            </form>
        </div>';

echo $cadena;
?>
<script>
$("#fedsucursal").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("fedsucursal"));
    
    $.ajax({
		url: "configuracion/sucursales.php",
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