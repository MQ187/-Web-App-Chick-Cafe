
<!DOCTYPE html>
	<head>
		<title>Main | Chick Cafe</title>
		<link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
	</head>
	<body>
	<header>
	    <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
		<?php
        require_once('nav/managerDash.php');
        ?>
    </header>
    <body>
		<nav>
            <ul>    
                <li><i>Manage Employees</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Employee Name</th><th>Password</th><th>Email</th><th>Active</th><th>Update</th><th>Delete</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.
                            $question="SELECT * FROM employee WHERE active = true";
                            $sth = $db->prepare($question);
                            $execute = $sth->execute();
                            $fetch = $sth->fetchAll();

	                        $i=1;
	                        foreach ($fetch as $key) {

                            $id[$i] = $key['idemployee'];
                            $name[$i] = $key['name'];
                            $pword[$i] = $key['password'];
                            $email[$i] = $key['email'];
                            $active[$i] = $key['active'];

                            echo '<tr>';
                            echo "<form action=manage_employees.php method=POST>";
                            echo '<td><input name="name" type="text" value='. $name[$i] .'></td>';
                            echo '<td><input name="pass" type="password" value='. $pword[$i] .'></td>';
                            echo '<td><input name="email" type="text" value='. $email[$i] .'></td>';
                            echo '<td>'. $active[$i] .'</td>';
                            echo "<td>
                                    <input type='submit' value='Update' name='Update'/>
                                    <input type=hidden name=employeeid value=$id[$i] />
                                  </form></td>"; 
                            echo "<td><form action=manage_employees.php method=POST>
                                    <input type='submit' value='Delete' name='Delete'/>
                                    <input type=hidden name=employeeid value=$id[$i] />
                                  </form></td>";   
                            echo '</tr>';
                            $i++;
                            }

                            if(isset($_POST['Delete'])){
                                $question = "UPDATE employee SET active = false WHERE idemployee = '$_POST[employeeid]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_employees.php">';
                            }
                            if(isset($_POST['Update'])){
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = sha1(md5($_POST['pass']));

                                $question="UPDATE `employee` SET name='$name', email='$email', password='$password' WHERE idemployee='$_POST[employeeid]'";
                                $sth = $db->prepare($question);
                                $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_employees.php">';
                            }
                        ?>
                    </table>
                        <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="add_employee.php">Add</a></p> 
                </li>
                <li><i>Inactive Employees</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Employee Name</th><th>Password</th><th>Email</th><th>Active</th><th>Update</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.
                            $question="SELECT * FROM employee WHERE active = false";
                            $sth = $db->prepare($question);
                            $execute = $sth->execute();
                            $fetch = $sth->fetchAll();

                            $i=1;
                            foreach ($fetch as $key) {

                            $id[$i] = $key['idemployee'];
                            $name[$i] = $key['name'];
                            $pword[$i] = $key['password'];
                            $email[$i] = $key['email'];
                            $active[$i] = $key['active'];

                            echo '<tr>';
                            echo '<td>'. $name[$i] .'</td>';
                            echo '<td><input value='. $pword[$i] .' type="password" readonly></td>';
                            echo '<td>'. $email[$i] .'</td>';
                            echo '<td>'. $active[$i] .'</td>';
                            echo "<td><form action=manage_employees.php method=POST>
                                    <input type='submit' value='Active' name='Active'/>
                                    <input type=hidden name=employeeid value=$id[$i] />
                                  </form></td>"; 
                            echo '</tr>';
                            $i++;
                            }

                            if(isset($_POST['Active'])){
                                $question = "UPDATE employee SET active = true WHERE idemployee = '$_POST[employeeid]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_employees.php">';
                            }
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

