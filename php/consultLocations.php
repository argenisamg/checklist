<?php 

include("conexion.php");

    $response = array();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {  
        if(!isset($_POST['param'])) {
            $baySelected = "";        
            $response = array('boolean' => false, 'msg' => 'No GET or POST request');
            echo json_encode($response);            
            exit();       
        } else {                
            $idis = $_POST['idis'];            
            $baySelected = $_POST['param'];            
            executeSelectToDB($baySelected, $idis, $conexion);                            
        }  
        
    } else {
        $response = array('boolean' => false, 'msg' => 'POST error.');
        echo json_encode($response);                    
        exit();
    }    

function executeSelectToDB($bayValue, $idis, $conexion) {        
        $inicio = 1;
        $fin = 20;
        
        if ($bayValue == "NAUTILUS") {
            $inicio = 1;
            $fin = 10;
        } 
        
        try {
            $locations = crearLocaciones($bayValue);
            $sqlQuery = ($bayValue ==  "BAY 3" || $bayValue ==  "BAY 5") ? "SELECT id_check, {$locations} FROM `check_list_fiber35_Infra` WHERE `id_check` = ?" : 
                "SELECT ID, {$locations} FROM `check_list_fiber_Infra` WHERE `ID` = ?";       
                                    
            $stmt = mysqli_prepare($conexion, $sqlQuery);           
            # Asociar los parámetros, desempaquetando el parametro de la Bahia seleccionada y ejecutar la consulta
            mysqli_stmt_bind_param($stmt, "i", $idis);
            mysqli_stmt_execute($stmt);
            $executeQuery = mysqli_stmt_get_result($stmt);            
                    
            if(mysqli_num_rows($executeQuery) > 0) {  
                $arrResult = array();                                               
                $result = array(); 
                
                $iDis = 0;
                while ($rowes = mysqli_fetch_array($executeQuery)) { 
                    for ($i = $inicio; $i <= $fin; $i++) {                        
                        if ($bayValue == "BAY 3" || $bayValue == "BAY 5") {
                            $iDis = $rowes['id_check'];
                            $colorO = $rowes["color_orange_".$i];                        
                            $locO = "loc_".$colorO."_".$i;           
                            $remarkO = "remark_".$colorO."_".$i;                                                                   
                            
                            $colorB = $rowes["color_blue_".$i];                    
                            $locB = "loc_".$colorB."_".$i;                                    
                            $remarkB = "remark_".$colorB."_".$i;  

                            $result[] = array('colorO' => $colorO, 'locationO' => $rowes[$locO], 'remarkO' => $rowes[$remarkO], 'colorB' => $colorB, 'locationB' => $rowes[$locB], 'remarkB' => $rowes[$remarkB]);                                                                                   
                        } else {      
                            $iDis = $rowes['ID'];                                                                                            
                            $loc = "Loc_".$i;                                                                                                         
                            $remark = "Remark_Loc_".$i;
                            $result[] = array('location' => $rowes[$loc], 'remark' => $rowes[$remark]);
                            } #end if                                                                                                                                                                                                                             
                    } #end for i
                } #end while  
                $response = array('boolean' => true, 'msg' => 'success', 'idi' => $iDis, 'data' => $result);
                echo json_encode($response);  
                mysqli_close($conexion);                  
                exit();                                                                                                                                            
            } else {
                $response = array('boolean' => false, 'msg' => 'Empty data');
                echo json_encode($response);       
                mysqli_close($conexion);             
                exit();
            } # end if ysqli_num_rows                                                            
                       
        } catch (\Throwable $th) {
            $response = array('statusis' => false, 'msg' => $th);
            echo json_encode($response);
            exit();
        }        

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
?>