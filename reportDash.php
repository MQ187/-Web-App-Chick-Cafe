<?php/*
session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}
if ($_SESSION['loggedIn'] == false) {header('Location: login.php');}
if ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer") {header('Location: customerDash.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "employee") {header('Location: employeeDash.php');}
*/
?>

<!DOCTYPE html>
    <head>
        <title>Report Dash | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
        <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
        <br>
        <?php
            require_once("nav/managerDash.php");
        ?>
    </header>
    <body>
        <nav>
            <ul id="rDash">
                <li><i>Report</i></li>
                    <table>
                        <tr><td><li><a class="report_button" href="customerSpendingReport.php">Customer Spending</a></li></td>
                        <td><li><a class="report_button" href="refundReport.php">Refund</a></li></td>
                        <td><li><a class="report_button" href="staffPerformanceReport.php">Staff Performance</a></li></td></tr>
                        <tr><td><li><a class="report_button" href="orderReport.php">Order</a></li></td>
                        <td><li><a class="report_button" href="activeCustomerReport.php">Active Users</a></li></td> 
                        <td><li>
                            <form action=AutoPDFReport.php method=POST>
                                <input type='submit' class="report_button" value='Generate All' />
                     <?php echo'<input type="hidden" name="startDate" value='.date("Y-m-d", strtotime("-1 month")).'/>
                                <input type="hidden" name="endDate" value='.date('Y-m-d').' />'; ?>
                            </form>
                        </td></tr>
                    </table>
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>