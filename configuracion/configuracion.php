<?php
//Inicio la sesion 
session_start();

include('../conexion.php');
//include('../funciones.php');

$mensaje='';

$cadena='<div class="c100">
            <div class="menucard">
                <ul>
					<li><a href="#" onclick="financieras()" class = "mytooltip"><i class="ri-bank-fill"></i><span class = "mytext">Financieras</span></a></li>
                    <li><a href="#" onclick="empresas()" class = "mytooltip"><i class="ri-building-4-fill"></i><span class = "mytext">Empresas</span></a></li>
                    <li><a href="#" onclick="usuarios()" class = "mytooltip"><i class="ri-group-2-fill"></i><span class = "mytext">Usuarios</span></a></li>
                    <li><a href="#" onclick="promotores()" class = "mytooltip"><i class="ri-user-voice-fill"></i><span class = "mytext">Promotores</span></a></li>
                </ul>
            </div>
            <div id="contenido2" class="contenido2">
                
            </div>
        </div>';

echo $cadena;

?>
<script>
function empresas(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/configuracion/empresas/empresas.php'
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}
function usuarios(){
    $('#contenido2').html('<div class="loading"><img src="/images/loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'configuracion/usuarios.php'
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}
function promotores(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/configuracion/promotores/promotores.php'
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}
function financieras(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/configuracion/financieras/financieras.php'
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}

$(document).ready(empresas());
</script>

<?php
//Created with human intelligence by @jkarreno 2023 - 2024 -2025
//May the force be with you
//move your stars
//always ready
?>