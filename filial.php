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
        $filial = RepositorioFilial::obtener_filial_por_id(Conexion::getConexion(),$id_filial);
        
        Conexion::cerrar_conexion();
        
        if (isset($filial)){
            $titulo = 'Los Amigos | Filial '.$filial->getNombre();
        }else{
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
        <h1><?php echo $filial->getNombre();?><small> Loren ipsum dolor</small></span></h1>
    </div>
</div>
<br>
<div class="container">



</div>


<?php
include_once './plantillas/documento-cierre.inc.php';
?>


