<html>
	<head>
		<title>Administración</title>
		
		<link rel="stylesheet" href="estilos/estilos_index.css">
		<link rel="stylesheet" href="font_awesome/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="estilos/styles.css">
		
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maxmum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

		<link rel="icon" href="images/dashboard.png" type="image/png">
	</head>
	<body style="background: url('images/<?php echo rand(1,10);?>.png') no-repeat; background-size: cover; background-position: top center;">
		<video autoplay="" muted="" loop="" playsinline="" controlslist="nodownload" src="https://gptecnologia.com.mx/helpdesk/video/Design - 48420.mp4" type="video/mp4" id="video_background" preload="auto" volume="50">
		</video>
		<div class="centrado_logo">
			<h2>&nbsp;</h2>
			<img src="images/logotrans.png" border="0"  style="margin-top:35px">
		</div>
		<div class="centrado_index">
			<form name="flogin" id="flogin" method="POST" action="validausuario.php">
				<div>
					<label for="user" class="tit_login">Usuario</label>
					<div class="hf">
						<input type="text" name="user" id="user">
					</div>
				</div>
				<div>
					<label for="pass" class="tit_login">Contraseña</label>
					<div class="hf">
						<input type="password" name="pass" id="pass">
					</div>
				</div>
				<div>
					<div class="hf" style="margin-top: calc(var(--spacing)* 13);">
						<input type="submit" name="botingresar" id="botingresar" value="Ingresar" class="boton">
					</div>
				</div>
				<div style="display: flex; justify-content: center; align-items: center;">
					<img src="images/fundacion-best-logo.png" border="0" width="200" style="margin-top: calc(var(--spacing)* 13);">
				</div>
			</form>
		</div>
		<div class="power">
			<!--<img src="images/logo_grupo_solve.png" border="0" width="100">-->
		</div>
	</body>
</html>

<?php
//Created with human intelligence by @jkarreno 2023 - 2024
//May the force be with you
//move your stars
//always ready
?>