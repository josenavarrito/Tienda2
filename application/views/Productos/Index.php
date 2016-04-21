<div class="row">
    <div>
    <?php
    echo $this->pagination->create_links();
    echo form_close();
    if($lista=="")
    {
        echo "<h1>Actualmente no tenemos productos de esta categoria</h1>";
    ?>
    </div>
    <?php
    }
    else{
    echo form_open(base_url()."Productos/Producto");
    foreach ($lista as $producto) { ?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="fotos">
      <img src="<?php echo base_url();?>../assets/imagenes/productos/<?php echo $producto->imagen;?>"
         alt="grandpa">
      </div>
      <div class="caption">
        <h3><?php echo $producto->nombre;?></h3>
        <p><?php echo $producto->precio;?>€</p>
        <p>
          <a href="Producto?id=<?php echo $producto->id_productos;?>" class="btn btn-primary" role="button">Ver producto</a>
          <a href="Anadir_Carrito?id=<?php echo $producto->id_productos;?>" class="btn btn-primary" role="button">Añadir a la cesta</a>
        </p>
      </div>
    </div>
  </div>
    <?php };};?>
</div>