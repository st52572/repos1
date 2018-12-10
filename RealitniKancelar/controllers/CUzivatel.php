<?php

class CUzivatel {

    public static function selectUzivatele($clauseID = NULL, $clause = NULL) {
        $db = DbInfo::getinfo();
        if ($clauseID == NULL && $clause == NULL) {
            $select = "Select * from `uzivatele`";
        } else if ($clauseID != NULL) {
            $select = "Select * from `uzivatele` where id=$clauseID";
        } else {
            $select = "Select * from `uzivatele` $clause";
        }
        $index = 0;
        $uzivatele = NULL;
        foreach ($db->query($select) as $row) {
            $uzivatele[$index++] = new Uzivatel($row["id"], $row["prihlasovaci_jmeno"], $row["heslo"], NULL, $row["jmeno"], $row["prijmeni"], $row["email"], $row["telefon"]);
        }
        return $uzivatele;
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
            $update = $db->prepare("UPDATE `uzivatele` SET `prihlasovaci_jmeno`='" . $uzivatel->getPrihlasovaci_jmeno() . "',`opravneni`=" . $uzivatel->getOpravneni() . ",`jmeno`='" . $uzivatel->getJmeno() . "',`prijmeni`='" . $uzivatel->getPrijmeni() . "',`email`='" . $uzivatel->getEmail() . "',`telefon`='" . $uzivatel->getTelefon() . "' WHERE `id`=" . $uzivatel->getId() . "");
            $updated = $update->execute();
        } else {
            $update = $db->prepare("UPDATE `uzivatele` SET `prihlasovaci_jmeno`='" . $uzivatel->getPrihlasovaci_jmeno() . "',`heslo`='" . password_hash($uzivatel->getHeslo(), PASSWORD_DEFAULT) . "',`opravneni`=" . $uzivatel->getOpravneni() . ",`jmeno`='" . $uzivatel->getJmeno() . "',`prijmeni`='" . $uzivatel->getPrijmeni() . "',`email`='" . $uzivatel->getEmail() . "',`telefon`='" . $uzivatel->getTelefon() . "' WHERE `id`=" . $uzivatel->getId() . "");
            $updated = $update->execute();
        }
        return $updated;
    }

    public static function deleteUzivatel($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("DELETE FROM `uzivatele` Where id=$id");
        $deleted = $delete->execute();
        return $deleted;
    }

}
