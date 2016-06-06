<!--<div>
    <h1>Formulario de Registro</h1>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Nombre" name="nombre">
    </div>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Apellidos" name="apellido">
    </div>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="correo" name="correo">
    </div>
    <div class="input-group">
        <input type="submit" class="form-control" value="Enviar" name="correo">
    </div>
</div>-->
<h1>Formulario de Registro</h1>
<div class="container">
    <?=form_open(site_url()."/Cliente/Agregacliente");
    ?>
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <p>Nombre</p>
                <p>Apellidos</p>
                <p>DNI</p>
                <p>Direccion</p>
                <p>Codigo Postal</p>
                <p>Provincia</p>
                <p>Nombre de Usuario</p>
                <p>Email</p>
                <p>Contraseña</p>
            </div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre"
                    value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}else{echo "";}?>">
                    <input type="text" class="form-control" placeholder="Apellidos" name="apellido"
                    value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];}else{echo "";}?>">
                    <input type="text" class="form-control" placeholder="DNI" name="dni" 
                    value="<?php if(isset($_POST['dni'])){echo $_POST['dni'];}else{echo "";}?>">
                    <input type="text" class="form-control" placeholder="Direccion" name="direccion" 
                    value="<?php if(isset($_POST['direccion'])){echo $_POST['direccion'];}else{echo "";}?>">
                    <input type="text" class="form-control" placeholder="Codigo Postal" name="cp"
                    value="<?php if(isset($_POST['cp'])){echo $_POST['cp'];}else{echo "";}?>">
                    <select name="provincia" class="form-control">
                        <option>Provincia</option>
                    <?php foreach ($provincia as $prov){
                        if(isset($_POST['provincia'])){
                            if($_POST['provincia']==$prov['cod'])
                            {?>
                        <option selected="" value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                            <?php }
                            else
                                {?>
                                <option value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                            <?php }
                        } else{?>
                        <option value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                    <?php }} ?>
                    </select>
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" name="nombre_usuario"
                    value="<?php if(isset($_POST['nombre_usuario'])){echo $_POST['nombre_usuario'];}else{echo "";}?>">
                    <input id="txtEmail" type="text" class="form-control" placeholder="Email" name="email"
                    value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo "";}?>">
                    <input type="password" class="form-control" placeholder="Password" name="contrasena">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
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