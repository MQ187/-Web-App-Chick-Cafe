<?php session_start(); 
	include("db_config.php");

$userType = $_SESSION['userType'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
    <head>
        <title>My Account | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
         Switch($userType){
            case "customer":
                require_once('nav/customerDash.php'); 
                break;
            case "manager":
                require_once('nav/managerDash.php');
                break;
            case "employee":
                require_once('nav/employeeDash.php');
                break;
        }
        ?>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php
        Switch($userType){
            case 'customer':
                $question="SELECT * FROM `customer` WHERE idCustomer= :id";
                $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id' => $id));
                $fetch = $sth->fetchAll();

                $i=1;
                foreach($fetch as $key){
                    echo '<form action="update_user.php" method="POST">';
                    echo '<tr><td><p>First Name:</p></td><td><input type="text" name="name" size="20" maxlength="45" value=' . $key['name'].'></td></tr>';
                    echo '<tr><td><p>Surname:</p></td><td><input type="text" name="surname" size="20" maxlength="45" value=' . $key['surname'].'></td></tr>';
                    echo '<tr><td><p>E-mail:</p></td><td><input type="email" name="email" size="20" maxlength="45" value=' . $key['email'].'></td></tr>'; 
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password" value=' . $key['password'].'></td></tr>';
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password2" value=' . $key['password'].'></td></tr>';
                    echo '<tr><td><p>Phone:</p></td><td><input type="text" name="phone" size="20" maxlength="12" value=' . $key['phone'].'></td></tr>';
                    $i++;
                            }
                break;
            case 'manager':
                $question="SELECT * FROM `manager` WHERE idManager= :id";
                $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id' => $id));
                $fetch = $sth->fetchAll();

                $i=1;
                foreach($fetch as $key){
                    echo '<form action="update_user.php" method="POST">';
                    echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" size="20" maxlength="45" value=' . $key['name'].'></td></tr>';
                    echo '<tr><td><p>E-mail:</p></td><td><input type="email" name="email" size="20" maxlength="45" value=' . $key['email'].'></td></tr>'; 
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password" value=' . $key['password'].'></td></tr>';
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password2" value=' . $key['password'].'></td></tr>';
                    $i++;
                }
                break;
            case 'employee':
                $question="SELECT * FROM `employee` WHERE idEmployee= :id";
                $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(':id' => $id));
                $fetch = $sth->fetchAll();

                $i=1;
                foreach($fetch as $key){
                    echo '<form action="update_user.php" method="POST">';
                    echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" size="20" maxlength="45" value=' . $key['name'].'></td></tr>';
                    echo '<tr><td><p>E-mail:</p></td><td><input type="email" name="email" size="20" maxlength="45" value=' . $key['email'].'></td></tr>'; 
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password" value=' . $key['password'].'></td></tr>';
                    echo '<tr><td><p>Password:</p></td><td><input type="password" size="20" maxlength="8" name="password2" value=' . $key['password'].'></td></tr>';
                    $i++;
                }
                break;
            }
	?>
    <tr><td colspan=2 align="center"><p>
          <input type="submit" value="Update"></p></td></tr>
    </table>
    </div>
    </form>
    </body>
</html>