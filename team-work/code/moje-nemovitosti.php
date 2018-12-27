<?php
if (!isset($_SESSION["logged"])) {
    header("Location: nemovitosti.php");
}
$idUZ = $_SESSION["id"];
?>
        <div class="item2">
            <div id="seznam">
                <h2>Moje nemovitosti</h2>
                <?php
                $nemovitosti = CNemovitost::selectNemovitosti(NULL, $idUZ);
                if (sizeof($nemovitosti) > 0) {
                    
                    $index = 0;
                    foreach ($nemovitosti as $nemovitost) {
                        $fotka = CFotka::selectFotka($nemovitost->getId());
                        $adresa = CAdresa::selectAdresa($nemovitost->getId_obec());

                        echo"<div class='seznam-piece'>";
                            echo"<h3 id='text$index'>" . $nemovitost->getText() . "</h3>";
                            echo"<p id='cena$index'>Cena: " . $nemovitost->getCena() . "</p>";
                            echo"<p id='cena$index'>Adresa: " . $adresa->getKraj()->getNazev() . " - ".$adresa->getOkres()->getNazev()." - ".$adresa->getObec()->getNazev()."</p>";
                        echo"<div class='popis'>";
                            if ($fotka->getId() != NULL) {
                                echo"<img id='fotka$index' src=" . $fotka->getNazev() . " alt='fotka'>";
                            } else {
                                 echo"<img id='fotka$index' src='img/noimage.jpg' alt='fotka'>";
                            }
                            echo"<p id='popis$index'>Popis: " . $nemovitost->getPopis() . "</p>";
                        echo"</div>";
                        echo"<div class='link'>";
                            echo"<a id='link$index' href='?page=moje-nemovitost&id=" . $nemovitost->getId() . "' >Upravit</a>";
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
        <script>
            
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
