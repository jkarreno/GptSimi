<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$ResS=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM servicios WHERE Id = '".$_POST["id"]."'"));

$cadena='<div class="c100 card">
            <h2>Editar servicio</h2>
            <form name="feditservicio" id="feditservicio">
                <div class="c30">
                    <label class="l_form">Sucursal :</label>
                    <select name="sucursal" id="sucursal">
                        <option value="">Seleccione</option>';
$ResSucursales=mysqli_query($conn, "SELECT * FROM sucursales ORDER BY Nombre ASC");
while($RResSuc=mysqli_fetch_array($ResSucursales))
{
    $cadena.='<option value="'.$RResSuc["Id"].'"'.($RResSuc["Id"]===$ResS["Sucursal"] ? ' selected' : '').'>'.$RResSuc["Nombre"].'</option>';
}
$cadena.='          </select>
                </div>
                <div class="c30">
                    <label class="l_form">Semana Atención :</label>
                    <select name="semanaatencion" id="semanaatencion">
                        <option value="">Seleccione</option>';
$meses = [
        1  => 'Ene',
        2  => 'Feb',
        3  => 'Mar',
        4  => 'Abr',
        5  => 'May',
        6  => 'Jun',
        7  => 'Jul',
        8  => 'Ago',
        9  => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dic'
    ];
$hoy = new DateTime();

$semanaActual = (int)$hoy->format('W');
$anio = (int)$hoy->format('Y');

// El 28 de diciembre siempre pertenece a la última semana ISO del año
$semanasAnio = (int)(new DateTime($anio . '-12-28'))->format('W');

for ($semana = $semanaActual; $semana <= $semanasAnio; $semana++) {

    // Lunes
    $inicioSemana = new DateTime();
    $inicioSemana->setISODate($anio, $semana, 1);

    // Domingo
    $finSemana = clone $inicioSemana;
    $finSemana->modify('+6 days');

    $texto = 'Semana ' . $semana .
             ' del ' . $inicioSemana->format('d') . ' ' . $meses[(int)$inicioSemana->format('m')] .
             ' al ' . $finSemana->format('d') . ' ' . $meses[(int)$finSemana->format('m')];

    $cadena.='<option value="' . $semana . '"' . ($semana == $ResS["SemanaAtencion"] ? ' selected' : '') . '>' . $texto . '</option>';
}
$cadena.='          </select>
                </div>
                <div class="c30">
                    <label class="l_form">Tecnico asignado :</label>
                    <select name="tecnico" id="tecnico">
                        <option value="0">Seleccione</option>';
$ResTecnicos=mysqli_query($conn, "SELECT * FROM usuarios WHERE Perfil = '2' ORDER BY Nombre ASC");
while($RResTec=mysqli_fetch_array($ResTecnicos))
{
    $cadena.='<option value="'.$RResTec["Id"].'"'.($RResTec["Id"]===$ResS["TecnicoAsignado"] ? ' selected' : '').'>'.$RResTec["Nombre"].'</option>';
}
$cadena.='          </select>
                </div>
                <div class="c100">
                    <label class="l_form">Observaciones :</label>
                    <textarea name="observaciones" id="observaciones" rows="4">'.$ResS["Observaciones"].'</textarea>
                </div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="editservicio">
                    <input type="hidden" name="id" id="id" value="'.$ResS["Id"].'">
                    <input type="submit" name="botadservicio" id="botadservicio" value="Editar>>" onclick="cerrarmodal()">
                </div>
            </form>
        </div>';

echo $cadena; 

?>
<script>
$("#feditservicio").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("feditservicio"));

	$.ajax({
		url: "servicios/servicios.php",
		type: "POST",
		dataType: "HTML",
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done(function(echo){
		$("#contenido").html(echo);
	});
});
</script>

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>