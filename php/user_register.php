<?php
	include("conexion.php");    
	
	if (!$conexion) {
		die('Connection lost to DB, contact with Data Mining please.');
	} else {				
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$buttonIs = ($_POST["button"])  ? $_POST["button"] : "" ;
			$jsonRequest = ($_POST["json"]) ? $_POST["json"] : "" ;

			if (!empty($buttonIs)) {
				#almacenar los campos html en variables php
				$jsondecode = json_decode($jsonRequest);
				foreach ($jsondecode as $key => $value) {
						if ($key == "user") {
							$subs_user = $value;
						} elseif ($key == "password") {
							$subs_password = $value;
						} else {
							$subs_privilege = $value;
						}
						
				} #end for			
				$insert_user_sql = "INSERT INTO tbl_ticket_users (user, password, level_user) VALUES (?, ?, ?)";
				$stmt = mysqli_prepare($conexion, $insert_user_sql);
				if ($stmt) {
					mysqli_stmt_bind_param($stmt, "sss", $subs_user, $subs_password, $subs_privilege);
					$insert_user_query = mysqli_stmt_execute($stmt);

					if(!$insert_user_query) {							
							echo'Fail';
						} else {							
							echo'Success';
						}
					mysqli_stmt_close($stmt);
				} else {
					echo'Fail';
				}																																					
			} else {
				echo'Fail';
			}//end if $send		
			//mysql_close($conexion);
		} else {
			echo'Fail';
		}					
			
	}		
?>