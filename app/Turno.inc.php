<?php

class Turno {
    private $id;
    private $socio_id;
    private $filial_cancha_id;
    private $hora_inicio;
    private $estado;
    
    public function __construct($id, $socio_id, $filial_cancha_id, $hora_inicio, $estado) {
        $this->id = $id;
        $this->socio_id = $socio_id;
        $this->filial_cancha_id = $filial_cancha_id;
        $this->hora_inicio = $hora_inicio;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getSocio_id() {
        return $this->socio_id;
    }

    public function getFilial_cancha_id() {
        return $this->filial_cancha_id;
    }

    public function getHora_inicio() {
        return $this->hora_inicio;
    }

    public function getEstado() {
        return $this->estado;
    }

    protected function setId($id) {
        $this->id = $id;
    }

    public function setSocio_id($socio_id) {
        $this->socio_id = $socio_id;
    }

    public function setFilial_cancha_id($filial_cancha_id) {
        $this->filial_cancha_id = $filial_cancha_id;
    }

    public function setHora_inicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }


}
