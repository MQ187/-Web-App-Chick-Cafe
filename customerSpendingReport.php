<?php
session_start();
?>
<!DOCTYPE html>
    <head>
        <title>Customer Spending Report | Chick Cafe</title>
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
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                <li><a href="logoff.php">Logout</a></li>
                </ul>
        </div>
    </header>
    <body>

        <table align="center" class="startEnd">
            <form action="customerSpendingReport.php" method="POST">
                <tr><td><p>Start Date:</p></td><td><input type="text" name="startDate" size="20" placeholder="YYYY-MM-DD"></td></tr>
                <tr><td><p>End Date:</p></td><td><input type="text" name="endDate" size="20" placeholder="YYYY-MM-DD"></td></tr>
                <tr><td><input type="submit" value="Generate"></td></tr>
            </form>
        </table>

        <nav>
            <ul>
                <li><i>Customer Spending Report</i>
    

                <?php 
                    require_once('report.php');
                    if(isset($_POST['startDate'])){
                        $_SESSION['startDate'] = $_POST['startDate'];
                        $_SESSION['endDate'] = $_POST['endDate'];

                        $r = new report();
                        $dis = $r->csReportPDF($_POST['startDate'],$_POST['endDate']);
                        $_SESSION['report'] = $dis;
                        echo $_SESSION['report'];

                        $date = date('Y-m-d H:i:s');
                        $q = "INSERT INTO `reports`(`idmanager`, `date`, `type`) VALUES ('$_SESSION[id]','$date','Customer Spending')";
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