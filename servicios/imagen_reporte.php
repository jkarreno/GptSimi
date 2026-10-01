<?php
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
session_start();

include("../conexion.php");
include("../funciones.php");

$ResImg = mysqli_fetch_array(mysqli_query($conn, "SELECT sc.Id, sc.Archivo, ci.Nombre AS TipoImagen
                                                    FROM servicios_capturas AS sc
                                                    INNER JOIN cat_imagenes AS ci ON ci.Id = sc.IdCaptura
                                                    WHERE sc.Id = '".$_POST["idcaptura"]."' LIMIT 1"));

$mensaje='';

$cadena = '<div class="c100 card" style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                <div class="c40">
                    <h2><i class="ri-camera-line"></i> Imagen reporte</h2>
                    <img src="pwa/files/'.$ResImg["Archivo"].'" style="width: 100%">
                </div>
                <div class="c40">
                    <form name="fautcaptura" id="fautcaptura">
                        <div class="c100">
                            <label class="l_form">Tipo de Imagen</label>
                            <input type="text" value="'.$ResImg["TipoImagen"].'" disabled>
                        </div>
                        <div class="c100">
                            <label class="l_form">Comentarios</label>
                            <input type="text" name="comentarios" id="comentarios">
                        </div>
                        <div class="c100">
                            <label class="l_form">Autorizar</label>
                            <ul class="tg-list">
                                <li class="tg-list-item">
                                    <input class="tgl tgl-light" id="autorizar_img" name="autorizar_img" type="checkbox" value="1">
                                    <label class="tgl-btn" for="autorizar_img"></label>
                                </li>
                            </ul>
                        </div>
                        <div class="c100">
                            <input type="hidden" name="idcaptura" id="idcaptura" value="'.$ResImg["Id"].'">
                            <input type="hidden" name="hacer" id="hacer" value="autorizarcaptura">
                            <input type="submit" name="bot_autorizar" id="bot_autorizar" value="Enviar>>">
                        </div>
                    </form>
                </div>
            </div>';

echo $cadena;
?>

<script>
$("#fautcaptura").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("fautcaptura"));

    cerrarmodal();
	$.ajax({
		url: "dashboard/dashboard.php",
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