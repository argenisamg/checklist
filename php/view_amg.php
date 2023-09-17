<?php
include ("conexion.php");
include_once("get_hours.php");    

        #Hacer un select para todas las Bahias por turno con base al horario es turno del select del foreach                                   
        $sqlQuery = "SELECT BAY FROM check_list_fiber WHERE Turno = '$shiftIs' AND BAY IN ('BAY 1', 'BAY 2', 'BAY 4', 'BAY 6', 'BAY 7', 'BAY 8', 'MDIAG', 'NAUTILUS') AND `date_insert` BETWEEN '$start_finally' AND '$end_finally' 
        UNION SELECT bay_name FROM check_list_fiber35 WHERE shift_user = '$shiftIs' AND bay_name IN ('BAY 3', 'BAY 5') AND `DATE_INSERT` BETWEEN '$start_finally' AND '$end_finally'";
        $executeQuery = mysqli_query($conexion, $sqlQuery);
        $failQuery = "";
        error_reporting(E_ERROR);            
            if(!$executeQuery) {	
                $failQuery = "Failed to get records from Data Base";            
            } else {         
              $failQuery = "Yes";       
                $colorBay = array(
                    'BAY 1' => '',
                    'BAY 2' => '',
                    'BAY 3' => '',
                    'BAY 4' => '',
                    'BAY 5' => '',
                    'BAY 6' => '',
                    'BAY 7' => '',
                    'BAY 8' => '',
                    'MDIAG' => '',
                    'NAUTILUS' => ''
                  );
                  
                  while ($rows = mysqli_fetch_array($executeQuery)) {
                    $bay = $rows['BAY']; 
                    if (isset($colorBay[$bay])) {
                      $colorBay[$bay] = "#14df51";
                    }
                  }
                  
                  $colorBay1 = $colorBay['BAY 1'];
                  $colorBay2 = $colorBay['BAY 2'];
                  $colorBay3 = $colorBay['BAY 3'];
                  $colorBay4 = $colorBay['BAY 4'];
                  $colorBay5 = $colorBay['BAY 5'];
                  $colorBay6 = $colorBay['BAY 6'];
                  $colorBay7 = $colorBay['BAY 7'];
                  $colorBay8 = $colorBay['BAY 8'];
                  $colorMdiag = $colorBay['MDIAG'];
                  $colorNautilus = $colorBay['NAUTILUS'];
                  
            } // end if 
?>