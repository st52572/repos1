<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $db = DbInfo::getinfo();
    $kraj = $_POST["kraj"];
    $select3 = $db->prepare("Select * from `okres` where kraj_id=?");
    $select3->execute([$kraj]);
    $index = 0;
    $rows = $select3->fetchAll();
    foreach ($rows as $row) {
        $okresy[$index++] = $row["id"];
        $okresy[$index++] = $row["nazev"];
    }
   echo json_encode($okresy);
}
