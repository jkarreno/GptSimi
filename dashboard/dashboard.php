<?php
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["hacer"]))
{
    if($_POST["hacer"]=='autorizarcaptura')
    {
        if($_POST["autorizar_img"]==1){$estatus = 'Autorizada';} else {$estatus = 'Rechazada';}

        mysqli_query($conn, "UPDATE servicios_capturas SET Estatus = '".$estatus."',
                                                            Comentarios = '".$_POST["comentarios"]."'
                                                    WHERE Id = '".$_POST["idcaptura"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje">Se '.($_POST["autorizar_img"]==1 ? 'autorizo' : 'rechazo').'la imagen</div>';
    }
}


$cadena=$mensaje.'<div class="c100 agc akr ber bff bfz" style="display: flex; flex-wrap: wrap; align-items: center; align-content: center; justify-content: flex-start; margin-bottom: 20px; border: 1px solid #e7e7e7;">
            <div class="c100 card" style="border: 0; box-shadow:none; background-color: transparent;">
                <h2><i class="ri-camera-line"></i> Imagenes recientes</h2>
                <table id="table_images_servicios" class="stripe row-border order-column nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="tleads">Num. Servicio</th>
                            <th class="tleads">Fecha</th>
                            <th class="tleads">Sucursal</th>
                            <th class="tleads">Tecnico</th>
                            <th class="tleads">Supervisor</th>
                            <th class="tleads">Tipo de Evidencia</th>
                            <th class="tleads">Captura</th>
                    </thead>
                    <tbody>';
$ResImgs = mysqli_query($conn, "SELECT sc.Id, sc.IdServicio, sc.Fecha, sc.IdCaptura, suc.NumSucursal, suc.Nombre AS NombreSucursal, u.Nombre AS NombreTecnico, 
                                    us.Nombre AS NombreSupervisor, ci.Nombre AS Captura
                                FROM servicios_capturas AS sc 
                                INNER JOIN servicios AS s ON sc.IdServicio = s.Id
                                INNER JOIN sucursales AS suc ON s.Sucursal = suc.Id
                                INNER JOIN usuarios AS u ON u.Id = sc.IdTecnico
                                INNER JOIN usuarios AS us ON us.Id = u.Supervisor
                                INNER JOIN cat_imagenes AS ci ON ci.Id = sc.IdCaptura
                                WHERE sc.Estatus = 'Validar' AND sc.Comentarios IS NULL");
while($RResImgs = mysqli_fetch_array($ResImgs))
{
    $cadena.='          <tr>
                            <td>'.$RResImgs["IdServicio"].'</td>
                            <td>'.fecha(date('Y-m-d', $RResImgs["Fecha"])).'</td>
                            <td>'.$RResImgs["NumSucursal"].' - '.$RResImgs["NombreSucursal"].'</td>
                            <td>'.$RResImgs["NombreTecnico"].'</td>
                            <td>'.$RResImgs["NombreSupervisor"].'</td>
                            <td>'.$RResImgs["Captura"].'</td>
                            <td><a href="javascript:void(0):" onclick="imagen_reporte(\''.$RResImgs["Id"].'\')"><i class="ri-image-2-line"></i></a></td>
                        </tr>';
}
$cadena.='          </tbody>
                </table>
            </div>
        </div>';

echo $cadena;
?>
<script>
$(document).ready( function () {
    var table = $('#table_images_servicios').DataTable({
        language: {
            decimal: '.',
            thousands: ',',
            url: 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        paging: false,
        order: [[1, 'desc']]
    });
});

function imagen_reporte(idcaptura){
    limpiar();
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'servicios/imagen_reporte.php',
                data: {idcaptura:idcaptura}
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}
</script>