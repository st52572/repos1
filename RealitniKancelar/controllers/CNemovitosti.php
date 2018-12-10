<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    if (isset($_POST["edit"])) {
        $id = $_POST["edit"];
        $text = $_POST["text"];
        $popis = $_POST["popis"];
        $cena = $_POST["cena"];
        $id_obec = $_POST["obec"];
        $nemovitost = new Nemovitost($id, $text, $popis, $cena, $id_obec, NULL);
        CNemovitost::updateNemovitost($nemovitost);
        header("Location: http://localhost/realitnikancelar/moje-nemovitost.php?id=$id");
    } else if (isset($_POST["del"])) {
        $id = $_POST["id"];
        CNemovitost::deleteNemovitost($id);
    } else if (isset($_POST["add"])) {
        $id_uzivatel = $_POST["idUz"];
        $text = $_POST["text"];
        $popis = $_POST["popis"];
        $cena = $_POST["cena"];
        $id_obec = $_POST["obec"];
        $nemovitost = new Nemovitost(NULL, $text, $popis, $cena, $id_obec, $id_uzivatel);
        CNemovitost::insertNemovitost($nemovitost);
        $nem = CNemovitost::selectNemovitosti(NULL, NULL, "WHERE `id_uzivatel` =$id_uzivatel and `text` = '$text' ORDER BY `id` DESC LIMIT 1");
        CFotka::insertFotky($nem[0]->getId());
    }
}
    