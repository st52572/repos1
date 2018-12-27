<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $idZajemce = $_POST["zajemce"];
    $idNemovitost = $_POST["nemovitost"];
    CZajemci_Koupe::insertZajemciKoupe($idZajemce, $idNemovitost);
}

