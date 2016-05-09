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
<div class="container" id="sesion">
    <?=form_open(base_url()."Cliente/Agregacliente");
    ?>
        <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                    <input type="text" class="form-control" placeholder="Apellidos" name="apellido">
                    <input type="text" class="form-control" placeholder="DNI" name="dni">
                    <input type="text" class="form-control" placeholder="Direccion" name="direccion">
                    <input type="text" class="form-control" placeholder="Codigo Postal" name="cp">
                    <select name="provincia" class="form-control">
                        <option>Provincia</option>
                    <?php foreach ($provincia as $prov){ ?>
                        <option value="<?=$prov['cod']; ?>"><?=$prov['nombre']; ?></option>";
                    <?php } ?>
                    </select>
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" name="nombre_usuario">
                    <input id="txtEmail" type="text" class="form-control" placeholder="Email" name="email">
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