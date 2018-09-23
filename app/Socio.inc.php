<?php

class Socio {
    private $id;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $mail;
    private $clave;
    private $fecha_registro;
    
    public function __construct($id,$nombre,$apellido,$direccion,$telefono,$mail,$clave,$fecha_registro){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->fecha_registro = $fecha_registro;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getClave() {
        return $this->clave;
    }
    
    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    protected function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }
    
    public function setFechaRegistro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }
} 
