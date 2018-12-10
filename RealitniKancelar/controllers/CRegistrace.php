<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    require_once 'test_input.php';
    $prihlasovaci_jmeno = test_input($_POST["prihlasovaci_jmeno"]);
    $heslo = test_input($_POST["heslo"]);
    $heslo2 = test_input($_POST["heslo2"]);
    if ($heslo != $heslo2) {


        $jmeno = test_input($_POST["jmeno"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $jmeno)) {
            
        }
        $prijmeni = test_input($_POST["prijmeni"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $prijmeni)) {
            
        }
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
        }
        $telefon = test_input($_POST["telefon"]);
        $uzivatel = new Uzivatel(NULL, $prihlasovaci_jmeno, $heslo, 3, $jmeno, $prijmeni, $email, $telefon);
        CUzivatel::insertUzivatel($uzivatel);
    }
}

