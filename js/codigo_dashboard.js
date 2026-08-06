//funciones
function estatus_kyc(idcredito, idestatus){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_kyc.php',
                data: 'idcredito=' + idcredito + '&idestatus=' + idestatus
	}).done (function ( info ){
		$('#kyc_' + idcredito).html(info);
	});
}

function estatus_general(id, idestatus, tipo){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_general.php',
                data: 'id=' + id + '&idestatus=' + idestatus + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_general_' + id).html(info);
	});
}

function estatus_generalista(id, idestatus, tipo){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_generalista.php',
                data: 'id=' + id + '&idestatus=' + idestatus + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_generalista_' + id).html(info);
	});
}

function estatus_operaciones(id, idestatus, tipo){
	$.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_operaciones.php',
                data: 'id=' + id + '&idestatus=' + idestatus + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_operaciones_' + id).html(info);
	});
}

function comentarios_kyc(idcredito, comentarios, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/comentarios_kyc.php',
                data: 'idcredito=' + idcredito + '&comentarios=' + comentarios + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_comen_kyc_' + idcredito).html(info);
	});
}

function comentarios_pt(idcredito, comentarios, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/comentarios_pt.php',
                data: 'idcredito=' + idcredito + '&comentarios=' + comentarios + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_comen_pt_' + idcredito).html(info);
	});
}

function fecha_firma(idcredito, fechafirma, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/fecha_firma.php',
                data: 'idcredito=' + idcredito + '&fechafirma=' + fechafirma + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_fechafirma_' + idcredito).html(info);
	});
}

function fecha_desenbolso(idcredito, fechadesenbolso, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/fecha_desenbolso.php',
                data: 'idcredito=' + idcredito + '&fechadesenbolso=' + fechadesenbolso + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_fechaDesenbolso_' + idcredito).html(info);
	});
}
function fecha_alta(idcredito, fechaalta, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/fecha_alta.php',
                data: 'idcredito=' + idcredito + '&fechaalta=' + fechaalta + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_fechaAlta_' + idcredito).html(info);
	});
}

function estatus_sgcm(id, idestatus, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_sgcm.php',
                data: 'id=' + id + '&idestatus=' + idestatus + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_estatussgcm_' + id).html(info);
	});
}

function comentarios_sgcm(id, comentarios, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/comentarios_sgcm.php',
                data: 'id=' + id + '&comentarios=' + comentarios + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_comen_sgcm_' + id).html(info);
	});
}

function estatus_ff(id, idestatus, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/estatus_ff.php',
                data: 'id=' + id + '&idestatus=' + idestatus + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_estatusff_' + id).html(info);
	});
}

function fecha_pago_solve(id, fechapagosolve, tipo){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/fecha_pago_solve.php',
                data: 'id=' + id + '&fechapagosolve=' + fechapagosolve + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_fechaPagoSolve_' + id).html(info);
	});
}

function registrar_credito(){
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/creditos/registrar_credito.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function edit_deuda_d(idcredito, deuda, tipo){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/dashboard/edit_deuda.php',
		data: 'idcredito=' + idcredito + '&deuda=' + deuda + '&tipo=' + tipo
	}).done (function ( info ){
		$('#' + tipo + '_deuda_' + idcredito).html(info);
	});

	setTimeout(function(){
        $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/edit_cash.php',
                data: 'idcredito=' + idcredito 
        }).done (function ( info ){
		$('#' + tipo + '_cash_' + idcredito).html(info);
	});
    }, 1000);

	setTimeout(function(){
        $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/edit_total_depositar.php',
                data: 'idcredito=' + idcredito 
        }).done (function ( info ){
		$('#' + tipo + '_total_depositar_' + idcredito).html(info);
	});
    }, 1500);
}

function estatus_pep(idcredito, idestatus){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/dashboard/estatus_pep.php',
		data: 'idcredito=' + idcredito + '&idestatus=' + idestatus
	}).done (function ( info ){
		$('#pep_' + idcredito).html(info);
	});
}

function edit_seguro_d(idcredito, segurod){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/dashboard/edit_segurod.php',
		data: 'idcredito=' + idcredito + '&segurod=' + segurod 
	}).done (function ( info ){
		$('#C_segurod_' + idcredito).html(info);
	});

	setTimeout(function(){
        $.ajax({
				type: 'POST',
				url : 'mesacontrol/dashboard/edit_total_depositar.php',
                data: 'idcredito=' + idcredito 
        }).done (function ( info ){
		$('#C' + '_total_depositar_' + idcredito).html(info);
	});
    }, 1000);
}

