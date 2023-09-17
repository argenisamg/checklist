<?php
include_once('../../php/conexion.php');

	


	$sql = "SELECT id,
					date_incident,
					user_id,
					title,
					test_area,
					description,
					result,
					expected_result,
					damaged_level,
					level,
					p_n,
					mail_loop,
					img,
					status,
					date_resol 
			FROM repot_incedent";
	$r = mysqli_query($conexion, $sql);
	$arr = array();
	while($row = mysqli_fetch_assoc($r))
	{
		$id = $row['id'];
		$datei = $row['date_incident'];
		$user = $row['user_id'];
		$title = $row['title'];
		$tea = $row['test_area'];
		$desc = $row['description'];
		$result = $row['result'];
		$expect_result = $row['expected_result'];
		$dam_level = $row['damaged_level'];
		$leve = $row['level'];
		$p_n = $row['p_n'];
		$ml = $row['mail_loop'];
		$img = $row['img'];
		$status = $row['status'];
		$date_resol = $row['date_resol'];
		
		$arr = array($id, $datei, $user, $title, $tea);
	}
	
	foreach ($arr as $fila)
	{
		echo $fila[0];
		echo $fila[1];
		echo $fila[2];
		echo $fila[3];
	}
	
	
		// Cerrar la conexión
	mysqli_close($conexion);


?>