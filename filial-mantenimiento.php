<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioSocio.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_GET['nombre'])&&!empty($_GET['nombre'])){
    $nombre = $_GET['nombre'];
}else{
    Redireccion::redirigir(SERVIDOR);
}

$titulo = 'Filial en mantenimiento';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
//include_once 'plantillas/documento-cierre.inc.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!--Aca va el titulo normalmente-->
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Día de mantenimiento en <?php echo $nombre?>
                </div>
                <div class="panel-body text-center">
                    <p>¡Lo lamentamos!</p>
                    <br>
                    <p>La filial elegida se encuentra en mantenimiento por hoy. Podés regresar al <a href="<?php echo SERVIDOR ?>">menú principal</a> y elegir otra filial.</p>                        
                </div>
            </div>
        </div>
    </div>
</div>