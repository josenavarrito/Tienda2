<div class="container" id="sesion">
    <?=form_open(site_url()."/Cliente/Micuenta/guardacontrasena");
    ?>
    <h1>Cambiar Contraseña</h1>    
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <p>Nombre de Usuario</p>
                <p>Contraseña actual</p>
                <p>Nueva Contraseña</p>
            </div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <?php foreach ($dato as $datos) { ?>
                    <input disabled="" type="text" class="form-control" value="<?php if(isset($datos['nombreusuario'])){ echo $datos['nombreusuario'];}else{ echo"";}?>" name="nombre_usuario">
                    <?php } ?>
                    <input type="password" class="form-control" name="contrasenaactual">
                    <input type="password" class="form-control" name="nuevacontrasena">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Guardar cambios</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    <div>
        <?php
        echo validation_errors();
        echo @$error;
        ?>
    </div>
    <?=form_close(); ?>
    </div>