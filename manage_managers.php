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
                <li><i>Manage Managers</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Owner</th><th>Manager Name</th><th>Password</th><th>Email</th><th>Active</th><th>Update</th><th>Delete</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.
                            $question="SELECT * FROM manager WHERE active = true";
                            $sth = $db->prepare($question);
                            $execute = $sth->execute();
                            $fetch = $sth->fetchAll();

	                        $i=1;
	                        foreach ($fetch as $key) {

                            $owner[$i] = $key['owner'];

                            if ($owner[$i] == "1"){
                                $checked = 'checked';
                            }
                            elseif ($owner[$i] == "0") {
                                $checked = "";
                            }

                            $id[$i] = $key['idmanager'];
                            $name[$i] = $key['name'];
                            $pword[$i] = $key['password'];
                            $email[$i] = $key['email'];
                            $active[$i] = $key['active'];

                            echo '<tr>';
                            echo "<form action=manage_managers.php method=POST>";
                            echo '<td><input name="owner" type=checkbox value="owner" ' . $checked . '/>';
                            echo '<td><input name="name" type="text" value='. $name[$i] .'></td>';
                            echo '<td><input name="pass" type="password" value='. $pword[$i] .'></td>';
                            echo '<td><input name="email" type="text" value='. $email[$i] .'></td>';
                            echo '<td>'. $active[$i] .'</td>';
                            echo "<td>
                                    <input type='submit' value='Update' name='Update'/>
                                    <input type=hidden name=idmanager value=$id[$i] />
                                  </form></td>"; 
                            echo "<td><form action=manage_managers.php method=POST>
                                    <input type='submit' value='Delete' name='Delete'/>
                                    <input type=hidden name=idmanager value=$id[$i] />
                                  </form></td>";   
                            echo '</tr>';
                            $i++;
                            }
                            if (count($fetch) == 0){
                              echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td>';
                            }

                            if(isset($_POST['Delete'])){
                                $question = "UPDATE manager SET active = false WHERE idmanager = '$_POST[idmanager]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_managers.php">';
                            }
                            if(isset($_POST['Update'])){
                                $owner = $_POST['owner'];
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = sha1(md5($_POST['pass']));

                                $question="UPDATE `manager` SET owner='$owner'name='$name', email='$email', password='$password' WHERE idmanager='$_POST[idmanager]'";
                                $sth = $db->prepare($question);
                                $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_managers.php">';
                            }
                        ?>
                    </table>
                        <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="add_manager.php">Add</a></p> 
                </li>
                <li><i>Inactive Managers / Owners</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Owner</th><th>Manager Name</th><th>Password</th><th>Email</th><th>Active</th><th>Update</th>
                        </tr>
                        <?php 
                            $question="SELECT * FROM manager WHERE active = false";
                            $sth = $db->prepare($question);
                            $execute = $sth->execute();
                            $fetch = $sth->fetchAll();

                            $i=1;
                            foreach ($fetch as $key) {

                            $owner[$i] = $key['owner'];
                            $id[$i] = $key['idmanager'];
                            $name[$i] = $key['name'];
                            $pword[$i] = $key['password'];
                            $email[$i] = $key['email'];
                            $active[$i] = $key['active'];

                            echo '<tr>';
                            echo '<td>'. $owner[$i] .'</td>';
                            echo '<td>'. $name[$i] .'</td>';
                            echo '<td><input value='. $pword[$i] .' type="password" readonly></td>';
                            echo '<td>'. $email[$i] .'</td>';
                            echo '<td>'. $active[$i] .'</td>';
                            echo "<td><form action=manage_managers.php method=POST>
                                    <input type='submit' value='Active' name='Active'/>
                                    <input type=hidden name=idmanager value=$id[$i] />
                                  </form></td>"; 
                            echo '</tr>';
                            $i++;
                            }
                            if (count($fetch) == 0){
                              echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td>';
                            }

                            if(isset($_POST['Active'])){
                                $question = "UPDATE manager SET active = true WHERE idmanager = '$_POST[idmanager]'";
                                $sth = $db->prepare($question);
                                $execute = $sth->execute();
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_managers.php">';
                            }
                        ?>
                    </table>
                </li>
            </ul>
        </nav>
    </body>

</html>

