<?php

class Nemovitost {
    private $id;
    private $text;
    private $popis;
    private $cena;
    private $id_obec;
    private $id_uzivatel;
    public function __construct($id, $text, $popis, $cena, $id_obec, $id_uzivatel) {
        $this->id = $id;
        $this->text = $text;
        $this->popis = $popis;
        $this->cena = $cena;
        $this->id_obec = $id_obec;
        $this->id_uzivatel = $id_uzivatel;
    }
    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getPopis() {
        return $this->popis;
    }

    public function getCena() {
        return $this->cena;
    }

    public function getId_obec() {
        return $this->id_obec;
    }

    public function getId_uzivatel() {
        return $this->id_uzivatel;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setPopis($popis) {
        $this->popis = $popis;
    }

    public function setCena($cena) {
        $this->cena = $cena;
    }

    public function setId_obec($id_obec) {
        $this->id_obec = $id_obec;
    }

    public function setId_uzivatel($id_uzivatel) {
        $this->id_uzivatel = $id_uzivatel;
    }


}
