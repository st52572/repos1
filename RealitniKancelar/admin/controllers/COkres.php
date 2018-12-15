<?php

class COkres {

    public static function selectOkresy($id_Kraj) {
        $db = DbInfo::getinfo();
        $select3 = $db->prepare("Select * from `okres` where kraj_id=?");
        $select3->execute([$id_Kraj]);
        $index = 0;
        $okresy = NULL;
        $rows = $select3->fetchAll();
        foreach ($rows as $row) {
            $okresy[$index++] = new Okres($row["id"], $row["nazev"], $row["kod"], $row["kraj_id"]);
        }
        return $okresy;
    }

    public static function insertOkres(Okres $okres) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $okres->getNazev(), $okres->getKod(), $okres->getId_kraj()];
        $insert = $db->prepare("INSERT INTO `okres`(`id`, `nazev`, `kod`, `kraj_id`) VALUES (?,?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }

    public static function updateOkres(Okres $okres) {
        $db = DbInfo::getinfo();
        $update = $db->prepare("UPDATE `okres` SET `nazev`=? WHERE `id`=?");
        $updated = $update->execute([$okres->getNazev(), $okres->getId()]);
        return $updated;
    }

    public static function deleteOkres($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("Delete from `okres` WHERE `id`=?");
        $deleted = $delete->execute([$id]);
        return $deleted;
    }

}
