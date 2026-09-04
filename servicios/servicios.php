<?php
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");
$mensaje="";

$cadena=$mensaje;

if(isset($_POST["hacer"]))
{
    if($_POST["hacer"]=="addservicio")
    {
        mysqli_query($conn, "INSERT INTO servicios (Sucursal, FechaAsignacion, SemanaAtencion, Estatus, TecnicoAsignado, Observaciones) 
                                            VALUES ('".$_POST["sucursal"]."', '".time()."', '".$_POST["semanaatencion"]."', 
                                                    '".($_POST["tecnico"]==0 ? '1' : '2')."', '".$_POST["tecnico"]."', 
                                                    '".$_POST["observaciones"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el servicio correctamente</div>';
    }
    if($_POST["hacer"]=="editservicio")
    {
        mysqli_query($conn, "UPDATE servicios SET Sucursal = '".$_POST["sucursal"]."', 
                                                    SemanaAtencion = '".$_POST["semanaatencion"]."', 
                                                    TecnicoAsignado = '".$_POST["tecnico"]."', 
                                                    Observaciones = '".$_POST["observaciones"]."' ".($_POST["tecnico"]>0 ? ", Estatus = '2'" : "")."
                                            WHERE Id = '".$_POST["id"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se actualizo el servicio correctamente</div>';
    }
}


$cadena.=$mensaje.'<div class="c100 agc ber bff bfz card" id="tabla_leads">
            <h2><i class="fa-solid fa-house-laptop"></i> Servicios</h2>
            <table id="table_servicios" class="stripe row-border order-column nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="tleads">Num. Servicio</th>
                        <th class="tleads">Sucursal</th>
                        <th class="tleads">Tecnico</th>
                        <th class="tleads">Fecha Asignación</th>
                        <th class="tleads">Semana Atención</th>
                        <th class="tleads">Fecha Atención</th>
                        <th class="tleads">Fecha Finalización</th>
                        <th class="tleads">Estatus</th>
                        <th class="tleads">Reporte</th>
                </thead>
                <tbody>';
$ResServicios = mysqli_query($conn, "SELECT s.Id, su.Nombre AS NombreSucursal, u.Nombre AS NombreTecnico, 
                                            s.FechaAsignacion, s.SemanaAtencion, s.FechaAtencion, ce.Estatus, ce.Color, 
                                            s.InicioServicio, s.FinServicio
                                    FROM servicios AS s
                                    LEFT JOIN sucursales AS su ON s.Sucursal = su.Id
                                    LEFT JOIN usuarios AS u ON s.TecnicoAsignado = u.Id
                                    LEFT JOIN cat_estatus AS ce ON s.Estatus = ce.Id
                                    ORDER BY s.Id DESC");
while($RResS=mysqli_fetch_array($ResServicios))
{
    if($RResS["InicioServicio"]!=NULL)
    {
        $inisios = explode("|", $RResS["InicioServicio"]);
        $fechainisio = fecha(date("Y-m-d", $inisios[0]));
    }
    elseif($RResS["InicioServicio"]==NULL)
    {
        $fechainisio = '---';
    }

    if($RResS["FinServicio"]!=NULL)
    {
        $fins = explode("|", $RResS["FinServicio"]);
        $fechafin = fecha(date("Y-m-d", $fins[0]));
    }
    elseif($RResS["FinServicio"]==NULL)
    {
        $fechafin = '---';
    }



    $cadena.='      <tr>
                        <td align="center">'.(permisos($_SESSION["perfil"], 'edit.servicio') ? '<a href="javascript:void(0)" onclick="editar_servicio(\''.$RResS["Id"].'\')">'.$RResS["Id"].'</a>' : $RResS["Id"]).'</td>
                        <td>'.$RResS["NombreSucursal"].'</td>
                        <td>'.$RResS["NombreTecnico"].'</td>
                        <td>'.($RResS["FechaAsignacion"]>0 ? date("d/m/Y H:i:s", $RResS["FechaAsignacion"]) : '').'</td>    
                        <td>'.$RResS["SemanaAtencion"].'</td>
                        <td>'.$fechainisio.'</td>
                        <td>'.$fechafin.'</td>
                        <td><span class="estatus" style="background-color: '.$RResS["Color"].'; margin-left: 15px; margin-right: 15px">'.$RResS["Estatus"].'</span></td>
                        <td align="center">'.(permisos($_SESSION["perfil"], 'view.reporte') ? '<a href="javascript:void(0)" onclick="reporte_servicio(\''.$RResS["Id"].'\')"><i class="ri-file-list-3-line"></i></a>' : '').'</td>
                    </tr>';
}   
$cadena.='      </tbody>
            </table>
        </div>';

echo $cadena;
?>
<script>
$(document).ready( function () {
    var table = $('#table_servicios').DataTable({
        language: {
            decimal: '.',
            thousands: ',',
            url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        buttons: [
            <?php if(permisos($_SESSION["perfil"], 'add.servicio')): ?>{
                text: 'Nuevo Servicio',
                action: function ( e, dt, node, config ) {
                    agregar_servicio();
                }
            }
            <?php endif; ?>
        ],
        paging: false,
        order: [[0, 'desc']]
    });
} );

function agregar_servicio(){
    limpiar();
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'servicios/agregar_servicio.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function editar_servicio(id){
    limpiar();
    abrirmodal();
    $.ajax({
                type: 'POST',
                url : 'servicios/editar_servicio.php',
                data: {id:id}
    }).done (function ( info ){
        $('#modal-body').html(info);
    });
}

//mostrar mensaje despues de los cambios
setTimeout(function() { 
    $('#mesaje').fadeOut('fast'); 
}, 1000)
</script>
