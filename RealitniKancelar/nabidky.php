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
        <title>Nabidky</title>
    </head>
    <body>
        <div class="item1">
            <?php
            require_once 'info/info.php';
            require_once 'menu.php';
            ?>

        </div>
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
        <?php
        require_once 'footer.php';
        ?>
    </body>
</html>