<?php
include_once 'RepositorioSocio.inc.php';

class ValidadorLogin {
    private $socio;
    private $error;
    
    public function __construct($mail,$clave,$conexion) {
        $this->error = "";
        
        if (!$this->variable_iniciada($mail) || !$this->variable_iniciada($clave)){
            $this->socio = null;
            $this->error="Debes introducir tu mail y tu contraseña";
        } else {
            $this->socio = RepositorioSocio::obtener_socio_por_mail($conexion,$mail);
            if (is_null($this->socio) || !password_verify($clave, $this->socio->getClave())){
                $this->error="Datos incorrectos";
            }else {
                
            }
        }
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function obtener_socio(){
        return $this->socio;
    }
    
    public function obtener_error() {
        return $this->error;
    }
    
    public function mostrar_error() {
        if ($this->error !== ''){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }
}
