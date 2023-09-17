<?php
    include("conexion.php");
    include_once("get_hours.php");

    $response = array();
    $arrBaysFound = array();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {            
        $bayToSearch = "";

        $arrBays = array("bay_1" => "BAY 1", "bay_2" => "BAY 2", "bay_3" => "BAY 3", "bay_4" => "BAY 4", "bay_5" => "BAY 5", "bay_6" => "BAY 6", "bay_7" => "BAY 7", "bay_8" => "BAY 8" ,"mdiag" => "MDIAG", "nautilus" => "NAUTILUS");
        foreach ($arrBays as $key => $valueBay) {      
            $shiftGot = getByShift($shiftIs);                      
            $arrBaysFound[] =  baysDamagesAre($shiftGot, $valueBay, $conexion);                    
        } #end foreach arrBays  
                               
            $response = array('boolean' => true, 'msg' => 'success', 'data' => $arrBaysFound);
            echo json_encode($response);            
            mysqli_close($conexion);
            exit();        
    } else {
        $response = array('boolean' => false, 'msg' => 'error');
        echo json_encode($response);                    
        exit();
    }

function getByShift($shiftIs) {        
    $lastShift = "";    
    $arrShifts = array("1st" => "3rd", "2nd" => "1st", "3rd" => "2nd", "4th" => "3rd", "5th" => "4th");

    foreach ($arrShifts as $key => $value) {
        if ($shiftIs == $key) {
            $lastShift = $value;
            break;
        }
    }                   
    return $lastShift;
}  # end getByShift

function baysDamagesAre($shiftGotten, $bayValue, $conexion) {
    include_once("conexion.php");        
    $sqlQuery = ""; 
    $arrBaysGot = array();    

    try {
        $sqlQuery = ($bayValue ==  "BAY 3" || $bayValue ==  "BAY 5") ? "SELECT `id_check`, `bay_name`, `flag` FROM `check_list_fiber35_Infra` WHERE `id_check` = (SELECT MAX(`id_check`) FROM `check_list_fiber35_Infra` WHERE `bay_name` = ? AND `shift_user` = ? AND flag = 'false')" : 
            "SELECT `ID`, `BAY`, `flag` FROM `check_list_fiber_Infra` WHERE `ID` = (SELECT MAX(`ID`) FROM `check_list_fiber_Infra` WHERE `BAY` = ? AND `Turno` = ? AND flag = 'false')";       
                
        # Preparar la consulta
        $stmt = mysqli_prepare($conexion, $sqlQuery);
        
            # Asociar los parámetros, desempaquetando el parametro de la Bahia seleccionada y el shift, ejecutar la consulta:
            mysqli_stmt_bind_param($stmt, "ss", $bayValue, $shiftGotten);
            mysqli_stmt_execute($stmt);
            $executeQuery = mysqli_stmt_get_result($stmt);                                
           
            if(mysqli_num_rows($executeQuery) > 0) {
                # Recorrer los resultados y asignar valores a variables separadas                
                while ($row = mysqli_fetch_array($executeQuery)) {                                                              
                        if ($bayValue ==  "BAY 3" || $bayValue ==  "BAY 5") {
                            $arrBaysGot[] = array('bayId' => $row["id_check"], 'bayname' =>  $row["bay_name"], 'bayflag' => $row["flag"]);                            
                        } else {
                            $arrBaysGot[] = array('bayId' => $row["ID"], 'bayname' =>  $row["BAY"], 'bayflag' => $row["flag"]);                                                        
                        } 
                    } #end while                                                                                                                                            
                } else {
                    $arrBaysGot[] = array('bayId' => '', 'bayname' =>  '', 'bayflag' => '');                
            } # end if ysqli_num_rows                                            
                   
    } catch (\Throwable $th) {
        $response = array('statusis' => false, 'msg' => $th);
        echo json_encode($response);
        exit();
    }            

    return $arrBaysGot;
    //mysqli_close($conexion);
} # end baysDamagesAre     
    
?>