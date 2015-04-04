<?php session_start(); 
    include("db_config.php");
    

/*if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}
if ($_SESSION['logedIn'] == false) {header('Location: login.php');}
*/
if (isset($_SESSION['message'])){
        if ($_SESSION['message'] == "3") { 
        print '<script type="text/javascript">alert("Your passwords did not match, please try again.");</script>';
        unset($_SESSION['message']);
        }
        elseif ($_SESSION['message'] == "4") {
        print '<script type="text/javascript">alert("A user with such an email already exists. Maybe try logging in?");</script>';
        unset($_SESSION['message']);
        }
}
$userType = $_SESSION['userType'];
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
    <head>
        <title>Items | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
         Switch($userType){
            case "manager":
                require_once('nav/managerDash.php');
                break;
            case "employee":
                require_once('nav/employeeDash.php');
                break;
        }
        ?>
    </header>
        <nav>
            <ul>
                <li><i>Items</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr><form action="items.php" method="POST">
                        	<input style="float:right;"type="submit" value="Search" />
                            <input style="float:right;"type="text" name="search_name"/>
                            </form>
                       	</tr>
                        <tr>
                        <th>Item ID</th><th>Menu</th><th>Name</th><th>Type</th><th>Price</th><th>Prep Time</th><th>Special</th><?php if($userType=='manager'){echo"<th>Update</th><th>Delete</th>";}?>
                        </tr>
                        <?php
                        	if(!empty($_REQUEST['search_name'])){

                        		$sname = mysql_real_escape_string($_REQUEST['search_name']);

                        		// Connect to the Database and Select the ccdb database.
	                             $question="SELECT * FROM `item` WHERE name LIKE '%".$sname."%'";
	                             $sth = $db->prepare($question);
	                             $execute = $sth->execute();
	                             $fetch = $sth->fetchAll();

	                             $i=1;
	                             foreach ($fetch as $key) {
	                                $iditem[$i] = $key['iditem'];
                                    $idMenu[$i] = $key['idMenu'];
                                    $type[$i] = $key['type'];
                                    $name[$i] = $key['name'];
	                                $price[$i] = $key['price'];
                                    $prep[$i] = $key['preperationTime'];
                                    $spec[$i] = $key['dailySpecial'];

	                            echo '<tr>';
                                echo '<td>'. $iditem[$i] .'</td>';
                                switch($idMenu[$i]){
                                        case 1:
                                            echo '<td>Breakfast Menu</td>';
                                            break;
                                        case 2:
                                            echo '<td>Lunch Menu</td>';
                                            break;
                                        case 3:
                                            echo '<td>Dinner Menu</td>';
                                            break;
                                        case 4:
                                            echo '<td>Drinks Menu</td>';
                                            break;
                                }
                                echo '<td>'. $name[$i] .'</td>';
	                            echo '<td>'. $type[$i] .'</td>';
	                            echo '<td> &pound;'. $price[$i] .'</td>';
                                echo '<td>'. $prep[$i] .'</td>';
                                echo '<td>'. $spec[$i] .'</td>';
	                            if($userType=='manager'){    echo "<td><form action=update_item.php method=POST>
                                                                      <input type=submit name=visID value=Update />
                                                                      <input type=hidden name=itemid value=$iditem[$i] />
                                                                      </form></td>"; 
                                                            echo "<td><form action=items.php method=POST>
                                                                  <input type='submit' value='Delete' name='Delete'/>
                                                                  <input type=hidden name=itemid value=$iditem[$i] />
                                                                  </form></td>";  
	                            }
	                            echo '</tr>';
	                            $i++;
	                            }

                        	}else{
	                            // Connect to the Database and Select the ccdb database.
	                             $question="SELECT * FROM `item` ORDER BY idMenu";
	                             $sth = $db->prepare($question);
	                             $execute = $sth->execute();
	                             $fetch = $sth->fetchAll();

	                             $i=1;
	                             foreach ($fetch as $key) {
                                    $iditem[$i] = $key['iditem'];
                                    $idMenu[$i] = $key['idMenu'];
                                    $type[$i] = $key['type'];
                                    $name[$i] = $key['name'];
                                    $price[$i] = $key['price'];
                                    $prep[$i] = $key['preperationTime'];
                                    $spec[$i] = $key['dailySpecial'];

                                    echo '<tr>';
                                    echo '<td>'. $iditem[$i] .'</td>';
                                    switch($idMenu[$i]){
                                        case 1:
                                            echo '<td>Breakfast Menu</td>';
                                            break;
                                        case 2:
                                            echo '<td>Lunch Menu</td>';
                                            break;
                                        case 3:
                                            echo '<td>Dinner Menu</td>';
                                            break;
                                        case 4:
                                            echo '<td>Drinks Menu</td>';
                                            break;
                                    }
                                    echo '<td>'. $name[$i] .'</td>';
                                    echo '<td>'. $type[$i] .'</td>';
                                    echo '<td> &pound;'. $price[$i] .'</td>';
                                    echo '<td>'. $prep[$i] .'</td>';
                                    echo '<td>'. $spec[$i] .'</td>';
    	                            if($userType=='manager'){   echo "<td><form action=update_item.php method=POST>
    	                                                              <input type=submit name=visID value=Update />
    	                                                              <input type=hidden name=itemid value=$iditem[$i] />
    	                                                              </form></td>"; 
                                                                echo "<td><form action=items.php method=POST>
                                                                      <input type='submit' value='Delete' name='Delete'/>
                                                                      <input type=hidden name=itemid value=$iditem[$i] />
                                                                      </form></td>";       
	                                }
	                                   echo '</tr>';
	                                    $i++;
	                               }
                        	}
                            if(isset($_POST['Delete'])){
                                $q = "DELETE FROM `itemingredients` WHERE iditem = '$_POST[itemid]'";
                                $st = $db->prepare($q);
                                $execute = $st->execute();

                                $question = "DELETE FROM `item` WHERE iditem = '$_POST[itemid]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                            }
                        ?>
                        </table>
                        <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="add_item.php">Add</a></p> 
                </li>  
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>