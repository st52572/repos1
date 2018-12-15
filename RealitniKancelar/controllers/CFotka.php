<?php

class CFotka {

    public static function selectFotka($idNemovitost) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `fotky` where id_nemovitost=? LIMIT 1");
        $select->execute([$idNemovitost]);
        $row = $select->fetch();

        $fotka = new Fotka($row["id"], $row["nazev"], $row["text"], $row["id_nemovitost"]);
        return $fotka;
    }

    public static function selectFotky($idNemovitost) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `fotky` where id_nemovitost=?");
        $select->execute([$idNemovitost]);
        $fotky = null;
        $index = 0;
        $rows = $select->fetchAll();
        foreach ($rows as $row) {
            $fotky[$index++] = new Fotka($row["id"], $row["nazev"], $row["text"], $row["id_nemovitost"]);
        }
        return $fotky;
    }

    public static function updateFotka($id, $text) {
        $db = DbInfo::getinfo();
        $update = $db->prepare("UPDATE `fotky` SET `text`=? WHERE `id`=?");
        $updated = $update->execute(array($text, $id));
        return $updated;
    }

    public static function insertFotky($idNemovitost) {
        $db = DbInfo::getinfo();

        $count = count($_FILES['fileToUpload']['name']);
        $target_dir = "../img/";
        $file = $idNemovitost;
        if (!file_exists("../img/$file/")) {
            mkdir("../img/$file/");
        }
        $target_dir .= $file . "/";
        for ($i = 0; $i < $count; $i++) {
            if (file_exists($_FILES['fileToUpload']['tmp_name'][$i]) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i])) {
                $temp = explode(".", $_FILES["fileToUpload"]["name"][$i]);
                $newfilename = round(microtime(true)) . $i . '.' . end($temp);
                $src_image1 = "img/$file/$newfilename";
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_dir . $newfilename);
                $datainsert = [NULL, $src_image1, $idNemovitost];
                $insert = $db->prepare("INSERT INTO `fotky`(`id`, `nazev`, `id_nemovitost`) VALUES (?,?,?)");
                $inserted = $insert->execute($datainsert);
            }
        }
        return $inserted;
    }

    public static function deleteFotka($id) {
        $db = DbInfo::getinfo();
        $select = $db->prepare("Select * from `fotky` where id=?");
        $select->execute([$id]);
        $row = $select->fetch();
        if (unlink("../img/".$row["id_nemovitost"]."/" . end((explode("/", $row["nazev"]))))) {
            $delete = $db->prepare("Delete from `fotky` WHERE `id`=?");
            $deleted = $delete->execute([$id]);
       }
        return $deleted;
    }

}
