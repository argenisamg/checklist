<?php
include_once('../../php/conexion.php');

// Insertar una nueva entrada en la bitácora
	$datei = $_POST['datei'];
	$user = $_POST['user'];
	$title = $_POST['title'];
	$tea = $_POST['tea'];
	$desc = $_POST['desc'];
	$rh = $_POST['rh'];
	$ar = $_POST['ar'];
	$leveliss = $_POST['leveliss'];
	$level = $_POST['level'];
	$pn = $_POST['pn'];
	$ml = $_POST['ml'];
	$s = $_POST['s'];
	$rday = $_POST['rday'];
	//$send = $_POST['send'];
	
	//echo $datei."<br>".$user;
	
	
	//Aqui tengo la ultima id seleccionada para darle nombre a cada img
	$sq = "SELECT ID FROM repot_incedent WHERE last_insert_id(ID) ORDER BY ID DESC LIMIT 0,1;"; //and status= 'DAMAGED' ORDER BY item DESC LIMIT 0,1;
	$sqv = mysqli_query($conexion, $sq);
	error_reporting(E_ERROR);
	while($rows = mysqli_fetch_array($sqv))
		{	
		 $ids = $rows["ID"];
		}	
		
			$r = $ids + 1;
		//echo $r;
		
		/*Variables para el name de las imagenes*/
		//$b1 = "BAY 1";
		$ext =".png";
		/* NOMBRE DE LA BAY - ID - FECHA.PNG */
	   // $nm = $b1."-".$ids."-".$d2.$ext;
		$nm = $r.$ext;
		
		//echo $nm;
			  //ruta carpeta donde se van a copiar las imágenes
			  $ruta = "../uploads/";


			  //temporal generado para tener la img
		  if(!isset($_FILES['fichero']['tmp_name']))

		  {
			  $_FILES['fichero']['tmp_name']= "";
			  $uploadfile_temporal=$_FILES['fichero']['tmp_name'];
			  $_FILES['fichero']['name']="";
			  $uploadfile_nombre=$ruta.$_FILES['fichero']['name'];
		  }

		  $uploadfile_temporal=$_FILES['fichero']['tmp_name'];
		  $uploadfile_nombre=$ruta.$nm;


		  if (is_uploaded_file($uploadfile_temporal))
		  {
		  //move_uploaded_file
			  copy($uploadfile_temporal,$uploadfile_nombre);
		  }


	$sql = "INSERT INTO repot_incedent(date_incident, user_id, title, test_area, description, result, expected_result, damaged_level, level, p_n, mail_loop, img, status, date_resol)";
	$sql.= "VALUES('".$datei."', '".$user."', '".$title."', '".$tea."', '".$desc."', '".$rh."', '".$ar."', '".$leveliss."', '".$level."', '".$pn."', '".$ml."', '".$nm."', '".$s."', '".$rday."')";
	$r = mysqli_query($conexion, $sql);

	if (!$r) 
			{	
				echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
			} 
			else 
			{
				
			echo'<script type="text/javascript">
                alert("Data Saved succesful");
                window.location.href="../index.php";
    
                </script>';
			}
		
		// Cerrar la conexión
	mysqli_close($conexion);


?>