<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    if(isset($_POST["add"])){
        $idNemovitost = $_POST["add"];
        CFotka::insertFotky($idNemovitost);
        header("Location: ../index.php?page=moje-galerie&id=$idNemovitost");
    }
    else if (isset($_POST["edit"])) {
        $id = $_POST["edit"];
        $idNemovitost = $_POST["idNemovitost"];
        $text = $_POST["text"];
        CFotka::updateFotka($id, $text);
        header("Location: ../index.php?page=moje-galerie&id=$idNemovitost");
    }
    else if (isset($_POST["del"])) {
        $id = $_POST["id"];
        CFotka::deleteFotka($id);
        header("Location: ../index.php?page=moje-galerie&id=$idNemovitost");
    }
}