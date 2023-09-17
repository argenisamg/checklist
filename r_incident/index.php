<?php 
	
	date_default_timezone_set('America/Chihuahua');
	
	$dateNow = date('Y-m-d');
		include("../php/conexion.php");
	session_start();
		$nombre = $_SESSION['username'];
		if(!isset($nombre))
		{
			header('location: ../index.php');
	
		}

?>

<!DOCTYPE html>
<html>
<head><title>Report Incident</title>



    <!--link href="css/style-view.css" rel="stylesheet"-->




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
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link href="css/uploadstyle.css" type="text/css" rel="stylesheet">
	
</head>
<body>
	<!--?php include_once("../recursos/header.php");?-->
	
	<div class="container">
		<h1>REPORTE DE INCIDENTES</h1>
		<!--input type="text" id="search"  size="40" class="form-control mb-3" placeholder="Buscar..."-->
		  <!-- Input y botón de búsqueda -->
		  <div class="row">
			<div class="col-md-6">
			  <div class="input-group mb-3">
				<input type="text" id="search" class="form-control" placeholder="Buscar incidente">
			  </div>
			</div>
		  </div>
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
						<form method="POST" action="php/addIncidencia.php" enctype="multipart/form-data">
	
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
							</select><br><br>
							
							<label for="level">Level:</label>
							<select name="level">
								<option>L10</option>
								<option>L11</option>
							</select><br><br>
									
							<label for="pn">P/N:</label>
							<input type="text" name="pn" required><br><br>
									
							<label for="ml">Mail Loop:</label>
							<input type="text" name="ml" required><br><br>
									
							<label for="ss">Screen Shot:</label>
							<input type="file" name="fichero">
							<!--div class="input__row uploader">
								<div id="inputval" class="input-value"> </div>
								<label for="file"></label>
								<input id="file" class="upload"  name="fichero" type="file"> 
							</div>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script--><br><br>
									
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
					<th scope="col">NIVEL</th>
					<th scope="col">P/N</th>
					<th scope="col">MAIL LOOP</th>
					<th scope="col">IMAGEN</th>
					<th scope="col">ESTADO</th>
					<th scope="col">FECHA DE RESOLUCION</th>
				</tr>
			</thead>
			<tbody id="table-body">
				<?php
				  // Conexión a la base de datos
				  include_once('../php/conexion.php');
				  

				  // Consulta SQL
				  $query = "SELECT * FROM repot_incedent";
				  $result = mysqli_query($conexion, $query);

				  // Mostrar resultados en la tabla
				  while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>{$row['id']}</td>";
					echo "<td>{$row['date_incident']}</td>";
					echo "<td>{$row['user_id']}</td>";
					echo "<td>{$row['title']}</td>";
					echo "<td>{$row['test_area']}</td>";
					echo "<td>{$row['description']}</td>";
					echo "<td>{$row['result']}</td>";
					echo "<td>{$row['expected_result']}</td>";
					echo "<td>{$row['damaged_level']}</td>";
					echo "<td>{$row['level']}</td>";
					echo "<td>{$row['p_n']}</td>";
					echo "<td>{$row['mail_loop']}</td>";
					echo "<td> <img src='uploads/{$row['img']}' width='40px' heigth='40px'> </td>";
					echo "<td>{$row['status']}</td>";
					echo "<td>{$row['date_resol']}</td>";
					echo "</tr>";
				  }

				  // Cerrar la conexión
				  mysqli_close($conexion);
				?>
			</tbody>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#tabla-incidencias').DataTable();
				});
			</script>
		</table>
	</div>
	<!-- Agregamos los scripts de Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

	<script>
	  $(document).ready(function() {
		// Agregar evento keyup al input de búsqueda
		$('#search').on('keyup', function() {
		  var value = $(this).val().toLowerCase();
		  // Filtrar filas de la tabla que no contienen el valor de búsqueda
		  $('#table-body tr').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
		});
	  });
	</script>
	<script>
	  // Abre la ventana modal al hacer clic en el botón
	  document.getElementById("open").addEventListener("click", function() {
		$("#myModal").modal("show");
	  });
	</script>
	

</html>
