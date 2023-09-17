<?php
	include("conexion.php");   
    
    $response = array();
	
	if (!$conexion) {		
        $response = array('statusis' => false, 'msg' => 'Connection lost to DB, contact with Data Mining please');
        echo json_encode($response);
        exit();
	} else {				
		if ($_SERVER["REQUEST_METHOD"] == "POST") {			
            processRequest($conexion);
		} else {
			$response = array('statusis' => false, 'msg' => 'There is not POST or GET request');
            echo json_encode($response);
            exit();
		}								
	}		

function processRequest($conexion) {
    $idi = $_POST['idi'];
    $bay = $_POST['bay'];
    $jsonRequest = $_POST['json'];

    try {
        if (!empty($jsonRequest) || !empty($idi)) {            
            $jsondecode = json_decode($jsonRequest);
            $queryString = "";
            foreach ($jsondecode as $key => $value) {						
                $queryString .= $value.",";
            } #end for		                                                            
                            
            $trimmedString = rtrim($queryString, ',');                
            $updateQuery = ($bay === "BAY 3" || $bay === "BAY 5") ? "UPDATE `check_list_fiber35_Infra` SET $trimmedString WHERE `check_list_fiber35_Infra`.`id_check` = ?"
                                                                  : "UPDATE `check_list_fiber_Infra` SET $trimmedString WHERE `check_list_fiber_Infra`.`ID` = ?";			                                                
            $stmt = $conexion->prepare($updateQuery);                
            if ($stmt === false) {                                    
                $response = array('statusis' => true, 'msg' => $conexion->error);                      
                echo json_encode($response);                
            }
    
            $stmt->bind_param("i", $idi);
            
            if ($stmt->execute() === true) {
                $response = array('statusis' => true, 'msg' => 'Records updated successfully.');                
                echo json_encode($response);                                       
            } else {            
                $response = array('statusis' => false, 'msg' => $stmt->error);                       
                echo json_encode($response);                
            }                                            
                                                                                                                                                                
        } else {
            $response = array('statusis' => false, 'msg' => 'Data received is empty.');
            echo json_encode($response);            
        }//end if $send	

        $stmt->close();                
        $conexion->close();

    } catch (\Throwable $th) {
        $response = array('statusis' => false, 'msg' => $th);
        echo json_encode($response);
        exit();
    }
    	
} # end processRequest
?>