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

$mensaje='';

if(isset($_POST["hacer"]))
{
    if($_POST["hacer"]=="addservicio")
    {
        mysqli_query($conn, "INSERT INTO servicios (Sucursal, FechaAsignacion, SemanaAtencion, Estatus, TecnicoAsignado, Observaciones) 
                                            VALUES ('".$_POST["sucursal"]."', '".time()."', '".$_POST["semanaatencion"]."', 
                                                    '2', '".$_POST["tecnico"]."', '".$_POST["observaciones"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el servicio correctamente</div>';
    }
    if($_POST["hacer"]=="editservicio")
    {
        mysqli_query($conn, "UPDATE servicios SET Sucursal = '".$_POST["sucursal"]."', 
                                                    SemanaAtencion = '".$_POST["semanaatencion"]."', 
                                                    TecnicoAsignado = '".$_POST["tecnico"]."', 
                                                    Observaciones = '".$_POST["observaciones"]."' ".($_POST["tecnico"]>0 ? ", Estatus = '2'" : "")."
                                            WHERE Id = '".$_POST["id"]."'") or die(mysqli_error($conn));    

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se actualizo el servicio correctamente</div>';
    }
}

if(isset($_GET["hacer"]))
{
        if($_GET["hacer"]=='finservicio')
        {
                $finserv = time().'|'.$_GET["latitud"].'|'.$_GET["longitud"];
                mysqli_query($conn, "UPDATE servicios SET Estatus = '4', 
                                                        FinServicio = '".$finserv."', 
                                                        Notas = '".$_GET["serviceNotes"]."' 
                                                WHERE Id = '".$_GET["id"]."'") or die(mysqli_error($conn));
                $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se finalizo el servicio correctamente</div>';
        }
}

?>
<html lang="es"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Lista de Servicios - FieldFlow Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="../estilos/estilos.css" rel="stylesheet">
<script src="codigo.js"></script>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "surface-container-high": "#e6e8ea",
                      "on-tertiary": "#ffffff",
                      "on-primary-fixed-variant": "#2e476f",
                      "surface-container-highest": "#e0e3e5",
                      "error-container": "#ffdad6",
                      "secondary-fixed-dim": "#b9c7df",
                      "tertiary-fixed": "#a3f69c",
                      "on-error": "#ffffff",
                      "on-secondary-fixed-variant": "#3a485b",
                      "on-primary-container": "#87a0cd",
                      "surface-tint": "#465f88",
                      "outline-variant": "#c4c6cf",
                      "error": "#ba1a1a",
                      "on-surface": "#191c1e",
                      "surface": "#f7f9fb",
                      "primary": "#002046",
                      "tertiary-container": "#00400c",
                      "on-tertiary-container": "#61b15f",
                      "primary-container": "#1b365d",
                      "inverse-on-surface": "#eff1f3",
                      "surface-container": "#eceef0",
                      "inverse-surface": "#2d3133",
                      "surface-dim": "#d8dadc",
                      "tertiary-fixed-dim": "#88d982",
                      "surface-container-lowest": "#ffffff",
                      "secondary-fixed": "#d5e3fc",
                      "on-primary-fixed": "#001b3d",
                      "on-tertiary-fixed-variant": "#005312",
                      "primary-fixed": "#d6e3ff",
                      "on-surface-variant": "#44474e",
                      "on-secondary-fixed": "#0d1c2e",
                      "inverse-primary": "#aec7f7",
                      "secondary-container": "#d5e3fc",
                      "on-background": "#191c1e",
                      "on-secondary": "#ffffff",
                      "on-error-container": "#93000a",
                      "on-secondary-container": "#57657a",
                      "outline": "#74777f",
                      "tertiary": "#002805",
                      "on-primary": "#ffffff",
                      "on-tertiary-fixed": "#002204",
                      "secondary": "#515f74",
                      "primary-fixed-dim": "#aec7f7",
                      "background": "#f7f9fb",
                      "surface-variant": "#e0e3e5",
                      "surface-container-low": "#f2f4f6",
                      "surface-bright": "#f7f9fb"
              },
              "borderRadius": {
                      "DEFAULT": "0.125rem",
                      "lg": "0.25rem",
                      "xl": "0.5rem",
                      "full": "0.75rem"
              },
              "spacing": {
                      "container-margin": "16px",
                      "gutter": "16px",
                      "md": "16px",
                      "xs": "4px",
                      "xl": "32px",
                      "sm": "12px",
                      "lg": "24px",
                      "base": "8px"
              },
              "fontFamily": {
                      "label-bold": [
                              "Inter"
                      ],
                      "label-sm": [
                              "Inter"
                      ],
                      "headline-lg": [
                              "Inter"
                      ],
                      "headline-lg-mobile": [
                              "Inter"
                      ],
                      "body-lg": [
                              "Inter"
                      ],
                      "body-md": [
                              "Inter"
                      ],
                      "headline-md": [
                              "Inter"
                      ]
              },
              "fontSize": {
                      "label-bold": [
                              "14px",
                              {
                                      "lineHeight": "20px",
                                      "fontWeight": "600"
                              }
                      ],
                      "label-sm": [
                              "12px",
                              {
                                      "lineHeight": "16px",
                                      "fontWeight": "500"
                              }
                      ],
                      "headline-lg": [
                              "32px",
                              {
                                      "lineHeight": "40px",
                                      "letterSpacing": "-0.02em",
                                      "fontWeight": "700"
                              }
                      ],
                      "headline-lg-mobile": [
                              "24px",
                              {
                                      "lineHeight": "32px",
                                      "letterSpacing": "-0.01em",
                                      "fontWeight": "700"
                              }
                      ],
                      "body-lg": [
                              "18px",
                              {
                                      "lineHeight": "28px",
                                      "fontWeight": "400"
                              }
                      ],
                      "body-md": [
                              "16px",
                              {
                                      "lineHeight": "24px",
                                      "fontWeight": "400"
                              }
                      ],
                      "headline-md": [
                              "20px",
                              {
                                      "lineHeight": "28px",
                                      "fontWeight": "600"
                              }
                      ]
              }
      },
          },
        }
      </script>
