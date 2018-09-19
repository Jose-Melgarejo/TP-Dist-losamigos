<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioSocio.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR); //Si ya inicio sesion el usuario, lo echamos de la pantalla de login y lo redirigimos.
}

if (isset($_POST['login'])){
    Conexion::abrir_conexion();
    
    $validador = new ValidadorLogin($_POST['mail'],$_POST['clave'], Conexion::getConexion());
    
    if ($validador->obtener_error() === '' && !is_null($validador->obtener_socio())){
        ControlSesion::iniciar_sesion(
                $validador->obtener_socio()->getId(),
                $validador->obtener_socio()->getNombre());
        Redireccion::redirigir(SERVIDOR);
        
    }
    
    Conexion::cerrar_conexion();
}
    
$titulo = 'Login';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>Iniciar sesión</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <label for="mail" class="sr-only">Mail</label> <!--Sirve para que gente no vidente su sistema pueda leerle y diga mail-->
                        <input type="email" name="mail" id="mail" class="form-control" placeholder="Mail" 
                               <?php
                               if (isset($_POST['login']) && isset($_POST['mail']) && !empty($_POST['mail'])){
                                   echo 'value="'.$_POST['mail'].'"';
                               }
                               ?>
                               required autofocus>
                        <br>
                        <label for="clave" class="sr-only">Clave</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <?php
                        if(isset($_POST['login'])){
                            $validador->mostrar_error();
                        }
                        ?>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                            Iniciar sesión
                        </button>
                        <br>
                        <br>
                        <div class="text-center">
                            <a href="<?php echo RUTA_REGISTRO ?>">¿Aún no estás registrado?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
            
    </div>
</div>


