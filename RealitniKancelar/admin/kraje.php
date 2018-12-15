<?php
session_start();
if (!isset($_SESSION["logged"]) && $_SESSION["opravneni"] != 1) {
    header("Location: http://localhost/realitnikancelar/index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        <title></title>
    </head>
    <body>
        <div class="grid-container">
            <div class="item1" id="myTopnav">
                <?php
                require_once 'info/info.php';
                require_once 'menu.php';
                ?>
            </div>
            <div class="item2">

                <?php
                $select = CKraj::selectKraje();
                $page = htmlspecialchars('controllers/CKraje.php');
                echo"<div id='zmena-udaju'>
                    <h3>Přidat nový kraj</h3>
                    <form method='post' action='$page'>
                        <input type='hidden' name='add' value=1>
                        <div>
                            <label>Název: </label><input required type='text' name='nazev' value=''>
                            <button type='submit'>Přidat</button>
                        </div>    
                    </form>
                </div>";
                echo"<h3>Kraje</h3>";
                foreach ($select as $kraj) {
                    echo "<div id='zmena-udaju'>
            <form method='post' action='$page'>
            <input type='hidden' name='id' value=" . $kraj->getId() . ">
                <div>
                    <label>Název: </label><input required type='text' name='nazev' value='" . $kraj->getNazev() . "'>
                    <button type='submit'>Změnit</button>
                    <button class='delete' value='" . $kraj->getId() . "'>Smazat</button>
                </div>        
            
        </form></div>";
                }
                ?>
            </div>
            <?php
            require_once '../footer.php';
            ?>
            <script>
                $(".delete").click(function () {
                    var id = $(this).val();
                    var del = true;
                    $.ajax({
                        url: 'controllers/CKraje.php',
                        type: 'POST',
                        data: {
                            id: id,
                            delete: del
                        },
                        error: function () {
                            Messenger().post({
                                message: 'Error',
                                type: 'error',
                                showCloseButton: true
                            });
                        },
                        success: function () {
                            location.reload();
                        }

                    });
                });
            </script>
    </body>

</html>