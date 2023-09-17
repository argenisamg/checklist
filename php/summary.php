<?php
//Incluye la conexion
ini_set("max_execution_time", "0");
include ("conexion.php");

    #generar la consulta con resultados de una semana atras:
    /**
     * SELECT bay_name as bay, date_insert as date, DAY_INSERT as day, pic_user AS pic, shift_user as shift, remark_all as remark FROM `check_list_bays35` WHERE date_insert >= DATE_SUB(NOW(), INTERVAL 1 WEEK) UNION SELECT BAY as bay, DATE_INSERT AS date, DAY_INSERT AS day, PIC as pic, Turno AS shift, Remark as remark FROM `check_list_amg` WHERE DATE_INSERT >= DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY date DESC
     */
    $sqlQuery = "
    SELECT bay_name as bay, date_insert as date, DAY_INSERT as day, pic_user AS pic, shift_user as shift, remark_all as remark FROM `check_list_fiber35` WHERE date_insert >= DATE_SUB(NOW(), INTERVAL 3 WEEK) 
    UNION SELECT BAY as bay, DATE_INSERT AS date, DAY_INSERT AS day, PIC as pic, Turno AS shift, Remark as remark FROM `check_list_fiber` WHERE DATE_INSERT >= DATE_SUB(NOW(), INTERVAL 3 WEEK) ORDER BY date DESC
    ";
    $queryExecuted = mysqli_query($conexion, $sqlQuery);
?>