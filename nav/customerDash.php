<?php 
    require_once("db_config.php");
    $d = date('Y-m-d');
    $id = "";
    $bool = 0;

    $question = "SELECT idorder FROM `order` WHERE idCustomer = '$_SESSION[id]' AND DATE(orderTimeS) = '$d' AND orderStatus = 'Completed'";
    $sth = $db->prepare($question);
    $sth->execute();
    $fetch = $sth->fetchAll();

    $sth2 = $db->prepare($question);
    $sth2->execute();
    $id = $sth2->fetchColumn();
?>

<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="customerDash.php">My Orders</a></li>
        <li><a href="#" id="notiBtn">Notifications <span style="margin-bottom:5px; border-radius: 5px 5px 5px; color: black; border: 1px solid black; background:white; font-size:15px; padding:5px;"><?php echo count($fetch); ?></span></a></li>
        <li><a href="vip_status.php">VIP Status</a></li>
        <li><a href="myAccount.php">My Account</a></li>
        <li><a href="logoff.php">Logout</a></li>
    </ul>
</div>

<script type="text/javascript">
    var x = document.getElementById("notiBtn");

    x.addEventListener("click", notif);

    function notif() {
        <?php if(count($fetch)<1){ ?>
            alert ("No Notifications.");
            location.reload();
        <?php }else if(count($fetch)>0 && $bool == 0){ ?>
            alert ("Order <?php echo $id; $bool = 1;?> is now ready for collection.");
                <?php 
                    if($bool == 1){
                    $q2 = "UPDATE `order` SET orderStatus = 'Collected' WHERE idorder='$id'";
                    $sth2 = $db->prepare($q2);
                    $sth2->execute();
                    $bool = 0;
                    }
                ?>
                location.reload();
        <?php } ?>
    }
</script>