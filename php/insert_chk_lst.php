<?php        
    #Obtener el dato de la bahia seleccionada por el boton presionado en el formulario:
    $pressedButton = "";    
    if(isset($_POST["button"])) {
        $pressedButton = $_POST["button"];                                    
        getJSON($pressedButton);        
    } else {
        echo json_encode("false");        
        $pressedButton = "";
    }             
    #Recuperar el json:
    function getJSON($pressButton) {
        include_once("conexion.php"); 
        if(isset($_POST["json"])) {            
            $jsonFrom = $_POST["json"];            
            processRequestFrom($conexion, $jsonFrom, $pressButton);            
        } else {
            $jsonFrom = "";
            echo json_encode("false en JSON");
            //echo "false en JSON";
        }
    } # end getJSON   

function processRequestFrom($conexion, $jsonReceived, $pressButton) {                
    if ($jsonReceived != "" || $jsonReceived != null) {         
        #Decodificar el json en un array:
        $jsonDecoded = json_decode($jsonReceived, true);                
        #Identificar la respuesta al AJAX:
        $message = "";
        $foundBayKey = "";
        $foundBayValue = "";
        #Identificar cual sera el INSERT a la DB con base al boton presionado '$pressButton'    
        $arrayPerBay = array("bay_1" => "BAY 1", "bay_2" => "BAY 2", "bay_3" => "BAY 3", "bay_4" => "BAY 4", "bay_5" => "BAY 5", "bay_6" => "BAY 6", "bay_7" => "BAY 7", "bay_8" => "BAY 8", "mdiag" => "MDIAG", "nautilus" => "NAUTILUS");
        $sqlInsert = "";
            foreach ($arrayPerBay as $key => $value) {
                if ($pressButton == $key) {
                    $foundBayKey = $key;
                    $foundBayValue = $value;
                    break;                                                 
                    }                         
            } #End foreach

            try {
                //Start the transaction:
                mysqli_autocommit($conexion, false);

                //First transaction:
                $insertPositions = createLocations($foundBayKey);
                $sqlInsert = ($pressButton == "bay_3" || $pressButton == "bay_5") ? "INSERT INTO `check_list_fiber35` (`bay_name`, `date_insert`, `day_insert`, `pic_user`, `shift_user`, ".$insertPositions."`remark_all`, `flag`, `review`)" : 
                    "INSERT INTO `check_list_fiber` (`BAY`, `DATE_INSERT`, `DAY_INSERT`, `PIC`, `Turno`, ".$insertPositions." `Remark`, `flag`, `review`)";            

                $valuesQuery = ($pressButton == "bay_3" || $pressButton == "bay_5") ? str_repeat("?,", 128) : ($pressButton == "nautilus" ? str_repeat("?,", 28) : str_repeat("?,", 48));
                $valuesQueryLessCharacter = substr($valuesQuery, 0, -1); #como en la linea anterior se crearon los VALUES con una coma, aqui se quita la ultima.     
                $sqlInsert .= " VALUES ($valuesQueryLessCharacter)";                                                                                                                                                                     
                $crearValoresconcatenar = createQuery($jsonDecoded, $foundBayKey, $foundBayValue);  

                $stmt1 = mysqli_prepare($conexion, $sqlInsert);     
                $valuesParam = ($pressButton == "bay_3" || $pressButton == "bay_5") ? str_repeat("s", 128) : ($pressButton == "nautilus" ? str_repeat("s", 28) : str_repeat("s", 48));                    
                mysqli_stmt_bind_param($stmt1, $valuesParam, ...$crearValoresconcatenar);         
                mysqli_stmt_execute($stmt1);        
                mysqli_stmt_close($stmt1);
            
                //Second transaction:
                $sqlInsert = ($pressButton == "bay_3" || $pressButton == "bay_5") ? "INSERT INTO `check_list_fiber35_Infra` (`bay_name`, `date_insert`, `day_insert`, `pic_user`, `shift_user`, ".$insertPositions."`remark_all`, `flag`, `review`) VALUES ($valuesQueryLessCharacter)" : 
                "INSERT INTO `check_list_fiber_Infra` (`BAY`, `DATE_INSERT`, `DAY_INSERT`, `PIC`, `Turno`, ".$insertPositions." `Remark`, `flag`, `review`) VALUES ($valuesQueryLessCharacter)";                                                                                                                                                                                                    
                $stmt2 = mysqli_prepare($conexion, $sqlInsert);                    
                mysqli_stmt_bind_param($stmt2, $valuesParam, ...$crearValoresconcatenar);         
                mysqli_stmt_execute($stmt2);        
                mysqli_stmt_close($stmt2);

                // Confirmar las inserciones
                mysqli_commit($conexion);
                
                //Make the response:
                $message = "true";
                echo json_encode($message);

                //Processthe file:
                processFile($conexion, $pressButton);    
            } catch (\Throwable $th) {  
                mysqli_rollback($conexion);    
                echo json_encode($th->getMessage());              
                exit();                    
            }
                                        
        } else {
            echo "Empty JSON";
        } // end if $jsonFrom !== ""
} # end procesRequestFrom
                                        
