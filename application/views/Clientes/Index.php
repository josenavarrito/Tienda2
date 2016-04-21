<div class="container" id="sesion">
    <?php
    echo form_open(base_url().$direccion);
    if(isset($_POST['compra']))
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
                    <input id="txtEmail" type="email" class="form-control" placeholder="Email" name="email">
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
    <?php echo form_close(); ?>
    </div>
