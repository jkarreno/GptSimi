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
        mysqli_query($conn, "INSERT INTO sucursales (NumSucursal, Nombre, Direccion, Telefono, Responsable, CorreoE) 
                                            VALUES('".$_POST["num_sucursal"]."', '".$_POST["nombre"]."', '".$_POST["direccion"]."', 
                                                    '".$_POST["telefono"]."', '".$_POST["responsable"]."', '".$_POST["correoe"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego la sucursal '.$_POST["nombre"].'</div>';
    }
}

$cadena=$mensaje.'<div class="c100 card agc ber bff bfz">
            <h2><i class="ri-building-4-fill"></i> Sucursales</h2>
            <table id="table_sucursales" class="stripe row-border order-column nowrap">
                <thead>
                    <tr>
                        <th>Num. Sucursal</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
$ResSucursales=mysqli_query($conn, "SELECT * FROM sucursales");
while($RResSuc=mysqli_fetch_array($ResSucursales))
{
    $cadena.='      <tr>
                        <td>'.$RResSuc["NumSucursal"].'</td>
                        <td>'.$RResSuc["Nombre"].'</td>
                        <td>'.$RResSuc["Direccion"].'</td>
                        <td>'.$RResSuc["Telefono"].'</td>
                        <td>'.$RResSuc["Responsable"].'</td>
                        <td><i class="fa-solid fa-pen-to-square"></i> <i class="fa-solid fa-trash"></i></td>
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
</script>