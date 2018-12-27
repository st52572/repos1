<?php
require_once 'controllers/CLogin.php';
require_once 'info/info.php';   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require_once 'info/info.php';
        ?>
        <?php
        if (isset($_SESSION["logged"])) {
            echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
        } else {
            $login = htmlspecialchars('controllers/CLogin.php');
            echo "<form method='post' action='$login'>
            prihlasovaci_jmeno<input required type='text' name='prihlasovaci_jmeno'>
            heslo<input required type='password' name='heslo'>
            <button type='submit'>Přihlásit</button>
        </form>";
        }
        ?>
    </body>

</html>