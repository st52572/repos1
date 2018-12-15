<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["opravneni"] == 1) {
    require_once '../info/info.php';
    require_once '../../controllers/test_input.php';
    if (isset($_POST["add"])) {
        $nazev = test_input($_POST["nazev"]);
        $id_kraj = $_POST["kraj"];
        $okres = new Okres(NULL, $nazev, "kod", $id_kraj);
        COkres::insertOkres($okres);
        header("Location: ../okresy.php");
    } else if (isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);
        COkres::deleteOkres($id);
    } else if (isset($_POST["select"])) {
        $id = test_input($_POST["id"]);
        $okresy = COkres::selectOkresy($id);
        $page = htmlspecialchars('controllers/COkresy.php');
        $string = "";
        foreach ($okresy as $okres) {
            $string .= "<div id='zmena-udaju'>
            
            <input type='hidden' name='id' value=" . $okres->getId() . ">
                <div>
                    <label>Název: </label><input required type='text' id='input".$okres->getId()."' name='nazev' value='" . $okres->getNazev() . "'>
                    <button class='edit' value='" . $okres->getId() . "'>Změnit</button>
                    <button class='delete' value='" . $okres->getId() . "'>Smazat</button>
                </div>        
            
        </div>";
        }
        echo $string;
    } else if(isset ($_POST["edit"])){
        $id = test_input($_POST["id"]);
        $nazev = test_input($_POST["nazev"]);
        $okres = new Okres($id, $nazev, "KOD", NULL);
        COkres::updateOkres($okres);
    }
}

