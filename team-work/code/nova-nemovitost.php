<?php
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
}
$idUZ = $_SESSION["id"];
?>

<div class="item2" id="nova-nemovitost">
    <h2>Nová nemovitost</h2>
    <form id="form-json-from" method="post" enctype="multipart/form-data" action="controllers/from-json.php">
        <label>Nemovitost z JSON</label>
        <input type='file' name='file' />
        <button type="submit">Přidat</button>
    </form>
    <form id="form" method="post" enctype="multipart/form-data">
        <div class='uzivatele'>
            <input type="hidden" value="<?php echo $idUZ; ?>" name="idUz">
            <div class="row-uzivatele">
                <label>Text</label><input required type="text" name="text">
            </div>

            <div class="row-uzivatele">
                <label>Cena</label><input required type="number" name="cena">
            </div>
            <div class="row-uzivatele">
                <label>Fotografie</label><input name="fileToUpload[]" type="file" multiple/>
            </div>
            <div class="row-uzivatele">
                <label>Popis</label><textarea required name="popis"></textarea>
            </div>
            <div class="row-uzivatele">
                <label>Kraj</label>
                <select id="kraj">
                </select>
            </div>
            <div class="row-uzivatele">
                <label>Okres</label>
                <select id="okres">

                </select>
            </div>  
            <div class="row-uzivatele">
                <label>Obec</label>
                <select id="obec" name="obec">

                </select>
            </div>     

            <button id="submit-btn" type="submit">Přidat</button>
        </div>
    </form>
</div>
<style>
    * {
        box-sizing: border-box;
    }
</style>
<script>
    $(function () {
        $.ajax({
            url: 'controllers/CKraje.php',
            type: 'POST',
            error: function () {
                Messenger().post({
                    message: 'Error',
                    type: 'error',
                    showCloseButton: true
                });
            },
            success: function (data) {
                var kraje = $.parseJSON(data);
                for (var i = 0; i < kraje.length; i++) {
                    $('#kraj').append($('<option>', {value: kraje[i++], text: kraje[i]}));
                }
                getOkresy();
            }

        });
    });
    $("#form").submit(function () {
        var formData = new FormData($(this)[0]);
        formData.append('add', true);
        $.ajax({
            url: 'controllers/CNemovitosti.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            error: function () {
                Messenger().post({
                    message: 'Chyba- data nahrána',
                    type: 'error',
                    showCloseButton: true
                });
            },
            success: function () {
                location.reload();
            }
        });
    });
    function getOkresy()
    {
        var kraj = $('#kraj').val();
        $.ajax({
            url: 'controllers/COkresy.php',
            type: 'POST',
            data: {
                kraj: kraj
            },
            error: function () {
                Messenger().post({
                    message: 'Error',
                    type: 'error',
                    showCloseButton: true
                });
            },
            success: function (data) {
                $('#okres').empty();
                var okresy = $.parseJSON(data);
                for (var i = 0; i < okresy.length; i++) {
                    $('#okres').append($('<option>', {value: okresy[i++], text: okresy[i]}));
                }
                $('#okres option:first-child').attr("selected", "selected");
                getObce();
            }

        });
    }
    function getObce()
    {
        var okres = $('#okres').val();
        $.ajax({
            url: 'controllers/CObce.php',
            type: 'POST',
            data: {
                okres: okres
            },
            error: function () {
                Messenger().post({
                    message: 'Error',
                    type: 'error',
                    showCloseButton: true
                });
            },
            success: function (data) {
                $('#obec').empty();
                var obce = $.parseJSON(data);
                for (var i = 0; i < obce.length; i++) {
                    $('#obec').append($('<option>', {value: obce[i++], text: obce[i]}));
                }
            }


        });
    }
    $("#kraj").change(function () {
        getOkresy();
    });
    $("#okres").change(function () {
        getObce();
    });
</script>