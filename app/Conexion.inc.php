<?php

class Conexion {

    private static $conexion;

    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            try {
                include_once 'config.inc.php';

                //self::$conexion = new PDO("mysql:host=$nombre_servidor; dbname=$nombre_base_datos", $nombre_usuario, $password);
                self::$conexion = new PDO('mysql:host=' . NOMBRE_SERVIDOR . '; dbname=' . NOMBRE_BD, NOMBRE_USUARIO, PASSWORD);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage() . "<br>";
                die(); //termina la conexion
            }
        }
    }

    /* public static function abrir_conexion() {
      if (!isset(self::$conexion)) {
      include_once 'config.inc.php';

      $dsn = "losamigos";
      $conexion = odbc_connect($dsn, "root", "");

      }
      } */

    public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    public static function getConexion() {
        return self::$conexion;
    }

}