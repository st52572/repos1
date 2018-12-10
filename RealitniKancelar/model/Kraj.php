<?php

class Kraj implements JsonSerializable {

    private $id;
    private $nazev;
    private $kod;

    public function __construct($id, $nazev, $kod) {
        $this->id = $id;
        $this->nazev = $nazev;
        $this->kod = $kod;
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setNazev($nazev) {
        $this->nazev = $nazev;
    }

    public function setKod($kod) {
        $this->kod = $kod;
    }

    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'nazev' => $this->nazev,
            'kod' => $this->kod
        );
    }

}
