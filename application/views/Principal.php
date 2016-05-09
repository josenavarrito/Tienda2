<div>
    <h1>Bienvenido a MuchBeard</h1>
    <table><tr><td>
<div id="portada">

<image id="barba" src="<?=base_url();?>/assets/imagenes/barba.png">
</div>
          </td><td>
    <h1>Productos destacados</h1>
    <div id="destacados">
     <?php
    foreach ($hola as $producto) { ?>
  <div class="col-sm-4 col-md-5">
    <div class="thumbnail">
      <div class="fotos">
      <img src="<?=base_url();?>/assets/imagenes/productos/<?php echo $producto['imagen'];?>"
         alt="grandpa">
      </div>
      <div class="caption">
        <h3><?php echo $producto['nombre'];?></h3>
        <p><?php echo $producto['precio'];?>€</p>
        <p>
          <a href="Productos/Producto?id=<?php echo $producto['id_productos'];?>" class="btn btn-primary" role="button">Ver producto</a>
          <a href="Productos/Anadir_Carrito?id=<?php echo $producto['id_productos'];?>" class="btn btn-primary" role="button">Añadir a la cesta</a>
        </p>
      </div>
    </div>
  </div>
    <?php };?>
        </div>
    </td>
    </tr>
    </table>
</div>