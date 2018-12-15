<?php
session_start();
$page = "index";
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <?php echo"<title>$page</title>";?>
    </head>
    <body>
        <div class="grid-container">
            <div class="item1" id="myTopnav">
                <?php
                require_once 'info/info.php';
                require_once 'menu.php';
                ?>
            </div>
            <?php
            if (isset($_GET["page"])) {
                $file = "./" . $_GET["page"] . ".php";
                if (file_exists($file)) {
                    include $file;
                }
            } else {
                echo "<div class='item2 main-img'>
                        <img src='img/dum.jpg' alt='dum'>
                    </div>";
            }
            ?>
            <?php
            require_once 'footer.php';
            ?>
        </div>
    </body>

</html>
