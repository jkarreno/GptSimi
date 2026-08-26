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

$ResTS = mysqli_fetch_array(mysqli_query($conn, "SELECT 
                                            u.supervisor,
                                            COUNT(s.TecnicoAsignado) AS total_servicios,
                                            SUM(CASE WHEN s.Estatus <> 4 THEN 1 ELSE 0 END) AS servicios_asignados,
                                            SUM(CASE WHEN s.Estatus = 4 THEN 1 ELSE 0 END) AS servicios_completados
                                        FROM usuarios u
                                        INNER JOIN servicios s 
                                            ON s.TecnicoAsignado = u.id
                                        WHERE u.perfil = 2
                                            AND u.supervisor = '".$_SESSION["Id"]."'
                                        GROUP BY u.supervisor;"));

?>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Supervisor Dashboard - FieldFlow Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1; }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col font-body-md pb-24">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-container-margin h-14 z-50 bg-surface dark:bg-surface docked full-width top-0 border-b border-outline-variant dark:border-outline">
<div class="flex items-center gap-sm">
<img class="w-10 h-8" src="../images/logotrans.png"/>
</div>
<h1 class="text-headline-md font-headline-md-mobile font-bold text-primary dark:text-primary-fixed"><?php echo $_SESSION['nombre']; ?></h1>

</header>
<!-- Main Content -->
<main class="flex-grow px-container-margin py-lg space-y-lg max-w-7xl mx-auto w-full">
<!-- Overview Section (Bento Grid Style) -->
<section class="grid grid-cols-2 md:grid-cols-4 gap-md">
<div class="col-span-2 md:col-span-2 bg-surface-container-lowest border border-outline-variant rounded-xl p-md flex flex-col justify-between h-32">
<div class="flex items-center justify-between text-on-surface-variant">
<span class="text-label-bold font-label-bold">Total Servicios</span>
<span class="text-label-sm font-label-sm text-outline">&nbsp;</span>
</div>
<div class="flex items-end justify-between">
<div>
<span class="text-headline-lg font-headline-lg-mobile text-on-surface block"><?php echo $ResTS['total_servicios']; ?></span>
<span class="text-label-sm font-label-sm text-outline">&nbsp;</span>
</div>

</div>
</div>
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md flex flex-col justify-between h-32">
<div class="text-on-surface-variant text-label-bold font-label-bold">Asignados</div>
<div>
<span class="text-headline-md font-headline-md-mobile text-primary block"><?php echo $ResTS['servicios_asignados']; ?></span>
<span class="text-label-sm font-label-sm text-outline">&nbsp;</span>
</div>
</div>
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md flex flex-col justify-between h-32">
<div class="text-on-surface-variant text-label-bold font-label-bold">Completados</div>
<div>
<span class="text-headline-md font-headline-md-mobile text-tertiary-container block"><?php echo $ResTS['servicios_completados']; ?></span>
<span class="text-label-sm font-label-sm text-on-tertiary-container">&nbsp;</span>
</div>
</div>
</section>
<!-- Technician Workload Section -->
<section class="space-y-md">
<div class="flex items-center justify-between">
<h2 class="text-headline-md font-headline-md-mobile text-on-surface">Tecnicos en Servicio</h2>

</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
<!-- Tech Card 1 -->
<?php
    $ResTecnicos = mysqli_query($conn, "SELECT 
                                            u.Id,
                                            u.Nombre,
                                            COUNT(s.TecnicoAsignado) AS total_servicios,
                                            SUM(CASE WHEN s.Estatus = 4 THEN 1 ELSE 0 END) AS servicios_completados,
                                            ROUND(
                                                (SUM(CASE WHEN s.Estatus = 4 THEN 1 ELSE 0 END) / COUNT(s.TecnicoAsignado)) * 100,
                                                2
                                            ) AS porcentaje_completado
                                        FROM usuarios u
                                        INNER JOIN servicios s ON s.TecnicoAsignado = u.Id
                                        WHERE u.perfil = 2
                                            AND u.supervisor = '".$_SESSION["Id"]."'
                                        GROUP BY 
                                            u.Id,
                                            u.Nombre
                                        HAVING COUNT(s.TecnicoAsignado) > 1
                                        ORDER BY total_servicios DESC");

    while($RResT = mysqli_fetch_array($ResTecnicos))
    {
        echo '<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md flex flex-col gap-md relative">
                <div class="absolute top-md right-md bg-tertiary-container text-on-tertiary px-xs py-1 rounded text-label-sm font-label-sm flex items-center gap-1">
                    On Site
                </div>
                <div class="flex items-center gap-sm">
                    <div>
                        <div class="text-label-bold font-label-bold text-on-surface">'.$RResT["Nombre"].'</div>
                        <div class="text-label-sm font-label-sm text-on-surface-variant">Tecnico • Sector 4</div>
                    </div>
                </div>
                <div class="space-y-sm">
                    <div class="flex justify-between text-label-sm font-label-sm">
                        <span class="text-on-surface-variant">Serivicios Actuales ('.$RResT["porcentaje_completado"].'%)</span>
                        <span class="text-on-surface">'.$RResT["servicios_completados"].'/'.$RResT["total_servicios"].' Servicios</span>
                    </div>
                    <div class="w-full bg-surface-container-high rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full" style="width: '.$RResT["porcentaje_completado"].'%"></div>
                    </div>
                </div>
                <button class="w-full h-12 bg-surface-container-low text-on-surface-variant text-label-bold font-label-bold rounded-lg hover:bg-surface-container-highest transition-colors flex items-center justify-center gap-xs">
                    <span class="material-symbols-outlined">assignment_ind</span> Asignar Servicio
                </button>
            </div>';
    }                            
?>
<!-- Floating Action Button (+) -->
<button onclick="agregar_servicio_pwa()" class="fixed right-container-margin bottom-24 w-14 h-14 bg-primary text-on-primary rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.1)] flex items-center justify-center z-40 hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined fill text-[32px]">add</span>
</button>
<!-- BottomNavBar -->
<nav class="fixed bottom-0 w-full z-50 flex justify-around items-center h-16 px-base pb-safe bg-surface dark:bg-surface border-t border-outline-variant dark:border-outline md:hidden">
<a class="flex flex-col items-center justify-center text-primary dark:text-primary-fixed font-bold scale-95 transition-transform duration-100" href="principal_pwa.php">
<span class="material-symbols-outlined fill">home_work</span>
<span class="text-label-sm font-label-sm">Inicio</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-on-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-highest rounded-lg p-1" href="servicios_pwa.php">
<span class="material-symbols-outlined">build_circle</span>
<span class="text-label-sm font-label-sm">Servicios</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-on-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-highest rounded-lg p-1" href="equipo_pwa.php">
<span class="material-symbols-outlined">group</span>
<span class="text-label-sm font-label-sm">Equipo</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant dark:text-on-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-highest rounded-lg p-1" href="profile_pwa.php">
<span class="material-symbols-outlined">person</span>
<span class="text-label-sm font-label-sm">Profile</span>
</a>
</nav>
</body></html>