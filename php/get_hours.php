<?php
        $horarios123 = array(
              "1st" => array(
                "start" => "06:00:01",
                "end" => "15:30:00"
            ), 
            "2nd" => array(
                "start" => "15:30:01", 
                "end" => "23:59:59"
            ),
            "3rd" => array(
                "start" => "00:00:00",
                "end" => "05:59:59"
            )
        );
        $horarios45 = array(           
             "4th" => array(
                 "start" => "06:00:00",
                 "end" => "18:00:00"
             ),
             "5th" => array(
                 "start" => "18:00:01",
                 "end" => "06:00:00"
             )
        );
            
        #Define la zona horaria deseada, en este caso, Denver, que es la misma a la de Chihuahua       
        date_default_timezone_set('America/Denver');        
        #Formatea la fecha y hora en el formato deseado               
        $date_actually = date('Y-m-d H:i:s');       
        #Obtener unicamente la fecha sin hora
        $date_only = date('Y-m-d');                  
        $theDay = date("l");                                                    
        $hour_actually = date('H:i:s', strtotime($date_actually));                       
        $shiftIs = "";
        $start_finally = "";
        $end_finally = "";
        #para habilitar/inhabilitar el Select principal del Check list y mostrar el horario proximo para habilitarlo
        $enableDisable = "none";
        $hourat = "";
        $results = array();
        
        if (($theDay == "Saturday") && ($hour_actually >= "00:00:00" && $hour_actually <= "05:59:59")) {            
            $results = getShift($horarios123, $hour_actually, $date_only);
            $shiftIs = $results["shiftFound"];
            $start_finally = $results["start_finally"];
            $end_finally = $results["end_finally"]; 

            $enableDisable = ($shiftIs == "3rd" && $hour_actually >= "00:00:00" && $hour_actually <= "00:40:00") ? "block" : "none";
            $hourat = "00:00:00";
        } elseif (($theDay == "Saturday" || $theDay == "Sunday") || (($theDay == "Monday") && ($hour_actually >= "00:00:00" && $hour_actually <= "05:59:59") )) {    
            $results = getShift($horarios45, $hour_actually, $date_only); 
            $shiftIs = $results["shiftFound"];
            $start_finally = $results["start_finally"];
            $end_finally = $results["end_finally"];      

            $enableDisable = ($shiftIs == "4th" && $hour_actually >= "06:00:00" && $hour_actually <= "06:40:00") ||
                             ($shiftIs == "5th" && $hour_actually >= "18:00:00" && $hour_actually <= "18:40:00") ? "block" : "none";                  
            $hourat = ($shiftIs == "4th") ? "06:00:00" : "18:00:00";
        } else {                                      
            $results = getShift($horarios123, $hour_actually, $date_only);
            $shiftIs = $results["shiftFound"];
            $start_finally = $results["start_finally"];
            $end_finally = $results["end_finally"];                   

            $enableDisable = ($shiftIs == "1st" && $hour_actually >= "06:40:00" && $hour_actually <= "07:20:00") ||
                             ($shiftIs == "2nd" && $hour_actually >= "15:40:00" && $hour_actually <= "16:20:00") ||
                             ($shiftIs == "3rd" && $hour_actually >= "00:00:00" && $hour_actually <= "00:40:00") ? "block" : "block";    
            $hourat = ($shiftIs == "1st") ? "07:40:00" : ($shiftIs == "2nd" ? "15:40:00" : "00:00:00");
        }          
        
    /**
     * Funcion para encontrar el turno correspondiente al horario:
     * @params: $arrReceived, $hour_actually and $dateOnly (array de horarios, hora actual y fecha actual)
     * return: el turno actual
     */
    function getShift($arrayReceived, $hour_actually, $dateOnly) {
        $shiftFound = "";
        $start_finally = "";
        $end_finally= "";
        $start = "";
        $end = "";
        foreach ($arrayReceived as $key => $horario) {
            $start = $horario['start'];
            $end = $horario['end'];
           if ($key != "5th") {
                if ($hour_actually >= $start && $hour_actually <= $end) {            
                    $shiftFound = $key;
                    $start_finally = $dateOnly." ".$start;
                    $end_finally = $dateOnly." ".$end;                    
                    break;
                }
           } else {
                if ($hour_actually >= $start || $hour_actually <= $end) {            
                    $shiftFound = $key;
                    $start_finally = $dateOnly." ".$start;
                    $end_finally = $dateOnly." ".$end;                    
                    break;
                }
           }                       
        } #end foreach

        return array("shiftFound" => $shiftFound, "start_finally" => $start_finally, "end_finally" => $end_finally);
    }   
        
?>