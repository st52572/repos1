<?php

class CNemovitost {

    public static function selectNemovitosti($clauseID = NULL, $clauseUzivatelID = NULL, $ownClause = NULL) {
        $db = DbInfo::getinfo();
        if ($clauseID == NULL && $clauseUzivatelID == NULL && $ownClause == NULL) {
            $select = "Select * from `nemovitost` where prodano=0";
        } else if ($clauseID != NULL && $clauseUzivatelID != NULL) {
            $select = "Select * from `nemovitost` where id=$clauseID and id_uzivatel=$clauseUzivatelID and prodano=0";
        } else if ($clauseID != NULL) {
            $select = "Select * from `nemovitost` where id=$clauseID and prodano=0";
        } else if ($clauseUzivatelID != NULL) {
            $select = "Select * from `nemovitost` where id_uzivatel=$clauseUzivatelID And prodano=0";
        } else if ($ownClause != NULL) {
            $select = "Select * from `nemovitost` $ownClause";
        }
        $index = 0;
        $nemovitosti = NULL;
        foreach ($db->query($select) as $row) {
            $nemovitosti[$index++] = new Nemovitost($row["id"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
        }
        return $nemovitosti;
    }

    public static function selectNemovitostiArray($filtr) {
        $db = DbInfo::getinfo();
        $select = "Select * from `nemovitost` where text like '%$filtr%'";
        $index = 1;
        $nemovitosti = new ArrayObject();
        foreach ($db->query($select) as $row) {
            $nemovitosti[$index++] = $row["id"];
            $nemovitosti[$index++] = $row["text"];
            $nemovitosti[$index++] = $row["cena"];
        }
        $nemovitosti[0] = $index;
        return $nemovitosti;
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
        $update = $db->prepare("UPDATE `nemovitost` SET `text`='" . $nemovitost->getText() . "',`popis`='" . $nemovitost->getPopis() . "',`id_obec`=" . $nemovitost->getId_obec() . ",`cena`=" . $nemovitost->getCena() . " WHERE `id`=" . $nemovitost->getId() . "");
        $updated = $update->execute();
        return $updated;
    }

    public static function deleteNemovitost($id) {
        $db = DbInfo::getinfo();
        $delete = $db->prepare("DELETE FROM `nemovitost` Where id=$id");
        $deleted = $delete->execute();
        return $deleted;
    }

}
