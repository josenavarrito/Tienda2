<div class="row">
    <?php
    echo form_open(base_url()."Productos/Anadir_Carrito");
    foreach ($hola as $producto) { ?>
  <div>
        <div class="imagen">
      <img src="<?php echo base_url();?>../assets/imagenes/productos/<?php echo $producto['imagen'];?>"
         alt="grandpa">
      </div>
      <div class="datos">
        <h1><?php echo $producto['nombre'];?></h1>
        <h3><?php echo $producto['precio'];?>€</h3>
        <p><?php echo $producto['descripcion'];?></p>
        <p>
            <input class="btn numero" name="cantidad" type="number" value="1" min="1" max="<?php echo $producto['cantidad'];?>">
            <input type="hidden" name="id" value="<?php echo $producto['id_productos'];?>">
          <input type="submit" class="btn btn-primary" value="Añadir a la Cesta">
        </p>
      </div>
  </div>
    <?php };
    echo form_close();
    ?>
</div>