<?php
include ("../conexion.php");
include ("../funciones.php");

$ResImagen = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM cat_imagenes WHERE Id = '".$_POST["tipoimagen"]."' LIMIT 1"));

$documento='<h3 class="text-body-lg font-bold text-on-surface border-b border-outline-variant pb-2">Captura una fotografia de: </h3> 
            <h2 class="text-headline-md-mobile md:text-headline-md text-on-surface mb-xs" style="margin-bottom: 20px">'.$ResImagen["Nombre"].'</h2>';  
if(file_exists('files/'.$_POST["id"].'_'.$ResImagen["Id"].'.jpg')){$preview='<img src="files/'.$_POST["id"].'_'.$ResImagen["Id"].'.jpg?'.rand(1,100).'">';}
else{$preview='';}


$cadena='<form name="fimgev" id="fimgev" enctype="multipart/form-data" style="width: 100%;" method="post" action="servicio_pwa.php?id='.$_POST["id"].'">
            <div class="c100">
                '.$documento.'
                <input type="file" id="imageInput" name="imageInput" accept="image/*">
                <button type="button" class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" id="cameraButton" class="boton">Abrir Cámara</button>
                <button type="button" class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" id="captureButton" class="boton" style="display: none;">Capturar Imagen</button>
            </div>
            
            <div class="c100" id="preview">'.$preview.'</div>

            <video id="video" autoplay></video>
            <canvas id="canvas" style="display: none;"></canvas>
                
            <div class="c100">
                <input type="hidden" name="id" id="id" value="'.$_POST["id"].'">
                <input type="hidden" name="tipoimagen" id="tipoimagen" value="'.$_POST["tipoimagen"].'">
                <input type="hidden" name="hacer" id="hacer" value="guardadoc">
                <input type="submit" class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" name="botsendcontact" id="botsendcontact" value="Guardar">
            </div>
        </form>';

echo $cadena;

?>
<style>
#preview img, #preview video{
    width: 100% !important;
}
</style>

<script>
$("#fimgev").on("submit", function(e){
    cerrarmodal();
    irAlTop();
    $('#contenido').html('<div class="loading"><img src="../images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');
	e.preventDefault();
	var formData = new FormData(document.getElementById("fimgev"));

	$.ajax({
        url: "servicio_pwa.php",
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

<script> 
$(document).ready(function(){ 
    var video = document.getElementById('video'); 
    var canvas = document.getElementById('canvas'); 
    var preview = $('#preview'); 

    $('#imageInput').change(function(event){ 
        var reader = new FileReader(); 
        reader.onload = function(){ 
            var img = $('<img>').attr('src', reader.result); 
            preview.html(img); 
        } 
        reader.readAsDataURL(event.target.files[0]); 
    }); 

    $('#cameraButton').click(function(){ 
        navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: { exact: "environment" } } // Usar la cámara trasera
        }).then(function(stream) { 
            video.srcObject = stream; 
            video.style.display = 'block'; 
            preview.html(video); 
            $('#captureButton').show(); // Mostrar el botón de captura
        }).catch(function(err) { 
            console.error("Error al acceder a la cámara: " + err); 
            alert("No se pudo acceder a la cámara trasera. Usando la cámara predeterminada.");

            // Fallback a la cámara predeterminada si la trasera no está disponible
            navigator.mediaDevices.getUserMedia({ 
                video: true 
            }).then(function(stream) {
                video.srcObject = stream; 
                video.style.display = 'block'; 
                preview.html(video); 
                $('#captureButton').show(); // Mostrar el botón de captura
            }).catch(function(err) {
                console.error("Error al acceder a la cámara: " + err);
            });
        }); 
    });


    $('#captureButton').click(function(){ 
        var context = canvas.getContext('2d'); 
        canvas.width = video.videoWidth; 
        canvas.height = video.videoHeight; 
        context.drawImage(video, 0, 0, canvas.width, canvas.height); 
        
        var imgData = canvas.toDataURL('image/jpeg'); 
        var img = $('<img>').attr('src', imgData); 
        preview.html(img); 
        
        // Crear un archivo a partir de la imagen capturada
        var blob = dataURLToBlob(imgData); 
        var file = new File([blob], 'captura.jpg', { type: 'image/jpeg' });
        
        // Añadir el archivo al formulario existente
        $('#imageInput')[0].files = new DataTransfer().files; // Reiniciar input
        var dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        $('#imageInput')[0].files = dataTransfer.files;
        
        video.pause(); 
        video.srcObject.getTracks().forEach(track => track.stop()); 
        video.style.display = 'none'; 
        $('#captureButton').hide();
    });

    function dataURLToBlob(dataURL) {
    var byteString = atob(dataURL.split(',')[1]);
    var mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: mimeString });
}  
});
</script>