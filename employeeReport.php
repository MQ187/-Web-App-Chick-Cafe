<!DOCTYPE html>
    <head>
        <title>Employee Report | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
         require_once('nav/employeeDash.php');
         ?>
    </header>
        <nav>
            <ul>
                <li><i>Individual Report</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Breakfast Count</th><th>Lunch Count</th><th>Dinner Count</th><th>Breakfast Min</th><th>Breakfast Max</th><th>Lunch Min</th><th>Lunch Max</th><th>Dinner Min</th><th>Dinner Max</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            session_start();
                            
                           
                        ?>
                        </table>
                </li>  
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>