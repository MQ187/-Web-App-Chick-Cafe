<?php session_start(); 
    include("db_config.php");
    $_SESSION['access'] = array("owner","manager","employee");
    include('security.php');
    require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
    
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
                    require_once("nav/managerDash.php");
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
                                if (count($fetch) == 0){
                                  echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
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
                                    if (count($fetch) == 0){
                                        echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
                                    }
                        	}
                            if(isset($_POST['Delete'])){
                                $q = "DELETE FROM `itemingredients` WHERE iditem = '$_POST[itemid]'";
                                $st = $db->prepare($q);
                                $execute = $st->execute();

                                $question = "DELETE FROM `item` WHERE iditem = '$_POST[itemid]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=items.php">';
                            }
                        ?>
                        </table>
                        <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="add_item.php">Add</a></p> 
                </li>  
            </ul>
        </nav>
    </body>
</html>