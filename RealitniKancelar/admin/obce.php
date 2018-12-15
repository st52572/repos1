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
                <?php $page = htmlspecialchars('controllers/CObce.php'); ?>
                <div id='zmena-udaju'>
                    <form method='post' action='<?php echo $page; ?>'>
                        <h3>Přidat novou obec</h3>

                        <div class="row-uzivatele">
                            <label>Kraj</label>
                            <select id="kraj">
                            </select>
                        </div>
                        <div class="row-uzivatele">
                            <label>Okres</label>
                            <select name="okres" id="okres">

                            </select>
                        </div>  

                        <input type='hidden' name='add' value=1>
                        <div>
                            <label>Název: </label><input required type='text' name='nazev' value=''>
                            <button type='submit'>Přidat</button>
                        </div>    
                    </form>
                </div>
                <?php
                echo"<h3>Obce</h3>";
                echo"<div id='obce'></div>";
                ?>
            </div>
            <?php
            require_once '../footer.php';
            ?>
            <script>
                $(function () {
                    $.ajax({
                        url: '../controllers/CKraje.php',
                        type: 'POST',
                        error: function () {
                            Messenger().post({
                                message: 'Error',
                                type: 'error',
                                showCloseButton: true
                            });
                        },
                        success: function (data) {
                            var kraje = $.parseJSON(data);
                            for (var i = 0; i < kraje.length; i++) {
                                $('#kraj').append($('<option>', {value: kraje[i++], text: kraje[i]}));
                            }
                            getOkresy();
                        }

                    });
                });
                function getOkresy()
                {
                    var kraj = $('#kraj').val();
                    $.ajax({
                        url: '../controllers/COkresy.php',
                        type: 'POST',
                        data: {
                            kraj: kraj
                        },
                        error: function () {
                            Messenger().post({
                                message: 'Error',
                                type: 'error',
                                showCloseButton: true
                            });
                        },
                        success: function (data) {
                            $('#okres').empty();
                            var okresy = $.parseJSON(data);
                            for (var i = 0; i < okresy.length; i++) {
                                $('#okres').append($('<option>', {value: okresy[i++], text: okresy[i]}));
                            }
                            $('#okres option:first-child').attr("selected", "selected");
                            getData();
                        }

                    });

                }
                $(document).on('click', '.delete', function () {
                    var id = $(this).val();
                    var del = true;
                    $.ajax({
                        url: 'controllers/CObce.php',
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
                    var nazev = $('#input' + id).val();
                    var edit = true;
                    $.ajax({
                        url: 'controllers/CObce.php',
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
                function getData() {
                    var idOkres = $("#okres").val();
                    var select = true;
                    $('#obce').empty();
                    $.ajax({
                        url: 'controllers/CObce.php',
                        type: 'POST',
                        data: {
                            idOkres: idOkres,
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
                            $('#obce').append(html);
                        }

                    });
                }
                $("#okres").change(function () {
                    getData();
                });
                $("#kraj").change(function () {
                    getOkresy();
                });
            </script>
    </body>

</html>