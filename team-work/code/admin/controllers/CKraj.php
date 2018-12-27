<?php

class CKraj {

    public static function selectKraje() {
        $db = DbInfo::getinfo();
        $select3 = "Select * from `kraj`";
        $index = 0;
        $kraje = NULL;
        foreach ($db->query($select3) as $row) {
            $kraje[$index++] = new Kraj($row["id"], $row["nazev"], $row["kod"]);
        }
        return $kraje;
    }

    public static function insertKraj(Kraj $kraj) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $kraj->getNazev(), $kraj->getKod()];
        $insert = $db->prepare("INSERT INTO `kraj`(`id`, `nazev`, `kod`) VALUES (?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }
    
    public static function updateKraj(Kraj $kraj) {
        $db = DbInfo::getinfo();
        $update = $db->prepare("UPDATE `kraj` SET `nazev`=? WHERE `id`=?");
        $updated = $update->execute([$kraj->getNazev(),$kraj->getId()]);
        return $updated;
    }

    public static function deleteKraj($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("Delete from `kraj` WHERE `id`=?");
        $deleted = $delete->execute([$id]);
        return $deleted;
    }

}
