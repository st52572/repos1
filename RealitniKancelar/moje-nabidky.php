<?php
session_start();
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
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
        <title>Moje nabidky</title>
    </head>
    <body>
    <body>
        <div class="item1">
            <?php
            require_once 'info/info.php';
            require_once 'menu.php';
            ?>

        </div>
        <div class="item2">
            <div id="nabidky">
                <h2>Moje nabídky</h2>
                <?php
                $zajemci_koupe = CZajemci_Koupe::selectZajemciKoupe($_SESSION["id"], NULL);
                if (sizeof($zajemci_koupe) > 0) {
                    foreach ($zajemci_koupe as $row) {
                        $nemovitost = $row->getNemovitost();
                        $uzivatel = $row->getUzivatel();
                        $idZK = $row->getId();
                        $potvrzeno;
                        if ($row->getPotvrzeno() == 0) {
                            $potvrzeno = "zamítnuto";
                        } else if ($row->getPotvrzeno() == 1) {
                            $potvrzeno = "potvrzeno";
                            echo "<div class='row'>";
                            echo "<p>";
                            echo $nemovitost->getText() . " - ";
                            echo $potvrzeno . " - ";
                            echo $uzivatel->getJmeno() . " - ";
                            echo $uzivatel->getPrijmeni() . " - ";
                            echo $uzivatel->getEmail() . " - ";
                            echo $uzivatel->getTelefon();
                            echo "</p>";
                            echo "</div>";
                        } else if ($row->getPotvrzeno() == 2) {
                            $potvrzeno = "Čekání na potvrzení";
                            echo "<div class='row'>";
                            echo "<p>";
                            echo $nemovitost->getText() . " - ";
                            echo $potvrzeno . " - ";
                            echo $uzivatel->getJmeno() . " - ";
                            echo $uzivatel->getPrijmeni() . " - ";
                            echo $uzivatel->getEmail() . " - ";
                            echo $uzivatel->getTelefon();
                            echo "</p>";
                            echo "<button class='potvrdit' value='$idZK'>Potvrdit</button>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<div class='row'><p>Nemáte žádné nabídky na nemovitosti</p></div>";
                }
                ?>
            </div>
        </div>
        <?php
        require_once 'footer.php';
        ?>
        <script>
            $(".potvrdit").click(function () {
                var idZK = $(this).attr('value');
                $.ajax({
                    url: 'controllers/CMoje-Nabidky.php',
                    type: 'POST',
                    data: {
                        idZK: idZK
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