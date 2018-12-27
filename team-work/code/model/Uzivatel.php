<?php

class Uzivatel {
    private $id;
    private $prihlasovaci_jmeno;
    private $heslo;
    private $opravneni;
    private $jmeno;
    private $prijmeni;
    private $email;
    private $telefon;
    public function __construct($id, $prihlasovaci_jmeno, $heslo, $opravneni, $jmeno, $prijmeni, $email, $telefon) {
        $this->id = $id;
        $this->prihlasovaci_jmeno = $prihlasovaci_jmeno;
        $this->heslo = $heslo;
        $this->opravneni = $opravneni;
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
        $this->email = $email;
        $this->telefon = $telefon;
    }
    public function getId() {
        return $this->id;
    }

    public function getPrihlasovaci_jmeno() {
        return $this->prihlasovaci_jmeno;
    }

    public function getHeslo() {
        return $this->heslo;
    }

    public function getOpravneni() {
        return $this->opravneni;
    }

    public function getJmeno() {
        return $this->jmeno;
    }

    public function getPrijmeni() {
        return $this->prijmeni;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefon() {
        return $this->telefon;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPrihlasovaci_jmeno($prihlasovaci_jmeno) {
        $this->prihlasovaci_jmeno = $prihlasovaci_jmeno;
    }

    public function setHeslo($heslo) {
        $this->heslo = $heslo;
    }

    public function setOpravneni($opravneni) {
        $this->opravneni = $opravneni;
    }

    public function setJmeno($jmeno) {
        $this->jmeno = $jmeno;
    }

    public function setPrijmeni($prijmeni) {
        $this->prijmeni = $prijmeni;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefon($telefon) {
        $this->telefon = $telefon;
    }



}
