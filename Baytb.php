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
    <link rel="shortcut icon" href="imagenes/favicon.ico" />
    <meta charset="utf-8">
    <title> CHECK LIST FIBER</title>
    <meta name="author" content="Erick Gomez">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css">
	
    
    <link href="css/tabng.css" type="text/css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/imgstyle.css" type="text/css" rel="stylesheet">
    
    <script type="text/javascript" src="JS/jquery.min.js"></script>
    <script type="text/javascript" src="css/DataTables/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/DataTables/datatables.min.css"/>

</head>

<body >

<?php include_once("recursos/header.php");?>

    <section>

        <div id="filtrer">
            <form method="POST">
                    <div class="option">
                        <label>Filtrer by:<label>
                            <select name="select" onChange="activate(this)">
                                <option>SELECT...</option>
                                <option value="1">BAY</option>
                                <option value="2">DATE</option>
                            </select>

                            <div id="bay" style="display:none;">
                                <label><strong>BAY:</strong></label>
                                <select name="op">
                                    <option> Select...</option>
                                    <option value="1">BAY 1</option>
                                    <option value="2">BAY 2</option>
                                    <option value="3">BAY 3</option>
                                    <option value="4">BAY 4</option>
                                    <option value="5">BAY 5</option>
                                    <option value="6">BAY 6</option>
                                    <option value="7">BAY 7</option>
                                    <option value="8">BAY 8</option>
                                    <option value="9">MDIAG</option>
                                    <option value="10">NAUTILUS</option>
                                </select>	
                            </div>
                            <div id="date" style="display:none;">
                                <label><strong>DATE:</strong></label>
                                <br/>
                                <label>Start Date:</label>
                                <input type="date" name="di">
                                <br/>
                                <label>End Date:</label>
                                <input type="date" name="df">
                            </div>		
                    </div>
                    <input type="submit" class="add" name="src" value="src">
            </form>
        </div>

        <div class="container-table">
            <table id="tabledata" class="cell-border compact stripe" cellspacing="0" style="width:80%">
                <thead>
                    <th>ID</th>
                    <th>BAY</th>
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>PIC</th>
                    <th>SHIFT</th>                 
                    <th>LOC_1</th>
                    <th>REMARK_LOC_1</th>


                    <th>Loc_2</th>
                    <th>Remark_Loc_2</th>


                    <th>Loc_3</th>
                    <th>Remark_Loc_3</th>


                    <th>Loc_4</th>
                    <th>Remark_Loc_4</th>


                    <th>Loc_5</th>
                    <th>Remark_Loc_5</th>


                    <th>Loc_6</th>
                    <th>Remark_Loc_6</th>


                    <th>Loc_7</th>
                    <th>Remark_Loc_7</th>


                    <th>Loc_8</th>
                    <th>Remark_Loc_8</th>


                    <th>Loc_9</th>
                    <th>Remark_Loc_9</th>


                    <th>Loc_10</th>
                    <th>Remark_Loc_10</th>


                    <th>Loc_11</th>
                    <th>Remark_Loc_11</th>


                    <th>Loc_12</th>
                    <th>Remark_Loc_12</th>

 
                    <th>Loc_13</th>
                    <th>Remark_Loc_13</th>

                    <th>Loc_14</th>
                    <th>Remark_Loc_14</th>

                    <th>Loc_15</th>
                    <th>Remark_Loc_15</th>.

                    <th>Loc_16</th>
                    <th>Remark_Loc_16</th>

                    <th>Loc_17</th>
                    <th>Remark_Loc_17</th>

                    <th>Loc_18</th>
                    <th>Remark_Loc_18</th>

                    <th>Loc_19</th>
                    <th>Remark_Loc_19</th>

                    <th>Loc_20</th>
                    <th>Remark_Loc_20</th>

                    <th>Remark</th>
                    <th>Image</th>

                </thead>
                <tbody class="body-tabla">
                            <?php
                                include("php/selecttbBay.php");
                                
                                while($row = mysqli_fetch_array($query)) { ?>

                                    <tr class="tri">
                                        <td class="td">
                                            <?php echo $row ['ID']; ?>
                                        </td>
                                        <td class="td" id="td-fecha">
                                            <?php echo $row ['BAY']; ?>
                                        </td>
                                        <td class="td">
                                            <?php echo $row ['DATE']; ?>
                                        </td>
                                        <td class="td" id="td-pn">
                                            <?php 
                                                echo $row ['DAY'];
                                            ?>
                                        </td>
                                        <td class="td" id="td-sn">
                                            <?php echo $row ['PIC']; ?>
                                        </td>
                                                
                                        <td class="td">
                                            <?php echo $row ['Turno']; ?>
                                        </td>
                                        
                                        <td class="td" style="background-color: <?php $color = $row ['color_1'];echo $color ?>;">
                                            <?php echo $row ['Loc_1']; ?>
                                        </td>
                                        
                                        <td class="td" style="background-color: <?php $color = $row ['color_1'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_1']; ?>
                                        </td>
                                        
                                        <td class="td" style="background-color: <?php $color = $row ['color_2'];echo $color ?>;">
                                            <?php echo $row ['Loc_2']; ?>
                                        </td>
                                        
                                        <td class="td" style="background-color: <?php $color = $row ['color_2'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_2']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_3'];echo $color ?>;">
                                            <?php echo $row ['Loc_3']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_3'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_3']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_4'];echo $color ?>;">
                                            <?php echo $row ['Loc_4']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_4'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_4']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_5'];echo $color ?>;">
                                            <?php echo $row ['Loc_5']; ?>
                                        </td>
                                        
                                        <td class="td" style="background-color: <?php $color = $row ['color_5'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_5']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_6'];echo $color ?>;">
                                            <?php echo $row ['Loc_6']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_6'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_6']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_7'];echo $color ?>;">
                                            <?php echo $row ['Loc_7']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_7'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_7']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_8'];echo $color ?>;">
                                            <?php echo $row ['Loc_8']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_8'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_8']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_9'];echo $color ?>;">
                                            <?php echo $row ['Loc_9']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_9'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_9']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_10'];echo $color ?>;">
                                            <?php echo $row ['Loc_10']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_10'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_10']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_11'];echo $color ?>;">
                                            <?php echo $row ['Loc_11']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_11'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_11']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_12'];echo $color ?>;">
                                            <?php echo $row ['Loc_12']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_12'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_12']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_13'];echo $color ?>;">
                                            <?php echo $row ['Loc_13']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_13'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_13']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_14'];echo $color ?>;">
                                            <?php echo $row ['Loc_14']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_14'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_14']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_15'];echo $color ?>;">
                                            <?php echo $row ['Loc_15']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_15'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_15']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_16'];echo $color ?>;">
                                            <?php echo $row ['Loc_16']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_16'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_16']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_17'];echo $color ?>;">
                                            <?php echo $row ['Loc_17']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_17'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_17']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_18'];echo $color ?>;">
                                            <?php echo $row ['Loc_18']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_18'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_18']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_19'];echo $color ?>;">
                                            <?php echo $row ['Loc_19']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_19'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_19']; ?>
                                        </td>

                                        <td class="td" style="background-color: <?php $color = $row ['color_20'];echo $color ?>;">
                                            <?php echo $row ['Loc_20']; ?>
                                        </td>
                                                                                
                                        <td class="td" style="background-color: <?php $color = $row ['color_20'];echo $color ?>;">
                                            <?php echo $row ['Remark_Loc_20']; ?>
                                        </td>

                                        <td class="td" >
                                            <?php echo $row ['Remark']; ?>
                                        </td>
                                        
                                        <td class="td">
                                        <?php
                                            $id = $row['ID'];
                                            $b =$row ['BAY'];
                                            $d =$row ['DATE'];
                                            $d = date('Y-m-d');
                                            $ext = '.png';
                                            $img=$b.'-'.$id.'-'.$d;
                                            //echo $img;
                                            echo "<a href='paginas/img.php?img=$id' target='_blank'><img id='ipn' src='uploads/$id.png' width='36px' heigth='36px'></a>";   
                                        ?>
                                        </td>
                                    </tr>
                            <?php } ?>
                </tbody>
                    <script type="text/javascript">
                      /*  $(document).ready(function() {
                            $('#tabledata').DataTable(
                                {
                                    order: [ 0, "desc" ]
                                }
                            );
                        });
                    */

                        table = $('#tabledata').DataTable( {
                            order: [ 0, "desc" ],
                            paging: false
                        } );
                        
                        table.destroy();
                        
                        table = $('#tabledata').DataTable( {
                            order: [ 0, "desc" ],
                            searching: false
                        } );

                    </script>	
			</table>
        </div>

    </section>
 


    <br />
    <br />
    <!-- Pie de pagina -->
    <div class="footer-basic"></div>
    <footer class="clearfix">
        <div class="row">
            <center>
                <p><img src="imagenes/logo30.png" alt="" width="10%"></p>
                <p COLOR="white">© 2021 Wiwynn, TE Department, Inc. All Rights Reserved.</p>
            </center>

        </div>s
    </footer>

</body>

    <script>
        function activate(sel)
            {	
                if (sel.value=="1"){
                    divW = document.getElementById("bay");
                    divW.style.display = "block";

                    divW = document.getElementById("date");
                    divW.style.display = "none";

                }
            else if (sel.value=="2"){
                    divW = document.getElementById("bay");
                    divW.style.display = "none";

                    divW = document.getElementById("date");
                    divW.style.display = "block";

                }
            }
    </script>

</html>