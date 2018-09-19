<?php

class ControlSesion {

    public static function iniciar_sesion($id_socio, $nombre_socio) {
        if (session_id() == '') {
            session_start();
        }
        
        $_SESSION['id_socio'] = $id_socio;
        $_SESSION['nombre_socio'] = $nombre_socio;
        
    }
    
    public static function cerrar_sesion() {
        if (session_id() == '') {
            session_start();
        }
        
        if (isset($_SESSION['id_socio'])) {
            unset($_SESSION['id_socio']);
        }
        if (isset($_SESSION['nombre_socio'])) {
            unset($_SESSION['nombre_socio']);
        }
        
        session_destroy();
    }
    
    public static function sesion_iniciada() {
        if (session_id() == '') {
            session_start();
        }
        
        if (isset($_SESSION['nombre_socio']) && isset($_SESSION['id_socio'])) {
            return true;
        }else{
            return false;
        }
    }
}
