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
  
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>