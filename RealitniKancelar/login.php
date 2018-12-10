<?php
require_once 'controllers/CLogin.php';
require_once 'info/info.php';
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <title>Login</title>
    </head>
    <body>
        <div class="grid-container">
            <div class="item1">
                <?php
                require_once 'menu.php';
                ?>

            </div>
            <div class="item2">

                <div id="login">
                    <h2>Login</h2>
                    <?php
                    if (isset($_SESSION["logged"])) {
                        echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
                    } else {
                        $login = htmlspecialchars('controllers/CLogin.php');
                        echo "<form method='post' action='$login'>
                            <div class='row'>
                                <label>Přihlašovací jméno</label><input required type='text' name='prihlasovaci_jmeno'>
                            </div>  
                            <div class='row'>  
                                <label>Heslo</label><input required type='password' name='heslo'>
                            </div>  
                                <button type='submit'>Přihlásit</button>
                            </form>";
                    }
                    ?>
                </div>
            </div>
            <?php
            require_once 'footer.php';
            ?>
        </div>


    </body>

</html>
