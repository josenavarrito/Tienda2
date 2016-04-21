<h1>Pagina para agregar productos</h1>
<div class="container" id="sesion">
    <?php
    echo form_open(base_url()."Administrador/Insertarproducto");
    ?>
        <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="login">
                <form class="form-signin" role="form">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombres">
                    <input type="text" class="form-control" placeholder="precio" name="precios">
                    <input type="text" class="form-control" placeholder="descripcion" name="descripciones">
                    <input type="text" class="form-control" placeholder="cantidad" name="cantidades">
                    <select class="form-control" name="categorias">
                        <option value="" selected="selected">-  Categoria  -</option>
                        <option value="1">Aceites</option>
                        <option value="2">Champús</option>
                        <option value="3">Peines</option>
                        <option value="4">Ceras</option>
                        <option value="5">Bálsamos</option>
                        <option value="6">Kits</option>
                    </select>
                    <input type="text" class="form-control" placeholder="descuentos" name="descuentos">
                    <input type="text" class="form-control" placeholder="codigo" name="codigos">
                    <input type="text" class="form-control" placeholder="iva" name="ivas">
                   destacado <input type="checkbox" class="form-control" name="destacado">
                    <input type="date" class="form-control" placeholder="fecha de inicio" name="fecha_i">
                    <input type="date" class="form-control" placeholder="fecha final" name="fecha_f">
                    oculto<input type="checkbox" class="form-control" placeholder="oculto" name="ocultos">
                    <input type="text" class="form-control" placeholder="anuncio" name="anuncios">
                    <input type="file" class="form-control" placeholder="url de la imagen" name="imagenes">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    <div>
        <?php echo validation_errors(); ?>
    </div>
    <?php echo form_close(); ?>
    </div>