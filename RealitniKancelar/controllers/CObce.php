<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $db = DbInfo::getinfo();
    $okres = $_POST["okres"];
    $select3 = "Select * from `obec` where okres_id=$okres";
    $index = 0;
    foreach ($db->query($select3) as $row) {
        $obce[$index++] = $row["id"];
        $obce[$index++] = $row["nazev"];
    }
   echo json_encode($obce);
}

