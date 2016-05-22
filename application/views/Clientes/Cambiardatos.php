<div class="container">
    <?=form_open(site_url()."/Cliente/Micuenta/guardacambios");
    ?>
    <h1>Cambiar Datos</h1>    
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <p>Nombre de Usuario</p>
                <p>Nombre</p>
                <p>Apellidos</p>
                <p>DNI</p>
                <p>Direccion</p>
                <p>Codigo Postal</p>
                <p>Provincia</p>
                <p>Email</p>
            </div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <?php
                        foreach ($dato as $datos)
                        {?>
                    <input type="text" class="form-control" value="<?php if(isset($datos['nombreusuario'])){ echo $datos['nombreusuario'];}else{ echo"";}?>" name="nombreusuario">
                    <input type="text" class="form-control" value="<?php if(isset($datos['nombre'])){ echo $datos['nombre'];}else{ echo"";}?>" name="nombre">
                    <input type="text" class="form-control" value="<?php if(isset($datos['apellidos'])){ echo $datos['apellidos'];}else{ echo"";}?>" name="apellido">
                    <input type="text" class="form-control" value="<?php if(isset($datos['dni'])){ echo $datos['dni'];}else{ echo"";}?>" name="dni">
                    <input type="text" class="form-control" value="<?php if(isset($datos['direccion'])){ echo $datos['direccion'];}else{ echo"";}?>" name="direccion">
                    <input type="text" class="form-control" value="<?php if(isset($datos['cp'])){ echo $datos['cp'];}else{ echo"";}?>" name="cp">
                    <select name="provincia" class="form-control">
                        <option>Provincia</option>
                    <?php foreach ($provincia as $prov){ 
                        if($datos['provincia']==$prov['cod'])
                        {?>
                        <option selected="" value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                    <?php }
                        else{?>
                        <option value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                    <?php }}; ?>
                    </select>
                    <input id="txtEmail" type="text" class="form-control" value="<?php if(isset($datos['correo_electronico'])){ echo $datos['correo_electronico'];}else{ echo"";}?>" name="email">
                    <?php } ?>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Guardar Cambios</button>
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