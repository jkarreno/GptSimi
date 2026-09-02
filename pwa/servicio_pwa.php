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

include ("../conexion.php");
include ("../funciones.php");

$mensaje= '';

if(isset($_GET["hacer"]))
{
    if($_GET["hacer"]=='inicioservicio')
    {
        $inicioserv = time().'|'.$_GET["latitud"].'|'.$_GET["longitud"];

        mysqli_query($conn, "UPDATE servicios SET InicioServicio = '".$inicioserv."' WHERE Id = '".$_GET["id"]."'");
    }
}

if(isset($_POST["hacer"]))
{
    if($_POST["hacer"]=='guardadoc')
    {
        $nombrearchivo = $_POST["id"].'_'.$_POST["tipoimagen"].'.jpg';
        $rutaarchivo = 'files/'.$nombrearchivo;

        if (move_uploaded_file($_FILES['imageInput']['tmp_name'], $rutaarchivo)) {
            $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el archivo correctamente</div>';
        } else {
            //echo "Error al subir el archivo.";
            $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Error al agregar el archivo</div>';
        }
    }
}

$ResServicio = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM servicios WHERE Id = '".$_GET["id"]."'"));
$ResSucursal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM sucursales WHERE Id = '".$ResServicio["Sucursal"]."'"));

?>
<!DOCTYPE html><html lang="es" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Service Execution - FieldFlow Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="../estilos/estilos_principal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="codigo.js"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#f7f9fb",
                        "on-surface-variant": "#44474e",
                        "secondary-fixed": "#d5e3fc",
                        "on-background": "#191c1e",
                        "on-tertiary-fixed-variant": "#005312",
                        "secondary-container": "#d5e3fc",
                        "secondary-fixed-dim": "#b9c7df",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#515f74",
                        "surface-dim": "#d8dadc",
                        "on-primary-fixed-variant": "#2e476f",
                        "on-primary-fixed": "#001b3d",
                        "on-secondary-container": "#57657a",
                        "background": "#f7f9fb",
                        "error": "#ba1a1a",
                        "primary": "#002046",
                        "surface-container-highest": "#e0e3e5",
                        "outline-variant": "#c4c6cf",
                        "tertiary": "#002805",
                        "on-tertiary-container": "#61b15f",
                        "tertiary-container": "#00400c",
                        "inverse-surface": "#2d3133",
                        "surface-container-high": "#e6e8ea",
                        "tertiary-fixed-dim": "#88d982",
                        "on-secondary-fixed-variant": "#3a485b",
                        "primary-fixed-dim": "#aec7f7",
                        "primary-container": "#1b365d",
                        "surface-container": "#eceef0",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#aec7f7",
                        "surface-container-low": "#f2f4f6",
                        "primary-fixed": "#d6e3ff",
                        "on-tertiary-fixed": "#002204",
                        "tertiary-fixed": "#a3f69c",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "outline": "#74777f",
                        "surface-variant": "#e0e3e5",
                        "on-surface": "#191c1e",
                        "on-error": "#ffffff",
                        "surface-tint": "#465f88",
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f7f9fb",
                        "on-primary-container": "#87a0cd"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "16px",
                        "md": "16px",
                        "xs": "4px",
                        "sm": "12px",
                        "base": "8px",
                        "container-margin": "16px",
                        "lg": "24px",
                        "xl": "32px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-bold": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "500" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-bold": ["14px", { "lineHeight": "20px", "fontWeight": "600" }],
                        "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col pb-16 md:pt-14 md:pb-0">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-container-margin h-14 z-50 bg-surface dark:bg-surface docked full-width top-0 border-b border-outline-variant dark:border-outline">
<div class="flex items-center gap-sm">
<img class="w-10 h-8" src="../images/logotrans.png"/>
</div>
<h1 class="text-headline-md font-headline-md-mobile font-bold text-primary dark:text-primary-fixed"><?php echo $_SESSION['nombre'];?></h1>

</header>
<!-- Main Content -->
<main class="flex-grow w-full max-w-3xl mx-auto p-md md:p-lg space-y-lg">
    
