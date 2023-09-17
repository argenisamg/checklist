<?php 
	
	date_default_timezone_set('America/Chihuahua');
	
	$dateNow = date('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head><title>Report Incident</title>

	<link rel="stylesheet" type="text/css" href="lib/datatables.min.css"/>
	<script type="text/javascript" src="lib/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="lib/datatables.min.js"></script>


	<link rel="stylesheet" type="text/css" href="css/modal.css" />
	<!--link rel="stylesheet" type="text/css" href="css/style.css" /-->
	<!-- Agregamos los estilos de Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Agregamos nuestro archivo CSS personalizado -->
	<link rel="stylesheet" href="css/style2.css">
	
</head>
<body>
	<div class="container">
		<h1>REPORTE DE INCIDENTES</h1>

			<div class="input-group-append">
	
				<input id="open" class="btn" type="button" value="Add Incident">

			  
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Incident</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
						<form method="POST" action="php/addIncidencia.php" enctype="multipart/formdata">
	
							<label for="datei">Date incident:</label>
							<input type="date" name="datei" required><br><br>
						
							<label for="user">User name:</label>
							<input type="text" name="user" required><br><br>
							
							<label for="title">Title:</label>
							<input type="text" name="title" required><br><br>
							
							<label for="tea">Test area:</label>
							<input type="text" name="tea" required><br><br>
							
							<label for="desc">Description:</label>
							<input type="text" name="desc" required><br><br>
							
							<label for="rh">Result Hope:</label>
							<input type="text" name="rh" required><br><br>
							
							<label for="ar">Actual Result:</label>
							<input type="text" name="ar" required><br><br>
							
							<label for="leveliss">Level issue:</label>
							<select name="leveliss">
								<option>Alto</option>
								<option>Medio</option>
								<option>Bajo</option>
							</select>
							
							<label for="level">Level:</label>
							<select name="level">
								<option>L10</option>
								<option>L11</option>
							</select><br><br>
									
							<label for="pn">P/N:</label>
							<input type="text" name="pn" required><br><br>
									
							<label for="ml">Mail Loop:</label>
							<input type="text" name="ml" required><br><br>
									
							<!--label for="ss">Screen Shot:</label>
							<input type="file" name="ss" required><br><br-->
									
							<label for="s">Status:</label>
							<input type="text" name="s" required><br><br>
									
							
							<label for="rday">Resolution Day:</label>	
							<input type="date" id="rday" name="rday" value="<?php echo $dateNow; ?>"><br><br>
							
							<input type="submit" value="Submit"  name = "send">
							
						</form>
					</div>
				</div>
			  </div>
			</div>
			
			
			
		<table id="tabla-incidencias" class="table table-dark dataTable">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">DATE</th>
					<th scope="col">USER</th>
					<th scope="col">TITLE</th>
					<th scope="col">TEST AREA</th>
					<th scope="col">DESCRIPTION</th>
					<th scope="col">RESULTADO ACTUAL</th>
					<th scope="col">RESULTADO ESPERADO</th>
					<th scope="col">GRAVEDAD</th>
				</tr>
			</thead>
			<tbody id="table-body">
				

			</tbody>

		</table>
	</div>

</body>



</html>
