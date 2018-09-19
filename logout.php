<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioSocio.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {

    //Procedemos a cerrar la sesion
    $nombre_socio = $_SESSION['nombre_socio'];
    
    ControlSesion::cerrar_sesion();
} else {
    Redireccion::redirigir(SERVIDOR); //Un socio sin sesion que quiere cerrar sesion, lo redirigimos.
}

$titulo = 'Logout';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>Sesión cerrada</h4>
                </div>
                <div class="panel-body">
                    <p>Esperamos que vuelvas pronto <?php echo $nombre_socio?>.</p>
                    <br>
                    <div class="text-center">
                        <a href="<?php echo RUTA_LOGIN ?>">Iniciar sesión</a>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="<?php echo RUTA_REGISTRO ?>">Registrarse</a>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-3"></div>

    </div>
</div>


