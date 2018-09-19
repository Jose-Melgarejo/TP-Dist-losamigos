<?php
$titulo = 'Los Amigos | Tenis';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    
} else {
    Redireccion::redirigir(RUTA_LOGIN);
}
?>

<div id="portada-tenis">

</div>

<div class="container">

    <div class="page-header">
        <h1>Tenis <small>Reservá tu turno <span class="glyphicon glyphicon-check" aria-hidden="true"></small></span></h1>
    </div>

    <div class="dropdown" style="display: inline-block;margin-right:10px;">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Elegí una filial
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu1">
            <li><a href="#">Plaza Fútbol</a></li>
            <li><a href="#">Torres del Sol</a></li>
            <li><a href="#">Los Pinos</a></li>
        </ul>
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