<!-- Job Header Details -->
<section class="bg-surface-container-lowest border border-outline-variant rounded-lg p-md shadow-sm space-y-sm">
<div class="flex justify-between items-start">
<div>
<h2 class="text-headline-md-mobile md:text-headline-md font-bold text-on-surface mb-xs"><?php echo $ResSucursal["NumSucursal"].' - '.$ResSucursal["Nombre"];?></h2>
<p class="text-label-bold text-on-surface-variant font-label-bold flex items-center gap-xs">
<span class="material-symbols-outlined text-[16px]">pin_drop</span>
                        <?php echo $ResSucursal["Direccion"]; ?>
                    </p>
</div>
<span class="bg-primary text-on-primary text-label-sm font-label-sm px-2 py-1 rounded-full whitespace-nowrap">Programado</span>
</div>
<p class="text-body-md text-on-surface-variant pt-2 border-t border-outline-variant">
                <?php echo $ResServicio["Observaciones"]; ?>
            </p>
</section>
<!-- Primary Action -->
<?php
if($ResServicio["InicioServicio"] == NULL)
{
?>
<section class="flex gap-md">
<input type="hidden" id="longitud" value="">
<input type="hidden" id="latitud" value="">
<button class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" id="btnArrive" onclick="InicioServicio('<?php echo $ResServicio["Id"];?>', '<?php echo $_SESSION["Id"];?>', document.getElementById('latitud').value, document.getElementById('longitud').value)">
<span class="material-symbols-outlined filled">location_on</span>
                Registrar llegada a Sucursal
            </button>
</section>
<?php } 

if($ResServicio["InicioServicio"] != NULL)
{
?>
<!-- Evidence Collection (Disabled initially) -->
<section class="transition-opacity duration-300 bg-surface-container-lowest border border-outline-variant rounded-lg p-md space-y-md" id="evidenceSection">
<h3 class="text-body-lg font-bold text-on-surface border-b border-outline-variant pb-2">Capturar Evidencias</h3>
<div class="flex flex-col gap-md">
    <?php
    if($ResServicio["InicioServicio"] != NULL AND $ResServicio["FinServicio"] == NULL)
    {
    ?>
    <div class="flex flex-col gap-xs">
        <label class="text-label-bold font-label-bold text-on-surface" for="photoType">Tipo de Evidencia</label>
        <select id="photoType" class="w-full border border-outline-variant rounded-lg p-sm bg-surface-container-lowest text-body-md focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
            <option value="0">Seleccione un tipo de evidencia</option>
            <?php
            $ResTipos = mysqli_query($conn, "SELECT * FROM cat_imagenes ORDER BY Nombre ASC");
            while($RResT = mysqli_fetch_array($ResTipos))
            {
                echo '<option value="'.$RResT["Id"].'">'.$RResT["Nombre"].'</option>';
            }   
            ?>
        </select>
    </div>
    <button class="w-full h-14 border-2 border-dashed border-outline-variant rounded-lg flex items-center justify-center gap-sm text-on-surface-variant hover:bg-surface-container-low transition-colors bg-surface-container-lowest photo-upload-btn" onclick="capturarImagen('<?php echo $_GET["id"]; ?>', document.getElementById('photoType').value)">
        <span class="material-symbols-outlined text-[24px]">add_a_photo</span>
        <span class="text-label-bold font-label-bold">Capturar Imagen</span>
    </button>
    <?php
    }
    ?>
    <div id="capturedImagesList" class="space-y-sm mt-md">
        <?php
            $ResImagenes = mysqli_query($conn, "SELECT * FROM cat_imagenes ORDER BY Nombre ASC");
            while($RResI = mysqli_fetch_array($ResImagenes))
            {
                if(file_exists('files/'.$_GET["id"].'_'.$RResI["Id"].'.jpg'))
                {
                    echo '<div class="flex items-center justify-between p-2 bg-surface-container-low border border-outline-variant rounded-lg">
                            <div class="flex items-center gap-sm">
                                <div class="w-12 h-12 bg-surface-container-highest rounded overflow-hidden">
                                    <img src="files/'.$_GET["id"].'_'.$RResI["Id"].'.jpg?'.rand(1,100).'" alt="Thumbnail" class="w-full h-full object-cover">
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-label-bold font-label-bold text-on-surface">'.$RResI["Nombre"].'</span>
                                    <span class="text-label-sm text-on-surface-variant">'.date("d/m/Y H:i:s", filemtime('files/'.$_GET["id"].'_'.$RResI["Id"].'.jpg')).'</span>
                                </div>
                            </div>
                            <button class="text-error hover:bg-error-container p-2 rounded-full transition-colors" onclick="eliminarImagen(\''.$_GET["id"].'\', \''.$RResI["Id"].'\')">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>';
                }
            }
        ?>
    </div>
</div>
<div class="space-y-xs">
<label class="text-label-bold font-label-bold text-on-surface" for="serviceNotes">Notas del Servicio</label>
<textarea class="w-full border border-outline-variant rounded-lg p-sm bg-surface-container-lowest text-body-md focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none resize-none" id="serviceNotes" placeholder="Describe los hallazgos y trabajos realizados..." rows="3">
    <?php echo $ResServicio["Notas"]; ?>
</textarea>
</div>
</section>
<!-- Final Action -->
 <?php
}
if($ResServicio["InicioServicio"] != NULL AND $ResServicio["FinServicio"] == NULL)
{
    ?>
<section>
<input type="hidden" id="longitud" value="">
<input type="hidden" id="latitud" value="">
<button class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-bold flex items-center justify-center gap-sm hover:opacity-90 transition-opacity active:scale-[0.98]" id="btnComplete" onclick="FinServicio('<?php echo $ResServicio["Id"];?>', '<?php echo $_SESSION["Id"];?>', document.getElementById('latitud').value, document.getElementById('longitud').value, document.getElementById('serviceNotes').value)">
<span class="material-symbols-outlined">check_circle</span>
                Finalizar Servicio
            </button>
</section>
<?php } ?>

