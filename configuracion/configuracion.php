<?php
//Inicio la sesion 
session_start();

include('../conexion.php');
include('../funciones.php');

$mensaje='';

$cadena='<div class="c100">
            <div class="menucard">
                <ul>
					'.(permisos($_SESSION["perfil"], 'ver.sucursales')==TRUE ? '<li><a href="#" onclick="sucursales()" class = "mytooltip"><i class="fa-solid fa-store"></i><span class = "mytext">Sucursales</span></a></li>' : '').'
                    '.(permisos($_SESSION["perfil"], 'ver.usuarios')==TRUE ? '<li><a href="#" onclick="usuarios()" class = "mytooltip"><i class="ri-group-2-fill"></i><span class = "mytext">Usuarios</span></a></li>' : '').'
                </ul>
            </div>
            <div id="contenido2" class="contenido2">
                
            </div>
        </div>';

echo $cadena;

?>
<script>
function sucursales(){
	$.ajax({
				type: 'POST',
				url : 'configuracion/sucursales.php'
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