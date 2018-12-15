<?php
if (!isset($_SESSION["logged"])) {
    header("Location: nemovitosti.php");
}
$adresa = htmlspecialchars('controllers/CFotky.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $fotky = CFotka::selectFotky($id);
    $nemovitost = CNemovitost::selectNemovitosti($id, $_SESSION["id"]);
    if ($nemovitost == NULL) {
        header("Location: ?page=nemovitost&id=$id");
    }
    ?>
    <div class="item2">
        <div>
            <form action="<?php echo $adresa; ?>" id="form" method="post" enctype="multipart/form-data">
                <input name='add' type='hidden' value='<?php echo $id; ?>' >
                <h2>Nové fotky</h2><input name="fileToUpload[]" type="file" multiple/>
                <button id="submit-btn" type="submit">Přidat</button>
            </form>
        </div>
        <?php
        if ($fotky != NULL) {
            $count = sizeof($fotky);
            $pocet = 1;
            echo "<h2>Fotky</h2>";
            foreach ($fotky as $fotka) {
                if ($pocet == 1 || $pocet == round($count / 2) + 1) {
                    echo "<div class='col-6'>";
                }
                echo "<form action='$adresa' class='form' method='POST' enctype='multipart/form-data'>";

                echo "<input name='idNemovitost' type='hidden' value=$id >";
                echo "<input name='edit' type='hidden' value='" . $fotka->getId() . "' >";


                echo "<div class='seznam-piece galerie'>";
                echo "<img src='" . $fotka->getNazev() . "'>";
                echo "<label>Text</label><input name='text' type='text' value='" . $fotka->getText() . "' >";
                echo "<button type='submit' class='update-btn' >Upravit</button>";
                echo "<button value='" . $fotka->getId() . "' class='delete delete-btn' >Delete</button>";
                echo "</div>";
                echo "</form>";
                if ($pocet == round($count / 2)) {
                    echo "</div>";
                }
                $pocet++;
            }
            echo "</div>";
        }
        ?>
    </div>
    <?php
} else {
    header("Location: ?page=nemovitosti");
}
?>
</div>
<style>
    * {
        box-sizing: border-box;
    }
</style>
<script>
    $(".delete-btn").click(function () {
        var id = $(this).val();
        var del = true;
        $.ajax({
            url: 'controllers/CFotky.php',
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