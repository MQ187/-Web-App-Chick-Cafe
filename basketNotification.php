<div class="header-container">
		<div class="left-container">
        <?php
          session_start(); 
          if(isset($_SESSION['basket']) && $_SESSION['userType'] == "customer"){
            echo '<a href="basket.php"><img class="left" src="images/basket.png" width=20%/></a>';
          }
        ?>
    </div>
</div>