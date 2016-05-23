<div class="container" id="sesion">
    <h1>Inicio de Sesión</h1>
    <?=form_open(site_url()."/Cliente/Comprobarcliente");
    if(isset($compra))
    {
        ?>
    <input type="hidden" name="compra" value="1">
    <?php
    }
        
    ?>
        <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <div class="text-center">
                    </div>
                    <input id="txtEmail" type="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo "";}?>" class="form-control" placeholder="Email" name="email">
                    <input type="password" class="form-control" placeholder="Password" name="contrasena">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
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
