
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
	            <li><a href="managerDash.php">Current Orders</a></li>
	            <li><a href="#">Reports</a></li>
	            <li><a href="#">Employee Accounts</a></li>
	            <li><a href="refund.php">Refund</a></li>
	            <li><a href="#">VIP</a></li>
	            <li><a href="#">Stock</a></li>
	            <li><a href="myAccount.php">My Account</a></li>
	            <li><a href="logoff.php">Logout</a></li>
		    </ul>
		</div>
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
                            $question="SELECT * FROM employee";
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
                            echo '<td><input type="text" value='. $name[$i] .'></td>';
                            echo '<td><input type="password" value='. $pword[$i] .'></td>';
                            echo '<td><input type="text" value='. $email[$i] .'></td>';
                            echo '<td>'. $active[$i] .'</td>';
                            echo '<td><input type="submit" value="Update" name="Update"/></td>';
                            echo '<td><input type="submit" value="Delete" name="Delete"/></td>';
                            echo '</tr>';
                            $i++;
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

