<?php

header('Content-disposition: attachment; filename=file.json');
header('Content-type: application/json');

$jsonArray = array("id" => NULL, "text" => $_GET["text"], "popis" => $_GET["popis"], "id_okres" => $_GET["id_okres"], "cena" => $_GET["cena"], "kraj" => $_GET["kraj"], "okres" => $_GET["okres"], "obec" => $_GET["obec"], "id_uzivatel" => $_GET["id_uzivatel"]);
$json = json_encode($jsonArray);
echo $json;

