//definimos el modal
var modal = document.getElementById('myModal');

function limpiar(){
    document.getElementById("modal-body").innerHTML="";
}

function abrirmodal(){
	modal.style.display = "flex";
}
function cerrarmodal(){
	modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}

//funciones ajax
function dashboard(fechai, fechaf, fechac){
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/dashboard.php',
				data: 'fechai=' + fechai + '&fechaf=' + fechaf + '&fechac=' + fechac
	}).done (function ( info ){
		$('#contenido').html(info);
	});

}
function dashboard_p(promotor){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/dashboard/dashboard_p.php',
		data: 'promotor=' + promotor
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function dashboard_i(inversionista){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/dashboard/dashboard_i.php',
		data: 'inversionista=' + inversionista
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function dashboard_broxel(fechai, fechaf, fechaconsulta){
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/dashboard_broxel.php',
				data: 'fechai=' + fechai + '&fechaf=' + fechaf + '&fechaconsulta=' + fechaconsulta
	}).done (function ( info ){
		$('#contenido').html(info);
	});

}
function cliente(idcliente, destino){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/clientes/cliente.php',
				data: 'idcliente=' + idcliente + '&destino=' + destino
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}
function clientes(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/clientes/clientes.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function pedidos(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/pedidos/pedidos.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}	
function creditos(){
	//Añadimos la imagen de carga en el contenedor
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'mesacontrol/creditos/creditos.php'
	}).done (function ( info ){
		$('#contenido').fadeIn(3000).html(info);
	});
}	
function creditos_broxel(){
	//Añadimos la imagen de carga en el contenedor
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'mesacontrol/creditos/creditos_broxel.php'
	}).done (function ( info ){
		$('#contenido').fadeIn(3000).html(info);
	});
}	
function pedido(idpedido){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/pedidos/pedido.php',
				data: 'idpedido=' + idpedido
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}	
function credito(idcredito)
{
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/creditos/credito.php',
				data: 'idcredito=' + idcredito
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}
function configuracion(){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/configuracion/configuracion.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function maximo_descuento(idcliente, idcredito = 0){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/clientes/max_descuento.php',
                data: 'idcliente=' + idcliente + '&idcredito=' + idcredito
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}
function bitacora(){
	$.ajax({
				type: 'POST',
				url : 'bitacora/bitacora.php',
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function estadisticos()
{
	$.ajax({
				type: 'POST',
				url : 'estadisticos/estadisticos.php',
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}
function estats_i()
{
	$.ajax({
				type: 'POST',
				url : 'estadisticos/estadisticos.php',
	}).done (function ( info ){
		$('#contenido_stat').html(info);
	});
}
function perfil()
{
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/perfil/perfil.php',
	}).done (function ( info ){
	$('#contenido').html(info);
});
}

function diade(){
	$.ajax({
				type: 'POST',
				url : 'diade/diade.php',
	}).done (function ( info ){
		$('#diade').html(info);
	});
}

function leads(){
	//Añadimos la imagen de carga en el contenedor
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/leads.php',
}).done (function ( info ){
$('#contenido').html(info);
});
}

function leads_broxel(){
	//Añadimos la imagen de carga en el contenedor
	$('#contenido').html('<div class="loading"><img src="/images/loading-loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/leads_broxel.php',
}).done (function ( info ){
$('#contenido').html(info);
});
}

function notificaciones(){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/notificaciones/notificaciones.php',
}).done (function ( info ){
$('#contenido').html(info);
});
}

function solvexpress(){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/solvexpress/dashboard.php',
}).done (function ( info ){
$('#contenido').html(info);
});
}

function helpdesk(){
	$.ajax({
		type: 'POST',
		url : 'helpdesk/helpdesk.php',
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}

function logout(compani){
	window.location.href = 'logout.php?f=' + compani;
}




//cerrar sesion
var bloqueo;
function ini(compani) {
    bloqueo = setTimeout('location="logout.php?session=exp&f=' + compani + '"', 3120000);
}

function parar(compani) {
    clearTimeout(bloqueo);
    bloqueo = setTimeout('location="logout.php?session=exp&f=' + compani + '"', 3120000);
}

function logout(compani){
	location="logout.php?session=exp&f=" + compani;
}
//Created with human intelligence by @jkarreno 2023 - 2024 - 2025
//May the force be with you
//move your stars
//always ready