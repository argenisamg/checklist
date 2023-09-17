<?php
	include("php/conexion.php");
	$failed = true;
		if( !$conexion ) {														
			$failed = false;																									
		}

	session_start();
		$nombre = $_SESSION['username'];	
		$role = $_SESSION['user_level'];	
		if(!isset($nombre))
		{
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
        <title>Wiwynn- Fiber register</title>
        <link rel="stylesheet" href="css/wiwynn-icon.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link href="css/insert.css" type="text/css" rel="stylesheet">	        
        <link href="css/toggle-switch.css" type="text/css" rel="stylesheet">	        
				
		<style>			
		/* Fondo modal: negro con opacidad al 50% */
		.modal {
				display: none; /* Por defecto, estará oculto */
				position: fixed; /* Posición fija */
				z-index: 1; /* Se situará por encima de otros elementos de la página*/
				padding-top: 10rem;
				left: 0;
				top: 0;
				width: 100%; /* Ancho completo */
				height: 100%; /* Algura completa */				
				background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
			}    
			/* Ventana o caja modal */
			.contenido-modal {
				position: relative; /* Relativo con respecto al contenedor -modal- */
				background-color: white;
				border-radius: 4px;
				margin: auto; /* Centrada */
				padding: 10px;
				width: 90%;
				-webkit-animation-name: animarsuperior;
				-webkit-animation-duration: 0.5s;
				animation-name: animarsuperior;
				animation-duration: 0.5s
			}

			.contenido-modal h2 {
				text-align: center;
				color: #565758;
			}

			/* Estilo de la tabla de contenido */
			.tablesAreaResult {   
				overflow: auto;
			}

			/* Animación */
			@-webkit-keyframes animatetop {
				from {top:-300px; opacity:0} 
				to {top:0; opacity:1}
			}

			@keyframes animarsuperior {
				from {top:-300px; opacity:0}
				to {top:0; opacity:1}
			}

			/* Botón cerrar */
			.modal-header {
				display: flex;
				flex-direction: column;
			}    

			.close {
				color: #000000;
				float: left;
				font-size: 30px;
				font-weight: bold;
			}    
			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
			.button-modal {
				display: flex;
				flex-direction: row;
				justify-content: flex-end;
			}    
			/*Loader*/
			.content-spinner {        
				display: block;
				position: fixed; /* Posición fija */
				z-index: 1; /* Se situará por encima de otros elementos de la página*/
				
				left: 0;
				top: 0;
				width: 100%; /* Ancho completo */
				height: 100%; /* Algura completa */        
				background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */

				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
			}    

			.fiberconsult {
				opacity: 0;
				transition: opacity 0.5s ease;
			}

			.show {
				opacity: 1;
			}

			/* .tabla {
				white-space: nowrap;
			} */
		</style>

    </head>	
    <body>

    <?php include_once("recursos/header.php");?>
			
	<!--Nuevo formulario-->	
	<div class="fiberregister">		
		<div class="form-infra">			
			
		<!-- Div to fill with Bay's Buttons  -->
		<div class="fiber-status-info">
			<h3 class="title-h3">Bays with any damage:</h3>
			<div id="btnCheck"></div>
		</div>

			<div id="table_register">	
				<form name="reg_fiber" id="reg_fiber">	
					<table class="table-check">		
						<th colspan="3"><h2>Fiber registration</h2></th>														
								<tr>
									<td><label for="name">Bay:</label></td>						
									<td>																				
											<select name="bay_number" id="bay_number" required> 
												<option value="">-</option>									
												<option value="bay 1">BAY 1</option>
												<option value="bay 2">BAY 2</option>
												<option value="bay 3">BAY 3</option>
												<option value="bay 4">BAY 4</option>
												<option value="bay 5">BAY 5</option>
												<option value="bay 6">BAY 6</option>
												<option value="bay 7">BAY 7</option>
												<option value="bay 8">BAY 8</option>
												<option value="mdiag">MDIAG</option>
												<option value="nautilus">NAUTILUS</option>									
											</select>
																	
									</td>
									<td><label for="location">Location:</label></td>
									<td>
										<input type="number" name="location" id="location" value="" min="1" max="999" title="Location should be 3 characters maximum" required>
									</td>						
								</tr>								
								<tr>		
									<td><label for="new_sn_fiber">New serial number:</label></td>
									<td>
										<input type="text" name="new_sn_fiber" id="new_sn_fiber" value="" size="15" required title="Serial number should be 15 characters maximum" >
									</td>
									
									<td><label for="instalation_date">Instalation date:</label></td>						
									<td>
										<input type="date" name="instalation_date"  id="instalation_date" value="" required >
									</td>																							
								</tr>										
								<tr>							
									<td><label for="status_fiber">Status:</label></td>						
									<td>											
										<select name="status_fiber" id="status_fiber" required> 
											<option value="">-</option>									
											<option value="Cosmetic damage">Cosmetic damage</option>
											<option value="Damage">Damage</option>
											<option value="Empty">Empty</option>
											<option value="Good">Good</option>																	
										</select>													
									</td>						
									<td><label for="name">Functional y/n:</label></td>						
									<td>
										<div>															
											<input type="radio" id="yes" name="option" value="Yes">
											<label for="yes">Yes</label><spam></spam>
											<input type="radio" class="input-radio-not" id="not" name="option" value="Not">
											<label for="not">Not</label>													
										</div>
									</td>														
								</tr>	
								<tr>
									<td><label for="name">Project:</label></td>
									<td>							
										<select name="project" id="project" required> 
											<option value="">-</option>									
											<option value="MFG">MFG</option>
											<option value="BSL">BSL</option>
											<option value="MDaaS">MDaaS</option>																		
										</select>										    
									</td>
									<td><label for="name">Comments:</label></td>						
									<td>														
										<select name="comment" id="comment" required> 
											<option value="">-</option>									
											<option value="Busted connector">Busted connector</option>
											<option value="Lack of fiber">Lack of fiber</option>
											<option value="Exposed filaments">Exposed filaments</option>
											<option value="Broken tongue">Broken tongue</option>															
											<option value="Optimal conditions">Optimal conditions</option>
											<option value="With adhesive tape">With adhesive tape</option>
										</select>													
									</td>									
								</tr>														
								<tr>	
									<td colspan="4">
									<div class="button-group-space">	
										<!-- <a href="#" name="linkConsult" id="linkConsult" class="linkConsult">Consult per Bay</a-->
										<p>Fiber registration form</p>
										<div class="new-fiber">
											<input type='reset' name='clearButton' value='Clear'>																		
											<?php 
												if($failed) 
													echo '<input type="submit" name="registerNew" id="register" value="Register fiber">';
												else
													echo '<input type="submit" name="registerNew" id="register" value="Register fiber" disabled >';
											?>		
										</div>
									</div>										
									</td>
								
								</tr>												
					</table>
				</form>
			</div>							
		</div>			      							
	</div>				
		<!--End formulario-->

	<!-- Modal result tables -->
	<div id="ventanaModal" class="modal">
		<div class="contenido-modal">
			<span class="close" id="close">&times;</span>
			<div class="modal-header"><h2><span id="bayselected"></span></h2></div>
			
			<form id="form-fixer">
				<div class="tablesAreaResult" id="resultsTables">     
					<!-- Comparative table one -->             
					<div>
						<label id="lblMaster">Damage locations</label> 					
							<table class="table-infra">
								<thead id="theads"></thead>
								<tbody>
									<tr id="tbodys"></tr>
								</tbody>
							</table>         
						</div>                                                                                                                                                     
					</div>   <!--End tablesAreaResult-->
					<hr class="horizontal-line">			
					<div class="group-inter-button">				
						<input type="button" name="applychanges" id="applychanges" value="Apply Changes" disabled>
						<input type="button" name="closemodal" id="closemodal" value="Close">
					</div>
				</div>
			</form>

		</div>
	</div>           
                <!-- End modal Result tables  --> 

	<script type="text/javascript">  			                           
		const registerFiber = (json) => {          
			let button = document.getElementById('register').name;      
			let formData = new FormData();				
			formData.append('json', json);
			formData.append('button', button);


			const xhr = new XMLHttpRequest();
			xhr.open("POST", "php/fiber_register.php", true, xhr.responseType = "json");
			xhr.onreadystatechange = function() {
				if (xhr.readyState === XMLHttpRequest.DONE) {
				if (xhr.readyState == 4 && xhr.status === 200) {                                 
					if (xhr.response == "Successful") {
						alert("Data processed successfully.");            
						document.getElementById("reg_fiber").reset(); 
					} else {
						alert(`Error [ ${xhr.response} ], contact with Data Mining !`);
						window.location.href="./principal.php";
					}                      
				} else {
					console.error(xhr.statusText);
					alert("Error server, contact with Data Mining !");
					window.location.href="./principal.php";
				}
				}
			};
			xhr.send(formData);
			
		} // end registerFiber

		document.addEventListener("DOMContentLoaded", function (e) {	          
			const form = document.querySelector("form");		
				form.onsubmit = function(e) {       
					e.preventDefault();              
					let jsonFormData = new FormData();
					let radio = document.querySelector('input[name="option"]:checked');

					for (let input of form.elements) {
						if ((input.name !== "registerNew") && (input.name !== "clearButton") && (input.name !== "option")) {        
							if (input.value.trim().length > 0 && input.name) {                        
								jsonFormData.append(input.name, input.value);
							}   
						} 
					} // end for
						if (radio) {												
							jsonFormData.append("functional", radio.value);						
							}								
					let json_fiber = JSON.stringify(Object.fromEntries(jsonFormData.entries()), null, 2);
					if (json_fiber == "") {
						alert("Form data is empty !");
						return;
					} else {      
						registerFiber(json_fiber);
						//console.log(json_fiber);
					}				
				}//end function (e)
		});
    </script>
	
		<!-- End Formulario para realizar consultas a la DB -->
		<script type="text/javascript" src="JS/select_infra.js"></script>  


		<!-- <script type="text/javascript" src="JS/selector_bay_amg.js"></script>   -->           
		<?php include_once("recursos/footer.php");?>
    </body>
</html>