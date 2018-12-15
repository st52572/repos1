<?php

class CZajemci_Koupe {

    public static function selectZajemciKoupe($clauseIdVlastnik = NULL, $clauseIdZajemce = NULL) {
        $db = DbInfo::getinfo();
        $index = 0;
        $zajemciKoupe = NULL;
        if ($clauseIdVlastnik != NULL) {
            $select = $db->prepare("SELECT * FROM `nemovitost`, `uzivatele`, `zajemci_koupe` WHERE zajemci_koupe.id_nemovitost = nemovitost.id AND nemovitost.id_uzivatel = ? AND zajemci_koupe.id_kupujici = uzivatele.id ORDER BY id_nemovitost");
            $select->execute([$clauseIdVlastnik]);
            $rows = $select->fetchAll();
            foreach ($rows as $row) {
                $nemovitost = new Nemovitost($row["id_nemovitost"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
                $zajemce = new Uzivatel($row["id_kupujici"], NULL, NULL, NULL, $row["jmeno"], $row["prijmeni"], $row["email"], $row["telefon"]);
                $zajemciKoupe[$index++] = new Zajemci_Koupe($row["id"], $zajemce, $nemovitost, $row["potvrzeno"]);
            }
        } else if ($clauseIdZajemce != NULL) {
            $select = $db->prepare("SELECT * FROM `nemovitost`,`zajemci_koupe` WHERE zajemci_koupe.id_nemovitost = nemovitost.id AND zajemci_koupe.id_kupujici = ?");
            $select->execute([$clauseIdZajemce]);
            $rows = $select->fetchAll();
            foreach ($rows as $row) {
                $nemovitost = new Nemovitost($row["id_nemovitost"], $row["text"], $row["popis"], $row["cena"], $row["id_obec"], $row["id_uzivatel"]);
                $zajemciKoupe[$index++] = new Zajemci_Koupe($row["id"], new Uzivatel($clauseIdZajemce, NULL, NULL, NULL, NULL, NULL, NULL, NULL), $nemovitost, $row["potvrzeno"]);
            }
        }

        return $zajemciKoupe;
    }

    public static function insertZajemciKoupe($idZajemce, $idNemovitost) {
        $db = DbInfo::getinfo();
        $datainsert = [NULL, $idNemovitost, $idZajemce, 2];
        $insert = $db->prepare("INSERT INTO `zajemci_koupe`(`id`, `id_nemovitost`, `id_kupujici`,`potvrzeno`) VALUES (?,?,?,?)");
        $inserted = $insert->execute($datainsert);
        return $inserted;
    }

    public static function updateZajemciKoupe($id) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("SELECT * FROM `zajemci_koupe` where id=?");
        $select->execute([$id]);
        $rows = $select->fetchAll();
        foreach ($rows as $row) {
            $idNemovitost = $row["id_nemovitost"];
        }
        $update = $db->prepare("UPDATE `zajemci_koupe` SET `potvrzeno`=0 WHERE id_nemovitost=?");
        $update->execute([$idNemovitost]);
        $update1 = $db->prepare("UPDATE `zajemci_koupe` SET `potvrzeno`=1 WHERE id=?");
        $updated1 = $update1->execute([$id]);
        $update2 = $db->prepare("UPDATE `nemovitost` SET `prodano`=1 WHERE id=?");
        $update2->execute([$idNemovitost]);
        return $updated1;
    }

}
