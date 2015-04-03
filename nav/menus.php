<?php
    session_start();
?>
<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="br_menu.php">Breakfast</a></li>
        <li><a href="lu_menu.php">Lunch</a></li>
        <li><a href="di_menu.php">Dinner</a></li>
        <li><a href="dr_menu.php">Drinks</a></li>
        <?php
        if (!isset($_SESSION['logedIn'])) { 
            $_SESSION['logedIn'] = false;
        }
        if (!isset($_SESSION['userType'])) {
            $_SESSION['userType'] = "NONE";
        }
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