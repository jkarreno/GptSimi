<?php
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["fechadesde"])){$fechadesde = $_POST["fechadesde"];}else{$fechadesde = date('Y-m-d');}
if(isset($_POST["fechahasta"])){$fechahasta = $_POST["fechahasta"];}else{$fechahasta = date('Y-m-d');}
if(isset($_POST["estado"])){$estado = $_POST["estado"];}else{$estado = 0;}
if(isset($_POST["coordinador"])){$coordinador = $_POST["coordinador"];}else{$coordinador = 0;}

$cadena=$mensaje.'<div class="c100 agc akr ber bff bfz" style="display: flex; flex-wrap: wrap; align-items: center; align-content: center; justify-content: flex-start; margin-bottom: 20px; border: 1px solid #e7e7e7;">
            <div class="c100 card" style="border: 0; box-shadow:none; background-color: transparent;">
                <h2><i class="ri-file-text-line"></i> Consultorios concluidos</h2>
                <form>
                    <div class="c30">
                        <label class="l_form">Total:</label>
                        <input type="text" name="total" id="total" value="" disabled>
                    </div>
                    <div class="c30">
                        <label class="l_form">Fecha Desde:</label>
                        <input type="date" name="fechaconsultadesde" id="fechaconsultadesde" value="'.$fechadesde.'" onchange="consultar_reporte()">
                    </div>
                    <div class="c30">
                        <label class="l_form">Fecha Hasta:</label>
                        <input type="date" name="fechaconsultahasta" id="fechaconsultahasta" value="'.$fechahasta.'" onchange="consultar_reporte()">
                    </div>
                    <div class="c30">
                        <label class="l_form">Monto</label>
                        <input type="text" name="monto" id="monto" value="" disabled>
                    </div>

                    <div class="c30">
                        <label class="l_form">Corte de Pago</label>
                        <input type="text" name="corte" id="corte" value="" disabled>
                    </div>
                    <div class="c30">
                        <label class="l_form">Zona</label>
                        <input type="text" name="zona" id="zona" value="" disabled>
                    </div>
                    <div class="c30"></i>
                        <label class="l_form">Estado</label>
                        <select name="estado" id="estado" onchange="consultar_reporte()">
                            <option value="0">Todos</option>';
$ResEstados =mysqli_query($conn, "SELECT * FROM cat_estados ORDER BY Estado ASC");
while($RResEstados = mysqli_fetch_array($ResEstados))
{
    $cadena.='              <option value="'.$RResEstados["Id"].'">'.$RResEstados["Estado"].'</option>';
}
$cadena.='              </select>
                    </div>
                    <div class="c30">
                        <label class="l_form">Coordinador</label>
                        <select name="coordinador" id="coordinador" onchange="consultar_reporte()">
                            <option value="0">Todos</option>';
$ResCoordinadores =mysqli_query($conn, "SELECT * FROM usuarios WHERE Perfil = 3 ORDER BY Nombre ASC");
while($RResCoordinadores = mysqli_fetch_array($ResCoordinadores))
{
    $cadena.='              <option value="'.$RResCoordinadores["Id"].'">'.$RResCoordinadores["Nombre"].'</option>';
}
$cadena.='              </select>
                    </div>
                    <div class="c30">
                        <button 
                            name="btnreporte" 
                            id="btnreporte" 
                            class="boton" 
                            onclick="generar_reporte()">
                           Generar Reporte
                        </button>
                    </div>
                </form>
                <table id="table_reporte_pago" class="stripe row-border order-column nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="tleads">Num. Servicio</th>
                            <th class="tleads">Num. Consultorio</th>
                            <th class="tleads">Nombre Consultorio</th>
                            <th class="tleads">Fecha Atención</th>
                            <th class="tleads">Pago</th>
                            <th class="tleads">Status Pago</th>
                    </thead>
                    <tbody>';
$ResCorteDía = mysqli_query($conn, "SELECT s.Id, s.EstatusPago, s.Pago, s.FinServicio, su.NumSucursal, su.Nombre AS NombreSucursal
                                    FROM servicios AS s
                                    INNER JOIN sucursales AS su ON s.Sucursal = su.Id
                                    INNER JOIN usuarios AS u ON s.TecnicoAsignado = u.Id
                                    INNER JOIN usuarios AS c ON u.Supervisor = c.Id
                                    WHERE s.FinServicio IS NOT NULL
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) >= UNIX_TIMESTAMP('".$fechadesde." 00:00:00')
                                    AND CAST(SUBSTRING_INDEX(s.FinServicio, '|', 1) AS UNSIGNED) <= UNIX_TIMESTAMP('".$fechahasta." 23:59:59')
                                    AND ".($estado>0 ? "su.Estado = '".$estado."'" : "(su.Estado LIKE '%' OR su.Estado IS NULL)")."
                                    AND ".($coordinador>0 ? "c.Id = '".$coordinador."'" : "(c.Id LIKE '%' OR c.Id IS NULL)")) or die(mysqli_error($conn));
