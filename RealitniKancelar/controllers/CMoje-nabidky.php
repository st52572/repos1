<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $idZK= $_POST["idZK"];
    CZajemci_Koupe::updateZajemciKoupe($idZK);
}
