<?php

class Zajemci_Koupe {
    private $id;
    private $uzivatel;
    private $nemovitost;
    private $potvrzeno;
   
    public function __construct($id, $uzivatel, $nemovitost, $potvrzeno) {
        $this->id = $id;
        $this->uzivatel = $uzivatel;
        $this->nemovitost = $nemovitost;
        $this->potvrzeno = $potvrzeno;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

        public function getPotvrzeno() {
        return $this->potvrzeno;
    }

    public function setPotvrzeno($potvrzeno) {
        $this->potvrzeno = $potvrzeno;
    }

        public function getUzivatel() : Uzivatel{
        return $this->uzivatel;
    }

    public function getNemovitost() : Nemovitost{
        return $this->nemovitost;
    }

    public function setUzivatel($uzivatel) {
        $this->uzivatel = $uzivatel;
    }

    public function setNemovitost($nemovitost) {
        $this->nemovitost = $nemovitost;
    }


}
