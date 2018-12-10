<?php

class Okres {
    private $id;
    private $nazev;
    private $kod;
    private $id_kraj;
    public function __construct($id, $nazev, $kod, $id_kraj) {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->kod = $kod;
        $this->id_kraj = $id_kraj;
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

    public function getId_kraj() {
        return $this->id_kraj;
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

    public function setId_kraj($id_kraj) {
        $this->id_kraj = $id_kraj;
    }


}
