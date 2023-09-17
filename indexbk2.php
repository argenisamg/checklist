<!DOCTYPE html>
<html>
	<head>
		<title>Wiwynnn - Check list</title>
		<link rel="stylesheet" href="css/wiwynn-icon.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/logincss.css" rel="stylesheet" type="text/css">		
						
	</head>
<body>

	<div class="fade-in" id="contenedor">	
		<form name="login" class="login">
			<table cellspacing="0">
				<thead>
					<th>
						<h1 style="text-align: center;">Wiwynn - Login</h1>
					</th>
				</thead>
					<tbody>
					<tr>
						<td>
							<p>User</p>
							<input type="text" autocomplete="off" id="num_part" name="user" pattern="[A-Za-z0-9 ]+" placeholder="Username" required>						
						</td>
					</tr>
					<tr>
					<td>
						<p>Password</p>
						<input type="password" id="text" name="pass" placeholder="Password" pattern="[A-Za-z0-9 ]+" required><br/>
					</td>
					<tr>
					<td>
						<input type="submit" name="login" id="btn" value="Sign In" >
					</td>
					<tr>
					</tbody>
			</table>					
			<?php include_once("recursos/loading.php");?>
		</form>
	</div>

</body>

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
