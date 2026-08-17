<?php 
date_default_timezone_set('America/Mexico_City');
//Inicio la sesion 
//ini_set("session.cookie_lifetime","7200");
//ini_set("session.gc_maxlifetime","7200");
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
    //si no existe, envio a la p?gina de autentificacion 
    header("Location: index.php"); 
    //ademas salgo de este script 
    exit(); 
} 

include ("conexion.php");
include ("funciones.php");

?>
<html lang="es-mx">
<head>
	<meta charset="UTF-8" />
	<title>Panel de control</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
	
	<link rel="stylesheet" href="estilos/estilos_principal.css">
	<link rel="stylesheet" href="estilos/estilos.css">
	<link rel="stylesheet" href="estilos/new_estilos.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!--<script src="https://kit.fontawesome.com/a5e678cc82.js" crossorigin="anonymous"></script>-->
	<link href="fontawesome64/css/fontawesome.css" rel="stylesheet">
  	<link href="fontawesome64/css/brands.css" rel="stylesheet">
  	<link href="fontawesome64/css/solid.css" rel="stylesheet">
	

	<script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/scroller/2.1.1/css/scroller.dataTables.min.css"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@1.0.0/dataTables.rowsGroup.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/datatables-rowsgroup@1.0.0/dataTables.rowsGroup.js"></script>



	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	
	
	<script src="js/codigo.js"></script>

	<script src="js/codigo_dashboard.js"></script>

	<link rel="icon" href="images/dashboard.png" type="image/png">
</head>
<body onload="ini(); diade()" onkeypress="parar()" onclick="parar()">

	<input type="checkbox" id="check">
	<header class="" style="background-color: #000; border-bottom: 1px solid #000;">
		<div class="relative flex h-16 items-center justify-between">
			<div id="logotop" class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
				<div class="menu_bar"><label for="check" id="chk_btn"><img src="images/logotrans.png" border="0"></label></div>
			</div>
		</div>
		<div class="titulo_head"><h2>Panel de Control</h2></div>
		<div class="logo_img">Bienvenido <?php echo $_SESSION["nombre"];?></div>
	</header>

	<div class="menu_principal">
		<!--<div class="tooltip top"><a href="principal.php"><a href="#" onclick="dashboard(\''.date("Y-01-01").'\', \''.date("Y-m-d").'\', \'1\')"><i class="ri-dashboard-3-line"></i></a><span class="tiptext">Dashboard</span></div>
		<div class="tooltip top"><a href="principal.php"><a href="#" onclick="dashboard_broxel()"><i class="ri-dashboard-3-line"></i></a><span class="tiptext">Dashboard</span></div>
		<div class="tooltip top" onclick="solvexpress()"><a href="#"><img src="images/express.png" border="0" /></a><span class="tiptext">Express</span></div>
		<div class="tooltip top" onclick="leads()"><a href="#"><i class="ri-crosshair-line"></i></a><span class="tiptext">Leads</span></div>
		<div class="tooltip top" onclick="leads_broxel()"><a href="#"><i class="ri-crosshair-line"></i></a><span class="tiptext">Leads</span></div>
		<div class="tooltip top" onclick="clientes()"><a href="#"><i class="ri-group-3-line"></i></a><span class="tiptext">Clientes</span></div>
		<div><a href="#" onclick="pedidos();"><i class="fa-solid fa-boxes-stacked"></i></a></div>
		<div class="tooltip top" onclick="creditos()"><a href="#"><i class="ri-money-dollar-box-line"></i></a><span class="tiptext">Créditos</span></div>
		<div class="tooltip top" onclick="creditos_broxel()"><a href="#"><i class="ri-money-dollar-box-line"></i></a><span class="tiptext">Créditos</span></div>
		-->
		<?php if(permisos($_SESSION["perfil"], "configuracion")): ?>
			<div class="tooltip top" onclick="configuracion()"><a href="#"><i class="ri-settings-3-line"></i></a><span class="tiptext">Configuración</span></div>
		<?php endif; ?>
		<!--<div class="tooltip top" onclick="estadisticos()"><a href="#"><i class="ri-line-chart-line"></i></a><span class="tiptext">Indicadores</span></div>
		<div class="tooltip top" onclick="facturacion()"><a href="#"><i class="ri-article-line"></i></a><span class="tiptext">Facturación</span></div>
		<div class="tooltip top" onclick="bitacora()"><a href="#"><i class="ri-git-repository-line"></i></a><span class="tiptext">Bitácora</span></div>
		<div class="tooltip top" onclick="helpdesk()"><i class="ri-ticket-line"></i><span class="tiptext">Help Desk</span></div>
		<div class="tooltip top" onclick="perfil()"><i class="ri-user-line"></i><span class="tiptext">perfil</span></div>-->
		<div class="tooltip top" onclick="logout()"><i class="ri-logout-box-r-line"></i><span class="tiptext">Adios</span></div>
	</div>

	<div class="contenido" id="contenido">
		
	</div>

	<!-- The Modal -->
    <div id="myModal" class="modal">
		
        <!-- Modal content -->
        <div class="modal-content">
			
            <div class="modal-body" id="modal-body">
    
            </div>
			
        </div>
		<div class="closse" onclick="cerrarmodal()"><i class="ri-close-circle-fill" style="font-size: 30px"></i></div>
    </div>
</body>
</html>
<script src="js/codigo_principal.js"></script>

<style>
/* Estilo común para el tooltip */
@import url("estilos/variables.css");
.tooltip {
  position: relative;
  display: inline-block;
 /* border-bottom: 1px dotted black;  Opcional, para subrayar el elemento */
}

/* Estilo para el texto del tooltip */
.tooltip .tiptext {
  visibility: hidden;
  width: 110px;
  background-color: #1e2a3a;
  color: var(--color-gray-50);
  text-align: center;
  border-radius: 3px;
  padding: 6px 0;
  font-size: 14px;
  
  /* Posicionamiento */
  position: absolute;
  z-index: 1;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

/* Triángulo indicador del tooltip 
.tooltip .tiptext::after {
  content: "";
  position: absolute;
  border-width: 5px;
  border-style: solid;
}

/* Mostrar el tooltip al pasar el mouse */
.tooltip:hover .tiptext {
  visibility: visible;
}

/* Posicionamiento específico del tooltip - Ejemplo para arriba */
.tooltip.top .tiptext {
  margin-left: 0px;
  bottom: 20px;
  left: 100%;
}

.tooltip.top .tiptext::after {
  margin-left: -5px;
  top: 100%;
  left: 50%;
  border-color: black transparent transparent transparent;
}
</style>

<?php
//Created with human intelligence by @jkarreno 2023 - 2024 - 2025
//May the force be with you
//move your stars
//always ready
?>