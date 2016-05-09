<div class="row">
    <?php
    echo form_open(site_url()."/Productos/Anadir_Carrito");
    foreach ($hola as $producto) { ?>
  <div>
        <div class="imagen">
      <img src="<?=base_url();?>/assets/imagenes/productos/<?=$producto['imagen'];?>"
         alt="grandpa">
      </div>
      <div class="datos">
        <h1><?=$producto['nombre'];?></h1>
        <h3><?=$producto['precio'];?>€</h3>
        <p><?=$producto['descripcion'];?></p>
        <p>
            <input class="btn numero" name="cantidad" type="number" value="1" min="1" max="<?=$producto['cantidad'];?>">
            <input type="hidden" name="id" value="<?=$producto['id_productos'];?>">
          <input type="submit" class="btn btn-primary" value="Añadir a la Cesta">
        </p>
      </div>
  </div>
    <?php };
    echo form_close();
    ?>
</div>