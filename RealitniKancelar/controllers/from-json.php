<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $jsondata = file_get_contents($_FILES["file"]["tmp_name"]);
    $obj = json_decode($jsondata, true);
    print_r($obj);
    $nemovitost = new Nemovitost(NULL, $obj["text"], $obj["popis"], $obj["cena"], $obj["id_okres"], $_SESSION["id"]);
    CNemovitost::insertNemovitost($nemovitost);
    header("Location: ../index.php?page=moje-nemovitosti");
}

