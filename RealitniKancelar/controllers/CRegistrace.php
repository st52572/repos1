<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    require_once 'test_input.php';
    $prihlasovaci_jmeno = test_input($_POST["prihlasovaci_jmeno"]);
    $heslo = test_input($_POST["heslo"]);
    $heslo2 = test_input($_POST["heslo2"]);
    $jmeno = test_input($_POST["jmeno"]);
    $prijmeni = test_input($_POST["prijmeni"]);
    $email = test_input($_POST["email"]);
    $telefon = test_input($_POST["telefon"]);
    if ($heslo == $heslo2 && preg_match("/^[a-žA-Ž ]*$/", $jmeno) && preg_match("/^[a-žA-Ž ]*$/", $prijmeni) && filter_var($email, FILTER_VALIDATE_EMAIL)) {


        $uzivatel = new Uzivatel(NULL, $prihlasovaci_jmeno, $heslo, 3, $jmeno, $prijmeni, $email, $telefon);
        CUzivatel::insertUzivatel($uzivatel);
    }
    header("Location: ../index.php");
}

