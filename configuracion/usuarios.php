<?php
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$mensaje='';

$cadena=$mensaje.'<div class="c100 card agc ber bff bfz">
            <h2><i class="ri-group-2-fill"></i> Usuarios</h2>
            <table id="table_usuarios" class="stripe row-border order-column nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Perfil</th>
                        <th>Supervisor</th>
                        <th>Suc. atendidas</th>
                        <th>Suc. por atender</th>
                        <th>Total sucursales</th>
                    </tr>
                </thead>
                <tbody>';
$cadena.='      </tbody>
            </table>
        </div>';

echo $cadena;
?>
<script>
$(document).ready( function () {
    var table = $('#table_usuarios').DataTable({
        language: {
            decimal: '.',
            thousands: ',',
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Perfiles',
                action: function ( e, dt, node, config ) {
                    perfiles();
                }
            },
            {
                text: 'Agregar Usuario',
                action: function ( e, dt, node, config ) {
                    limpiar();
                    abrirmodal();
                    agregar_usuario();
                }
            },
            {
                text: 'Enviar Mensaje',
                action: function ( e, dt, node, config ) {
                    limpiar();
                    abrirmodal();
                    mensaje_usuarios();
                }
            }
        ],
        paging: false
    });
} );

function agregar_usuario(){
    $.ajax({
				type: 'POST',
				url : 'configuracion/agregar_usuario.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function edit_usuario(idusuario){
    $.ajax({
				type: 'POST',
				url : 'configuracion/edit_usuario.php',
                data: 'idusuario=' + idusuario
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function perfiles(){
    $.ajax({
				type: 'POST',
				url : 'configuracion/perfiles.php'
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}

function doc_usuario(idusuario){
    $.ajax({
				type: 'POST',
				url : 'configuracion/doc_usuario.php',
                data: 'idusuario=' + idusuario
	}).done (function ( info ){
		$('#contenido2').html(info);
	});
}

function mensaje_usuarios(){
    $.ajax({
				type: 'POST',
				url : 'configuracion/mensaje_usuarios.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

//mostrar mensaje despues de los cambios
setTimeout(function() { 
    $('#mesaje').fadeOut('fast'); 
}, 1000)
</script>

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>