$totalPago = 0;
$NumRegistros = mysqli_num_rows($ResCorteDía);
while($RResCD=mysqli_fetch_array($ResCorteDía))
{
    $cadena.='      <tr>
                        <td class="tleads">'.$RResCD["Id"].'</td>
                        <td class="tleads">'.$RResCD["NumSucursal"].'</td>
                        <td class="tleads">'.$RResCD["NombreSucursal"].'</td>
                        <td class="tleads">'.fecha(date("Y-m-d", explode("|", $RResCD["FinServicio"])[0])).'</td>
                        <td class="tleads"><input type="number" class="form-control cantidad" data-id="'.$RResCD["Id"].'" value="'.($RResCD["Pago"]>0 && $RResCD["Pago"]!==null ? $RResCD["Pago"] : '0.00').'" min="0" step="1"></td>
                        <td class="tleads">'.$RResCD["EstatusPago"].'</td>
                    </tr>';
    $totalPago += ($RResCD["Pago"]>0 && $RResCD["Pago"]!==null ? $RResCD["Pago"] : 0);
}

$cadena.='          </tbody>
                </table>
            </div>
        </div>';

echo $cadena;
?>
<script>
$(document).ready(function () {
    $("#monto").val("<?php echo "$ ".number_format($totalPago, 2, '.', ''); ?>");
    $("#total").val("<?php echo $NumRegistros; ?>");


    var table = $('#table_reporte_pago').DataTable({
        language: {
            decimal: '.',
            thousands: ',',
            url: 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        },
        dom: 'Bfrtip',
        paging: false,
        order: [[1, 'asc']]
    });

    // Detectar cambios en los inputs
    $('#table_reporte_pago tbody').on('change', '.cantidad', function () {

        const $inputs = $('#table_reporte_pago tbody .cantidad');

        // Identificar el primer registro de la tabla
        const primerInput = table
            .rows()
            .nodes()
            .to$()
            .find('.cantidad')
            .first()[0];

        let registros = [];

        // Si cambia el primer input, actualizar todos
        if (this === primerInput) {

            const valor = $(this).val();

            $inputs.val(valor);

            $inputs.each(function () {
                registros.push({
                    id: $(this).data('id'),
                    cantidad: $(this).val()
                });
            });

        } else {

            // Si cambia otro input, actualizar solamente ese
            registros.push({
                id: $(this).data('id'),
                cantidad: $(this).val()
            });

        }

        calcularTotal();

        // Enviar los cambios a PHP
        $.ajax({
            url: 'reportes/guardar_pagos.php',
            type: 'POST',
            dataType: 'json',
            data: {
                registros: JSON.stringify(registros)
            },

            success: function (respuesta) {

                if (respuesta.ok) {
                    console.log('Cambios guardados correctamente');
                } else {
                    console.error(respuesta.mensaje);
                }

            },

            error: function (xhr) {
                console.error(
                    'Error al guardar los cambios:',
                    xhr.responseJSON?.mensaje || 'Error de comunicación'
                );
            }
        });

    });
});

function consultar_reporte()
{
    var fechadesde = $("#fechaconsultadesde").val();
    var fechahasta = $("#fechaconsultahasta").val();
    var estado = $("#estado").val();
    var coordinador = $("#coordinador").val();

    $.ajax({
        type: "POST",
        url: "reportes/reportes.php",
        data: {fechadesde: fechadesde, fechahasta: fechahasta, estado: estado, coordinador: coordinador},
        success: function(data) {
            $("#contenido").html(data);
        }
    });
}

function generar_reporte()
{
    var fechadesde = $("#fechaconsultadesde").val();
    var fechahasta = $("#fechaconsultahasta").val();
    var estado = $("#estado").val();
    var coordinador = $("#coordinador").val();

    window.open("reportes/reporte_pago.php?fechadesde=" + fechadesde + "&fechahasta=" + fechahasta + "&estado=" + estado + "&coordinador=" + coordinador, "_blank");
}

function calcularTotal() {

    let total = 0;

    $('#table_reporte_pago tbody .cantidad').each(function () {

        const valor = parseFloat($(this).val());

        if (!isNaN(valor)) {
            total += valor;
        }

    });

    $('#monto').val('$'+total.toFixed(2));
}
</script>
