<?php

    if(!isset($_POST["selected"])) {
        $baySelected = "";        
        echo trim("Error");       
    } else {                
        $baySelected = $_POST['selected'];          
        include_once("get_hours.php");        
        
        $bayToSearch = "";
        $arrBays = array("bay_1" => "BAY 1", "bay_2" => "BAY 2", "bay_3" => "BAY 3", "bay_4" => "BAY 4", "bay_5" => "BAY 5", "bay_6" => "BAY 6", "bay_7" => "BAY 7", "bay_8" => "BAY 8" ,"mdiag" => "MDIAG", "nautilus" => "NAUTILUS");
          
        foreach ($arrBays as $key => $value) {
            if ($key == $baySelected) {
                $baySelected = $value;  
                $bayToSearch_ =  $key;
                break;
            }            
        } #end foreach arrBays                
            $shift_found_is = getQueryByShift($shiftIs);
            executeSelectToDB($shift_found_is, $baySelected, $bayToSearch_);                            
    }    

$response = array();

#Primero obtener el turno que haya registrado una locacion diferente a Good:             
function getQueryByShift($shiftIs) {        
    /**
     * Puedo crear un array que contenga los shifts y recorrerlo, cuando el shiftIs == al del array, almacenar dicho shift del array
     * en una variable que sera asignada
     */
    $arrShifts = array("1st" => "3rd", "2nd" => "1st", "3rd" => "2nd", "4th" => "3rd", "5th" => "4th");
        foreach ($arrShifts as $key => $value) {
            if ($shiftIs == $key) {
                $shift_found = $value;
                break;
            }
        }           

    return $shift_found;
}  # end getQueryByShift 

function executeSelectToDB($shift_found_is, $bayValue,  $bayKey) {
    include_once("conexion.php");
    $getId = "";
    $getBay = "";  
    $sqlQuery = "";     

    $sqlQuery = ($bayKey ==  "bay_3" || $bayKey ==  "bay_5") ? "SELECT `id_check`, `bay_name`, `flag` FROM `check_list_fiber35_Infra` WHERE `id_check` = (SELECT MAX(`id_check`) FROM `check_list_fiber35_Infra` WHERE `bay_name` = ? AND `shift_user` = ? AND flag = 'false')" : 
        "SELECT `ID`, `BAY`, `flag` FROM `check_list_fiber_Infra` WHERE `ID` = (SELECT MAX(`ID`) FROM `check_list_fiber_Infra` WHERE `BAY` = ? AND `Turno` = ? AND flag = 'false')";       
            
    # Preparar la consulta
    $stmt = mysqli_prepare($conexion, $sqlQuery);
    if (!$stmt) {
        echo "Error statement";
    } else {
        # Asociar los parámetros, desempaquetando el parametro de la Bahia seleccionada y el shift, ejecutar la consulta:
        mysqli_stmt_bind_param($stmt, "ss", $bayValue, $shift_found_is);
        mysqli_stmt_execute($stmt);
        $executeQuery = mysqli_stmt_get_result($stmt);            
    
        # Manejar errores
        if (!$executeQuery) {
            echo "Error query";             
        } else {
            if(mysqli_num_rows($executeQuery) > 0) {
                # Recorrer los resultados y asignar valores a variables separadas                
                while ($row = mysqli_fetch_array($executeQuery)) {                                                              
                        if ($bayKey ==  "bay_3" || $bayKey ==  "bay_5") {
                            $getId = $row["id_check"];
                            $getBay = $row["bay_name"];
                            $getFlag = $row["flag"];
                        } else {
                            $getId = $row["ID"];
                            $getBay = $row["BAY"];
                            $getFlag = $row["flag"];
                        }                                                                                                      
                } #end while                    
                    /**Una vez que se sabe si es true o false;
                     * implementar una funcion para hacer el select de todas las locaciones
                     * para saber cual(es) son diferentes a 'good', de tal forma que esos
                     * valores encontrados sean asignados como respuesta.
                     * Lo que va a retornar seran los indices de las locaciones, el valor y remark:                         
                     */                                   
                        $locations = crearLocaciones($getBay);               
                        selectLocations($getId, $getBay, $locations, $conexion);                                                                                                      
            } else {
                echo "good";
            } # end if ysqli_num_rows                                            
        } # end if !executeQuery
    } # end if !stmt
    
    #Cerrar la conexión
    mysqli_close($conexion);

} # end executeSelectToDB                
    
