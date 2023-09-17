<?php 
    // session_start();																//300
    // if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 15000)) {        
    //     echo json_encode("expired");
    // } else {        
    //     $_SESSION['LAST_ACTIVITY'] = time();        
    // }    

    // Establecer la variable de tiempo de última actividad
    $_SESSION['last_activity'] = time();

    // Establecer el tiempo de expiración en segundos (5 minutos en este caso)
    $expiration_time = 300; // 5 minutos

    // Verificar si ha pasado demasiado tiempo desde la última actividad
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $expiration_time) {
        // Cerrar la sesión
        session_unset();
        session_destroy();
    }

    // Actualizar el tiempo de última actividad en cada interacción del usuario
    $_SESSION['last_activity'] = time();

?>