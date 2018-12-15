<?php

class CObec {

    public static function selectObce($id_Okres) {
        $db = DbInfo::getinfo();
        $select3 = $db->prepare("Select * from `obec` where okres_id=?");
        $select3->execute([$id_Okres]);
        $index = 0;
        $obce = NULL;
        $rows = $select3->fetchAll();
        foreach ($rows as $row) {
            $obce[$index++] = new Obec($row["id"], $row["nazev"], $row["kod"], $row["okres_id"]);
        }
        return $obce;
    }

    public static function insertObec(Obec $obec) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $obec->getNazev(), $obec->getKod(), $obec->getId_okres()];
        $insert = $db->prepare("INSERT INTO `obec`(`id`, `nazev`, `kod`, `okres_id`) VALUES (?,?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }

    public static function updateObec(Obec $obec) {
        $db = DbInfo::getinfo();
        $update = $db->prepare("UPDATE `obec` SET `nazev`=? WHERE `id`=?");
        $updated = $update->execute([$obec->getNazev(), $obec->getId()]);
        return $updated;
    }

    public static function deleteObec($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("Delete from `obec` WHERE `id`=?");
        $deleted = $delete->execute([$id]);
        return $deleted;
    }

}
