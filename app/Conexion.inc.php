<?php

class Conexion {

    private static $conexion;

    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            include_once 'config.inc.php';

            $dsn = "losamigos";
            self::$conexion = odbc_connect($dsn, "", "");

            if (!self::$conexion) {
                exit("<strong>Error tratanto de conectarse con el origen de datos.</string>");
            }
        }
    }

    public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    public static function getConexion() {
        return self::$conexion;
    }

}
