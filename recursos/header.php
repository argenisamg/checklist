<?php

    $nombre = $_SESSION['username'];
    $rol = $_SESSION['user_level'];
    $rol_user = 0;       

    if($rol == 1) {
        $rol_user = 1;
    } elseif ($rol == 2) {
        $rol_user = 2;
    } elseif ($rol == 3) {
        $rol_user = 3;
    }
?>

    <!-- <script type="text/javascript">
        function updatemenu() {
            if (document.getElementById('responsive-menu').checked == true) {
                document.getElementById('#menu').style.borderRadius = '0';                
            }else{
                document.getElementById('#menu').style.borderRadius = '0';
            }
        }
    </script> -->
    <header>
    <?php include_once("php/check_session.php");?>  
        <div class="cabecera-menu">
            <h1>FIBER CHECK LIST</h1>
            <nav id='menu'>
                <!-- onclick='updatemenu()' -->
                <input type='checkbox' id='responsive-menu' ><label></label>
                <ul>
                    <li><a href="principal.php">Review</a></li>
                    <li><a href="chk_list.php">Do check list</a></li>
                    <li>
                            <a href="history.php">History check</a><v-r></v-r>
                    </li>
                    <li><a href="http://10.250.36.58:8080/monitor/monitor.php" target="_blank">Monitor</a></li>
                        <?php 
                            if($rol_user == 2) {
                                echo '<li>';
                                echo '<a href="" style="visibility:hidden;"></a>';
                                echo '</li>';
                            } elseif ($rol_user == 3) {
                                echo '<li>';                                
                                echo '<a href="replace_fiber.php">Fiber manager</a>';
                                echo '</li>';
                            } elseif ($rol_user == 1) {
                                echo '<li>';
                                echo '<a href="register.php">Register user</a>';
                                echo '</li>';
                                echo '<li>';
                                echo '<a href="replace_fiber.php">Fiber manager</a>';
                                echo '</li>';
                            }                       
                        ?>
					
                    <li><a href="#"><?php echo "Welcome: $nombre"; ?></a></li>                    
                    <li class="sign-out"><a href="php/exit.php">Sign out</a></li>
                </ul>
            </nav>
        </div>
    </header>   