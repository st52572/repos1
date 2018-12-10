<?php

class Fotka {
    private $id;
    private $nazev;
    private $text;
    private $id_nemovitost;
    public function __construct($id, $nazev, $text, $id_nemovitost) {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->text = $text;
        $this->id_nemovitost = $id_nemovitost;
    }
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

        public function getId() {
        return $this->id;
    }

    public function getNazev() {
        return $this->nazev;
    }

    public function getId_nemovitost() {
        return $this->id_nemovitost;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNazev($nazev) {
        $this->nazev = $nazev;
    }

    public function setId_nemovitost($id_nemovitost) {
        $this->id_nemovitost = $id_nemovitost;
    }


}