function lead_pape(idlead)
{
    limpiar();
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'mesacontrol/leads/lead_pape.php',
                data: 'idlead=' + idlead
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function rechazar_lead(idlead)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/rechazar_lead.php',
		data: 'idlead=' + idlead
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function rechazar_lead_si(idlead, idempresa)
{
	var empresa;

	cerrarmodal();
	
	if(idempresa == 1) {empresa = 'leads_mpio_dgo.php';}
	if(idempresa == 9) {empresa = 'leads_mpio_ahome.php';}
	if(idempresa == 11) {empresa = 'leads_cazel.php';}
	if(idempresa == 16) {empresa = 'leads_edo_qroo.php';}
	if(idempresa == 17) {empresa = 'leads_biosinsa.php';}
	if(idempresa == 21) {empresa = 'leads_edo_son.php';}
	if(idempresa == 25) {empresa = 'leads_mpio_atizapan.php';}
	if(idempresa == 30) {empresa = 'leads_morelos.php';}
	if(idempresa == 31) {empresa = 'leads_integracion_negocios.php';}
	if(idempresa == 34) {empresa = 'leads_aguas_atizapan.php';}
	if(idempresa == 35) {empresa = 'leads_morelos_admin_judicial.php';}
	if(idempresa == 36) {empresa = 'leads_edo_yuc.php';}

	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/' + empresa,
		data: 'idlead=' + idlead + '&hacer=rechazar'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}

function cargar_cep(idlead)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/cargar_cep.php',
		data: 'idlead=' + idlead
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function crear_propuestas(idlead)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/propuesta_lead.php',
		data: 'idlead=' + idlead
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function cargar_liga_contrato(idlead)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/liga_contrato.php',
		data: 'idlead=' + idlead
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function dispersar(idcredito)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/creditos/dispersar.php',
		data: 'idcredito=' + idcredito
	}).done (function ( info ){
		$('#modal-body').html(info);
	});

}

function borra_cliente(idcliente)
{
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/clientes/borra_cliente.php',
		data: 'idcliente=' + idcliente
}).done (function ( info ){
$('#modal-body').html(info);
});
}

function cambiar_crear_propuestas (servicio, idlead)
{
    $.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/cambiar_crear_propuesta.php',
		data: 'idlead=' + idlead + '&servicio=' + servicio
	}).done (function ( info ){
		$('#crearpropuestas_' + idlead).html(info);
	});
}

function facturacion ()
{
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/facturacion/dashboard_f.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}

function valida_rh(idlead){
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/valida_rh.php',
		data: 'idlead=' + idlead 
	}).done (function ( info ){
		$('#validarh_' + idlead).html(info);
	});
}

function lead_docs (idlead){
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/leads/docs_lead.php',
		data: 'idlead=' + idlead 
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function cargar_cep_credito(idcredito){
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/creditos/cargar_cep.php',
		data: 'idcredito=' + idcredito 
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function monto_cuota(idcredito, montocuota, tipo)
{
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/creditos/monto_cuota.php',
		data: 'idcredito=' + idcredito + '&montocuota=' + montocuota
	}).done (function ( info ){
		$('#' + tipo + '_montocuota_' + idcredito).html(info);
	});
}

function cuenta_clabe(idcredito){
	limpiar();
	abrirmodal();
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/creditos/cuenta_clabe.php',
		data: 'idcredito=' + idcredito
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function para_desenbolso()
{
	$.ajax({
		type: 'POST',
		url : 'mesacontrol/creditos/para_desenbolso.php'
	}).done (function ( info ){
		$('#contenido').html(info);
	});
}

function timestamp(idlead){
    limpiar();
    abrirmodal();
    $.ajax({
        type: 'POST',
        url : 'mesacontrol/leads/timestamp.php',
        data: 'idlead=' + idlead
    }).done(function(info){
        $('#modal-body').html(info);
    });
}


//Created with human intelligence by @jkarreno 2023 - 2024 -2025 - 2026
//May the force be with you
//move your stars
//be prepared