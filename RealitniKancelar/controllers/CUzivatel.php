<?php

class CUzivatel {

    public static function selectUzivatele($clause, $array) {
        $db = DbInfo::getinfo();

        $select = $db->prepare("Select * from `uzivatele` $clause");
        $select->execute($array);
        $index = 0;
        $uzivatele = NULL;
        $rows = $select->fetchAll();
        foreach ($rows as $row) {
            $uzivatele[$index++] = new Uzivatel($row["id"], $row["prihlasovaci_jmeno"], $row["heslo"], $row["opravneni"], $row["jmeno"], $row["prijmeni"], $row["email"], $row["telefon"]);
        }
        return $uzivatele;
    }

    public static function selectUzivatel($clauseID = null, $clausePrihlasovaciJmeno = NULL) {
        $db = DbInfo::getinfo();
        if ($clauseID != null) {
            $select = $db->prepare("Select * from `uzivatele` where id=?");
            $select->execute([$clauseID]);
        } else {
            $select = $db->prepare("Select * from `uzivatele` where prihlasovaci_jmeno=?");
            $select->execute([$clausePrihlasovaciJmeno]);
        }
        $row = $select->fetch();
        $uzivatel = new Uzivatel($row["id"], $row["prihlasovaci_jmeno"], $row["heslo"], $row["opravneni"], $row["jmeno"], $row["prijmeni"], $row["email"], $row["telefon"]);
        return $uzivatel;
    }

    public static function insertUzivatel(Uzivatel $uzivatel) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $uzivatel->getPrihlasovaci_jmeno(), password_hash($uzivatel->getHeslo(), PASSWORD_DEFAULT), $uzivatel->getOpravneni(), $uzivatel->getJmeno(), $uzivatel->getPrijmeni(), $uzivatel->getEmail(), $uzivatel->getTelefon()];
        $insert = $db->prepare("INSERT INTO `uzivatele`(`id`, `prihlasovaci_jmeno`, `heslo`, `opravneni`, `jmeno`, `prijmeni`, `email`, `telefon`) VALUES (?,?,?,?,?,?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }

    public static function updateUzivatel(Uzivatel $uzivatel) {
        $db = DbInfo::getinfo();
        if ($uzivatel->getHeslo() == NULL) {
            $update = $db->prepare("UPDATE `uzivatele` SET `prihlasovaci_jmeno`=?,`opravneni`=?,`jmeno`=?,`prijmeni`=?,`email`=?,`telefon`=? WHERE `id`=?");
            $updated = $update->execute([$uzivatel->getPrihlasovaci_jmeno(), $uzivatel->getOpravneni(),$uzivatel->getJmeno(), $uzivatel->getPrijmeni(), $uzivatel->getEmail(),$uzivatel->getTelefon(), $uzivatel->getId()]);
        } else {
            $update = $db->prepare("UPDATE `uzivatele` SET `prihlasovaci_jmeno`=?,`heslo`=?,`opravneni`=?,`jmeno`=?,`prijmeni`=?,`email`=?,`telefon`=? WHERE `id`=?");
            $updated = $update->execute([$uzivatel->getPrihlasovaci_jmeno(), password_hash($uzivatel->getHeslo(), PASSWORD_DEFAULT), $uzivatel->getOpravneni(), $uzivatel->getJmeno(), $uzivatel->getPrijmeni(), $uzivatel->getEmail(), $uzivatel->getTelefon(), $uzivatel->getId()]);
        }
        return $updated;
    }

    public static function deleteUzivatel($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("Delete from `uzivatele` WHERE `id`=?");
        $deleted = $delete->execute([$id]);
        return $deleted;
    }

}
