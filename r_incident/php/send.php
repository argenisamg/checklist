<?php
// Conectarse a la base de datos (asumiendo que ya has creado la tabla)
$conn = mysqli_connect("10.250.36.58","root","p@ssw0rd","monica");

// Verificar si la conexión fue exitosa
/*
if (!$conn) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}*/

// Insertar una nueva entrada en la bitácora
$milestone_description = $_POST['milestone_description'];
$description = $_POST['description'];
$status = $_POST['status'];
$progress = $_POST['progress'];
$remark = $_POST['remark'];
$start = $_POST['start'];
$end = $_POST['end'];
$day = $_POST['day'];
$submit = $_POST['submit'];

if ($submit !=  null)
	{
        $sql = "INSERT INTO tbl_bitacora (milestone_description, description, status, progress, remark, start, end, day) 
        VALUES ('$milestone_description', '$description', '$status', '$progress', '$remark', '$start', '$end', '$day')";
/*
        if (mysqli_query($conn, $sql)) 
        {
            echo "La entrada fue agregada correctamente.";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }*/
        if (mysqli_query($conn, $sql))
        {
            echo '<script type="text/javascript">
            window.location.href= "Index.php";
            </script>';
        }
// Cerrar la conexión
mysqli_close($conn);
?>
