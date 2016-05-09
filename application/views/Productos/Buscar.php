<div class="row">
    <div>
    <?php
    echo form_close();
    ?>
    </div>
    <?php
    echo form_open(site_url()."/Productos/Anadir_Carrito");
    foreach ($hola as $producto) { ?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="fotos">
      <img src="<?=base_url();?>/assets/imagenes/productos/<?=$producto['imagen'];?>"
         alt="grandpa">
      </div>
      <div class="caption">
        <h3><?=$producto['nombre'];?></h3>
        <p><?=$producto['precio'];?>€</p>
        <p>
            <input type="hidden" name="id" value="<?=$producto['id_productos'];?>">
          <a href="Producto?id=<?=$producto['id_productos'];?>" class="btn btn-primary" role="button">Ver producto</a>
          <input type="submit" class="btn btn-primary" value="Añadir a la Cesta">
        </p>
      </div>
    </div>
  </div>
    <?php };?>
</div>