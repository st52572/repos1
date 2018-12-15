<?php
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
}
?>

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