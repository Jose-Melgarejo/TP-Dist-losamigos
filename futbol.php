<?php
$titulo = 'Los Amigos | Fútbol';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    
} else {
    Redireccion::redirigir(RUTA_LOGIN);
}
?>

<div id="portada-futbol">

</div>

<div class="container">

    <div class="page-header">
        <h1>Fútbol <small>Reservá tu turno <span class="glyphicon glyphicon-check" aria-hidden="true"></small></span></h1>
    </div>
</div>
<br>
<div class="container">

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <li class="list-group-item list-group-item-danger">Vestibulum at eros</li>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <li class="list-group-item list-group-item-danger">Vestibulum at eros</li>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-info">Cras sit amet nibh libero</a>
        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
    </div>

</div>


<?php
include_once './plantillas/documento-cierre.inc.php';
?>


