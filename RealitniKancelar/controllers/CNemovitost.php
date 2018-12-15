<?php

class CNemovitost {

    public static function selectNemovitostOwnClause($ownClause, $array) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `nemovitost` $ownClause");
        $select->execute($array);
        $rows = $select->fetchAll();
        $index = 0;
        $nemovitosti = NULL;

        foreach ($rows as $row) {
            $nemovitosti[$index++] = new Nemovitost($row["id"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
        }
        return $nemovitosti;
    }

    public static function selectNemovitosti($clauseID = NULL, $clauseUzivatelID = NULL) {
        $db = DbInfo::getinfo();
        if ($clauseID == NULL && $clauseUzivatelID == NULL) {
            $select = $db->prepare("Select * from `nemovitost` where prodano=0");
            $select->execute();
        } else if ($clauseID != NULL && $clauseUzivatelID != NULL) {
            $select = $db->prepare("Select * from `nemovitost` where id=? and id_uzivatel=? and prodano=0");
            $select->execute([$clauseID, $clauseUzivatelID]);
        } else if ($clauseID != NULL) {
            $select = $db->prepare("Select * from `nemovitost` where id=? and prodano=0");
            $select->execute([$clauseID]);
        } else if ($clauseUzivatelID != NULL) {
            $select = $db->prepare("Select * from `nemovitost` where id_uzivatel=? And prodano=0");
            $select->execute([$clauseUzivatelID]);
        }
        $index = 0;
        $nemovitosti = NULL;
        $rows = $select->fetchAll();
        foreach ($rows as $row) {
            $nemovitosti[$index++] = new Nemovitost($row["id"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
        }
        return $nemovitosti;
    }

    public static function selectNemovitost($clauseID) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `nemovitost` where id=? and prodano=0");
        $select->execute([$clauseID]);
        $row = $select->fetch();
        $nemovitost = new Nemovitost($row["id"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
        return $nemovitost;
    }

    public static function insertNemovitost(Nemovitost $nemovitost) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $nemovitost->getText(), $nemovitost->getPopis(), $nemovitost->getId_obec(), $nemovitost->getCena(), $nemovitost->getId_uzivatel()];
        $insert = $db->prepare("INSERT INTO `nemovitost`(`id`, `text`, `popis`, `id_obec`, `cena`, `id_uzivatel`) VALUES (?,?,?,?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }

    public static function updateNemovitost(Nemovitost $nemovitost) {
        $db = DbInfo::getinfo();
        $update = $db->prepare("UPDATE `nemovitost` SET `text`=?,`popis`=?,`id_obec`=?,`cena`=? WHERE `id`=?");
        $updated = $update->execute([$nemovitost->getText(), $nemovitost->getPopis(), $nemovitost->getId_obec(), $nemovitost->getCena(), $nemovitost->getId()]);
        return $updated;
    }

    public static function deleteNemovitost($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("Delete from `nemovitost` WHERE `id`=?");
        $deleted = $delete->execute([$id]);
        return $deleted;
    }

}
