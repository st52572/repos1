<div class="item2">
    <div id="nemovitost" class="col-6">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET["id"];
            $nemovitost = CNemovitost::selectNemovitost($id);
            $adresa = CAdresa::selectAdresa($nemovitost->getId_obec());
            $uzivatel = CUzivatel::selectUzivatel($nemovitost->getId_uzivatel());
            $fotky = CFotka::selectFotky($id);
            ?>
            <h2><?php echo $nemovitost->getText() ?></h2>
            <p>Lokace: <?php
                echo $adresa->getKraj()->getNazev();
                echo ", " . $adresa->getOkres()->getNazev();
                echo ", " . $adresa->getObec()->getNazev();
                ?></p>
            <p>Popis: <?php echo $nemovitost->getPopis() ?></p>
            <p>CENA: <?php echo $nemovitost->getCena() ?> Kč</p>
            <p>Kontakt: <?php
                echo $uzivatel->getJmeno();
                echo ', ' . $uzivatel->getPrijmeni();
                echo ', ' . $uzivatel->getEmail();
                echo ', ' . $uzivatel->getTelefon();
                ?></p>
            <?php
            if (!isset($_SESSION["id"])) {
                echo "<p class='dalsi-info'>Pro vytvoření nabídky se přihlaš!</p>";
            } else {
                $idZajemce = $_SESSION['id'];
                if (isset($_SESSION["logged"]) && $uzivatel->getId() != $_SESSION["id"]) {
                    echo "<input class='dalsi-info' type='hidden' value='$idZajemce' id='zajemce'>";
                    echo "<button class='dalsi-info' value='" . $nemovitost->getId() . "' id='nabidka'>Udělat nabídku</button>";
                } else if ($uzivatel->getId() == $_SESSION["id"]) {
                    echo "<p class='dalsi-info'>Vaše nemovitost</p>";
                }
            }
            ?>
            <?php
        } else {
            header("Location: index.php");
        }
        ?>
    </div>
    <div id="galerie" class="col-6">
        <div class="row1">
            <?php
            if ($fotky != NULL) {
                foreach ($fotky as $fotka) {
                    echo "<div class = 'column'>
                            <img alt='" . $fotka->getText() . "' src = '" . $fotka->getNazev() . "' onclick = 'myFunction(this);'>
                        </div>";
                }
            } else {
                echo "<div class = 'column'>
                            <p>Žádné fotky k dispozici</p>
                        </div>";
            }
            ?>
        </div>

        <!-- The expanding image container -->
        <div class="container">
            <!-- Close the image -->
            <span onclick="this.parentElement.style.display = 'none'" class="closebtn">&times;</span>

            <!-- Expanded image -->
            <img id="expandedImg" src="img/noimage.jpg" alt="fotka">

            <!-- Image text -->
            <div id="imgtext"></div>
        </div>
    </div>
</div>
<style>
    * {
        box-sizing: border-box;
    }
</style>
<script>
    function myFunction(imgs) {
        // Get the expanded image
        var expandImg = document.getElementById("expandedImg");
        // Get the image text
        var imgText = document.getElementById("imgtext");
        // Use the same src in the expanded image as the image being clicked on from the grid
        expandImg.src = imgs.src;
        // Use the value of the alt attribute of the clickable image as text inside the expanded image
        imgText.innerHTML = imgs.alt;
        // Show the container element (hidden with CSS)
        expandImg.parentElement.style.display = "block";
    }
    $("#nabidka").click(function () {
        var idNemovitost = $(this).attr('value');
        var idZajemce = $('#zajemce').attr('value');
        $.ajax({
            url: 'controllers/CNabidka.php',
            type: 'POST',
            data: {
                nemovitost: idNemovitost,
                zajemce: idZajemce
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
