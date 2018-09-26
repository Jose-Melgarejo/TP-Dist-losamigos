<?php

class CanchaFilial{
    private $id;
    private $numero;
    private $deporte;
    private $tipo;
    
    public function __construct($id, $numero, $deporte, $tipo) {
        $this->id = $id;
        $this->numero = $numero;
        $this->deporte = $deporte;
        $this->tipo = $tipo;
    }

    public function getId() {
        return $this->id;
    }

    protected function getNumero() {
        return $this->numero;
    }

    public function getDeporte() {
        return $this->deporte;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setDeporte($deporte) {
        $this->deporte = $deporte;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
