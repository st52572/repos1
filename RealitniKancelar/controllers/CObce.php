<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../info/info.php';
    $db = DbInfo::getinfo();
    $okres = $_POST["okres"];
    $select3 = $db->prepare("Select * from `obec` where okres_id=?");
    $select3->execute([$okres]);
    $index = 0;
    $rows = $select3->fetchAll();
    foreach ($rows as $row) {
        $obce[$index++] = $row["id"];
        $obce[$index++] = $row["nazev"];
    }
    echo json_encode($obce);
}

