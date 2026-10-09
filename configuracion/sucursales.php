<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["hacer"]))
{
    //agregar sucursal
    if($_POST["hacer"]=='addsucursal')
    {
        mysqli_query($conn, "INSERT INTO sucursales (Zona, NumSucursal, Nombre, Direccion, Estado,Telefono, Responsable, CorreoE) 
                                            VALUES('".$_POST["zona"]."', '".$_POST["num_sucursal"]."', '".$_POST["nombre"]."', 
                                                    '".$_POST["direccion"]."', '".$_POST["estado"]."', '".$_POST["telefono"]."', 
                                                    '".$_POST["responsable"]."', '".$_POST["correoe"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego la sucursal '.$_POST["nombre"].'</div>';
    }
    //editar sucursal
    if($_POST["hacer"]=='editsucursal')
    {
        mysqli_query($conn, "UPDATE sucursales SET Zona='".$_POST["zona"]."', 
                                                    NumSucursal='".$_POST["num_sucursal"]."', 
                                                    Nombre='".$_POST["nombre"]."', 
                                                    Direccion='".$_POST["direccion"]."', 
                                                    Estado='".$_POST["estado"]."', 
                                                    Telefono='".$_POST["telefono"]."', 
                                                    Responsable='".$_POST["responsable"]."', 
                                                    CorreoE='".$_POST["correoe"]."' 
                                            WHERE Id='".$_POST["id_sucursal"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se edito la sucursal '.$_POST["nombre"].'</div>';
    }
    //eliminar sucursal
    if($_POST["hacer"]=='delsucursal')
    {
        mysqli_query($conn, "UPDATE sucursales SET Activo = 0 WHERE Id='".$_POST["id_sucursal"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se elimino la sucursal '.$_POST["nombre"].'</div>';
    }
}

$cadena=$mensaje.'<div class="c100 card agc ber bff bfz">
            <h2><i class="ri-building-4-fill"></i> Sucursales</h2>
            <table id="table_sucursales" class="stripe row-border order-column nowrap">
                <thead>
                    <tr>
                        <th>Num. Sucursal</th>
                        <th>Zona</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
$ResSucursales=mysqli_query($conn, "SELECT * FROM sucursales WHERE Activo = 1");
while($RResSuc=mysqli_fetch_array($ResSucursales))
{
    $cadena.='      <tr>
                        <td>'.$RResSuc["NumSucursal"].'</td>
                        <td>'.$RResSuc["Zona"].'</td>
                        <td>'.$RResSuc["Nombre"].'</td>
                        <td>'.$RResSuc["Direccion"].'</td>
                        <td>'.$RResSuc["Telefono"].'</td>
                        <td>'.$RResSuc["Responsable"].'</td>
                        <td><a href="javascript:void(0)" onclick="editar_sucursal('.$RResSuc["Id"].')"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" onclick="eliminar_sucursal()"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>';
}
$cadena.='      </tbody>
            </table>
        </div>';

echo $cadena;
?>
<script>
    $('#table_sucursales').DataTable({
        dom: 'Bfrtip',
        buttons: [
            <?php if(permisos($_SESSION["perfil"], 'add.sucursal')): ?>
            {
                text: 'Agregar Sucursal',
                action: function ( e, dt, node, config ) {
                    agregar_sucursal();
                }
            }
            <?php endif; ?>   
        ],
        paging: false
    });

function agregar_sucursal(){
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'configuracion/agregar_sucursal.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function editar_sucursal(idsucursal){
    abrirmodal();
    $.ajax({
                type: 'POST',
                url : 'configuracion/editar_sucursal.php',
                data: { id: idsucursal }
    }).done (function ( info ){
        $('#modal-body').html(info);
    });
}

function eliminarSucursal(idsucursal) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {

        $.ajax({
            url: 'configuracion/sucursales.php',
            type: 'POST',
            data: {
                idsucursa: idsucursa,
                hacer: 'delsucursal'
            },
        });

    }
}
</script>