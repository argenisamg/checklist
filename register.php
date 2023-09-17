<?php
	include("php/conexion.php");
	session_start();

	$nombre = $_SESSION['username'];	
	$role = $_SESSION['user_level'];	
		if(!isset($nombre)) {
			header('location: index.php');	
		}		
		if( $role == 2 ) {	
			echo'<script type="text/javascript">
				alert("Unauthorized user !");
				window.location.href = "principal.php";					
				</script>';
		}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wiwynn - User register</title>
        <link rel="stylesheet" href="css/wiwynn-icon.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <link href="css/insert.css" type="text/css" rel="stylesheet">				
    </head>

	<script type="text/javascript">
			const registerNewUser = (jsonReceived) => {
				let button = document.getElementById("newUserButton").name;
				let formSend = new FormData();
				formSend.append('button', button);
				formSend.append('json', jsonReceived);

				fetch('php/user_register.php', {
					method: 'POST',					
					body: formSend
				})
				.then(response => {
					if (response.ok) {
						return response.text();
					} else {
						throw new Error('An error occurred while submitting the request.');
					}
				})
				.then(responseText => {					
					//console.log(responseText);
					 if (responseText == "Fail") {
					 	alert(`Error: [ ${responseText} ], contact with Data Mining !`);
					 	window.location.href = "./principal.php";
					 } else {
						alert("User registered succesfully.");
						document.getElementById("reg_user").reset();
					 } //end if ajaxRequest
				})
				.catch(error => console.error(error));

			} // end registerNewUser

			document.addEventListener("DOMContentLoaded", function (params) {
				const form = document.querySelector("form");
				form.onsubmit = function(params) {
					params.preventDefault();
					let formData = new FormData();
					for (let entrada of form.elements) {
						if (entrada.name == "registerButton" || entrada.name == "clearButton") {
							continue;
						}
						if (entrada.value.trim().length > 0 && entrada.name) {
							formData.append(entrada.name, entrada.value);
						} // end if
					} // end for
					//crear el json en formato cadena de texto vertical:
					let jsonNewUser = JSON.stringify(Object.fromEntries(formData.entries()), null, 2);
					if (jsonNewUser == "") {
						alert("JSON data is empty.");
						return;
					} else {      
						registerNewUser(jsonNewUser);
						//console.log(jsonNewUser);
					}
				} //end form.onsubmit
			});
		</script>
    <body>

    <?php include_once("recursos/header.php");?> 
				
		<div class="contenedor-formularios">	
			<div id="table_register">			
				<form id="reg_user">	
					<table class="table-check">		
						<th>
						<h2>User registration</h2>
						</th>															
							<tr>						
								<td>							
								<label for="name">User:</label><input type="text" id="name" name="user" value="" size="16" placeholder="User name" required title="user should be not more than 15 characters">
								</td>										
							</tr>								
							<tr>								
								<td>
									<label for="name">Password:</label><input type="password" name="password"  value="" size="16" required  title="Password should be not more than 15 characters" >
								</td>
							</tr>										
							<tr>						
								<td><label for="name">Privilege:</label>											
									<select name="privilege">	
									<option value = "select" >-</option>			
										<?php 									
										if( $conexion ) {														
											$failed = true;												
											$select_user_sql = "SELECT * FROM tbl_rticket_roles ";															
							
												if ( $result = $conexion -> query( $select_user_sql ) ) {
													$failed = true;																					
													while ($row = $result -> fetch_assoc()) {
														$field_id_rol = $row["id_rol"];
														$field_rol_usuario = $row["rol_usuario"];									
														echo '<option value = "'.$field_id_rol.'" >'.$field_rol_usuario.' </option>';											
													}		
														/*freeresultset*/
														$result -> free();
												} else {
													
													$failed = false;
													echo '<option value = "" >Failed to get data ! </option>';											
												} // end if $result	
													
											} else {
												$failed = false;
												echo'<script type="text/javascript">
													alert("Connection lost to DB, contact with Data Mining please.");
													window.location.href = "principal.php";					
													</script>';
																	
												} //end if $conexion
										?>									
									</select>								
								</td>		
							</tr>					
							<tr>						
								<td>	
									<div class="button-group">										
										<input type='reset' name='clearButton' value='Clear'>							
										<?php 
											if( $failed == true ) 
												echo '<p align="left"><input type="submit" name="registerButton" id="newUserButton" value="Register"></p>';								
											else
												echo '<p align="left"><input type="submit" name="registerButton" id="newUserButton" value="Register" disabled ></p>';							
										?>																					
									</div>
								</td>												
							</tr>									
					</table>
				</form>		
			</div>
		</div>
		<!--End formulario-->
		<?php include_once("recursos/footer.php");?>

    </body>
</html>