<div class="header-container">
		<div class="left-container">
        <?php
          session_start(); //start the session

          //check if basket exists
          if (!isset($_SESSION['basket'])){
          	$_SESSION['basket'] = array();
          }

          //display the basket icon if item exists in basket
          if(count($_SESSION['basket']) > 0 && $_SESSION['userType'] == "customer"){
            echo '<a href="basket.php"><img class="left" src="images/basket.png" width=20%/></a>';
          }
          ?>
    </div>
    <div class="right-container">
          <?php
          //display vip icon based on customer status
          if (isset($_SESSION['vip'])){
            switch ($_SESSION['vip']) {
              case '1':
                echo '<a href="vip_status.php"><img class="right" src="images/vip.png" width=20%/></a>';
                break;
              case '2':
                echo '<a href="vip_status.php"><img class="right" src="images/gold.png" width=20%/></a>';
                break;
              case '3':
                echo '<a href="vip_status.php"><img class="right" src="images/platinum.png" width=20%/></a>';
                break;
            }
          }

        ?>
    </div>    
</div>