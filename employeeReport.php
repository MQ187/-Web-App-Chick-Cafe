<?php 
    require_once("db_config.php");
    session_start();
?>
<!DOCTYPE html>
    <head>
        <title>Employee Report | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
         require_once('nav/employeeDash.php');
         ?>
    </header>
        <nav>
            <ul>
                <li><i>Individual Report</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Breakfast Count</th><th>Lunch Count</th><th>Dinner Count</th><th>Breakfast Min</th><th>Breakfast Max</th><th>Lunch Min</th><th>Lunch Max</th><th>Dinner Min</th><th>Dinner Max</th>
                        </tr>
                        <?php 

                            //breakfast count
                            $question3 = "SELECT count(*) FROM `order` WHERE idEmployee = '$_SESSION[id]' AND orderType = 'Breakfast'";
                            $sth2 = $db->prepare($question3);
                            $execute2 = $sth2->execute();

                            $breakfastCount = $sth2->fetchColumn(); 

                            //lunch count
                            $question4 = "SELECT count(*) FROM `order` WHERE idEmployee = '$_SESSION[id]' AND orderType = 'Lunch'";
                            $sth3 = $db->prepare($question4);
                            $execute3 = $sth3->execute();

                            $lunchCount = $sth3->fetchColumn(); 

                            //dinner count
                            $question5 = "SELECT count(*) FROM `order` WHERE idEmployee = ' $_SESSION[id]' AND orderType = 'Dinner'";
                            $sth4 = $db->prepare($question5);
                            $execute4 = $sth4->execute();

                            $dinnerCount = $sth4->fetchColumn(); 

                            //breakfast min/max
                            $question6 = "SELECT timeCompleted FROM `order` WHERE idEmployee = ' $_SESSION[id]' AND orderType = 'Breakfast'";
                            $sth5 = $db->prepare($question6);
                            $execute5 = $sth5->execute();
                            $fetch1 = $sth5->fetchAll();

                            $breakfastMax = '00:00:00';
                            foreach ($fetch1 as $k1) {
                                if($k1['timeCompleted'] > $breakfastMax){
                                    $breakfastMax = $k1['timeCompleted'];
                                }
                            }

                            $breakfastMin = $breakfastMax;
                            foreach ($fetch1 as $k) {
                                if($k['timeCompleted'] < $breakfastMin){
                                    $breakfastMin = $k['timeCompleted'];
                                }
                            }

                            //lunch min/max
                            $question7 = "SELECT timeCompleted FROM `order` WHERE idEmployee = ' $_SESSION[id]' AND orderType = 'Lunch'";
                            $sth6 = $db->prepare($question7);
                            $execute6 = $sth6->execute();
                            $fetch2 = $sth6->fetchAll();

                            $lunchMax = '00:00:00';
                            foreach ($fetch2 as $k1) {
                                if($k1['timeCompleted'] > $lunchMax){
                                    $lunchMax = $k1['timeCompleted'];
                                }
                            }

                            $lunchMin = $lunchMax;
                            foreach ($fetch2 as $k1) {
                                if($k1['timeCompleted'] < $lunchMin){
                                    $lunchMin = $k1['timeCompleted'];
                                }
                            }

                            //dinner min/max
                            $question8 = "SELECT timeCompleted FROM `order` WHERE idEmployee = ' $_SESSION[id]' AND orderType = 'Dinner'";
                            $sth7 = $db->prepare($question8);
                            $execute7 = $sth7->execute();
                            $fetch3 = $sth7->fetchAll();

                            $dinnerMax = '00:00:00';
                            foreach ($fetch3 as $k2) {
                                if($k2['timeCompleted'] > $dinnerMax){
                                    $dinnerMax = $k2['timeCompleted'];
                                }
                            }

                            $dinnerMin = $dinnerMax;
                            foreach ($fetch3 as $k2) {
                                if($k2['timeCompleted'] < $dinnerMin){
                                    $dinnerMin = $k2['timeCompleted'];
                                }
                            }

                            echo'<tr>';
                            echo'<td>'. $breakfastCount .'</td>';
                            echo'<td>'. $lunchCount .'</td>';
                            echo'<td>'. $dinnerCount .'</td>';
                            echo'<td>'. $breakfastMin .'</td>';
                            echo'<td>'. $breakfastMax .'</td>';
                            echo'<td>'. $lunchMin .'</td>';
                            echo'<td>'. $lunchMax .'</td>';
                            echo'<td>'. $dinnerMin .'</td>';
                            echo'<td>'. $dinnerMax .'</td>';
                            echo'</tr>';
                            
                           
                        ?>
                        </table>
                </li>  
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>