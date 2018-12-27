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
                $page = htmlspecialchars('controllers/COkresy.php');
                $options ="";
                foreach ($select as $kraj) {
                    $options.="<option value='".$kraj->getId()."'>".$kraj->getNazev()."</option>";
                }
                echo"<div id='zmena-udaju'>
                    <h3>Přidat nový okres</h3>
                    <form method='post' action='$page'>
                        <select id='kraje' name='kraj'>
                            $options
                        </select>
                        <input type='hidden' name='add' value=1>
                        <div>
                            <label>Název: </label><input required type='text' name='nazev' value=''>
                            <button type='submit'>Přidat</button>
                        </div>    
                    </form>
                </div>";
                echo"<h3>Okresy</h3>";
                echo"<div id='okresy'></div>";            
                ?>
            </div>
            <?php
            require_once '../footer.php';
            ?>
            <script>
                $(document).on('click', '.delete', function () {
                    var id = $(this).val();
                    var del = true;
                    $.ajax({
                        url: 'controllers/COkresy.php',
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
                            getData();
                        }

                    });
                });
                $(document).on('click', '.edit', function () {
                    var id = $(this).val();
                    var nazev = $('#input'+id).val();
                    var edit = true;
                    $.ajax({
                        url: 'controllers/COkresy.php',
                        type: 'POST',
                        data: {
                            id: id,
                            nazev: nazev,
                            edit: edit
                        },
                        error: function () {
                            Messenger().post({
                                message: 'Error',
                                type: 'error',
                                showCloseButton: true
                            });
                        },
                        success: function () {
                            getData();
                        }

                    });
                });
                function getData(){
                    var id = $("#kraje").val();
                    var select = true;
                    $('#okresy').empty();
                    $.ajax({
                        url: 'controllers/COkresy.php',
                        type: 'POST',
                        data: {
                            id: id,
                            select: select
                        },
                        error: function () {
                            Messenger().post({
                                message: 'Error',
                                type: 'error',
                                showCloseButton: true
                            });
                        },
                        success: function (html) {
                            $('#okresy').append(html);
                        }

                    });
                }
                $("#kraje").change(function () {
                    getData();
                });
                
            </script>
    </body>

</html>