/**
 * funcion para crear las columnas de locaciones y remark de
 * la tabla de la DB:
 * * @param: $pressedButton 
 */
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

    /**Funcion para SELECT de las locaciones y Remark*/
    function selectLocations($getId_, $getBay_, $locations_, $conexion2) {
    $inicio = 1;
    $fin = 20;         

    $queryLocations = (($getBay_ == "BAY 3") || ($getBay_ == "BAY 5")) ? "SELECT `id_check`, $locations_ FROM `check_list_fiber35` WHERE `id_check` = ?" : "SELECT `ID`, $locations_ FROM `check_list_fiber` WHERE `ID` = ?" ;    

    if ($getBay_ == "NAUTILUS") {
        $inicio = 1;
        $fin = 10;
    }      
    #Preparar la consulta
    $stmt_ = mysqli_prepare($conexion2, $queryLocations);
    if (!$stmt_) {
        $failQuery_ = "Error statement";
    } else {
        #Asociar los parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt_, "s", $getId_);           
        mysqli_stmt_execute($stmt_);
        $executeQuery_ = mysqli_stmt_get_result($stmt_);          
        #Manejar errores
        if (!$executeQuery_) {
            $failQuery_ = "Error query";
        } else {                                            
            #crear un array vacío para almacenar los datos
            $result = array(); 
            $color = "";           
            $idi = 0;                         
            while ($rowes = mysqli_fetch_assoc($executeQuery_)) {   
                //print_r($rowes);
                #Recorrer el array $rowes con los 20 posiciones que arroja de acuerdo a la consulta:                        
                for ($i = $inicio; $i <= $fin; $i++) {                        
                    if ($getBay_ == "BAY 3" || $getBay_ == "BAY 5") {
                        $idi = $rowes['id_check'];
                        $color = $rowes["color_orange_".$i];                        
                        $loc = "loc_".$color."_".$i;                                                        
                            if ($rowes[$loc] != "good") {
                                $remark = "remark_".$color."_".$i;                                     
                                $result[] = array('index' => $i, 'color' => $color, 'location' => $rowes[$loc], 'remark' => $rowes[$remark]);  
                            }    
                            $color = $rowes["color_blue_".$i];                    
                            $loc = "loc_".$color."_".$i;
                            if ($rowes[$loc] != "good") {
                                $remark = "remark_".$color."_".$i;                                     
                                $result[] = array('index' => $i, 'color' => $color, 'location' => $rowes[$loc], 'remark' => $rowes[$remark]);                                                              
                        }                                                      
                    } else {          
                        $idi = $rowes['ID'];                                                                                        
                        $loc = "Loc_".$i;                            
                        if ($rowes[$loc] != "good") {
                            #agregar los datos al array asociativo $result
                            $remark = "Remark_Loc_".$i;
                            $result[] = array('index' => $i, 'location' => $rowes[$loc], 'remark' => $rowes[$remark]);
                        } #end if                             
                    } # end if $getBay_                                                                                                                                                                      
                    } #end for i
            } #end While             
            #convertir el array en un objeto JSON
            $response = array('ststusis' => true, 'msg' => 'success', 'idi' => $idi, 'data' => $result);
            $json_result = json_encode($response);            
            #enviar el objeto JSON como respuesta al AJAX que invoca esta función
            echo $json_result;            
        } #end if $executeQuery_
    } #end if $stmt_      

    #Mostrar errores si es necesario
    if (isset($failQuery_)) {
        echo "Error";
    }       
} #end function selectLocations                                               

?>        