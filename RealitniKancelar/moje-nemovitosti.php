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
        <title>Moje nemovitosti</title>
    </head>
    <body>
        <div class="item1">
            <?php
            require_once 'info/info.php';
            require_once 'menu.php';
            ?>

        </div>
        <div class="item2">
            <div id="seznam">
                <h2>Moje nemovitosti</h2>
                <?php
                $nemovitosti = CNemovitost::selectNemovitosti(NULL, $idUZ);
                if (sizeof($nemovitosti) > 0) {
                    //echo "filtr <input type='text' id='filter'>";
                    $index = 0;
                    foreach ($nemovitosti as $nemovitost) {
                        $fotka = CFotka::selectFotka($nemovitost->getId());
                        $adresa = CAdresa::selectAdresa($nemovitost->getId_obec());

                        echo"<div class='seznam-piece'>";
                            echo"<h3 id='text$index'>" . $nemovitost->getText() . "</h3>";
                            echo"<p id='cena$index'>Cena: " . $nemovitost->getCena() . "</p>";
                            echo"<p id='cena$index'>Adresa: " . $adresa->getKraj()->getNazev() . " - ".$adresa->getOkres()->getNazev()." - ".$adresa->getObec()->getNazev()."</p>";
                        echo"<div class='popis'>";
                            if ($fotka != NULL) {
                                echo"<img id='fotka$index' src=" . $fotka->getNazev() . " alt='fotka'>";
                            } else {
                                echo"<p>Není k dispozici</p>";
                            }
                            echo"<p id='popis$index'>Popis: " . $nemovitost->getPopis() . "</p>";
                        echo"</div>";
                        echo"<div class='link'>";
                            echo"<a id='link$index' href='moje-nemovitost.php?id=" . $nemovitost->getId() . "' >Upravit</a>";
                            echo"<button class='delete' value='" . $nemovitost->getId() . "'>Smazat</button>";
                        echo"</div>";
                        echo"</div>";
                        $index++;
                    }
                }else{
                    echo "<div class='seznam-piece'><p>Nemáš žádné nemovitosti</p></div>";
                }
                ?>
            </div>
        </div>
        <?php
        require_once 'footer.php';
        ?>
        <script>
            $("#filter").change(function () {
                var filtr = $("#filter").val();
                $.ajax({
                    url: 'controllers/CFiltrNemovitost.php',
                    type: 'POST',
                    data: {
                        filtr: filtr
                    },
                    error: function () {
                        Messenger().post({
                            message: 'Error',
                            type: 'error',
                            showCloseButton: true
                        });
                    },
                    success: function (data) {
                        /*var myArr = $.parseJSON(data);
                         alert(myArr[0]);*/
                    }

                });
            });
            $(".delete").click(function () {
                var id = $(this).val();
                var del = true;
                $.ajax({
                    url: 'controllers/CNemovitosti.php',
                    type: 'POST',
                    data: {
                        id: id,
                        del: del
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