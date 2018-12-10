<?php

class CAdresa {

    public static function selectAdresa($clauseObecID) {
        $db = DbInfo::getinfo();
        $select = "Select * from `obec` where id=$clauseObecID";
        $obec = null;
        foreach ($db->query($select) as $row) {
            $obec = new Obec($row["id"], $row["nazev"], $row["kod"], $row["okres_id"]);
        }
        $select2 = "Select * from `okres` where id=".$obec->getId_okres();
        $okres = null;
        foreach ($db->query($select2) as $row) {
            $okres = new Okres($row["id"], $row["nazev"], $row["kod"], $row["kraj_id"]);
        }
        $select3 = "Select * from `kraj` where id=".$okres->getId_kraj();
        $kraj = null;
        foreach ($db->query($select3) as $row) {
            $kraj = new Kraj($row["id"], $row["nazev"], $row["kod"]);
        }
        $adresa = new Adresa($kraj, $okres, $obec); 
        return $adresa;
    }

}
