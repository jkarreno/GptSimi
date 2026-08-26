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
?>  

<html class="h-full" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Asignar Nuevo Servicio - FieldFlow Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                            "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                            "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                            "headline-lg-mobile": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                            "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                            "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                            "label-bold": ["14px", {"lineHeight": "20px", "fontWeight": "600"}],
                            "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface text-on-surface h-full flex flex-col antialiased">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-container-margin h-14 z-50 bg-surface border-b border-outline-variant fixed top-0 w-full">
<div class="flex items-center gap-sm">
<button class="text-on-surface-variant hover:bg-surface-container-low rounded-full p-2 transition-colors">
<span class="material-symbols-outlined">arrow_back</span>
</button>

</div>
<div class="flex items-center gap-sm">


</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-1 mt-14 mb-16 md:mb-0 overflow-y-auto px-container-margin py-lg md:max-w-3xl md:mx-auto w-full">
<div class="mb-lg">
<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg-mobile md:font-headline-lg text-on-surface">Asignar Nuevo Servicio</h2>
<p class="text-body-md font-body-md text-on-surface-variant mt-2">Completa los datos.</p>
</div>
<form class="space-y-lg bg-surface-container-lowest p-md md:p-lg rounded-xl border border-outline-variant shadow-sm" action="servicios_pwa.php" method="POST">
<!-- Section: Location -->
<fieldset>
<legend class="text-label-bold font-label-bold text-primary mb-sm flex items-center gap-2 border-b border-surface-container-high w-full pb-2">
<span class="material-symbols-outlined text-[18px]">location_on</span>
                    Sucursal
                </legend>
<div class="space-y-sm">
<div>

<div class="relative">
<select class="block w-full rounded-lg border-outline-variant bg-surface-container-lowest text-on-surface focus:ring-2 focus:ring-primary focus:border-primary h-12 pl-4 pr-10 appearance-none text-body-md font-body-md" id="sucursal" name="sucursal">
<option disabled="" selected="" value="">Selecciona una sucursal</option>
<?php
$ResSuc = mysqli_query($conn, "SELECT Id, NumSucursal, Nombre FROM sucursales ORDER BY Nombre ASC");
while($RSuc=mysqli_fetch_array($ResSuc))
{
    echo '<option value="'.$RSuc["Id"].'">'.$RSuc["NumSucursal"].' - '.$RSuc["Nombre"].'</option>';
}  
?>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
</div>
</div>
</div>
</fieldset>
<!-- Section: Assignment -->
<fieldset>
<legend class="text-label-bold font-label-bold text-primary mb-sm flex items-center gap-2 border-b border-surface-container-high w-full pb-2">
<span class="material-symbols-outlined text-[18px]">engineering</span>
                    Asignación
                </legend>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div>
<label class="block text-label-bold font-label-bold text-on-surface mb-xs" for="technician">Tecnico</label>
<div class="relative">
<select class="block w-full rounded-lg border-outline-variant bg-surface-container-lowest text-on-surface focus:ring-2 focus:ring-primary focus:border-primary h-12 pl-4 pr-10 appearance-none text-body-md font-body-md" id="tecnico" name="tecnico">
<option disabled="" selected="" value="">Asignar tecnico...</option>
<?php
$ResTec = mysqli_query($conn, "SELECT Id, Nombre FROM usuarios WHERE Perfil = 2 AND Supervisor = '".$_SESSION["Id"]."' ORDER BY Nombre ASC");
while($RTec=mysqli_fetch_array($ResTec))
{
    echo '<option value="'.$RTec["Id"].'">'.$RTec["Nombre"].'</option>';
}
?>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
</div>
</div>
<div>
<label class="block text-label-bold font-label-bold text-on-surface mb-xs" for="date">Semana de atención</label>
<div class="relative">
<select class="block w-full rounded-lg border-outline-variant bg-surface-container-lowest text-on-surface focus:ring-2 focus:ring-primary focus:border-primary h-12 pl-4 pr-10 appearance-none text-body-md font-body-md" id="semanaatencion" name="semanaatencion">
<option disabled="" selected="" value="">Seleccionar semana...</option>
<?php
    $meses = [
        1  => 'Ene',
        2  => 'Feb',
        3  => 'Mar',
        4  => 'Abr',
        5  => 'May',
        6  => 'Jun',
        7  => 'Jul',
        8  => 'Ago',
        9  => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dic'
    ];
    $hoy = new DateTime();

    $semanaActual = (int)$hoy->format('W');
    $anio = (int)$hoy->format('Y');

    // El 28 de diciembre siempre pertenece a la última semana ISO del año
    $semanasAnio = (int)(new DateTime($anio . '-12-28'))->format('W');

    for ($semana = $semanaActual; $semana <= $semanasAnio; $semana++) {

        // Lunes
        $inicioSemana = new DateTime();
        $inicioSemana->setISODate($anio, $semana, 1);

        // Domingo
        $finSemana = clone $inicioSemana;
        $finSemana->modify('+6 days');

        $texto = 'Semana ' . $semana .
                ' del ' . $inicioSemana->format('d') . ' ' . $meses[(int)$inicioSemana->format('m')] .
                ' al ' . $finSemana->format('d') . ' ' . $meses[(int)$finSemana->format('m')];

        echo '<option value="' . $semana . '">' . $texto . '</option>';
    }