/**
 * Funcion para recorrer el json recibido en el alcance de POST y generar
 * el string para el Query con los valores que este contiene:
 * * @param: $jsonDecoded & $pressedButton
 *  */            
function createQuery($jsonArray, $foundBayKey_, $foundBayValue_) {
    $sqlConcatenar = $foundBayValue_.","; 
        #definir la fecha en la que se hace el chek list    
        date_default_timezone_set('America/Denver');
        $dateZone = date('Y-m-d H:i');   
        $sqlConcatenar .= $dateZone.",";           
        foreach ($jsonArray as $clave => $valores) {        
            if (($foundBayKey_ == "bay_3") || ($foundBayKey_ == "bay_5")) { 
                #Todas estas sentencias ifelse son para evaluar las fibras orange, blue y funciona bien:
                if (($valores === "good") || ($valores === "damage") || ($valores === "bad") || ($valores === "empty")) {                    
                    $sqlConcatenar .= ($valores == "good") ? $valores.",-," : $valores.",";                
                } elseif ($valores == "orange") {
                    $sqlConcatenar .= $valores.",";
                } elseif ($valores == "blue") {
                    $sqlConcatenar .= $valores.",";
                } elseif ($clave == "remarktext") {                            
                    $sqlConcatenar .= $valores.",";
                } else {                  
                    $sqlConcatenar .= $valores.",";
                }                          
            } else {
                #esta opcion aplica cuando NO es bay 3 o bay 5 y funciona bien:
                $sqlConcatenar .= ($valores === "good") ? $valores.",-," : $valores.",";
            }            
        } // end foreach
    $sqlConcatenar .= "COMPLETE";
    $arrayQuery = explode(",", $sqlConcatenar);
    //$lessLastElement = array_pop($arrayQuery);       
    return $arrayQuery;
} //end crearQuery

/**
 * funcion para crear las columnas de locaciones y remark de
 * la tabla de la DB:
 * * @param: $pressedButton 
 */
function createLocations($param) {
    $inicio = 1;
    $fin = 20;
    $insertPositionsRemark = "";
        if ($param == "nautilus") {
            $inicio = 1;
            $fin = 10;
        }                  
        #Crear las columnas de la tabla de la DB:    
        for ($i = $inicio; $i <= $fin; $i++) {         
            $insertPositionsRemark .= (($param == "bay_3") || ($param == "bay_5")) ? "`color_orange_".$i."`,`loc_orange_".$i."`,`remark_orange_".$i."`,`color_blue_".$i."`,`loc_blue_".$i."`,`remark_blue_".$i."`," : "`Loc_".$i."`,`Remark_Loc_".$i."`,";       
        }
    return $insertPositionsRemark;            
} // end function crearLocaciones

/**
 * Procesar el archivo cargado recibido:
 */
function processFile($conexion, $nameArchiveSelected) {
    $ext = ".png";
    $ruta = "";
    $idObtenido = "";
    $ruta = ($nameArchiveSelected == "bay_3" || $nameArchiveSelected == "bay_5") ? "../uploads/bay_3_5/" : "../uploads/" ;                       
    #Obtener el último ID insertado en la tabla
    try {
        $obtenerUltimoId = "SELECT MAX(id_check ) AS last_id FROM check_list_fiber35";
        if ($nameArchiveSelected != "bay_3" && $nameArchiveSelected != "bay_5") {
            $obtenerUltimoId = "SELECT MAX(ID) AS last_id FROM check_list_fiber";
        }            
        $registroObtenido = mysqli_query($conexion, $obtenerUltimoId);
        if (!$registroObtenido) {
            die("Error executing SQL query: ".json_encode(mysqli_error($conexion)));
        }

        $idObtenido = ($row = mysqli_fetch_assoc($registroObtenido)) ? $row['last_id'] : 1;

        $fileRenamed = $idObtenido.$ext;
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $uploadfile_temporal = $_FILES['file']['tmp_name'];
            $uploadfile_nombre = $ruta.$fileRenamed;
            if (!move_uploaded_file($uploadfile_temporal, $uploadfile_nombre)) {
                echo json_encode("An error occurred while uploading the file.");               
            } 
        } 
    } catch (\Throwable $th) {            
        echo json_encode($th->getMessage());              
        exit();
    }
   
    #Cerrar la conexión
    mysqli_close($conexion);
} // end procesar archivo                      
?>