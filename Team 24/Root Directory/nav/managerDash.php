<?php 
    session_start();
    require_once("db_config.php");
    //connect to the database
    $d = date('Y-m-d');
    $notifi = 0;
    if (!isset($_SESSION['ignored'])){
        $_SESSION['ignored'] = array();
    }
    $maxi = count($_SESSION['ignored']);
    // checks if the manager has already ignored any late orders

    
    $question = "SELECT * FROM `order` WHERE DATE(orderTimeS) = '$d' AND orderStatus = 'Preparing'";
    $sth = $db->prepare($question);
    $sth->execute();
    $fetch = $sth->fetchAll();
    //Gets all orders which are currently preparing

    $xi = 0;
    foreach ($fetch as $key) {
        $id[$xi] = $key['idorder'];

        for ($i=0; $i < $maxi; $i++) { 
            if ($id[$xi] == $_SESSION['ignored'][$i]){
                break(2);
            }
        }
        //checks if the current id has already been ignored.

        $timestamp = $key['etc'];
        $timestamp2 = $key['orderTimeS'];

        //var_dump($timestamp);
        //var_dump($timestamp2);

        $datetime = explode(" ",$timestamp2);

        $date = $datetime[0];
        $time = $datetime[1];

        //var_dump($date);
        //var_dump($time);

        $times = explode(":",$time);
        $tih = $times[0];
        $tii = $times[1];
        $tis = $times[2];

        $estimate = explode(":",$timestamp);
        $etch = $estimate[0];
        $etci = $estimate[1];
        $etcs = $estimate[2];

        //var_dump($estimate);
        //var_dump($times);
    
        $th = intval($etch) + intval($tih);
        $ti = intval($etci) + intval($tii);
        $ts = intval($etcs) + intval($tis);

        //var_dump($th);
        //var_dump($ti);
        //var_dump($ts);

        while ($ts > 60){
            $ti++;
            $ts = $ts - 60;
        }
        while ($ti > 60) {
            $th++;
            $ti = $ti - 60;
        } 
        if ($th > 24) {
            $th = 24;
        }


        $t = $th . ":" . $ti . ":" . $ts;
        $eet = $date . " " . $t;
        $estimatedEnd = strtotime($eet);
        //var_dump($eet);

        $now = time();

        //var_dump(date ( "Y-m-d h:i:s" , $now));

        //var_dump($estimatedEnd);
        //var_dump($now);

        if ($estimatedEnd < $now){
            $notifi++;
        }
        //the long process of adding a time to a time stamp to get the "estimated end time" is then compared to the current time.
        // if they do not match, notifications are added.
        $xi++;
    }
    $idmax = count($id);
?>

<div class="nav" >
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="managerDash.php">Current Orders</a></li>
        <?php
        echo '<li><a ';
        //echo 'onclick="notifyme('.$notifi.')"';
        echo '>Notifications <span id="noti" style="margin-bottom:5px; border-radius: 25px 25px 25px; color: black; border: 
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

        for ($j=0 ; $j < $idmax ; $j++){
            echo '<input id="'.$j.'" name="'.$j.'" type="hidden" value="'. $id[$j] .'" /> ';
        }


            echo '<input id="j" name="j" type="hidden" value="'. $j .'" />';
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
    date.setDate(10);
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

    /* All above JS is for automatic DB restore & automated reports.
       A cookie is set to store the date of the next time the DB needs to be backed up (in the case of an owner) and the 
       next time a set of reports must be produced. this is checked every time the manager loads any page from the dashboard
       (with the exception of the homepage). Reports are produced in a new tab. */

    function notifyme(counter){

        if (counter > 1){    
            j = document.getElementById("j").value;
            list = "";
            for (i = 0; i < j; i++) {
                id[i] = document.getElementById(i).value;
                list = list + "Order " + id[i] + ", ";
            }
            alert("There are several late orders" + list);
            document.getElementById("ignore").submit();
            setTimeout(function(){
                location.reload();
            },200); 
        }
        else if(counter == 1){
            idone = document.getElementById("0").value;
            orders = "Order " + idone;
            alert("There is a late order: " + orders);
            document.getElementById("ignore").submit();
            setTimeout(function(){
                location.reload();
            },200); 
        }
    }
    c = document.getElementById("noti").innerHTML;
    notifyme(c);
    setTimeout(function(){
            location.reload();
        },180000); 

    /*all of the above JS is used to check if there are any notifications, if there are, the system displays an alert box.
      Once the alert box is clicked, the ignore form is submited which sets all notifications to be ignored (using the session as 
        a storage area). Once clicked notifications for these late orders will no longer show up unless the manager logs out. */
</script>