</main>
<!-- BottomNavBar -->
<nav class="md:hidden fixed bottom-0 w-full z-50 flex justify-around items-center h-16 px-base pb-safe bg-surface dark:bg-surface border-t border-outline-variant dark:border-outline">
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low h-full w-full rounded-DEFAULT" href="principal_pwa.php">
<span class="material-symbols-outlined text-[24px]">home_work</span>
<span class="text-label-sm font-label-sm mt-1">Home</span>
</a>
<a class="flex flex-col items-center justify-center text-primary dark:text-primary-fixed font-bold hover:bg-surface-container-low h-full w-full rounded-DEFAULT opacity-80 transition-opacity scale-95 duration-100" href="servicios_pwa.php">
<span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' 1;">build_circle</span>
<span class="text-label-sm font-label-sm mt-1">Services</span>
</a>
<?php
    if($_SESSION["perfil"] == 3)
    {
?>
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low h-full w-full rounded-DEFAULT" href="equipo_pwa.php">
<span class="material-symbols-outlined text-[24px]">group</span>
<span class="text-label-sm font-label-sm mt-1">Team</span>
</a>
<?php
    }
?>
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low h-full w-full rounded-DEFAULT" href="perfil_pwa.php">
<span class="material-symbols-outlined text-[24px]">logout</span>
<span class="text-label-sm font-label-sm mt-1">Salir</span>
</a>
</nav>
	<!-- The Modal -->
    <div id="myModal" class="modal">
		
        <!-- Modal content -->
        <div class="modal-content">
			
            <div class="modal-body" id="modal-body">
    
            </div>
			
        </div>
		<div class="closse" onclick="cerrarmodal()"><i class="fa-solid fa-circle-xmark" style="font-size: 30px"></i></div>
    </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(
            function(position) {

                const latitud = position.coords.latitude;
                const longitud = position.coords.longitude;

                document.getElementById('latitud').value = latitud;
                document.getElementById('longitud').value = longitud;

                console.log('Latitud:', latitud);
                console.log('Longitud:', longitud);

            },
            function(error) {

                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        console.log('El usuario rechazó el permiso de ubicación.');
                        break;

                    case error.POSITION_UNAVAILABLE:
                        console.log('No se pudo obtener la ubicación.');
                        break;

                    case error.TIMEOUT:
                        console.log('La solicitud de ubicación tardó demasiado.');
                        break;

                    default:
                        console.log('Ocurrió un error desconocido.');
                        break;
                }

            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );

    } else {
        console.log('El navegador no soporta geolocalización.');
    }

});

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
</script>


</body></html>