<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["opravneni"] == 1) {
    require_once '../info/info.php';
    require_once '../../controllers/test_input.php';
    if (isset($_POST["add"])) {
        $nazev = test_input($_POST["nazev"]);
        $id_okres = $_POST["okres"];
        $obec = new Obec(NULL, $nazev, "kod", $id_okres);
        CObec::insertObec($obec);
        header("Location: ../obce.php");
    } else if (isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);
        CObec::deleteObec($id);
    } else if (isset($_POST["select"])) {
        $id_Okres = test_input($_POST["idOkres"]);
        $obce = CObec::selectObce($id_Okres);
        $page = htmlspecialchars('controllers/CObce.php');
        $string = "";
        foreach ($obce as $obec) {
            $string .= "<div id='zmena-udaju'>
            
            <input type='hidden' name='id' value=" . $obec->getId() . ">
                <div>
                    <label>Název: </label><input required type='text' id='input".$obec->getId()."' name='nazev' value='" . $obec->getNazev() . "'>
                    <button class='edit' value='" . $obec->getId() . "'>Změnit</button>
                    <button class='delete' value='" . $obec->getId() . "'>Smazat</button>
                </div>        
            
        </div>";
        }
        echo $string;
    } else if(isset ($_POST["edit"])){
        $id = test_input($_POST["id"]);
        $nazev = test_input($_POST["nazev"]);
        $obec = new Obec($id, $nazev, "kod", NULL);
        CObec::updateObec($obec);
    }
}

