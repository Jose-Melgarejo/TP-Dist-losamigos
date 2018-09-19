<?php
$titulo = 'Página de registro';

include_once './plantillas/documento-declaracion.inc.php';
include_once './app/Socio.inc.php';
include_once './plantillas/navbar.inc.php';
include_once './app/ValidadorRegistro.inc.php';
include_once './app/Redireccion.inc.php';


if (isset($_POST['enviar'])){
    Conexion::abrir_conexion();
    
    $validador = new ValidadorRegistro($_POST['nombre'],$_POST['apellido'],$_POST['mail'],$_POST['clave1'], $_POST['clave2'],Conexion::getConexion());   

    if ($validador->registro_valido()){
        //$nombre_del_usuario = $validador->obtener_nombre();
        //$id,$nombre,$apellido,$direccion,$telefono,$mail,$clave,$fecha_registro
        $socio = new Socio('',$validador->obtener_nombre(),
                $validador->obtener_apellido(),
                '','',
                $validador->obtener_mail(),
                password_hash($validador->obtener_clave(),PASSWORD_DEFAULT),
                '');
        $socio_insertado = RepositorioSocio::insertar_socio(Conexion::getConexion(),$socio);
        
        if ($socio_insertado) {
            //Redirigir a registro_correcto
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO.'?apellido='.$socio->getApellido());
        }
    }
    
    Conexion::cerrar_conexion();
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Registro de usuario
                    </h3>
                </div>
                <div class="panel-body">
                    <br>
                    <p class="text-justify">
                        Para unirte al Club Polideportivo Los Amigos, introducí los datos solicitados en el formulario.
                    </p>
                    <br>
                    <a href="<?php echo RUTA_LOGIN?>">¿Ya tenés cuenta?</a>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Complete el formulario
                    </h3>
                </div>
                <div class="panel-body">
                    
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <?php
                        if (isset($_POST['enviar'])){
                            include_once './plantillas/registro_validado.inc.php';
                        }
                        else{
                            include_once './plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>
