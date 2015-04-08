<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
if (isset($_POST['priority'])){
    $priority = 1;
    $checked = "checked";    
}
else{
    $priority = 0;
    $checked = "";
}

$total = $_POST['total'];
$iddiscount = 1;
$discounted = 0;

if (!isset($_POST['orderOK'])){
	header("Location: basket.php");
	die();
}
?>
<!DOCTYPE html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <script src="jQuery.js"></script>
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <?php
         require_once("nav/menus.php");
         ?>

    </header>
    <body><nav>
    	<ul><li><i>Please choose a method of payment:</i></li></ul>
    	<table border=0 ><tr><td width = 200px></td>
    		<td>
    	<div id="cardbutton">
            <input type='image'  name='submit' src='/images/card.png' width="200px" />
		</div>
		</td><td width = 100px></td><td>
		<div id="bankbutton">
            <input type='image'  name='submit' src='/images/bank.png' width="200px" />
		</div>
		</td><td width = 200px></td></tr><tr><td colspan=5>
		<div id="card" class="pay">
			<br>
			<?php
            echo "<center><form action='pay_me.php' method=POST id='card'>";
            echo "<input type='hidden' value=".$priority." name='priority' />";
            echo "<input type='hidden' value=".$total." name='total' />";
            echo "<input type='hidden' value=".$iddiscount." name='iddiscount' /><li>";
            echo "<input type='hidden' value=".$discounted." name='discounted' /><li>";
            echo "Name : <input type='text' name='cardname' required='required'/></li>";
            echo '<br>';
            echo "<li>Card Number: <input type='text' name='cardnumber' maxlength='16' size='16' required='required'/></li>";
            echo '<br>';
			echo "<li>CCV: <input type='text' name='ccv' maxlength='3' size='3' required='required'/></li>";
            echo '<br>';
            echo "<li>Card Expiry Date:<input type='text' maxlength='2' size='2' name='dd' required='required'/> / <input type='text' maxlength='2' size='2' name='mm' required='required'/> / <input type='text' maxlength='2' size='2' name='yyyy' required='required'/></li>";
            echo '<br>';	
            echo "<li><input type=submit name=card value='Pay now' /></li>";
            echo "</form></center>";
            ?>
            <br>
		</div>
		
		<div id="bank" class="pay">
			<br>
			<?php
            echo "<center><form action='pay_me.php' method=POST id='bank'>";
            echo "<input type='hidden' value=".$priority." name='priority' />";
            echo "<input type='hidden' value=".$total." name='total' />";
            echo "<input type='hidden' value=".$iddiscount." name='iddiscount' /><li>";
            echo "<input type='hidden' value=".$discounted." name='discounted' /><li>";
            echo "Name : <input type='text' name='bankname' required='required'/></li>";
            echo '<br>';
            echo "<li>Bank Account: <input type='text' name='banknumber' maxlength='8' size='8' required='required'/></li>";
            echo '<br>';
			echo "<li>Sort Code: <input type='text' name='sortcode' maxlength='6' size='6' required='required'/></li>";
            echo '<br>';
            echo "<li><input type=submit name=bank value='Pay now' required='required'/></li>";
            echo "</form></center>";
            ?>
            <br>
		</div>
		</td></tr></table>
		

    </nav></body>
    <br>
   </body>

    
</html>
<script>
$(function() {
	$("#bank").hide(0);

    $("#cardbutton").on('click', function() {
        $("#bank").hide(1000);
        $("#card").show(1000);
    });
    $("#bankbutton").on('click', function() {
        $("#card").hide(1000);
        $("#bank").show(1000);
    });
});
</script>