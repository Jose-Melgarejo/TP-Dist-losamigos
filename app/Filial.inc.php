<?php

class Filial {
    private $id;
    private $direccion;
    private $nombre;
    private $dia_mantenimiento;
    private $hora_inicio;
    private $hora_fin;
    
    public function __construct($id,$direccion,$nombre,$dia_mantenimiento,$hora_inicio,$hora_fin) {
        $this->id = $id;
        $this->direccion = $direccion;
        $this->nombre = $nombre;
        $this->dia_mantenimiento = $dia_mantenimiento;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
    }
    
    public function getId() {
        return $this->id;
    }
    
    protected function setId($id) {
        $this->id = $id;
    }
    
    public function getDireccion() {
        return $this->direccion;
    }
    
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getDiaMantenimiento() {
        return $this->dia_mantenimiento;
    }
    
    public function setDiaMantenimiento($dia_mantenimiento){
        $this->dia_mantenimiento = $dia_mantenimiento;
    }
    
    public function getHoraInicio() {
        return $this->hora_inicio;
    }
    
    public function setHoraInicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }
    
    public function getHoraFin() {
        return $this->hora_fin;
    }
    
    public function setHoraFin($hora_fin) {
        $this->hora_fin = $hora_fin;
    }
}
