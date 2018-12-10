<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $prihlasovaci_jmeno = $_POST["prihlasovaci_jmeno"];
    $heslo = $_POST["heslo"];
    $db = DbInfo::getinfo();
    $select = "Select * from `uzivatele` where prihlasovaci_jmeno='$prihlasovaci_jmeno'";
    foreach ($db->query($select) as $row) {

        if (password_verify($heslo, $row["heslo"])) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["logged"] = TRUE;
            $_SESSION["opravneni"] = $row["opravneni"];
            
        }

    }
    header("Location: http://localhost/realitnikancelar/index.php");
}