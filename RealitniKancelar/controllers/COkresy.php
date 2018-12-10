<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $db = DbInfo::getinfo();
    $kraj = $_POST["kraj"];
    $select3 = "Select * from `okres` where kraj_id=$kraj";
    $index = 0;
    foreach ($db->query($select3) as $row) {
        $okresy[$index++] = $row["id"];
        $okresy[$index++] = $row["nazev"];
    }
   echo json_encode($okresy);
}

