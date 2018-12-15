<?php
session_start();
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <title>Nemovitosti</title>
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
                <h2>Nemovitosti</h2>
                <?php
                $nemovitosti = CNemovitost::selectNemovitosti();

                $index = 0;
                
                if (sizeof($nemovitosti) > 0) {
                    foreach ($nemovitosti as $nemovitost) {
                        $fotka = CFotka::selectFotka($nemovitost->getId());
                        $adresa = CAdresa::selectAdresa($nemovitost->getId_obec());
                        $vlastnik = NULL;
                        if(isset($_SESSION['id']) && $_SESSION["id"] == $nemovitost->getId_uzivatel()){
                            $vlastnik = "(Vaše nemovitost)";
                        }
                        
                        echo"<div class='seznam-piece'>";
                        echo"<h3 id='text$index'>" . $nemovitost->getText() . " $vlastnik</h3>";
                        echo"<p id='cena$index'>Cena: " . $nemovitost->getCena() . "</p>";
                        echo"<p id='cena$index'>Adresa: " . $adresa->getKraj()->getNazev() . " - " . $adresa->getOkres()->getNazev() . " - " . $adresa->getObec()->getNazev() . "</p>";
                        echo"<div class='popis'>";
                        if ($fotka != NULL) {

                            echo"<img id='fotka$index' src=" . $fotka->getNazev() . " alt='fotka'>";
                        } else {
                            echo"<p>Není k dispozici</p>";
                        }
                        echo"<p id='popis$index'>Popis: " . $nemovitost->getPopis() . "</p>";
                        echo"</div>";
                        echo"<div class='link'>";
                        echo"<a id='link$index' href='nemovitost.php?id=" . $nemovitost->getId() . "' >Více</a>";
                        echo"<a href='controllers/toJson.php?text=" . $nemovitost->getText() . "&cena=" . $nemovitost->getCena() . "&kraj=" . $adresa->getKraj()->getNazev() . "&okres=" . $adresa->getOkres()->getNazev() . "&obec=" . $adresa->getObec()->getNazev() . "&popis=" . $nemovitost->getPopis() . "&id_okres=" . $adresa->getObec()->getId() . "&id_uzivatel=" . $nemovitost->getId_uzivatel() . "' >Stáhnout JSON</a>";
                        echo"</div>";
                        echo"</div>";
                        $index++;
                    }
                }else{
                    echo "<div class='seznam-piece'><p>Žádné nemovitosti</p></div>";
                }
                ?>
            </div>
        </div>
        <?php
        require_once 'footer.php';
        ?>
        
    </body>

</html>