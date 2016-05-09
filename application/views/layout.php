<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Prueba de Hola mundo</title>

    <!-- Bootstrap -->
    <link href="<?=base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="<?=base_url();?>/assets/css/micss.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target="#barra-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" href="<?=site_url();?>">
          <image src="<?=base_url();?>/assets/imagenes/bigote.png" width="60px"></a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="navbar-collapse collapse" id="barra-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown" class="menu">
           <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cuenta
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <?php $sesion=$this->session->userdata('email');
                    if($sesion=="desconocido"||$sesion==""){ ?>
          <li><a href="<?=site_url();?>/Cliente/">Iniciar Sesion</a></li>
          <li class="divider"></li>
          <li><a href="<?=site_url();?>/Cliente/Agregar">Registrarse</a></li>
            <?php } else{ ?>
            <li><a href="<?=site_url();?>/Cliente/Micuenta">Mi Cuenta</a></li>
            <li><a href="<?=site_url();?>/Cliente/Cerrar">Cerrar sesion</a></li>
            <?php } ?>
        </ul>
      </li>
      <li class="dropdown" class="menu">
           <a class="dropdown-toggle" data-toggle="dropdown" href="#">Productos
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?=site_url();?>/Productos/">Todos</a></li>
          <li class="divider"></li>
          <li>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorias
                  <b class="glyphicon glyphicon-triangle-right"></b>
              </a>
              <ul class="dropdown-menu">
                  <?php 
                  $this->load->model('Producto');
                  $categorias=$this->Producto->Categorias();
                  foreach ($categorias as $cat)
                  {?>
                  <li><a href="<?=site_url('/Productos/Categoria/'.$cat['id']);?>"><?=$cat['nombre'];?></a></li>
                  <?php
                  }
                  ?>
              </ul>
          </li>
        </ul>
      </li>
      <li><a href="<?=site_url();?>/Principal/Empresa">¿Quienes Somos?</a></li>
    </ul>
      <form class="navbar-form navbar-left" role="search" method="get" 
            action="<?=site_url();?>/Productos/Buscar">
      <div class="form-group">
        <input type="text" name="nombre" class="form-control" placeholder="Buscar Producto">
      </div>
      <button type="submit" class="btn btn-default">Enviar</button>
      <a class="btn btn-primary" href="<?=site_url();?>/Productos/Ver_Carrito">Ver Carrito</a>
    </form>
      <p class="usuario"><?= $sesion; ?></p>
      
  </div>
  </div>
</nav>
  <center>
            <div class="bloque"><?=$cuerpo?></div>
<footer>
<div>
&copy 2016-Todos los derechos reservados
</div>
</footer>
</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=base_url();?>/assets/js/bootstrap.min.js"></script>
  </body>
</html>