<?php 
    require_once("db_config.php");
    $d = date('Y-m-d');
    $notifi = 0;
    if (!isset($_SESSION['ignored'])){
        $_SESSION['ignored'] = array();
    }
    $max = count($_SESSION['ignored']);

    $question = "SELECT * FROM `order` WHERE DATE(orderTimeS) = '$d' AND orderStatus = 'Preparing'";
    $sth = $db->prepare($question);
    $sth->execute();
    $fetch = $sth->fetchAll();

    $x = 0;
    foreach ($fetch as $key) {
        $id[$x] = $key['idorder'];

        for ($i=0; $i < $max; $i++) { 
            if ($id == $_SESSION['ignore'][$i]['id']){
                break(3);
            }
        }
    
        $etc = date('H-i-s', $key['etc']);
        $Ordertime = date('H-i-s', $key['orderTimeS']);
        $now = date('H-i-s');

        $etch = intval(date('H', $etc));
        $etci = intval(date('i', $etc));
        $etcs = intval(date('s', $etc));
        $Ordertimeh = intval(date('H', $Ordertime));
        $Ordertimei = intval(date('i', $Ordertime));
        $Ordertimes = intval(date('s', $Ordertime));
        $th = $etch + $Ordertimeh;
        $ti = $etci + $Ordertimei;
        $ts = $etcs + $Ordertimes;

        while ($ts > 60){
            $ti++;
            $ts = $ts - 60;
        }
        while ($ti > 60) {
            $th++;
            $ti = $ti - 60;
        } 
        if ($th > 24) {$th = 24;}

        $t = $th . "-" . $ts . "-" . $ts;
        //echo $t;

        if ($t > $now){
            $notifi++;
        }
        $x++;
    }
?>

<div class="nav" >
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="managerDash.php">Current Orders</a></li>
        <?php
        echo '<li><a onclick="notifyme('.$notifi.')" id="notiBtn">Notifications <span style="margin-bottom:5px; border-radius: 25px 25px 25px; color: black; border: 
            0px solid black; background:#e6c8a6; font-size:15px; padding:5px;" >'. $notifi .'</span></a></li>';
        ?>
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

<form id="ignore" action='/ignore_all.php' method=POST target="_blank" hidden >
    <?php
        $j = 0;
        foreach ($id as $key) {
            echo '<input id="'.$j.'" type="hidden" value="'. $key .'" />';
            $j++;
        }
            echo '<input id="j" type="hidden" value="'. $j .'" />';
    ?>
    <input type='submit' value='Ignore'/>
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

    //All above JS is for automatic DB restore & automated reports.

    function notifyme(counter){

        if (counter > 1){    
            j = document.getElementById("j").value;
            list = "";
            for (i = 0; i < j; i++) {
                id[i] = document.getElementById(i).value;
                list = list + "Order" + id[i] + ", ";
            }
            alert("There are several late orders" + list);
            document.getElementById("ignore").submit();
        }
        else if(counter == 1){
            idone = document.getElementById("j0").value;
            orders = "Order" + idone;
            alert("There is a late order: " + orders);
            document.getElementById("ignore").submit();
        }
        else{
            alert ("No notifications to display.");
        }
        setTimeout(function(){
            location.reload();
        },2000); 

    }

</script>