<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioSocio.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_GET['apellido'])&&!empty($_GET['apellido'])){
    $apellido = $_GET['apellido'];
}else{
    Redireccion::redirigir(SERVIDOR);
}

//Es importante hacer una redireccion antes de escribir HTML

$titulo = '¡Registro correcto!';

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
                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registro correcto
                </div>
                <div class="panel-body text-center">
                    <p>¡Gracias por registrarte <b><?php echo $apellido ?></b>!</p>
                    <br>
                    <p><a href="<?php echo RUTA_LOGIN ?>">Inicia sesión</a> para comenzar a usar tu cuenta.</p>                        
                </div>
            </div>
        </div>
    </div>
</div>