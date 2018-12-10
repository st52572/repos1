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
    $select = CUzivatel::selectUzivatele($id);
    if (password_verify($sheslo, $select[0]->getHeslo()) && $heslo == $heslo2) {
        if (strlen($heslo) == 0) {
            $heslo = $sheslo;
        }
        $prihlasovaci_jmeno = test_input($_POST["prihlasovaci_jmeno"]);
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
        $uzivatel = new Uzivatel($id, $prihlasovaci_jmeno, $heslo, $_SESSION["opravneni"], $jmeno, $prijmeni, $email, $telefon);
        CUzivatel::updateUzivatel($uzivatel);
    }
    
}
header("Location: http://localhost/realitnikancelar/profil.php");

