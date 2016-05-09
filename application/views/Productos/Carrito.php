<table cellpadding="6" cellspacing="1" style="width:90%" border="0">

<tr>
  <th>Cantidad</th>
  <th>Description</th>
  <th style="text-align:right">Precio</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>
	<?=form_hidden($i.'[rowid]', $items['rowid']);?>

	<tr>
	  <td><?=$items['qty']; ?></td>
	  <td>
              <a href="Producto?id=<?=$items['id']; ?>"><?=$items['name']; ?></a>

	  </td>
	  <td style="text-align:right"><?=$this->cart->format_number($items['price']); ?></td>
	  <td style="text-align:right">$<?=$this->cart->format_number($items['subtotal']); ?></td>
          <td><button><a href="Elimina_producto_carrito?id=<?=$items['rowid']; ?>">Eliminar</a></button></td>
	</tr>

<?php $i++; ?>

<?php endforeach; ?>
<a href="<?=$_SERVER['HTTP_REFERER'] ?>" class="btn btn-primary">Volver</a>
<tr>
  <td colspan="2"> </td>
  <td class="right"><strong>Total</strong></td>
  <td class="right">$<?=$this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

<p><a class="btn btn-primary" role="button" href="#">Comprar</a>
<a class="btn btn-primary" role="button" href="Destruir_Carrito">Borrar</a>
</p>