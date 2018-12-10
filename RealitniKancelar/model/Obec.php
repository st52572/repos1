<?php

class Obec {
    private $id;
    private $nazev;
    private $kod;
    private $id_okres;
    public function __construct($id, $nazev, $kod, $id_okres) {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->kod = $kod;
        $this->id_okres = $id_okres;
    }
    public function getId() {
        return $this->id;
    }

    public function getNazev() {
        return $this->nazev;
    }

    public function getKod() {
        return $this->kod;
    }

    public function getId_okres() {
        return $this->id_okres;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNazev($nazev) {
        $this->nazev = $nazev;
    }

    public function setKod($kod) {
        $this->kod = $kod;
    }

    public function setId_okres($id_okres) {
        $this->id_okres = $id_okres;
    }


}
