<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$cadena='<div class="c100 card">
            <h2>Nueva sucursal</h2>
            <form name="fadsucursal" id="fadsucursal">
                <div class="c30">
                    <label class="l_form">Num. Sucursal :</label>
                    <input type="text" name="num_sucursal" id="num_sucursal">
                </div>
                <div class="c30">
                    <label class="l_form">Nombre :</label>
                    <input type="text" name="nombre" id="nombre">
                </div>
                <div class="c30">
                    <label class="l_form">Responsable :</label>
                    <input type="text" name="responsable" id="responsable">
                </div>
                <div class="c100">
                    <label class="l_form">Dirección :</label>
                    <input type="text" name="direccion" id="direccion">
                </div>
                <div class="c30">
                    <label class="l_form">Teléfono :</label>
                    <input type="text" name="telefono" id="telefono">
                </div>
                <div class="c30">
                    <label class="l_form">Correo Electrónico :</label>
                    <input type="text" name="correoe" id="correoe">
                </div>
                <div class="c30"></div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="addsucursal">
                    <input type="submit" name="botadsucursal" id="botadsucursal" value="Agregar>>" onclick="cerrarmodal()">
                </div>
            </form>
        </div>';

echo $cadena;
?>
<script>
$("#fadsucursal").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("fadsucursal"));
    
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