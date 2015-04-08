<?php
session_start();

$_SESSION['access'] = array("manager","owner");
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
            require_once('nav/managerDash.php');
         ?>
    </header>
    <body>

        <table align="center" class="startEnd">
            <form action="activeCustomerReport.php" method="POST">
                <tr><td><input type="submit" name="gen" value="Generate"></td></tr>
            </form>
        </table>

        <nav>
            <ul>
                <li><i>Active Customer Report</i>
    

                <?php 
                require_once('report.php');
                if(isset($_POST['gen'])){
                    $r = new report();
                    $dis = $r->acReportPDF();
                    $_SESSION['report'] = $dis;
                    echo $_SESSION['report'];

                    $date = date('Y-m-d H:i:s');
                    $q = "INSERT INTO `reports`(`idmanager`, `date`, `type`) VALUES ('$_SESSION[id]','$date','Active Customer')";
                    $sth = $db->prepare($q);
                    $execute = $sth->execute();
            }
                ?>
                      
            <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="PDFReport.php" target="_blank">Export Report</a></p> 
                </li>
            </ul>
        </nav>
    </body>
    


    </body>
</html>