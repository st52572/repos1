<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $prihlasovaci_jmeno = $_POST["prihlasovaci_jmeno"];
    $heslo = $_POST["heslo"];
    $db = DbInfo::getinfo();
    $uzivatel = CUzivatel::selectUzivatel(NULL, $prihlasovaci_jmeno);
    if (password_verify($heslo, $uzivatel->getHeslo())) {
        $_SESSION["id"] = $uzivatel->getId();
        $_SESSION["logged"] = TRUE;
        $_SESSION["opravneni"] = $uzivatel->getOpravneni();
    }
    
    header("Location: ../index.php");
}