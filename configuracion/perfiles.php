<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["hacer"]))
{
    //agregar perfil
    if($_POST["hacer"]=='addperfil')
    {
        $permisos='|';
        $ResPermisos = mysqli_query($conn, "SELECT Id FROM permisos ORDER BY Id ASC");
        while($RResP=mysqli_fetch_array($ResPermisos))
        {
            if(isset($_POST["per_".$RResP["Id"]]) && $_POST["per_".$RResP["Id"]]==1)
            {
                $permisos.=$RResP["Id"].'|';
            }
            
        }
        mysqli_query($conn, "INSERT INTO perfiles (Nombre, Permisos) VALUES('".$_POST["nombre"]."', '".$permisos."')");

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el perfil '.$_POST["nombre"].'</div>';
    }
    //editar perfil
    if($_POST["hacer"]=='editperfil')
    {
        $permisos='|';
        $ResPermisos = mysqli_query($conn, "SELECT Id FROM permisos ORDER BY Id ASC");
        while($RResP=mysqli_fetch_array($ResPermisos))
        {
            if(isset($_POST["per_".$RResP["Id"]]) && $_POST["per_".$RResP["Id"]]==1)
            {
                $permisos.=$RResP["Id"].'|';
            }
            
        }
        mysqli_query($conn, "UPDATE perfiles SET Nombre = '".$_POST["nombre"]."', Permisos = '".$permisos."' WHERE Id = '".$_POST["idperfil"]."'");
        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se actualizo el perfil '.$_POST["nombre"].'</div>';
    }
}

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
$ResPerfiles=mysqli_query($conn, "SELECT * FROM perfiles ORDER BY Nombre ASC");
$J=1;
while($RResPer=mysqli_fetch_array($ResPerfiles))
{
    $cadena.='      <tr>
                        <td align="center">'.$J.'</td>
                        <td>'.(permisos($_SESSION["perfil"], 'edit.perfil') ? '<a href="javascript:void(0)" onclick="edit_perfil(\''.$RResPer["Id"].'\')">'.$RResPer["Nombre"].'</a>' : $RResPer["Nombre"]).'</td>
                        <td>'.($RResPer["Id"]==1 ? 'Todos' : 'Restringidos').'</td>
                        <td>'.(permisos($_SESSION["perfil"], 'edit.perfil') ? '<i class="fa-solid fa-pen-to-square"></i>' : '').(permisos($_SESSION["perfil"], 'delete.perfil') ? ' <i class="fa-solid fa-trash"></i>' : '').'</td>
                    </tr>';
    $J++;
}
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
            <?php if(permisos($_SESSION["perfil"], 'add.perfil')): ?>
            {
                text: 'Agregar Perfil',
                action: function ( e, dt, node, config ) {
                    limpiar();
                    abrirmodal();
                    agregar_perfil();
                }
            }
            <?php endif; ?>
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
    limpiar();
    abrirmodal();
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