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

$mensaje=''; $toast = 0;

if(isset($_POST["hacer"]))
{
  if($_POST["hacer"]=='updatepass')
  {
    $sql= "UPDATE usuarios SET Contrasenna = '".md5($_POST["newPassword"])."' WHERE Id = '".$_SESSION["Id"]."'";

    if (mysqli_query($conn, $sql)) {
      $mensaje = 'Se actualizo la contraseña satisfactoriamente';
      $toast = 1;
      unset($_SESSION['pass']);
    } else {
      $mensaje = 'Ocurrio un error, intenta nuevamente';
      $toast = 1;
    }
  }

  if($_POST["hacer"]=='guardadato')
  {
    $sql = "UPDATE usuarios SET ";
    switch($_POST["dato"])
    {
        case 'phone': $label='Teléfono'; $sql.="Telefono='".$_POST["valordato"]."'"; break;
    }
    $sql.= " WHERE Id = '".$_SESSION["Id"]."'";

    if(mysqli_query($conn, $sql))
    {
      $mensaje = 'Se actulizo el valor de '.$label.' satisfactoriamente';
    }
    else
    {
      $mensaje = 'Ocurrio un error, intenta nuevamente';
    }
  }
}

$ResUsuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM usuarios WHERE Id = '".$_SESSION["Id"]."' LIMIT 1"));

?>
<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Lista de Servicios - FieldFlow Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="../estilos/estilos_principal.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      },
          },
        }
      </script>
<meta content="mobile_tab" name="shell-type"/><style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col pb-16 md:pt-14 md:pb-0" style="padding-top: 20px;">
<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-container-margin h-14 z-50 bg-surface dark:bg-surface docked full-width top-0 border-b border-outline-variant dark:border-outline">
<div class="flex items-center gap-sm">
<img class="w-10 h-8" src="../images/logotrans.png"/>
</div>
<h1 class="text-headline-md font-headline-md-mobile font-bold text-primary dark:text-primary-fixed"><?php echo $_SESSION['nombre']; ?></h1>

</header>
<!-- Main Content -->
<main class="flex-grow px-container-margin py-lg flex flex-col gap-lg w-full max-w-7xl mx-auto"><div class="flex flex-col w-full gap-lg">
<?php if($toast == 1) { ?>
<!-- Interactive Feedback Banner (hidden by default) -->
<div class="transition-all duration-300 transform -translate-y-2 bg-tertiary-container text-on-tertiary-container px-md py-base rounded-lg flex items-center justify-between shadow-sm" id="toastSuccess">
  <div class="flex items-center gap-base">
    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
    <span class="font-label-bold text-label-bold text-tertiary-fixed">Contraseña actualizada exitosamente</span>
  </div>
  <button class="text-tertiary-fixed-dim hover:text-white p-xs" onclick="document.getElementById('toastSuccess').classList.add('hidden')">
    <span class="material-symbols-outlined text-[18px]">close</span>
  </button>
</div>
<?php } ?>
<!-- Header Profile Card -->
<section class="bg-surface-container-lowest rounded-xl p-md shadow-sm relative overflow-hidden flex flex-col gap-base">
  <div class="flex flex-col mt-xs">
    <div class="flex items-center gap-xs">
      <h2 class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-on-surface"><?php echo $ResUsuario["Nombre"];?></h2>
    </div>
    <p class="font-label-bold text-label-bold text-secondary">Técnico</p>
    <div class="flex items-center gap-xs mt-xs text-on-surface-variant font-label-sm text-label-sm">
      <span class="material-symbols-outlined text-[16px]">mail</span>
      <span><? echo $ResUsuario["CorreoE"];?></span>
    </div>
  </div>
