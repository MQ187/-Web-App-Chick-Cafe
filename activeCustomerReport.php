<?php
session_start();
//start the session

$_SESSION['access'] = array("manager","owner");
include('security.php');
//only give access to manager and/or owner

require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>
<!DOCTYPE html>
    <head>
        <!--set the title and include the css file-->
        <title>Active Customer Report | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
        <?php
            require_once('nav/managerDash.php'); //include the manager nav
         ?>
    </header>
    <body>

        <!--form for the start and end date and generate button-->
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
                //include the report class to get acReport method

                if(isset($_POST['gen'])){  //check if the generate button has been clicked
                    $r = new report();  //create report instance
                    $dis = $r->acReportPDF();   //call the acReport method
                    $_SESSION['report'] = $dis; //set the report type in the session
                    echo $_SESSION['report'];

                    //record the report date and who made the report
                    $date = date('Y-m-d H:i:s');
                    $q = "INSERT INTO `reports`(`idmanager`, `date`, `type`) VALUES ('$_SESSION[id]','$date','Active Customer')";
                    $sth = $db->prepare($q);
                    $execute = $sth->execute();
            }
                ?>
                    <!--Button to export the report as a pdf-->  
                    <p style="text-align:center;"><a style="text-decoration:none;color:white; "href="PDFReport.php" target="_blank">Export Report</a></p> 
                </li>
            </ul>
        </nav>
    </body>
    


    </body>
</html>