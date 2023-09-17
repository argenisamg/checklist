<?php 
	
	date_default_timezone_set('America/Chihuahua');
	
	$dateNow = date('Y-m-d');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Reporte de incidentes</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>
	<h1>Reporte de Incidentes</h1>
	
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

</body>
</html>
