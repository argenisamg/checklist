<?php
	include("php/conexion.php");
	session_start();
		$nombre = $_SESSION['username'];
		if(!isset($nombre))
		{
			header('location: index.php');
	
		}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wiwynn - Checklist summary</title>
        <link rel="stylesheet" href="css/wiwynn-icon.css">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style-view.css" type="text/css" rel="stylesheet">
        <link href="css/insert.css" type="text/css" rel="stylesheet">
        
        <link href="css/data-table.css" type="text/css" rel="stylesheet">
        <!-- Monitorear la sesion -->
        <script type="text/javascript" src="JS/check_session.js"></script>
    </head>
    <body>

    <?php include_once("recursos/header.php");?>    
    <?php include_once("php/summary.php");?>

    <div class="contenedor-principal">
            <div class="div-h3"><h3 class="title-h3">Checklist summary</h3></div>                        
            <table id="tabledata" class="table">
                <thead>
                    <tr>
                        <th rowspan="1" colspan="1"># Bay</th>
                        <th rowspan="1" colspan="1">Date</th>
                        <th rowspan="1" colspan="1">Day</th>
                        <th rowspan="1" colspan="1">Pic</th>
                        <th rowspan="1" colspan="1">Shift</th>                 
                        <th rowspan="1" colspan="1">Remark</th>                     
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_array($queryExecuted)) {                     
                    if ($queryExecuted) { ?>
                            <tr>
                                <td>
                                    <?php echo $row ['bay']; ?>
                                </td>
                                <td>
                                    <?php echo $row ['date']; ?>
                                </td>
                                <td>
                                    <?php echo $row ['day']; ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $row ['pic'];
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row ['shift']; ?>
                                </td>
                                        
                                <td>
                                    <?php echo $row ['remark']; ?>
                                </td>
                            </tr>
                            
                        <?php } else { ?>
                            <tr>                               
                                <td>-</td>                                    
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>                                
                            </tr>
                        <?php }?>                                                                                    
                    <?php }?>                                        
                </tbody>  
                <!-- <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1"># Bay</th>
                        <th rowspan="1" colspan="1">Date</th>
                        <th rowspan="1" colspan="1">Day</th>
                        <th rowspan="1" colspan="1">Pic</th>
                        <th rowspan="1" colspan="1">Shift</th>                 
                        <th rowspan="1" colspan="1">Remark</th>                    
                    </tr>
                </tfoot>               -->
            </table>      
            <!-- Para paginacion -->
            <script type="text/javascript" src="JS/jquery.min.js"></script>
            <script type="text/javascript" src="css/DataTables/datatables.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                            $('#tabledata').DataTable(
                                {
                                    order: [ 0, "desc" ]
                                }
                            );
                        });                                        
            </script>	                
    </div>
             
    <?php include_once("recursos/footer.php");?>

    </body>
</html>