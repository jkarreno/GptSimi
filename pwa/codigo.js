function agregar_servicio_pwa(){
    window.location.href = 'agregar_servicio_pwa.php';
}
function DetallesServicio(id){
    window.location.href = 'servicio_pwa.php?id='+id;
}
function InicioServicio(id, idtecnico, latitud, longitud){
    window.location.href = 'servicio_pwa.php?id='+id+'&latitud='+latitud+'&longitud='+longitud+'&idtecnico='+idtecnico+'&hacer=inicioservicio';
}