<div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?php $validador->mostrar_nombre()?>" required>
    <?php
    $validador->mostrar_error_nombre();
    ?>
</div>
<div class="form-group">
    <label>Apellido</label>
    <input type="text" class="form-control" name="apellido" value="<?php $validador->mostrar_apellido()?>" required>
    <?php
    $validador->mostrar_error_apellido();
    ?>
</div>
<div class="form-group">
    <label>Mail</label>
    <input type="email" class="form-control" name="mail" placeholder="usuario@dominio.com" value="<?php $validador->mostrar_mail()?>" required>
    <?php
    $validador->mostrar_error_mail();
    ?>
</div>
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="clave1" required>
    <?php
    $validador->mostrar_error_clave1();
    ?>
</div>
<div class="form-group">
    <label>Repite la contraseña</label>
    <input type="password" class="form-control" name="clave2" required>
    <?php
    $validador->mostrar_error_clave2();
    ?>
</div>
<br>
<button type="reset" class="btn btn-default">Limpiar formulario</button>
<button name="enviar" type="submit" class="btn btn-default">Enviar datos</button>
