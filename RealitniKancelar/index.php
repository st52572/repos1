<?php
session_start();
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <title>Index</title>
    </head>
    <body>
        <div class="grid-container">
            <div class="item1" id="myTopnav">
                <?php
                require_once 'info/info.php';
                require_once 'menu.php';
                ?>
            </div>
            <div class='item2 main-img'>
                <img src='img/dum.jpg' alt='dum'>
            </div>

            <?php
            require_once 'footer.php';
            ?>
        </div>
    </body>

</html>
