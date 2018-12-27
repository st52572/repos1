<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $filtr = $_POST["filtr"];
    $nemovitosti = CNemovitost::selectNemovitostiArray($filtr);
    echo json_encode($nemovitosti);
}