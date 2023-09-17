<?php
	include("php/conexion.php");
	session_start();
		$nombre = $_SESSION['username'];
		if(!isset($nombre))
		{
			header("location: index.php");
	
		}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wiwynn - Review</title>        
        <link rel="stylesheet" href="css/wiwynn-icon.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style-view.css" type="text/css" rel="stylesheet">
        <link href="css/insert.css" type="text/css" rel="stylesheet">        
    </head>
    <body>

    <?php include_once("recursos/header.php");?>
    <?php include_once("php/view_amg.php");?>    
    
    <div class="contenedor-principal">
            <div class="div-h3">        
                <h3 class="title-h3">Current shift: <?php echo $shiftIs; ?></h3>                               
            </div>  
            <div class="circles-container">
                <div class="circle" style="background-color: <?php echo $colorBay1; ?>">
                <span class="circle-text">BAY 1</span>        
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay2; ?>">
                <span class="circle-text">BAY 2</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay3; ?>">
                <span class="circle-text">BAY 3</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay4; ?>">
                <span class="circle-text">BAY 4</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay5; ?>">
                <span class="circle-text">BAY 5</span>
                </div>
                <br></br>
                <div class="circle" style="background-color: <?php echo $colorBay6; ?>">
                <span class="circle-text">BAY 6</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay7; ?>">
                <span class="circle-text">BAY 7</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorBay8; ?>">
                <span class="circle-text">BAY 8</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorMdiag; ?>">
                <span class="circle-text">MDIAG</span>
                </div>
                <div class="circle" style="background-color: <?php echo $colorNautilus; ?>">
                <span class="circle-text">NAUTILUS</span>
                </div>                 
            </div>                        
    </div>
             
    <?php include_once("recursos/footer.php");?>

    <script type="text/javascript" src="JS/check_session.js"></script>
    </body>
</html>