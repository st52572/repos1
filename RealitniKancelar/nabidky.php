<?php
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
}
?>
<div class="item2">
    <div id="nabidky">
        <h2>Podané nabídky</h2>
        <?php
        $zajemci_koupe = CZajemci_Koupe::selectZajemciKoupe(NULL, $_SESSION["id"]);
        if (sizeof($zajemci_koupe) > 0) {
            foreach ($zajemci_koupe as $row) {
                $nemovitost = $row->getNemovitost();
                $potvrzeno;
                if ($row->getPotvrzeno() == 0) {
                    $potvrzeno = "zamítnuto";
                } else if ($row->getPotvrzeno() == 1) {
                    $potvrzeno = "potvrzeno";
                } else if ($row->getPotvrzeno() == 2) {
                    $potvrzeno = "Čekání na potvrzení";
                }
                echo "<div class='row'>";
                echo "<p>";
                echo $nemovitost->getText() . " - ";
                echo $nemovitost->getCena() . " - ";
                echo $potvrzeno;
                echo "</p>";
                echo "</div>";
            }
        } else {
            echo "<div class='row'><p>Nepodal jste zatím žádnou nabídku</p></div>";
        }
        ?>

    </div>
</div>
