<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$cadena='<div class="c100 card">
            <h2>Importar Sucursales</h2>
            <form name="fimpucursal" id="fimpucursal" enctype="multipart/form-data">
                <div class="c100">
                    <h2 style="display: block; text-align: left !important; width: 100%;">Archivo de Sucursales</h2>
				    <label for="custom-file-upload" class="filupp">
                        <span class="filupp-file-name js-value">Buscar Archivo</span>
                        <input type="file" name="fis" accept=".csv" id="custom-file-upload"/>
                    </label>
                </div>
                <div class="c100">
                    <input type="hidden" name="hacer" id="hacer" value="importarsucursal">
                    <input type="submit" name="botimpucursal" id="botimpucursal" value="Importar>>" onclick="cerrarmodal()">    
                </div>
            </form>
        </div>';

echo $cadena;
?>

<script>
$("#fimpucursal").on("submit", function(e){
	e.preventDefault();
    
	var formData = new FormData(document.getElementById("fimpucursal"));

	$('#contenido').html('<div class="loading"><img src="../images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
		url: "configuracion/sucursales.php",
		type: "POST",
		dataType: "HTML",
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done(function(echo){
		$("#contenido2").html(echo);
	});
});

//funciones input file
$(document).on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);
	
	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

	if(fileSize > 2000000){
		alert('El archivo no debe superar los 2MB');
		this.value = '';
		this.files[0].name = '';
	}else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();
		
		// Convertimos en minúscula porque 
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();
    
		// console.log(ext);
		switch (ext) {
			case 'csv': break;
			default:
				alert('El archivo no tiene la extensión adecuada');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}

});

$(document).ready(function() {

// get the name of uploaded file
  $('input[type="file"]').change(function(){
      var value = $("input[type='file']").val();
      $('.js-value').text(value);
  });

});
</script>

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>
