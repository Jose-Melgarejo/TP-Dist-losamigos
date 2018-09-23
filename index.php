<?php
$titulo = 'Los Amigos';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioFilial.inc.php';
include_once 'app/Conexion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Conexion::abrir_conexion();
    
    $filiales = RepositorioFilial::obtener_todas(Conexion::getConexion());
    
    Conexion::cerrar_conexion();
} else {
    Redireccion::redirigir(RUTA_LOGIN);
}
?>
<div id="portada-amigos">

</div>

<div class="container">
    <div class="starter-template text-center">
        <br>
        <p class="lead">Tenemos canchas de fútbol, básquet y tenis.<br>Busca la filial que más cómoda te quede y vení a jugar!</p>

        <div class="dropdown" style="display: inline-block;margin-right:10px;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Elegí una filial
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu1">
                <!--<li><a href="#">Plaza Fútbol</a></li>-->
                <?php
                foreach ($filiales as $filial) {
                    ?>
                    <li><a href="<?php echo RUTA_FILIAL."?id=".$filial->getId();?>"><?php echo $filial->getNombre(); ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <h5 style="display: inline-block;margin-right:10px;"> o bien </h5>
        <div class="dropdown" style="display: inline-block">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Elegí un deporte
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu1">
                <li><a href="<?php echo RUTA_FUTBOL ?>">Fútbol</a></li>
                <li><a href="<?php echo RUTA_BASQUET ?>">Básquet</a></li>
                <li><a href="<?php echo RUTA_TENIS ?>">Tenis</a></li>
            </ul>
        </div>
    </div>



</div>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>