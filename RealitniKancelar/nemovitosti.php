
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
                        echo"<a id='link$index' href='?page=nemovitost&id=" . $nemovitost->getId() . "' >Více</a>";
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
