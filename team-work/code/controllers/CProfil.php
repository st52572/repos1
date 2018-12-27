<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["id"] == $_SESSION["id"]) {
    require_once '../info/info.php';
    require_once 'test_input.php';
    $id = test_input($_POST["id"]);

    $heslo = test_input($_POST["heslo"]);
    $heslo2 = test_input($_POST["heslo2"]);
    $sheslo = test_input($_POST["sheslo"]);

    $db = DbInfo::getinfo();
    $select = CUzivatel::selectUzivatel($id);
    $prihlasovaci_jmeno = test_input($_POST["prihlasovaci_jmeno"]);
    $jmeno = test_input($_POST["jmeno"]);
    $prijmeni = test_input($_POST["prijmeni"]);
    $email = test_input($_POST["email"]);
    $telefon = test_input($_POST["telefon"]);
    if (password_verify($sheslo, $select->getHeslo()) && $heslo == $heslo2 && preg_match("/^[a-žA-Ž ]*$/", $jmeno) && preg_match("/^[a-žA-Ž ]*$/", $prijmeni) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($heslo) == 0) {
            $heslo = $sheslo;
        }


        $uzivatel = new Uzivatel($id, $prihlasovaci_jmeno, $heslo, $_SESSION["opravneni"], $jmeno, $prijmeni, $email, $telefon);
        CUzivatel::updateUzivatel($uzivatel);
    }
}
header("Location: ../index.php?page=profil");

