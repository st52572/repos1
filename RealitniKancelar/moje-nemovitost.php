<?php
session_start();
if (!isset($_SESSION["logged"])) {
    header("Location: http://localhost/realitnikancelar/nemovitosti.php");
}
$idUZ = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <title>Moje nemovitost</title>
    </head>
    <body>
        <div class="item1">
            <?php
            require_once 'info/info.php';
            require_once 'menu.php';
            ?>

        </div>
        <div class="item2">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $page = htmlspecialchars('controllers/CNemovitosti.php');
                ?>
                <div id="wrap">
                    <form action="<?php echo $page;?>" id="form" method="POST">

                        <?php
                        $nemovitost = CNemovitost::selectNemovitosti($id);
                        if (sizeof($nemovitost) > 0) {
                            $adresa = CAdresa::selectAdresa($nemovitost[0]->getId_obec());
                            $uzivatel = CUzivatel::selectUzivatele($nemovitost[0]->getId_uzivatel());
                            if ($uzivatel[0]->getId() != $_SESSION["id"]) {
                                header("Location: http://localhost/realitnikancelar/nemovitost.php?id=$id");
                            }
                            echo"<input id = 'idNemovitost' type = 'hidden' value = $id name ='edit'>
                        <div class='row'>
                            <label>Text</label><input name = 'text' type ='text' value = '" . $nemovitost[0]->getText() . "'>
                        </div>
                        <div class='row'>
                            <label>Popis</label><textarea name = 'popis' >" . $nemovitost[0]->getPopis() . "</textarea>
                        </div>
                        <div class='row'>
                            <label>Cena</label><input name='cena' type='text' value='" . $nemovitost[0]->getCena() . "'>
                        </div>
                        <input type='hidden' id='idKraj' value='" . $adresa->getKraj()->getId() . "'>
                        <input type='hidden' id='idOkres' value='" . $adresa->getOkres()->getId() . "'>
                        <input type='hidden' id='idObec' value='" . $adresa->getObec()->getId() . "'>
                        <div class='row'>
                        <label>Kraj</label>
                                <select id='kraj'>
                                </select>
                        </div>
                        <div class='row'>
                        <label>Okres</label>
                                <select id='okres'>

                                </select>
                        </div>
                        <div class='row'>
                        <label>Obec</label>
                                <select id='obec' name='obec'>

                                </select>
                        </div>        
                        ";
                        } else {
                            header("Location: http://localhost/realitnikancelar/nemovitosti.php");
                        }
                        ?>

                        <div class="row">
                            <button type="submit" id="submit-btn" >Upravit</button>
                            <?php echo "<a href='moje-galerie.php?id=$id'>Galerie</a>"; ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    } else {
        header("Location: http://localhost/realitnikancelar/nemovitosti.php");
    }
    require_once 'footer.php';
    ?>

    <script>
        $(function () {
            getKraje();

        });

        $("#form").submit(function () {
            var formData = new FormData($("#form")[0]);
            formData.append('edit', true);
            $.ajax({
                url: 'controllers/CNemovitosti.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    Messenger().post({
                        message: 'Chyba- data nahrána',
                        type: 'error',
                        showCloseButton: true
                    });
                },
                success: function () {
                    location.reload();
                }
            });
        });
        function getKraje() {

            var idKraj = $("#idKraj").val();
            $.ajax({
                url: 'controllers/CKraje.php',
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
                    $('#kraj option[value=' + idKraj + ']').attr('selected', 'selected');
                    getOkresy();

                }

            });
        }
        function getOkresy()
        {
            var kraj = $('#kraj').val();
            var idOkres = $('#idOkres').val();
            $.ajax({
                url: 'controllers/COkresy.php',
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
                    $('#okres option[value=' + idOkres + ']').attr('selected', 'selected');
                    getObce();
                }

            });
        }
        function getObce()
        {
            var okres = $('#okres').val();
            var idObec = $('#idObec').val();
            $.ajax({
                url: 'controllers/CObce.php',
                type: 'POST',
                data: {
                    okres: okres
                },
                error: function () {
                    Messenger().post({
                        message: 'Error',
                        type: 'error',
                        showCloseButton: true
                    });
                },
                success: function (data) {
                    $('#obec').empty();
                    var obce = $.parseJSON(data);
                    for (var i = 0; i < obce.length; i++) {
                        $('#obec').append($('<option>', {value: obce[i++], text: obce[i]}));
                    }
                    $('#obec option[value=' + idObec + ']').attr('selected', 'selected');
                }


            });
        }
        $("#kraj").change(function () {
            getOkresy();
        });
        $("#okres").change(function () {
            getObce();
        });
    </script>
</body>


</html>