</head>
<body class="bg-background text-on-background antialiased min-h-screen flex flex-col pb-16 md:pb-0">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-container-margin h-14 z-50 bg-surface dark:bg-surface docked full-width top-0 border-b border-outline-variant dark:border-outline">
<div class="flex items-center gap-sm">
<img class="w-10 h-8" src="../images/logotrans.png"/>
</div>
<h1 class="text-headline-md font-headline-md-mobile font-bold text-primary dark:text-primary-fixed"><?php echo $_SESSION['nombre']; ?></h1>

</header>
<!-- Main Content -->
<main class="flex-grow px-container-margin py-lg flex flex-col gap-lg w-full max-w-7xl mx-auto">
<!-- Header & Search -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
<?php echo $mensaje; ?>
<div>
<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg-mobile md:font-headline-lg text-on-surface">Lista de Servicios</h2>
<p class="text-body-md font-body-md text-on-surface-variant mt-1">Gestión y seguimiento de trabajos asignados.</p>
</div>
<div class="w-full md:w-96 flex gap-sm relative">
<div class="relative flex-grow">

<input class="w-full h-12 pl-10 pr-4 rounded-DEFAULT border border-outline-variant bg-surface-container-lowest text-body-md font-body-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-on-surface-variant" placeholder="Buscar por ID, técnico o sucursal..." type="text">
</div>
<button class="h-12 w-12 flex-shrink-0 flex items-center justify-center bg-surface-container-high rounded-DEFAULT text-on-surface hover:bg-surface-container-highest transition-colors border border-outline-variant" title="Semana">
<span class="material-symbols-outlined">calendar_view_week</span>
</button><button class="h-12 w-12 flex-shrink-0 flex items-center justify-center bg-surface-container-high rounded-DEFAULT text-on-surface hover:bg-surface-container-highest transition-colors border border-outline-variant" title="Filtrar">
<span class="material-symbols-outlined">filter_list</span>
</button>
</div>
</div>
<!-- Service Cards Grid (Mobile/Tablet) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
<!-- Card 1: In Progress -->
<?php
    if($_SESSION["perfil"] == 3)
    {
        $ResServicios = mysqli_query($conn, "SELECT s.Id, s.Sucursal, s.FechaAsignacion, s.SemanaAtencion, s.Estatus, s.TecnicoAsignado, s.Observaciones,
                                                su.NumSucursal, su.Nombre AS NombreSucursal, u.Nombre AS NombreTecnico, e.Estatus AS Estatus, e.Color AS color
                                        FROM servicios s
                                        LEFT JOIN sucursales su ON s.Sucursal = su.Id
                                        LEFT JOIN usuarios u ON s.TecnicoAsignado = u.Id
                                        INNER JOIN cat_estatus AS e ON s.Estatus = e.Id
                                        WHERE u.Perfil = 2 AND u.Supervisor = '".$_SESSION["Id"]."'
                                        ORDER BY s.FechaAsignacion DESC");
    }
    else if($_SESSION["perfil"] == 2)
    {
        $ResServicios = mysqli_query($conn, "SELECT s.Id, s.Sucursal, s.FechaAsignacion, s.SemanaAtencion, s.Estatus, s.TecnicoAsignado, s.Observaciones,
                                                su.NumSucursal, su.Nombre AS NombreSucursal, u.Nombre AS NombreTecnico, e.Estatus AS Estatus, e.Color AS color
                                        FROM servicios s
                                        LEFT JOIN sucursales su ON s.Sucursal = su.Id
                                        LEFT JOIN usuarios u ON s.TecnicoAsignado = u.Id
                                        INNER JOIN cat_estatus AS e ON s.Estatus = e.Id
                                        WHERE u.Id = '".$_SESSION["Id"]."'
                                        ORDER BY s.FechaAsignacion DESC");
    }

    while($row = mysqli_fetch_assoc($ResServicios)) 
    {
        $semana = $row['SemanaAtencion'];
        $anio = date('Y', strtotime('+0 week', strtotime(date('Y-m-d')))); // Año actual

        $meses = [
            1  => 'ene',
            2  => 'feb',
            3  => 'mar',
            4  => 'abr',
            5  => 'may',
            6  => 'jun',
            7  => 'jul',
            8  => 'ago',
            9  => 'sep',
            10 => 'oct',
            11 => 'nov',
            12 => 'dic'
        ];

        // Obtener el lunes de la semana
        $inicioSemana = new DateTime();
        $inicioSemana->setISODate($anio, $semana, 1);

        // Obtener el domingo
        $finSemana = clone $inicioSemana;
        $finSemana->modify('+6 days');

        $cadena_semana = 'Semana ' . $semana .
                    ' del ' . $inicioSemana->format('d') . ' ' . $meses[(int)$inicioSemana->format('m')] .
                    ' al ' . $finSemana->format('d') . ' ' . $meses[(int)$finSemana->format('m')];

        echo '<div class="bg-surface-container-lowest border border-outline-variant rounded-DEFAULT p-sm flex flex-col gap-sm relative hover:bg-surface-container-low transition-colors group">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wide">ID: #SRV-' . $row['Id'] . '</span>
                        <h3 class="text-label-bold font-label-bold text-on-surface mt-xs">Mantenimiento</h3>
                    </div>
                    <div class="bg-secondary-fixed text-on-secondary-fixed px-2 py-1 rounded-sm text-label-sm font-label-sm font-semibold whitespace-nowrap" style="background-color: #'.$row["color"].'">
                                ' . $row['Estatus'] . '
                    </div>
                </div>
                <div class="flex flex-col gap-xs mt-xs">
                    <div class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">location_on</span>
                        <span class="">'.$row["NumSucursal"].' - '.$row["NombreSucursal"].'</span>
                    </div>
                    <div class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                        <span class="">'.$row["NombreTecnico"].'</span>
                    </div>
                    <div class="flex items-center gap-2 text-body-md font-body-md text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        <span class="">'.$cadena_semana.'</span>
                    </div>
                </div>
                <div class="mt-auto pt-sm flex gap-sm">
                    <button class="flex-1 bg-primary text-on-primary h-12 rounded-DEFAULT text-label-bold font-label-bold hover:opacity-90 transition-opacity" onclick="DetallesServicio('.$row["Id"].')">
                        Ver Detalles
                    </button>
                </div>
            </div>';
    }
?>
</div>
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
<!-- Adjust main content margin for desktop sidebar -->
<style>
        @media (min-width: 768px) {
            main {
                margin-left: 16rem; /* 256px */
                max-width: calc(100% - 16rem);
            }
        }
    </style>


</body></html>