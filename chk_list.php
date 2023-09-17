<?php
	include("php/conexion.php");
	session_start();
		$nombre = $_SESSION['username'];
		if(!isset($nombre))
		{
			header('location: index.php');
	
		}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Wiwynn - Check list</title>        
        <link rel="stylesheet" href="css/wiwynn-icon.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">                
        <link href="css/insert.css" rel="stylesheet">                                          
    </head>
        <body>        
        <?php include_once("recursos/header.php"); ?>     
        <?php include_once("php/get_hours.php"); ?>   
       <div class="contenedor-padre">     
                 <?php  $displayP = ($enableDisable == "block") ? "none" : "block"; ?>                
                <div class="title"><h2 style='display:<?php echo $enableDisable; ?>;'>Select bay</h2><p><?php echo $date_actually; ?> </p>                    
                    <label style='display:<?php echo $displayP; ?>;' >Your Shift is: <?php echo $shiftIs; ?> <br/>The Check list will be available at: <?php echo $hourat; ?></label>                    
                </div>                                   
                        <select class="select-css" input name="baySelect" id="baySelect" onchange="selectCheck(this);"  style="display: <?php echo $enableDisable; ?>;" required>
                            <option aling="center" value='select'>-</option>
                            <option aling="center" value='bay_1'> BAY 1 </option>
                            <option aling="center" value='bay_2'> BAY 2 </option>
                            <option aling="center" value='bay_3'> BAY 3 </option>
                            <option aling="center" value='bay_4'> BAY 4 </option>
                            <option aling="center" value='bay_5'> BAY 5 </option>
                            <option aling="center" value='bay_6'> BAY 6 </option>
                            <option aling="center" value='bay_7'> BAY 7 </option>
                            <option aling="center" value='bay_8'> BAY 8 </option>
                            <option aling="center" value='mdiag'> MDIAG </option>
                            <option aling="center" value='nautilus'> NAUTILUS </option>    
                        </select>
                                            
                        <div class="contenedor-hijo" style="display:block;">                                
                                <form name="listForm" id="listForm" enctype="multipart/formdata">                                    
                                    <div id="shiftTable" style="display:none;">
                                        <?php include_once('recursos/tablehead_formulary_bay.php'); ?>
                                    </div>
                                    <div class="table-constructor" id="tableConstructor"></div>                                                              
                                </form>                                
                        </div>                            
                                
                <div class="advert" id="advert" style="display:block;"><label>You most to select an option</label></div>                                                               
        </div> <!--Contenedor-padre-->              
        
        <?php include_once("recursos/footer.php");?>

        <script type="text/javascript" src="JS/selector_bay_amg.js"></script>           
        <script type="text/javascript" src="JS/json_insert.js"></script>
        <script type="text/javascript" src="JS/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="JS/check_session.js"></script> -->
        
    </body>   
</html>