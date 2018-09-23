<?php

class RepositorioSocio {

    public static function insertar_socio($conexion, $socio) {
        $socio_insertado = false;

        if (isset($conexion)) {
            $sql = "INSERT INTO socio(nombre,apellido,mail,clave,fecha_registro) VALUES (?,?,?,?,NOW())";

            $nombre = $socio->getNombre();
            $apellido = $socio->getApellido();
            $mail = $socio->getMail();
            $clave = $socio->getClave();

            $stmt = odbc_prepare($conexion, $sql);
            $socio_insertado = odbc_execute($stmt, array($nombre,$apellido,$mail,$clave));
        }
        return $socio_insertado;
    }

    public static function mail_existe($conexion, $mail) {
        //Vamos a buscar en la bd cualquier email que tenga ese nombre.
        $mail_existe = false;

        if (isset($conexion)) {
            $sql = "SELECT mail FROM socio WHERE mail = ?";
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array($mail)) or die (exit("Error en odbc_execute"));

            $res_mail = odbc_result($stmt, "mail");

            if (isset($res_mail) && $res_mail) {
                $mail_existe = true;
            }
        }

        return $mail_existe;
    }
    
    public static function obtener_socio_por_mail($conexion, $mail) {
        $socio = null;

        if (isset($conexion)) {
            include_once 'Socio.inc.php';

            $sql = "SELECT * FROM socio WHERE mail = ?";
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array($mail)) or die (exit("Error en odbc_execute"));

            $res_id = odbc_result($stmt, "id");

            if (isset($res_id) && $res_id) {
                $socio = new Socio($res_id,
                        odbc_result($stmt, "nombre"),
                        odbc_result($stmt, "apellido"),
                        odbc_result($stmt, "direccion"),
                        odbc_result($stmt, "telefono"),
                        odbc_result($stmt, "mail"),
                        odbc_result($stmt, "clave"),
                        odbc_result($stmt, "fecha_registro"));                
            }
        }

        return $socio;
    }
    
}