?>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
</div>
</div>
</div>
</fieldset>
<!-- Section: Job Details -->
<fieldset>
<legend class="text-label-bold font-label-bold text-primary mb-sm flex items-center gap-2 border-b border-surface-container-high w-full pb-2">
<span class="material-symbols-outlined text-[18px]">description</span>
                    Observaciones
                </legend>
<div>
<textarea class="block w-full rounded-lg border-outline-variant bg-surface-container-lowest text-on-surface focus:ring-2 focus:ring-primary focus:border-primary p-4 text-body-md font-body-md resize-y min-h-[100px]" id="observaciones" name="observaciones" placeholder="" rows="4"></textarea>
</div>
</fieldset>
<!-- Actions -->
<div class="pt-sm mt-lg flex flex-col sm:flex-row-reverse gap-sm border-t border-surface-container-high pb-sm">
<button class="bg-primary text-on-primary font-label-bold text-label-bold rounded-full h-12 px-8 flex items-center justify-center gap-2 hover:opacity-90 transition-opacity w-full sm:w-auto shadow-sm" type="submit">
<span class="material-symbols-outlined text-[20px]">send</span>
                    Asignar Servicio
                </button>
<button class="bg-surface-container-low text-on-surface font-label-bold text-label-bold rounded-full h-12 px-8 flex items-center justify-center hover:bg-surface-container-highest transition-colors w-full sm:w-auto border border-outline-variant" type="button">
                    Cancel
                </button>
</div>
<input type="hidden" name="hacer" id="hacer" value="addservicio"/>
</form>
</main>
<!-- BottomNavBar (Mobile Only) -->
<nav class="fixed bottom-0 w-full z-50 flex justify-around items-center h-16 px-base pb-safe bg-surface border-t border-outline-variant md:hidden shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
<!-- Home -->
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low p-2 rounded-lg transition-colors w-16" href="principal_pwa.php">
<span class="material-symbols-outlined" data-icon="home_work">home_work</span>
<span class="text-[10px] font-medium mt-1">Home</span>
</a>
<!-- Services (Active - intent matches assigning a service) -->
<a class="flex flex-col items-center justify-center text-primary font-bold bg-secondary-container/20 p-2 rounded-lg transition-transform duration-100 scale-95 w-16" href="#">
<span class="material-symbols-outlined" data-icon="build_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">build_circle</span>
<span class="text-[10px] font-bold mt-1">Services</span>
</a>
<!-- Team -->
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low p-2 rounded-lg transition-colors w-16" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="text-[10px] font-medium mt-1">Team</span>
</a>
<!-- Profile -->
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low p-2 rounded-lg transition-colors w-16" href="#">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="text-[10px] font-medium mt-1">Profile</span>
</a>
</nav>
</body></html>