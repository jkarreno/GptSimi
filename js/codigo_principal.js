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
function configuracion(){
	//Añadimos la imagen de carga en el contenedor
	$('#contenido').html('<div class="loading"><img src="/images/loading-forever.gif" alt="loading" width="60px" /></div>');

	$.ajax({
				type: 'POST',
				url : 'configuracion/configuracion.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}


function logout(){
	window.location.href = 'logout.php';
}




//cerrar sesion
var bloqueo;
function ini() {
    bloqueo = setTimeout('location="logout.php?session=exp"', 3120000);
}

function parar() {
    clearTimeout(bloqueo);
    bloqueo = setTimeout('location="logout.php?session=exp"', 3120000);
}

function logout(compani){
	location="logout.php?session=exp&f=" ;
}


//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared