<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.

$_SESSION['access'] = "customer";
include('security.php');
//only allow customer to access this page
?>
<!DOCTYPE html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <style>
          h2, h3 {
            color:white; /*set the colour of the headers to white*/
          }
        </style>
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <?php
         require_once("nav/customerDash.php");
         ?>

    </header>
    <body>
    	<nav>
            <ul><li><i>My Vip Status</i></li><br><br><br>
              
                <table width="800px">
                <?php
                //check type of vip discount
                if (isset($_SESSION['vipD'])){
                  $type = "fixed";
                  $value = $_SESSION['vipD'];
                }
                //display image based on the customers status
                if (isset($_SESSION['vip'])){
                  switch ($_SESSION['vip']) {
                    case '0':
                      echo '<tr><td><h2> You have no VIP membership status, come more often to benefit from our great offers!</h2>';
                      break;
                    case '1':
                      echo '<tr><td width="100" ></td><td><img src="images/vip.png" width=60% /></td><td><h1> - Silver</h1></td>';
                      echo '<td>';
                      break;
                    case '2':
                      echo '<tr><td width="100" ></td><td><img src="images/gold.png" width=60% /></td><td><h1> - Gold</h1></td>';
                      echo '<td>';
                      break;
                    case '3':
                      echo '<tr><td width="100" ></td><td><img src="images/platinum.png" width=60% /></td><td><h1> - Platinum</h1></td>';
                      echo '<td>';
                      break;
                  }
                }
                else{
                  echo '<tr><td><h2> You have no VIP membership status, come more often to benefit from our great offers!</h2>';
                }
                //display the discount percentage for the specific customer
                switch ($type) {
                  case 'fixed':
                    if ($_SESSION['vip'] != 0){
                      echo '</td><td><h3>(Fixed Discount Rate - </h3></td>';
                      echo '</td><td><h3>' . $value . '% )</h3></td>';
                    } 
                    break;
                  case 'flex':
                    echo '</td><td><h3>Flexible Discount Rate</h3></td>';
                    echo '<table>';
                    foreach ($_SESSION['vipFlex'] as $key) {
                      echo '<tr><td><h3> Upper Bound :' . $key['up'] . '</h3></td>';
                      echo '<td><td><h3> Lower Bound :' . $key['low'] . '</h3></td>';
                      echo '<td><td><h3> Value :' . $key['v'] . '% </h3></td>';
                    }
                    echo '</table>';
                    break;
                }
                ?>
                </td></tr>
              </table>
          

</ul>
</nav>
    </body>
</html>