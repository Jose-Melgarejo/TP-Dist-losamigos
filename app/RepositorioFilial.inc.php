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

    public static function traer_canchas_por_filial($conexion, $id_filial) {
        $canchas = array();

        if (isset($conexion)) {
            include_once 'CanchaFilial.inc.php';

            $sql = 'CALL TraerCanchasPorFilial(?);';
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array($id_filial)) or die(exit("Error en odbc_execute"));

            while ($myRow = odbc_fetch_array($stmt)) {
                $canchas[] = new CanchaFilial($myRow['id'],$myRow['numero'],$myRow['deporte'],$myRow['tipo']);
            }
        }

        return $canchas;
    }
    
    public static function traer_turnos_por_filial_cancha($conexion, $id_filial_cancha, $fecha) {
        $turnos = array();

        if (isset($conexion)) {
            include_once 'Turno.inc.php';

            $sql = 'CALL TraerTurnosPorFilialCancha(?,?);';
            $stmt = odbc_prepare($conexion, $sql);
            odbc_execute($stmt, array($id_filial_cancha,$fecha)) or die(exit("Error en odbc_execute"));

            while ($myRow = odbc_fetch_array($stmt)) {
                //$id, $socio_id, $filial_cancha_id, $hora_inicio, $estado
                $turnos[] = new Turno($myRow['id'],$myRow['socio_id'],$myRow['filial_cancha_id'],$myRow['hora_inicio'],$myRow['estado']);
            }
        }

        return $turnos;
    }
    
    public static function turno_esta_ocupado($turnos,$horario) {
        include_once 'Turno.inc.php';
        //Returno 0=libre 1=ocupado_por_tercero 2=ocupado_por_usuario
        foreach ($turnos as $turno) {
            $id_socio_turno = $turno->getSocio_id();
            $hora_inicio = new DateTime($turno->getHora_inicio());
            
            if ($hora_inicio->format('H:i') == $horario->format('H:i')) {
                if ($_SESSION['id_socio'] == $id_socio_turno) {
                    return 2;
                }else{
                    return 1;
                }
            }
        }
        
        return 0;
    }
    
    public static function reservar_turno($conexion,$id_filial_cancha,$horario) {
        $id_socio = $_SESSION['id_socio'];
        $estado = "activo";
        $turno_insertado = false;
        
        //$horario_dt = new DateTime(date('Y'),date('m'),date('d'), substr($horario,0,2),substr($horario,3,2),0);
        //$horario_dt = new DateTime();
        //$horario_dt->setDate(date('Y'), date('m'), date('d'));
        //$horario_dt->setTime(substr($horario,0,2),substr($horario,3,2),0);

        
        
        //$horario->format('Y-m-d H:i:s')
        
        if (isset($conexion)) {
            $sql = "INSERT INTO turno(socio_id,filial_cancha_id,hora_inicio,estado) VALUES (?,?,?,?)";
            $stmt = odbc_prepare($conexion, $sql);
            $turno_insertado = odbc_execute($stmt, array($id_socio,$id_filial_cancha,$horario,$estado)) or die(exit("Error en odbc_execute"));
        }
        return $turno_insertado;
    }
    
    public static function anular_turno($conexion,$id_turno) {
        
    }
}
