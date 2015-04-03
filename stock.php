<?php 
session_start(); 
include("db_config.php");
require_once("messages.php");
$userType = $_SESSION['userType'];
$id = $_SESSION['id'];
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
         <div class="nav">
            <ul>
         <?php
         Switch($userType){
            case "manager":
                ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="managerDash.php">Current Orders</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Employee Accounts</a></li>
                <li><a href="refund.php">Refund</a></li>
                <li><a href="#">VIP</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                <?php
                break;
            case "employee":
                ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="employeeDash.php">Pending Orders</a></li>
                <li><a href="employeeReport.php">Report</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                <?php
                break;
        }
        ?>
                 <li><a href="logoff.php">Logout</a></li>
            </ul>
        </div>
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
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>