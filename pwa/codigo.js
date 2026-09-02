function agregar_servicio_pwa(){
    window.location.href = 'agregar_servicio_pwa.php';
}
function DetallesServicio(id){
    window.location.href = 'servicio_pwa.php?id='+id;
}
function InicioServicio(id, idtecnico, latitud, longitud){
    window.location.href = 'servicio_pwa.php?id='+id+'&latitud='+latitud+'&longitud='+longitud+'&idtecnico='+idtecnico+'&hacer=inicioservicio';
}
function capturarImagen(id, tipoimagen){
    limpiar();
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'capturar_imagen_pwa.php',
                data: 'id=' + id + '&tipoimagen=' + tipoimagen,
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}
function FinServicio(id, idtecnico, latitud, longitud, notas){
    window.location.href = 'servicios_pwa.php?id='+id+'&latitud='+latitud+'&longitud='+longitud+'&idtecnico='+idtecnico+'&hacer=finservicio&serviceNotes='+notas;
}