</section>
<!-- Datos Personales & Cuenta -->
<section class="flex flex-col gap-base">
<div class="flex items-center justify-between px-xs">
<h3 class="font-label-bold text-label-bold text-secondary uppercase tracking-wider">Datos de la Cuenta</h3>
<span class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-xs">
</div>
<div class="bg-surface-container-lowest rounded-xl p-md shadow-sm flex flex-col gap-md">
<!-- Item: Nombre Completo -->
<div class="flex items-center justify-between min-h-[48px]">
<div class="flex items-center gap-base">
<div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[20px]">badge</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-sm text-label-sm text-on-surface-variant">Nombre completo</span>
<span class="font-body-md text-body-md font-medium text-on-surface truncate"><?php echo $ResUsuario["Nombre"];?></span>
</div>
</div>
</div>
<!-- Item: Nombre de Usuario -->
<div class="flex items-center justify-between min-h-[48px]">
<div class="flex items-center gap-base">
<div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[20px]">alternate_email</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-sm text-label-sm text-on-surface-variant">Nombre de usuario</span>
<span class="font-body-md text-body-md font-medium text-on-surface truncate"><?php echo $ResUsuario["Usuario"];?></span>
</div>
</div>
</div>
<!-- Item: Rol -->
<div class="flex items-center justify-between min-h-[48px]">
<div class="flex items-center gap-base">
<div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[20px]">construction</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-sm text-label-sm text-on-surface-variant">Rol operativo</span>
<span class="font-body-md text-body-md font-medium text-on-surface truncate">Técnico de Campo Senior</span>
</div>
</div>
</div>
<!-- Item: Teléfono -->
<div class="flex items-center justify-between min-h-[48px]">
<div class="flex items-center gap-base">
<div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[20px]">call</span>
</div>
<div class="flex flex-col min-w-0">
<span class="font-label-sm text-label-sm text-on-surface-variant">Teléfono móvil</span>
<span class="font-body-md text-body-md font-medium text-on-surface truncate"><?php echo $ResUsuario["Telefono"];?></span>
</div>
</div>
<button class="text-primary font-label-bold text-label-bold px-base py-xs rounded-lg hover:bg-surface-container" onclick="editar_datos('phone')">Editar</button>
</div>
</section>
<!-- Sección destacada: Seguridad y Contraseña -->
<section class="flex flex-col gap-base">
<div class="flex items-center gap-base px-xs">
<span class="material-symbols-outlined text-primary text-[20px]">shield</span>
<h3 class="font-label-bold text-label-bold text-secondary uppercase tracking-wider">Seguridad de la Cuenta</h3>
</div>
<div class="bg-surface-container-lowest rounded-xl p-md shadow-sm flex flex-col gap-md">
<div>
<h4 class="font-headline-md text-headline-md text-on-surface font-semibold">Cambiar Contraseña</h4>
<p class="font-body-md text-body-md text-on-surface-variant mt-xs">Actualice sus credenciales periódicamente para proteger sus informes en campo.</p>
</div>
<form class="flex flex-col gap-md mt-xs" id="passwordForm" method="POST" action="perfil.php">
<input type="hidden" name="hacer" id="hacer" value="updatepass">
<!-- Input Contraseña Actual -->
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface" for="currentPassword">Contraseña actual</label>
<div class="relative flex items-center">
<input class="w-full h-12 px-base pr-12 rounded-lg bg-surface-container text-on-surface font-body-md text-body-md placeholder-outline focus:outline-none focus:bg-surface-container-lowest transition-colors" id="currentPassword" name="currentPassword" placeholder="••••••••••••" required="" type="password"/>
<button class="absolute right-0 top-0 h-12 w-12 flex items-center justify-center text-outline hover:text-on-surface" onclick="togglePassVisibility('currentPassword', 'currPassIcon')" type="button">
<span class="material-symbols-outlined text-[20px]" id="currPassIcon">visibility</span>
</button>
</div>
</div>
<!-- Input Nueva Contraseña -->
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface" for="newPassword">Nueva contraseña</label>
<div class="relative flex items-center">
<input class="w-full h-12 px-base pr-12 rounded-lg bg-surface-container text-on-surface font-body-md text-body-md placeholder-outline focus:outline-none focus:bg-surface-container-lowest transition-colors" id="newPassword" name="newPassword" oninput="checkPasswordRequirements(this.value)" placeholder="Ingrese al menos 8 caracteres" required="" type="password"/>
<button class="absolute right-0 top-0 h-12 w-12 flex items-center justify-center text-outline hover:text-on-surface" onclick="togglePassVisibility('newPassword', 'newPassIcon')" type="button">
<span class="material-symbols-outlined text-[20px]" id="newPassIcon">visibility</span>
</button>
</div>
</div>
<!-- Input Confirmar Nueva Contraseña -->
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface" for="confirmPassword">Confirmar nueva contraseña</label>
<div class="relative flex items-center">
<input class="w-full h-12 px-base pr-12 rounded-lg bg-surface-container text-on-surface font-body-md text-body-md placeholder-outline focus:outline-none focus:bg-surface-container-lowest transition-colors" id="confirmPassword" name="confirmPassword" placeholder="Repita la nueva contraseña" required="" type="password"/>
<button class="absolute right-0 top-0 h-12 w-12 flex items-center justify-center text-outline hover:text-on-surface" onclick="togglePassVisibility('confirmPassword', 'confPassIcon')" type="button">
<span class="material-symbols-outlined text-[20px]" id="confPassIcon">visibility</span>
</button>
</div>
</div>
<!-- Indicadores visuales de requisitos -->
<div class="bg-surface-container-low rounded-lg p-base flex flex-col gap-xs mt-xs">
<span class="font-label-bold text-label-bold text-on-surface-variant">Requisitos indispensables:</span>
<div class="grid grid-cols-1 gap-xs mt-xs">
<div class="flex items-center gap-xs text-outline transition-colors" id="req-length">
<span class="material-symbols-outlined text-[16px]">radio_button_unchecked</span>
<span class="font-label-sm text-label-sm">Mínimo 8 caracteres</span>
</div>
<div class="flex items-center gap-xs text-outline transition-colors" id="req-number">
<span class="material-symbols-outlined text-[16px]">radio_button_unchecked</span>
<span class="font-label-sm text-label-sm">Incluye al menos un número (0-9)</span>
</div>
<div class="flex items-center gap-xs text-outline transition-colors" id="req-symbol">
<span class="material-symbols-outlined text-[16px]">radio_button_unchecked</span>
<span class="font-label-sm text-label-sm">Incluye un símbolo especial (!@#$%&amp;*)</span>
</div>
</div>
</div>
<!-- Botón primario de acción -->
<button class="w-full min-h-[48px] bg-primary text-on-primary font-label-bold text-label-bold rounded-lg shadow-sm hover:bg-primary-container active:scale-[0.99] transition-all flex items-center justify-center gap-base mt-xs" type="submit">
<span class="material-symbols-outlined text-[20px]">sync_lock</span>
<span>Actualizar Contraseña</span>
</button>
</form>
</div>
</section>

</div>
<script>
  // Ensure profile tab in bottom nav reflects active state dynamically
  (function setActiveProfileTab() {
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
      const text = link.innerText || link.textContent;
      if (text.includes('Profile') || text.includes('Perfil')) {
        link.classList.remove('text-on-surface-variant');
        link.classList.add('text-primary', 'font-bold');
        const icon = link.querySelector('.material-symbols-outlined');
        if (icon) {
          icon.style.fontVariationSettings = "'FILL' 1";
        }
      } else if (text.includes('Services') || text.includes('Servicios')) {
        link.classList.remove('text-primary', 'font-bold');
        link.classList.add('text-on-surface-variant');
        const icon = link.querySelector('.material-symbols-outlined');
        if (icon) {
          icon.style.fontVariationSettings = "'FILL' 0";
        }
      }
    });
  })();

  function togglePassVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (!input || !icon) return;
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = 'visibility_off';
    } else {
      input.type = 'password';
      icon.textContent = 'visibility';
    }
  }

  function checkPasswordRequirements(val) {
    const lenCheck = val.length >= 8;
    const numCheck = /\d/.test(val);
    const symCheck = /[!@#$%^&*(),.?":{}|<>]/.test(val);

    updateIndicator('req-length', lenCheck);
    updateIndicator('req-number', numCheck);
    updateIndicator('req-symbol', symCheck);
  }

  function updateIndicator(elemId, valid) {
    const elem = document.getElementById(elemId);
    if (!elem) return;
    const icon = elem.querySelector('.material-symbols-outlined');
    if (valid) {
      elem.classList.remove('text-outline');
      elem.classList.add('text-on-tertiary-container');
      if (icon) {
        icon.textContent = 'check_circle';
        icon.style.fontVariationSettings = "'FILL' 1";
      }
    } else {
      elem.classList.add('text-outline');
      elem.classList.remove('text-on-tertiary-container');
      if (icon) {
        icon.textContent = 'radio_button_unchecked';
        icon.style.fontVariationSettings = "'FILL' 0";
      }
    }
  }

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



</script></main>
<!-- BottomNavBar -->
<?php if(!isset($_SESSION["pass"])){?>
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
<a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-low h-full w-full rounded-DEFAULT" href="logout.php">
<span class="material-symbols-outlined text-[24px]">logout</span>
<span class="text-label-sm font-label-sm mt-1">Salir</span>
</a>
</nav>
<?php } ?>
<!-- The Modal -->
    <div id="myModal" class="modal">
		
        <!-- Modal content -->
        <div class="modal-content">
			
            <div class="modal-body" id="modal-body">
    
            </div>
			
        </div>
		    <div class="closse" onclick="cerrarmodal()"><i class="fa-solid fa-circle-xmark" style="font-size: 30px"></i></div>
    </div>
<!-- Adjust main content margin for desktop sidebar -->
<style>
        @media (min-width: 768px) {
            main {
                margin-left: 16rem; /* 256px */
                max-width: calc(100% - 16rem);
            }
        }
    </style>
<script>
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