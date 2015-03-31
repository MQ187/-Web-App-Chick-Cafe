<?php
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>
<!DOCTYPE html>
	<head>
		<title>Main | Chick Cafe</title>
		<link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
	</head>

	<body>
	<header>
		 <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
     <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="br_menu.php">Breakfast</a></li>
                <li><a href="lu_menu.php">Lunch</a></li>
                <li><a href="di_menu.php">Dinner</a></li>
                <li><a href="dr_menu.php">Drinks</a></li>
                <?php
                session_start();
                if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
                if (!isset($_SESSION['userType'])) {$_SESSION['userType'] = "NONE";}
                $userType = $_SESSION['userType'];
                if ($_SESSION['logedIn'] == false){
                    ?> 
                    <li><a href="login.php">Login/Register</a></li> 
                    <?php
                }
                else{

                    Switch($userType){
                        case 'customer':
                        ?> 
                        <li><a href="customerDash.php">Dashboard</a></li>
                        <?php
                        break;
                        case 'employee':
                        ?>
                        <li><a href="employeeDash.php">Dashboard</a></li>
                        <?php
                        break;
                        case 'manager':
                        ?>
                        <li><a href="managerDash.php">Dashboard</a></li>
                        <?php
                        break;
                    }
                    ?>
                    <li><a href="logoff.php">Logout</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </header>
    <body>
		<nav>
            <ul>
            
                <li><i>DINNER</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer'){echo"<th>Add to Basket</th>";} ?>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.

                            $question="SELECT * FROM item WHERE idMenu=3";
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
                            if($userType=='customer'){echo "<td><form action='addBasket.php' method='POST'>
                                                            <input type='hidden' value=".$id[$i]." name='product_id' />
                                                            <input type='hidden' value='di_menu.php' name='returnto' />
                                                            <input type=submit name=id value=Add />
                                                            </form></td>";}
                            echo '</tr>';
                            $i++;
                            }
                        ?>
                        </table>
                </li>
                
                <li><i>TODAYS SPECIAL</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Title</th><th>Description</th><th>Price</th><th>Type</th><?php if($userType=='customer'){echo"<th>Add to Basket</th>";} ?>
                        </tr>
                        <?php 
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
                            echo '<tr>';
                            echo '<td>'. $pname[$i] .'</td>';
                            echo '<td>'. $des[$i] .'</td>';
                            echo '<td> &pound;'. $price[$i] .'</td>';
                            echo '<td>'. $type[$i] .'</td>';
                            if($userType=='customer'){echo "<td><form action='addBasket.php' method='POST'>
                                                            <input type='hidden' value=".$id[$i]." name='product_id' />
                                                            <input type='hidden' value='di_menu.php' name='returnto' />
                                                            <input type=submit name=id value=Add />
                                                            </form></td>";}
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                        </table>
                </li>
            </ul>
        </nav>
    
	<footer>
		<strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
	</footer>

	</body>
</html>