<?php
session_start();

$_SESSION['access'] = array("owner","manager");
include('security.php');

require_once("messages.php");
//adds the check for all possible errors as well as the warnings.

?>
<!DOCTYPE html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
        <?php
                require_once("nav/managerDash.php");
            ?>
    </header>
    <body>

        <table align="center" class="startEnd">
            <form action="refundReport.php" method="POST">
                <tr><td><p>Start Date:</p></td><td><input type="text" name="startDate" size="20" placeholder="YYYY-MM-DD"></td></tr>
                <tr><td><p>End Date:</p></td><td><input type="text" name="endDate" size="20" placeholder="YYYY-MM-DD"></td></tr>
                <tr><td><input type="submit" value="Generate"></td></tr>
            </form>
        </table>

        <nav>
            <ul>
                <li><i>Refund Report</i>
    

                <?php 
                require_once('report.php');
                if(isset($_POST['startDate'])){
                $_SESSION['startDate'] = $_POST['startDate'];
                $_SESSION['endDate'] = $_POST['endDate'];

                $r = new report();
                $dis = $r->rReportPDF($_POST['startDate'],$_POST['endDate']);
                $_SESSION['report'] = $dis;
                echo $_SESSION['report'];

                    $date = date('Y-m-d H:i:s');
                    $q = "INSERT INTO `reports`(`idmanager`, `date`, `type`) VALUES ('$_SESSION[id]','$date','Refund')";
                    $sth = $db->prepare($q);
                    $execute = $sth->execute();
            }
                ?>
                      
            <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="PDFReport.php" target="_blank">Export Report</a></p> 
                </li>
            </ul>
        </nav>
    </body>
</html>