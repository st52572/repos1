<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once '../info/info.php';
$db = DbInfo::getinfo();
$select3 = "Select * from `kraj`";
$index = 0;
foreach ($db->query($select3) as $row) {
    $kraje[$index++] = $row["id"];
    $kraje[$index++] = $row["nazev"];
}
echo json_encode($kraje);

}
