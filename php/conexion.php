<?php

$host_db = "127.0.0.1";
$user_db = "root";
$pass_db = "";
$db_name = "monica";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

mysqli_set_charset ($conexion, "utf8");
?>