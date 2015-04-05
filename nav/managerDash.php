<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="managerDash.php">Current Orders</a></li>
        <li><a href="reportDash.php">Reports</a></li>
        <li><a href="manage_employees.php">Employee Accounts</a></li>
        <?php
        session_start();
        if ($_SESSION['owner'] == 1){
            echo '<li><a href="manage_managers.php">Manager Accounts</a></li>';
        }
        ?>
        <li><a href="refund.php">Refund</a></li>
        <li><a href="vip.php">VIP</a></li>
        <li><a href="stock.php">Stock</a></li>
        <li><a href="items.php">Items</a></li>
        <?php
        if ($_SESSION['owner'] == 1){
            echo '<li><a href="db_dash.php">Database Management</a></li>';
        }
        ?>
        <li><a href="myAccount.php">My Account</a></li>
        <li><a href="logoff.php">Logout</a></li>
    </ul>
</div>