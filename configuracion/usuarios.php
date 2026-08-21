<?php
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["hacer"]))
{
    //agregar usuario
    if($_POST["hacer"]=='addusuario')
    {
        //echo "INSERT INTO usuarios (Nombre, Telefono, CorreoE, Usuario, Contrasenna, Perfil, Supervisor) 
        //                                    VALUES('".$_POST["nombre"]."', '".$_POST["telefono"]."', '".$_POST["correoe"]."', 
        //                                            '".$_POST["usuario"]."', '".md5($_POST["contrasena"])."', '".$_POST["perfil"]."', 
        //                                            '".$_POST["supervisor"]."')";
        //die();

        mysqli_query($conn, "INSERT INTO usuarios (Nombre, Telefono, CorreoE, Usuario, Contrasenna, Perfil, Supervisor) 
                                            VALUES('".$_POST["nombre"]."', '".$_POST["telefono"]."', '".$_POST["correoe"]."', 
                                                    '".$_POST["usuario"]."', '".md5($_POST["contrasena"])."', '".$_POST["perfil"]."', 
                                                    '".$_POST["supervisor"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el usuario '.$_POST["nombre"].'</div>';
    }

    //editar usuario
    if($_POST["hacer"]=='aeditusuario')
    {
        $sql="UPDATE usuarios SET Nombre='".$_POST["nombre"]."', Telefono='".$_POST["telefono"]."', CorreoE='".$_POST["correoe"]."', Usuario='".$_POST["usuario"]."', Perfil='".$_POST["perfil"]."', Supervisor='".$_POST["supervisor"]."'";
        if($_POST["contrasena"]!='')
        {
            $sql.=", Contrasenna='".md5($_POST["contrasena"])."'";
        }
        $sql.=" WHERE Id='".$_POST["idusuario"]."'";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se edito el usuario '.$_POST["nombre"].'</div>';
    }
}

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
$ResUsuarios = mysqli_query($conn, "SELECT 
                                        u.Id,
                                        u.Nombre,
                                        u.Usuario,
                                        p.Nombre AS NombrePerfil,
                                        COALESCE(us.Nombre, '--') AS Supervisor
                                    FROM usuarios AS u
                                    INNER JOIN perfiles AS p 
                                        ON u.Perfil = p.Id
                                    LEFT JOIN usuarios AS us 
                                        ON u.Supervisor = us.Id
                                    ORDER BY u.Nombre ASC");

while($RResU=mysqli_fetch_array($ResUsuarios))
{
    $cadena.='      <tr>
                        <td align="center">'.$RResU["Id"].'</td>
                        <td>'.($RResU["Id"]!=1 ? (permisos($_SESSION["perfil"], 'edit.usuario') ? '<a href="javascript:void(0)" onclick="edit_usuario(\''.$RResU["Id"].'\')">'.$RResU["Nombre"].'</a>' : $RResU["Nombre"]) : $RResU["Nombre"]).'</td>
                        <td>'.$RResU["Usuario"].'</td>
                        <td>'.$RResU["NombrePerfil"].'</td>
                        <td>'.$RResU["Supervisor"].'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
}
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
            <?php if(permisos($_SESSION["perfil"], 'ver.perfiles')): ?>{
                text: 'Perfiles',
                action: function ( e, dt, node, config ) {
                    perfiles();
                }
            },
            <?php endif; ?>
            <?php if(permisos($_SESSION["perfil"], 'add.usuario')): ?>
            {
                text: 'Agregar Usuario',
                action: function ( e, dt, node, config ) {
                    limpiar();
                    abrirmodal();
                    agregar_usuario();
                }
            },
            <?php endif; ?>
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
    limpiar();
    abrirmodal();
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