<?php
	include("conexion.php");
	ini_set("max_execution_time", "3");
	session_start();
	
	if(isset($_POST["user"])) {
		$nombre = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
	 }
	 
	 if(isset($_POST["pass"])) {
		$password = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);		
	 }
	 
	 if (!empty($nombre) && !empty($password)) {
		$consulta = "SELECT user, password, level_user FROM tbl_ticket_users WHERE user = ? AND password = ?";
		
		$stmt = $conexion->prepare($consulta); #1
		$stmt->bind_param("ss", $nombre, $password); #2
		$stmt->execute(); #3
		$stmt->store_result(); #4
		
		if($stmt->num_rows > 0) {
		   $stmt->bind_result($user, $pass, $level);
		   $stmt->fetch();
		   
		   $_SESSION["username"] = $user;
		   $_SESSION["user_level"] = $level;					
		   header("Location: ../principal.php"); 
		}
	 }	 
 ?>