<!DOCTYPE html>
<html>
	<head>
		<title>Wiwynnn - Check list</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/logincss.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
					
	</head>
<body>

	<div class="container">		
			<div class="img">
				<img class="wave" src="images/wiwynnwhite.png" alt="Wiwynn - E-Tracker">	
			</div>	
			<div class="fade-in">	
				<div class="login-content">
					<form id="loginForm" name="login" class="loginForm">
						<h1>WIWYNN - WELCOME</h1>	
						<div class="interior">							
							<div class="inputs-user">
								<div class="input-div one">
									<i class="fas fa-user"></i>
									<div class="div">																				
										<input type="text"  class="input" autocomplete="off" id="num_part" name="user" pattern="[A-Za-z0-9 ]+" placeholder="Username" required>												
									</div>
								</div>							
								<div class="input-div pass">
									<i class="fas fa-lock"></i>
									<div class="div">																																										
										<input type="password" class="input" id="text" name="pass" autocomplete="off" placeholder="Password" pattern="[A-Za-z0-9 ]+" required><br/>								
									</div>
								</div>							
								<!-- <a href="#">Forgot Password?</a> -->
							</div>
							<input type="submit" name="login" id="btn" value="Sign In">		
						</div>							
					</form>
				</div>
				<?php include_once("recursos/loading.php");?>
			</div>
	</div>


</body>

<!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
<script src="JS/fontawesome/a81368914c.js"></script>
<script type="text/javascript" src="JS/jquery.min.js"></script>
<script type="text/javascript">

		// Obtener las referencias a los elementos HTML necesarios
		const form = document.querySelector('form');
		const submitBtn = document.querySelector('#btn');
		const loading = document.querySelector('#loading');
		const spinner = document.querySelector('.loadingio-spinner-ellipsis-oslofo8v1d');

		// Función para detener la animación del spinner
		function detenerSpinner() {
			spinner.style.animation = 'none';
		}

		// Función para manejar la solicitud de inicio de sesión
		function handleLogin(event) {
			// Establecer un tiempo de espera de 5 segundos
			var tiempoEspera = 5000; // 5000 milisegundos = 5 segundos

			// Detener la animación después de 5 segundos
			setTimeout(function() {
				spinner.style.animation = 'none'; // Detener la animación
			}, tiempoEspera);
			
			// Evita que el formulario se envíe normalmente
			event.preventDefault();
			
		// Oculta el botón "Enviar" y muestra la animación de carga
		submitBtn.style.display = 'none';
		loading.style.display = 'block';

		// Realiza la solicitud de inicio de sesión
		fetch('php/loguear.php', {
			method: 'POST',      
			body: new FormData(form)
		})
		.then((response) => {
			// Oculta la animación de carga y muestra el botón "Enviar"
			loading.style.display = 'none';
			submitBtn.style.display = 'block';
			
			// Maneja la respuesta de la solicitud de inicio de sesión
			if (response.ok) {
				// Redirige a la página de inicio
				window.location.href = 'principal.php'; ///php/loguear.php
			} else {
				// Muestra un mensaje de error
				alert('Incorrect data.');
			}
		})
		.catch((error) => {
			// Oculta la animación de carga y muestra el botón "Enviar"
			loading.style.display = 'none';
			submitBtn.style.display = 'block';

			// Muestra un mensaje de error
			alert('An error occurred while logging in: ' + error.message);
		})
			.finally(() => {
				// Detener la animación del spinner después de que se complete la solicitud
				detenerSpinner();
			});
		}
		
		// Agrega un controlador de eventos para el formulario
		form.addEventListener('submit', handleLogin);
	</script>
</html>		