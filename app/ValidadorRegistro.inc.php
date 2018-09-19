<?php
include_once 'RepositorioSocio.inc.php';

class ValidadorRegistro {
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $apellido;
    private $mail;
    private $clave;
    
    private $error_nombre;
    private $error_mail;
    private $error_clave1;
    private $error_clave2;

    public function __construct($nombre, $apellido, $mail, $clave1, $clave2, $conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";
        
        $this->nombre = "";
        $this->apellido = "";
        $this->mail = "";
        $this->clave = "";

        $this->error_nombre = $this->validar_nombre($conexion,$nombre);
        $this->error_apellido = $this->validar_apellido($conexion,$apellido);
        $this->error_mail = $this->validar_mail($conexion,$mail);
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1,$clave2);
        
        if($this->error_clave1 === "" && $this->error_clave2 === ""){
            $this->clave=$clave1;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($conexion, $nombre) {
        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir tu nombre.";
        } else {
            $this->nombre = $nombre;
        }

        if (strlen($nombre) < 2) {
            return "El nombre debe ser más largo que un caracter.";
        }

        if (strlen($nombre) > 24) {
            return "El nombre debe ser más chico que 25 caracteres.";
        }

        return "";
    }
    
    private function validar_apellido($conexion, $apellido) {
        if (!$this->variable_iniciada($apellido)) {
            return "Debes escribir un apellido.";
        } else {
            $this->apellido = $apellido;
        }

        if (strlen($apellido) < 2) {
            return "El apellido debe ser más largo que un caracter.";
        }

        if (strlen($apellido) > 24) {
            return "El apellido debe ser más chico que 25 caracteres.";
        }

        return "";
    }

    private function validar_mail($conexion, $mail) {
        if (!$this->variable_iniciada($mail)) {
            return "Debes escribir un mail.";
        } else {
            $this->mail = $mail;
        }
        if (RepositorioSocio::mail_existe($conexion,$mail)) {
            return "Este mail ya está en uso. Por favor, pruebe otro mail o <a href='".RUTA_LOGIN."'>inicie sesión</a>.";
        }
        
        return "";
    }

    private function validar_clave1($clave1) {
        if (!$this->variable_iniciada($clave1)) {
            return "Debes escribir una contraseña.";
        } 

        return "";
    }
    
    private function validar_clave2($clave1, $clave2) {
        if (!$this->variable_iniciada($clave1)) {
            return "Debes escribir una contraseña.";
        } 
        
        if (!$this->variable_iniciada($clave2)) {
            return "Debes repetir tu contraseña.";
        } 

        if ($clave1 !== $clave2){
            return "Las contraseñas ingresadas deben coincidir.";
        }
        
        return "";
    }

    public function obtener_nombre() {
        return $this->nombre;
    }
    
    public function obtener_apellido() {
        return $this->apellido;
    }
    
    public function obtener_mail() {
        return $this->mail;
    }
    
    public function obtener_clave() {
        return $this->clave;
    }
    
    public function obtener_error_nombre() {
        return $this->error_nombre;
    }
    
    public function obtener_error_apellido() {
        return $this->error_apellido;
    }
    
    public function obtener_error_mail() {
        return $this->error_mail;
    }
    
    public function obtener_error_clave1() {
        return $this->error_clave1;
    }
    
    public function obtener_error_clave2() {
        return $this->error_clave2;
    }
    
    public function mostrar_nombre() {
        if ($this->nombre !== ""){
            echo $this->nombre;
        }
    }
    
    public function mostrar_error_nombre() {
        if ($this->error_nombre !== ""){
            echo $this->aviso_inicio.$this->error_nombre.$this->aviso_cierre;
        }
    }
    
    public function mostrar_apellido() {
        if ($this->apellido !== ""){
            echo $this->apellido;
        }
    }
    
    public function mostrar_error_apellido() {
        if ($this->error_apellido !== ""){
            echo $this->aviso_inicio.$this->error_apellido.$this->aviso_cierre;
        }
    }
    
    public function mostrar_mail() {
        if ($this->mail !== ""){
            echo $this->mail;
        }
    }
    
    public function mostrar_error_mail() {
        if ($this->error_mail !== ""){
            echo $this->aviso_inicio.$this->error_mail.$this->aviso_cierre;
        }
    }
    
    public function mostrar_error_clave1() {
        if ($this->error_clave1 !== ""){
            echo $this->aviso_inicio . $this->error_clave1 . $this->aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2() {
        if ($this->error_clave2 !== ""){
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }
    
    public function registro_valido() {
        if ($this->error_nombre === "" &&
                $this->error_apellido === "" && 
                $this->error_mail === "" && 
                $this->error_clave1 === "" &&
                $this->error_clave2 === ""){
            return true;
        }
        else {
            return false;
        }
    }
}
