<?php 
    require_once("db_config.php");
    $d = date('Y-m-d');
    $id = "";
    $bool = 0;

    $question = "SELECT idorder FROM `order` WHERE idCustomer = '$_SESSION[id]' AND DATE(orderTimeS) = '$d' AND orderStatus = 'Completed'";
    $sth = $db->prepare($question);
    $sth->execute();
    $fetch = $sth->fetchAll();

    $notifi = count($fetch);

    $sth2 = $db->prepare($question);
    $sth2->execute();
    $id = $sth2->fetchColumn();
?>

<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="customerDash.php">My Orders</a></li>
        <?php
        echo '<li><a onclick="notifyme('. $notifi .')" id="notiBtn">Notifications <span style="margin-bottom:5px; border-radius: 25px 25px 25px; color: black; border: 
            0px solid black; background:#e6c8a6; font-size:15px; padding:5px;" >'. $notifi .'</span></a></li>';
        ?>
            
        <li><a href="vip_status.php">VIP Status</a></li>
        <li><a href="myAccount.php">My Account</a></li>
        <li><a href="logoff.php">Logout</a></li>
    </ul>
</div>

<form  name="jack" action='orderCompleted.php' id='update' method=POST hidden>
    <input type="hidden" name="id" value=<?php echo "'". $id ."'" ?> />
    <input type="submit" name="update" />
</form>

<script type="text/javascript">

    function notifyme(counter){

        if (counter > 0){    
            alert("Your order is now ready for collection.");
            document.getElementById("update").submit();
        }
        else{
            alert ("No notifications to display.");
            location.reload();
        }
    }
</script>