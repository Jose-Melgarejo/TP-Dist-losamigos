<?php

class RepositorioFilial {

    public static function obtener_filial_por_id($conexion, $id) {
        $filial = null;

        if (isset($conexion)) {
            include_once 'Filial.inc.php';

            $sql = "SELECT * FROM filial WHERE id = ?";
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array($id)) or die(exit("Error en odbc_execute"));

            $res_id = odbc_result($stmt, "id");

            if (isset($res_id) && $res_id) {
                //$id,$direccion,$nombre,$dia_mantenimiento,$hora_inicio,$hora_fin
                $filial = new Filial($res_id, odbc_result($stmt, "direccion"), odbc_result($stmt, "nombre"), odbc_result($stmt, "dia_mantenimiento"), odbc_result($stmt, "hora_inicio"), odbc_result($stmt, "hora_fin"));
            }
        }

        return $filial;
    }

    public static function obtener_todas($conexion) {
        $filiales = array();

        if (isset($conexion)) {
            include_once 'Filial.inc.php';

            $sql = 'CALL TraerFiliales();'; //Llamada a nuestro PROCEDURE
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array()) or die(exit("Error en odbc_execute"));
            
            while ($myRow = odbc_fetch_array($stmt)) {
                $filiales[] = new Filial($myRow['id'], $myRow['direccion'], $myRow['nombre'], $myRow['dia_mantenimiento'], $myRow['hora_inicio'], $myRow['hora_fin']);
            }
        }  

        return $filiales;
    }

}
