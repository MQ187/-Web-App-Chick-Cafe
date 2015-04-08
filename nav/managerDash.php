<div class="nav" >
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="managerDash.php">Current Orders</a></li>
        <li><a href="reportDash.php">Reports</a></li>
        <li><a href="manage_employees.php">Employee Accounts</a></li>
        <?php
        session_start();
        if ($_SESSION['owner'] == 1){
            echo '<li><a href="manage_managers.php">Manager Accounts</a></li>
                    <p id="owner" hidden >1</p>';
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

    <p id="text" ></p>

</div>

<form id="reports" action="/AutoPDFReport.php" method=POST target="_blank" hidden >
        <input type='submit' class="report_button" value='Generate All' />
        <?php echo'<input type="hidden" name="startDate" value=01-'.date("m-Y", strtotime("-1 month")).'/>
                    <input type="hidden" name="endDate" value=01-'.date('m-Y').' />';
        ?>
</form>

<form id="backup" action='/db_backup.php' method=POST target="_blank" hidden >
        <input type='submit' value='Backup now'/>
</form>

<script type="text/javascript">
    
    function SetCookie(cookieName,cookieValue) {
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + (62*24*60*60*1000)); //2 months validity
        document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString();
    }

    function ReadCookie(cookieName) {
        var theCookie=" "+document.cookie;
        var ind=theCookie.indexOf(" "+cookieName+"=");
        if (ind==-1) ind=theCookie.indexOf(";"+cookieName+"=");
        if (ind==-1 || cookieName=="") return "";
        var ind1=theCookie.indexOf(";",ind+1);
        if (ind1==-1) ind1=theCookie.length; 
        return unescape(theCookie.substring(ind+cookieName.length+2,ind1));
    }

    var date = new Date();
    var today = new Date();
    currentM = date.getMonth();
    newM = currentM + 1;
    date.setMonth(newM);
    cookieN = "ChickCafe";
    cookieV = date;
    SetCookie(cookieN,cookieV);

    if (document.cookie.indexOf("ChickCafe") >= 0) {
    }
    else {
        SetCookie(cookieN,cookieV);
    }
    cookieR = ReadCookie("ChickCafe");
    cookieDate = new Date(cookieR);
    owner = document.getElementById("owner").innerHTML;
    

    if (today > cookieDate){
        document.getElementById("reports").submit();
        SetCookie(cookieN,cookieV);
        if (owner == 1){
        document.getElementById("backup").submit();
        }
    }

</script>