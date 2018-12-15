<?php

class CAdresa {

    public static function selectAdresa($clauseObecID) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `obec` where id=?");
        $select->execute([$clauseObecID]);
        $row = $select->fetch();
        $obec = new Obec($row["id"], $row["nazev"], $row["kod"], $row["okres_id"]);


        $select2 = $db->prepare("Select * from `okres` where id=?");
        $select2->execute([$obec->getId_okres()]);
        $row = $select2->fetch();
        $okres = new Okres($row["id"], $row["nazev"], $row["kod"], $row["kraj_id"]);



        $select3 = $db->prepare("Select * from `kraj` where id=?");
        $select3->execute([$okres->getId_kraj()]);
        $row = $select3->fetch();

        $kraj = new Kraj($row["id"], $row["nazev"], $row["kod"]);
        $adresa = new Adresa($kraj, $okres, $obec);
        return $adresa;
    }

}
