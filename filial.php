<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioFilial.inc.php';

if (ControlSesion::sesion_iniciada()) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        Conexion::abrir_conexion();
        $id_filial = $_GET['id'];
        $filial = RepositorioFilial::obtener_filial_por_id(Conexion::getConexion(), $id_filial);

        Conexion::cerrar_conexion();
        
        $fecha_hoy = date('Y-n-j');
        $fecha_maniana = date('Y-n-j', strtotime(date('Y-n-j') . ' +1 day'));
        $fecha_pasado = date('Y-n-j', strtotime(date('Y-n-j') . ' +2 day'));

        if (isset($filial)) {
            $titulo = 'Los Amigos | Filial ' . $filial->getNombre();
            //echo "Today is " . date("Y/m/d") . "<br>";
            $day_of_week = date("N"); //Del 1 al 7, siendo 1 lunes y 7 domingo

            if ($filial->getDiaMantenimiento() == $day_of_week) {
                Redireccion::redirigir(RUTA_FILIAL_MANTENIMIENTO . "?nombre=" . $filial->getNombre());
            }

            $hora_inicio = $filial->getHoraInicio();
            $hora_fin = $filial->getHoraFin();
            $cantidad_turnos = $hora_fin - $hora_inicio;

            Conexion::abrir_conexion();
            $canchas = RepositorioFilial::traer_canchas_por_filial(Conexion::getConexion(), $id_filial);
            Conexion::cerrar_conexion();

            if (isset($_GET['id-filial-cancha']) && !empty($_GET['id-filial-cancha'])) {
                $fecha = $fecha_hoy;
                if (isset($_GET['fecha']) && !empty($_GET['fecha'])) {
                    $fecha = $_GET['fecha'];
                }
                $id_filial_cancha = $_GET['id-filial-cancha'];
                Conexion::abrir_conexion();
                $turnos = RepositorioFilial::traer_turnos_por_filial_cancha(Conexion::getConexion(), $id_filial_cancha, $fecha);
                Conexion::cerrar_conexion();
                
                if (isset($_GET['horario']) && !empty($_GET['horario'])) {
                    $horario_para_reservar = $_GET['horario'];
                    $fecha = explode(" ", $horario_para_reservar)[0];
                    Conexion::abrir_conexion();
                    $reservado = RepositorioFilial::reservar_turno(Conexion::getConexion(), $id_filial_cancha, $horario_para_reservar);
                    Conexion::cerrar_conexion();
                    if ($reservado) {
                        Conexion::abrir_conexion();
                        $turnos = RepositorioFilial::traer_turnos_por_filial_cancha(Conexion::getConexion(), $id_filial_cancha, $fecha);
                        Conexion::cerrar_conexion();
                    }
                }
                
            }
        } else {
            Redireccion::redirigir(SERVIDOR);
        }
    } else {
        Redireccion::redirigir(SERVIDOR);
    }
} else {
    Redireccion::redirigir(RUTA_LOGIN);
}

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container">

    <div class="page-header">
        <h1><?php echo $filial->getNombre(); ?><small>  (<?php echo $filial->getDireccion(); ?>)</small></span></h1>
    </div>
</div>
<div class="container">

    <div class="dropdown" style="display: inline-block;margin-right:10px;">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php 
            $titulo_combo = "Elegí una cancha";
            if (isset($id_filial_cancha) && $id_filial_cancha > 0){
                $cantidad = 0;
            
                foreach ($canchas as $cancha) {
                    $cantidad = $cantidad + 1;
                    if ($id_filial_cancha == $cancha->getId()) {
                        $titulo_combo = $cantidad . ". " . $cancha->getDeporte() . " - " . $cancha->getTipo();
                    }
                }
            }
            echo $titulo_combo;
            ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu1">
            <!--<li><a href="#">Plaza Fútbol</a></li>-->
            <?php
            $cantidad = 0;
            $nombre_deporte = "";
            foreach ($canchas as $cancha) {
                if ($cantidad == 0) {
                    $nombre_deporte = $cancha->getDeporte();
                } else {
                    if ($cancha->getDeporte() !== $nombre_deporte) {
                        ?>
                        <li role="separator" class="divider"></li>
                        <?php
                    }
                }
                $nombre_deporte = $cancha->getDeporte();
                $cantidad = $cantidad + 1;
                ?>
                <li><a href="<?php echo RUTA_FILIAL . "?id=" . $id_filial . "&id-filial-cancha=" . $cancha->getId(); ?>"><?php echo $cantidad . ". " . $cancha->getDeporte() . " - " . $cancha->getTipo(); ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    
    <?php if (isset($id_filial_cancha)){?>
    <div class="btn-group" style="display: inline-block;margin-right:10px;" role="group" aria-label="...">
        <a class="btn btn-default <?php if ($fecha == $fecha_hoy){?>btn-info<?php }?>" href="<?php echo RUTA_FILIAL."?id=".$id_filial."&id-filial-cancha=".$id_filial_cancha."&fecha=".$fecha_hoy;?>">Hoy</a>
        <a class="btn btn-default <?php if ($fecha == $fecha_maniana){?>btn-info<?php }?>" href="<?php echo RUTA_FILIAL."?id=".$id_filial."&id-filial-cancha=".$id_filial_cancha."&fecha=".$fecha_maniana;?>">Mañana</a>
        <a class="btn btn-default <?php if ($fecha == $fecha_pasado){?>btn-info<?php }?>" href="<?php echo RUTA_FILIAL."?id=".$id_filial."&id-filial-cancha=".$id_filial_cancha."&fecha=".$fecha_pasado;?>">Pasado</a>
    </div>
    <?php }?>
    
    <h5 style="display: inline-block;margin-right:10px;">Estamos desde las <?php echo substr($hora_inicio,0,-3); ?>hs. hasta las <?php echo substr($hora_fin,0,-3) ?>hs. Máximo de turnos posibles por cancha: <?php echo $cantidad_turnos ?>.</h5>
       
    <?php
    if (isset($id_filial_cancha) && $id_filial_cancha > 0) {
        ?>
    
        <div class="container">
            <br>
            <div class="list-group">
                <?php
                $x = 0;
                while ($x < $cantidad_turnos) {
                    $hora_turno = new DateTime();
                    $partes_fecha = explode("-", $fecha);
                    $hora_turno->setDate($partes_fecha[0],$partes_fecha[1],$partes_fecha[2]);
                    $hora_turno->setTime($hora_inicio + $x, 0, 0);
                    $res = RepositorioFilial::turno_esta_ocupado($turnos, $hora_turno);
                    $str_hora = $hora_turno->format('Y-n-j H:i');
                    if ($res == 0) {
                        //Turno libre
                        ?>
                        <a href="<?php echo RUTA_FILIAL."?id=".$id_filial."&id-filial-cancha=".$id_filial_cancha."&horario=".$str_hora;?>" class="list-group-item list-group-item-success"><?php echo $hora_turno->format('H:i'); ?>hs. Turno libre</a>
                        <?php
                    }elseif($res == 1) {
                        //Turno ocupado por tercero
                        ?>
                        <a class="list-group-item list-group-item-danger"><?php echo $hora_turno->format('H:i'); ?>hs. Turno ocupado</a>
                        <?php
                    }else {
                        //Turno ocupado por el usuario
                        ?>
                        <a class="list-group-item list-group-item-info"><?php echo $hora_turno->format('H:i'); ?>hs. Has reservado este turno.</a>
                        <?php
                    }
                    $x = $x + 1;
                }
                ?>
            </div>

        </div>
    
    <?php
}
?>



</div>


<?php
include_once './plantillas/documento-cierre.inc.php';
?>


