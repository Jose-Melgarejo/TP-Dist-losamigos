<?php
include_once './app/Conexion.inc.php';
include_once './app/ControlSesion.inc.php';
include_once './app/config.inc.php';



?>

<nav id="barra" class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este botón despliega la barra de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SERVIDOR ?>">Los Amigos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo RUTA_FUTBOL ?>"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Fútbol</a></li>
                <li><a href="<?php echo RUTA_BASQUET ?>"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Básquet</a></li>
                <li><a href="<?php echo RUTA_TENIS ?>"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Tenis</a></li>
            </ul> <!-- lista desordenada -->
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php echo ' ' . $_SESSION['nombre_socio']; ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Gestor <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    Mi perfil
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Lorem ipsum
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Dolor sit
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Amet consecutur
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_LOGOUT ?>">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar sesión
                        </a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li><a href="<?php echo RUTA_LOGIN ?>"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar sesión</a></li>
                    <li><a href="<?php echo RUTA_REGISTRO ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro</a></li>
                    <?php }
                    ?>
            </ul>
        </div>
    </div>
</nav>
