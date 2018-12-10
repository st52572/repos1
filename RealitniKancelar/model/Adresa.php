<?php

class Adresa {
    private $kraj;
    private $okres;
    private $obec;
    public function __construct(Kraj $kraj, Okres $okres, Obec $obec) {
        $this->kraj = $kraj;
        $this->okres = $okres;
        $this->obec = $obec;
    }
    public function getKraj() : Kraj{
        return $this->kraj;
    }

    public function getOkres() : Okres{
        return $this->okres;
    }

    public function getObec() : Obec{
        return $this->obec;
    }


}
