<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$mensaje='';

$cadena=$mensaje.'<div class="c100 card">
            <h2><i class="fa-solid fa-users-gear"></i> Perfiles</h2>
            <table id="table_perfiles" class="stripe row-border order-column nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
//$ResPerfiles=mysqli_query($conn, "SELECT * FROM usuarios_perfiles WHERE Compani = '".$_SESSION["compani"]."' ORDER BY Nombre ASC");
//$J=1;
//while($RResPer=mysqli_fetch_array($ResPerfiles))
//{
//    $cadena.='      <tr>
//                        <td align="center">'.$J.'</td>
//                        <td><a href="javascript:void(0)" onclick="limpiar();abrirmodal();edit_perfil(\''.$RResPer["Id"].'\')">'.$RResPer["Nombre"].'</a></td>
//                    </tr>';
//    $J++;
//}
$cadena.='      </tbody>
            </table>';

echo $cadena;
?>
<script>
$(document).ready( function () {
    var table = $('#table_perfiles').DataTable({
        language: {
            decimal: '.',
            thousands: ',',
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Agregar Perfil',
                action: function ( e, dt, node, config ) {
                    limpiar();
                    abrirmodal();
                    agregar_perfil();
                }
            }
        ],
        paging: false
    });
} );

function agregar_perfil(){
    $.ajax({
				type: 'POST',
				url : 'configuracion/agregar_perfil.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function edit_perfil(idperfil){
    $.ajax({
                type: 'POST',
                url : 'configuracion/editar_perfil.php',
                data: {idperfil: idperfil}
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