<table class="pedido" width="1000px">
    <tr class="tr-pedido">
        <td>Producto</td>
        <td>Descripcion</td>
        <td>Cantidad</td>
        <td>Total</td>
    </tr>
    <?php 
foreach ($pedidos as $pedido) {
    echo "<tr>";
    echo "<td class='producto'><a href='".site_url()."/Productos/Producto?id=".$pedido['id']."'>"
            . "<img src='".base_url()."assets/imagenes/productos/".$pedido['imagen']."'></a></td>";
    echo "<td><a href='".site_url()."/Productos/Producto?id=".$pedido['id']."'>".$pedido['nombre']."</a></td>";
    echo "<td>".$pedido['cantidad']."</td>";
    echo "<td>".$pedido['precio']*$pedido['cantidad']."€</td>";
    echo"</tr>";
}
?>
</table>