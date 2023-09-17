<?php
	include("conexion.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$pressedButton = isset($_POST["button"]) ? $_POST["button"] : "";
		$jsonFrom = isset($_POST["json"]) ? $_POST["json"] : "";

		if (!empty($jsonFrom)) {
			$jsonDecoded = json_decode($jsonFrom, true);

			if (!empty($pressedButton)) {
				switch ($pressedButton) {
					case 'registerNew':
						$insert_fiber = "INSERT INTO tbl_fiber_replace (bay, location, instalation_date, status, functional, project, comments, new_sn, instalation_date2, time_life) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

						$queryCreado = crearQuery($jsonDecoded, $pressedButton);
						$stmt = mysqli_prepare($conexion, $insert_fiber);

						if ($stmt) {
							/**
							 * La sintaxis ...$queryCreado se utiliza para desempaquetar un array o lista en una lista de 
							 * argumentos separados por comas. En este caso, $queryCreado es un array que contiene los 
							 * valores de los parámetros que se van a enlazar a la consulta preparada, y se desempaqueta 
							 * para pasar los valores como argumentos separados por comas a la función mysqli_stmt_bind_param().
							 */
							mysqli_stmt_bind_param($stmt, "sssssssssi", ...$queryCreado);
							$insert_user_query = mysqli_stmt_execute($stmt);
							
							if ($insert_user_query) {
								echo json_encode("Successful");								
							} else {
								echo json_encode("Fail");
							}
						} else {
							echo json_encode("Fail");
						}
						mysqli_stmt_close($stmt);
						break;

					case 'changeFiber':
						#Aqui el codigo para cuando se va a realizar el cambio de una fibra por bay y locacion
						break;
				} # end Switch
			} else {
				echo json_encode("Fail");
			} # end pressedButton
		} else {
			echo json_encode("Fail");
		} # end jsonFrom
	} # end REQUEST_METHOD

	function crearQuery($jsonArray, $opcionCrud) {
		$sqlConcatenar = [];		
		switch ($opcionCrud) {
			case 'registerNew':
				foreach ($jsonArray as $clave => $valores) {
					if ($clave == "bay_number") {
						$bayNum = $valores;
					} elseif ($clave == "location") {
						$location = $valores;
					} elseif ($clave == "new_sn_fiber") {
						$noSerie = $valores;
					} elseif ($clave == "instalation_date") {
						$dateInstalation = $valores;
					} elseif ($clave == "status_fiber") {
						$statusFiber = $valores;
					} elseif ($clave == "project") {
						$project = $valores;
					} elseif ($clave == "comment") {
						$comment = $valores;
					} elseif ($clave == "functional") {
						$functional = $valores;
					}							       
			} // end foreach			
			$sqlConcatenar = [$bayNum, $location, $dateInstalation, $statusFiber, $functional, $project, $comment, $noSerie, $dateInstalation, 0];
				break;

			case 'changeFiber':
				# code...
				break;
		}
		return $sqlConcatenar;
	} # end crearQuery
?>