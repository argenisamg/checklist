<?php
include("conexion.php");
/** This php file was created to update the status flag from two tables that saves the results of check list fiber
 * It's only functions when Infra updates or repairs one or more Bays locations and they press the button "Apply Changes"
 */

if (!$conexion) {		
    $response = array('statusis' => false, 'msg' => 'Connection lost to DB, contact with Data Mining please');
    echo json_encode($response);
    exit();
} else {				
    if ($_SERVER["REQUEST_METHOD"] == "POST") {			
        verifyFunction($conexion);
    } else {
        $response = array('statusis' => false, 'msg' => 'There is not POST or GET request');
        echo json_encode($response);
        exit();
    }								
}	

$response = array(); #Array response to client

function verifyFunction($conexion) {    
    $idi = $_POST['idi'];  
    $bayValue = $_POST['bay'];  
    $inicio = 1;
    $fin = 20;
    
    try {
        if ($bayValue == "NAUTILUS") {
            $inicio = 1;
            $fin = 10;
        } 
                
        $locations = crearLocaciones($bayValue);
        $sqlQuery = ($bayValue ==  "BAY 3" || $bayValue ==  "BAY 5") ? "SELECT id_check, {$locations} FROM `check_list_fiber35_Infra` WHERE `id_check` = ?" : 
            "SELECT ID, {$locations} FROM `check_list_fiber_Infra` WHERE `ID` = ?";       
                                 
        $stmt = $conexion->prepare($sqlQuery);
        if ($stmt === false) {                                                
            $response = array('statusis' => true, 'msg' => $conexion->error);                
            echo json_encode($response);                   
        }

        $stmt->bind_param("i", $idi);
            
        if ($stmt->execute() === false) {                    
            $response = array('statusis' => false, 'msg' => $conexion->error);                              
        } else {                                                       
            try {                                                                                     
                $result = $stmt->get_result();            
                if ($result->num_rows > 0) {      
                    $iDis = 0;
                    $contGood = 0;          
                    while ($rowes = $result->fetch_assoc()) {
                    for ($i = $inicio; $i <= $fin; $i++) {                        
                            if ($bayValue == "BAY 3" || $bayValue == "BAY 5") {
                                $iDis = $rowes['id_check'];
                                $colorO = $rowes["color_orange_".$i];   
                                $colorB = $rowes["color_blue_".$i];        
                                $locB = "loc_".$colorB."_".$i;              
                                $locO = "loc_".$colorO."_".$i;      
    
                                if ($rowes[$locO] !== "good" || $rowes[$locB] !== "good") {
                                    $contGood++;
                                }          
    
                            } else {      
                                $iDis = $rowes['ID'];                                                                                            
                                $loc = "Loc_".$i;                            
    
                                if ($rowes[$loc] !== "good") {
                                    $contGood++;
                                }              

                            } #end if                                                                                                                                                                                                                             
                        } #end for
                    } # end while
        
                    if ($contGood == 0) {
                        # IF ALL LOCATIONS ARE GOOD, THEN UPDATE THE FIELD FLAG TO TRUE:
                        flagfunction($iDis, $bayValue, $conexion);
                    }
        
                } else {
                    $response = array('statusis' => true, 'msg' => 'Empty records from DB.');                
                    echo json_encode($response);
                }
                    
            } catch (\Throwable $th) {       
                $stmt->close();                
                $conexion->close();         
                die("Error: " . $th);
            }                                    
                                               
        } # end if !stmt             
    
    } catch (\Throwable $th) {
        $conexion->close();
        echo json_encode($th->getMessage());              
        exit();
    } # end catch
    
} # end executeSelectToDB                
   
function crearLocaciones($param) {
    $inicio = 1;
    $fin = 20;
    $searchPositions = "";
        if ($param == "NAUTILUS") {
            $inicio = 1;
            $fin = 10;
        }                  
    #Crear las columnas de la tabla de la DB:    
    for ($i = $inicio; $i <= $fin; $i++) {   
        if ($i == $fin) {
            $searchPositions .= (($param == "BAY 3") || ($param == "BAY 5")) ? "color_orange_".$i.", loc_orange_".$i.", remark_orange_".$i.", color_blue_".$i.", loc_blue_".$i.", remark_blue_".$i : "Loc_".$i.", Remark_Loc_".$i;
        } else {
            $searchPositions .= (($param == "BAY 3") || ($param == "BAY 5")) ? "color_orange_".$i.", loc_orange_".$i.", remark_orange_".$i.", color_blue_".$i.", loc_blue_".$i.", remark_blue_".$i.", " : "Loc_".$i.", Remark_Loc_".$i.", ";
        }                     
    }
    return $searchPositions;            
} #end function crearLocaciones

function flagfunction($idi, $bay, $conexion) {
    try {
        $updateQuery = ($bay === "BAY 3" || $bay === "BAY 5") ? "UPDATE `check_list_fiber35_Infra`  SET `flag` = 'true'  WHERE `check_list_fiber35_Infra`.`id_check` = ?"
                                                            : "UPDATE `check_list_fiber_Infra` SET `flag` = 'true' WHERE `check_list_fiber_Infra`.`ID` = ?";			                                                
        $stmt = $conexion->prepare($updateQuery);                        
        if ($stmt === false) {            
            $response = array('statusis' => true, 'msg' => $conexion->error);                
            echo json_encode($response);                                                                         
        }
        
        $stmt->bind_param("i", $idi);
        if ($stmt->execute() === true) {
            $response = array('statusis' => true, 'msg' => 'Flag updated successfully.');                
            echo json_encode($response);                                               
        } else {
            $response = array('statusis' => true, 'msg' => $conexion->error);                
            echo json_encode($response);          
        } 
        
    } catch (\Throwable $th) {
        $conexion->close();
        echo json_encode($th->getMessage());              
        exit();
    }                           
} # end flagfunction

$stmt->close();                
$conexion->close();
exit();
?>