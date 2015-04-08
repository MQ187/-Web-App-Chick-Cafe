<?php 
session_start(); 
include("db_config.php");
require_once("messages.php");
$userType = $_SESSION['userType'];
$id = $_SESSION['id'];

$_SESSION['access'] = array("owner","manager", "employee");
include('security.php');

require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>
<!DOCTYPE html>
    <head>
        <title>Stock | Chick Cafe</title>
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
                <li><i>Stock</i>
                        <table id="tfhover" class="tftable" border="1" width="100%">
                        <tr><form action="stock.php" method="POST">
                        	<input style="float:right;"type="submit" value="Search" />
                            <input style="float:right;"type="text" name="search_name"/>
                            </form>
                       	</tr>
                        <tr>
                        <th>Name</th><th>Availability</th><th>Price</th><?php if($userType=='manager'){echo"<th>Update</th><th>Delete</th>";}?>
                        </tr>
                        <?php
                        	if(!empty($_REQUEST['search_name'])){

                        		$sname = mysql_real_escape_string($_REQUEST['search_name']);

                        		// Connect to the Database and Select the ccdb database.
	                             $question="SELECT * FROM `ingredients` WHERE name LIKE '%".$sname."%'";
	                             $sth = $db->prepare($question);
	                             $execute = $sth->execute();
	                             $fetch = $sth->fetchAll();

                                 $count = count($fetch);
                                 if ($count == 0){
                                    $_SESSION['message'] = "5"; //no such item exists
                                    header("Location: stock.php");
                                    die();
                                 }
                                 //if no item exists, give error and display full list.

	                             $i=1;
	                             foreach ($fetch as $key) {
	                                $idstock[$i] = $key['idIngredients'];
	                                $pname[$i] = $key['name'];
	                                $des[$i] = $key['availability'];
	                                $price[$i] = $key['price'];

	                            echo '<tr>';
	                            echo '<td>'. $pname[$i] .'</td>';
	                            echo '<td>'. $des[$i] .'</td>';
	                            echo '<td> &pound;'. $price[$i] .'</td>';
	                            if($userType=='manager'){    echo "<td><form action=update_stock.php method=POST>
                                                                  <input type=submit name=visID value=Update />
                                                                  <input type=hidden name=stockid value=$idstock[$i] />
                                                                  </form></td>"; 
                                                            echo "<td><form action=stock.php method=POST>
                                                                  <input type='submit' value='Delete' name='Delete'/>
                                                                  <input type=hidden name=stockid value=$idstock[$i] />
                                                                  </form></td>";   
	                            }
	                            echo '</tr>';
	                            $i++;
	                            }
                              if (count($fetch) == 0){
                                echo '<td>Nothing to display</td><td></td><td></td>';
                              }

                        	}else{
	                            // Connect to the Database and Select the ccdb database.
	                             $question="SELECT * FROM `ingredients`";
	                             $sth = $db->prepare($question);
	                             $execute = $sth->execute();
	                             $fetch = $sth->fetchAll();

	                             $i=1;
	                             foreach ($fetch as $key) {
	                                $idstock[$i] = $key['idIngredients'];
	                                $pname[$i] = $key['name'];
	                                $des[$i] = $key['availability'];
	                                $price[$i] = $key['price'];

	                            echo '<tr>';
	                            echo '<td>'. $pname[$i] .'</td>';
	                            echo '<td>'. $des[$i] .'</td>';
	                            echo '<td> &pound;'. $price[$i] .'</td>';
	                            if($userType=='manager'){   echo "<td><form action=update_stock.php method=POST>
	                                                              <input type=submit name=visID value=Update />
	                                                              <input type=hidden name=stockid value=$idstock[$i] />
	                                                              </form></td>"; 
                                                            echo "<td><form action=stock.php method=POST>
                                                                  <input type='submit' value='Delete' name='Delete'/>
                                                                  <input type=hidden name=stockid value=$idstock[$i] />
                                                                  </form></td>";       
	                            }
	                            echo '</tr>';
	                            $i++;
	                            }
                              if (count($fetch) == 0){
                                echo '<td>Nothing to display</td><td></td><td></td>';
                              }
                        	}
                            if(isset($_POST['Delete'])){
                                $question = "DELETE FROM `ingredients` WHERE idIngredients = '$_POST[stockid]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=stock.php">';
                            }
                        ?>
                        </table>
                        <?php 
                        if($userType=='manager'){ 
                            echo '<p style="text-align:center;"><a style="text-decoration:none;color:white; "href="add_stock.php">Add</a></p> ';
                        }
                        ?>
                </li>  
            </ul>
        </nav>
    </body>
</html>