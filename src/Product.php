<?php


class Product {

    private $nazwa;
    private $cena;
    private $kategoria;
    private $producent;

    // Setters

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setCena($cena) {
        $this->cena = $cena;
    }

    public function setKategoria($kategoria) {
        $this->kategoria = $kategoria;
    }

    public function setProducent($producent) {
        $this->producent = $producent;
    }

    // Getters

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getCena() {
        return $this->cena;
    }

    public function getKategoria() {
        return $this->kategoria;
    }

    public function getProducent() {
        return $this->producent;
    }

}
