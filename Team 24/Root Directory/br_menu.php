<?php
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
$day = date("l");
$time = time();
if ($day == "Sunday"){
    $startTime = strtotime("08:00:00");
    $endTime = strtotime("11:00:00");
}
else{
    $startTime = strtotime("07:00:00");
    $endTime = strtotime("11:00:00");
}
//gets the opening/closing time and current time

$OFB = 0;

if ($time<$endTime && $time>$startTime){
    $OFB = 1;
}
//openforbusiness yes or no? depending on the time.
?>
<!DOCTYPE html>
    <head>
        <title>Breakfast Menu | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <?php require_once("basketNotification.php"); //include the basket notifier file ?>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <?php
         require_once("nav/menus.php"); //include the nav
         ?>
    </header>
    <body>
        <nav>
            <ul>
                <li><i>BREAKFAST</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer' && $OFB == true){echo"<th>Add to Basket</th>";} //display add extra header based on time and user type ?>
                        </tr>
                        <?php
                             //select all from the breakfast table
                             $question="SELECT * FROM item WHERE idMenu=1";
                             $sth = $db->prepare($question);
                             $execute = $sth->execute();
                             $fetch = $sth->fetchAll();

                             $i=1;
                             foreach ($fetch as $key) {
                                $id[$i] = $key['iditem'];
                                $pname[$i] = $key['name'];
                                $des[$i] = $key['description'];
                                $price[$i] = $key['price'];
                                $type[$i] = $key['type'];

                                //display each items attributes
                                echo '<tr>';
                                echo '<td>'. $pname[$i] .'</td>';
                                echo '<td>'. $des[$i] .'</td>';
                                echo '<td> &pound;'. $price[$i] .'</td>';
                                echo '<td>'. $type[$i] .'</td>';
                                if($userType=='customer'  && $OFB == true){echo "<td><form action='addBasket.php' method='POST'>    
                                                                <input type='hidden' value=" . $id[$i] . " name='product_id' />
                                                                <input type='hidden' value='br_menu.php' name='returnto' />
                                                                <input type=submit name=id value=Add />
                                                                </form></td>";}
                                                                //display the add to basket button based on time and user type
                                echo '</tr>';
                            $i++;

                            }
                            if (count($fetch) == 0){
                                echo '<td>Nothing on this menu, come back later!</td><td></td><td></td><td></td>';
                                if($userType=='customer'  && $OFB == true){echo"<tr></td>";} 
                            } //if theres nothing to display
                        ?>
                        </table>
                </li>
               
               <!--Display todays specials-->
                <li><i>TODAYS SPECIAL</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer'  && $OFB == true){echo"<th>Add to Basket</th>";} //display add extra header based on time and user type ?>
                        </tr>
                        <?php 
                            //select from items where it's a dailyspecial
                            $question="SELECT * FROM item WHERE dailySpecial=1";
                             $sth = $db->prepare($question);
                             $execute = $sth->execute();
                             $fetch = $sth->fetchAll();

                             $i=1;
                             foreach ($fetch as $key) {
        
                                $id[$i] = $key['iditem'];
                                $pname[$i] = $key['name'];
                                $des[$i] = $key['description'];
                                $price[$i] = $key['price'];
                                $type[$i] = $key['type'];
                            
                            //display each special items attributes
                            echo '<tr>';
                            echo '<td>'. $pname[$i] .'</td>';
                            echo '<td>'. $des[$i] .'</td>';
                            echo '<td> &pound;'. $price[$i] .'</td>';
                            echo '<td>'. $type[$i] .'</td>';
                            if($userType=='customer'  && $OFB == true){echo "<td><form action='addBasket.php' method='POST'>
                                                            <input type='hidden' value=".$id[$i]." name='product_id' />
                                                            <input type='hidden' value='br_menu.php' name='returnto' />
                                                            <input type=submit name=id value=Add />
                                                            </form></td>";}
                                                            //display the add to basket button based on time and user type
                            echo '</tr>';

                            $i++;
                            }
                            if (count($fetch) == 0){
                                echo '<td>Nothing on this menu, come back later!</td><td></td><td></td><td></td>';
                                if($userType=='customer'  && $OFB == true){echo"<tr></td>";} 
                            } //if theres nothing to display
                        ?>
                        </table>
                </li>

                <li><i>Breakfast Hot Drinks</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer'  && $OFB == true){echo"<th>Add to Basket</th>";} //display add extra header based on time and user type ?>
                        </tr>
                        <?php 
                            //select all items where its a breakfast drink 
                            $question="SELECT * FROM item WHERE idMenu=5";
                             $sth = $db->prepare($question);
                             $execute = $sth->execute();
                             $fetch = $sth->fetchAll();

                             $i=1;
                             foreach ($fetch as $key) {
                                
                                $id[$i] = $key['iditem'];
                                $pname[$i] = $key['name'];
                                $des[$i] = $key['description'];
                                $price[$i] = $key['price'];
                                $type[$i] = $key['type'];
                            
                            //display each special items attributes
                            echo '<tr>';
                            echo '<td>'. $pname[$i] .'</td>';
                            echo '<td>'. $des[$i] .'</td>';
                            echo '<td> &pound;'. $price[$i] .'</td>';
                            echo '<td>'. $type[$i] .'</td>';
                            if($userType=='customer'  && $OFB == true){echo "<td><form action='addBasket.php' method='POST'>
                                                            <input type='hidden' value=".$id[$x]." name='product_id' />
                                                            <input type='hidden' value='lu_menu.php' name='returnto' />
                                                            <input type=submit name=id value=Add />
                                                            </form></td>";}
                                                            //display the add to basket button based on time and user type
                            echo '</tr>';

                            $i++;
                            }
                            if (count($fetch) == 0){
                                echo '<td>Nothing on this menu, come back later!</td><td></td><td></td><td></td>';
                                if($userType=='customer'  && $OFB == true){echo"<tr></td>";} 
                            } //if theres nothing to display
                        ?>
                        </table>
                </li>
                <br>
                <li><i>Breakfast Hot Drinks</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer'  && $OFB == true){echo"<th>Add to Basket</th>";} ?>
                        </tr>
                        <?php 
                            //select all items where its a breakfast hot drink
                            $question="SELECT * FROM item WHERE idMenu=8";
                             $sth = $db->prepare($question);
                             $execute = $sth->execute();
                             $fetch = $sth->fetchAll();

                             $i=1;
                             foreach ($fetch as $key) {
                                
                                $id[$i] = $key['iditem'];
                                $pname[$i] = $key['name'];
                                $des[$i] = $key['description'];
                                $price[$i] = $key['price'];
                                $type[$i] = $key['type'];
                                
                            echo '<tr>';
                            echo '<td>'. $pname[$i] .'</td>';
                            echo '<td>'. $des[$i] .'</td>';
                            echo '<td> &pound;'. $price[$i] .'</td>';
                            echo '<td>'. $type[$i] .'</td>';
                            if($userType=='customer'  && $OFB == true){echo "<td><form action='addBasket.php' method='POST'>
                                                            <input type='hidden' value=".$id[$x]." name='product_id' />
                                                            <input type='hidden' value='lu_menu.php' name='returnto' />
                                                            <input type=submit name=id value=Add />
                                                            </form></td>";}
                            echo '</tr>';

                            $i++;
                            }
                            if (count($fetch) == 0){
                                echo '<td>Nothing on this menu, come back later!</td><td></td><td></td><td></td>';
                                if($userType=='customer'  && $OFB == true){echo"<tr></td>";} 
                            }
                        ?>
                        </table>
                </li>
            </ul>
        </nav>
    </body>
</html>