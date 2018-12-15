<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["opravneni"] == 1) {
    require_once '../info/info.php';
    require_once '../../controllers/test_input.php';
    if (isset($_POST["add"])) {
        $nazev = test_input($_POST["nazev"]);
        $kraj = new Kraj(NULL, $nazev, "KOD");
        CKraj::insertKraj($kraj);
        
    } else if (isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);
        CKraj::deleteKraj($id);
        
    } else {
        $id = test_input($_POST["id"]);
        $nazev = test_input($_POST["nazev"]);
        $kraj = new Kraj($id, $nazev, "KOD");
        CKraj::updateKraj($kraj);
    }
}
header("Location: ../kraje.php");
