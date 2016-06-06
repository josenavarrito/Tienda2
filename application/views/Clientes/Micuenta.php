<table class="pedido" width="1000px">
    <tr class="tr-pedido">
        <td>Pedido</td>
        <td>Fecha</td>
        <td>Estado</td>
        <td>detalles</td>
        <td>Factura</td>
        <td>Anular</td>
    </tr>
    <?php 
    $count=0;
foreach ($pedidos as $pedido) {
    $count++;
    echo "<tr>";
    echo "<td>".$pedido['id']."</td>";
    echo "<td>".$pedido['fecha']."</td>";
    echo "<td>".$pedido['estado']."</td>";
    ?>
    <td><a href="<?=site_url();?>/Cliente/Verpedidos/<?=$pedido['id'];?>">Ver</a></td>
    <td><a href="#"><image src="<?=base_url();?>/assets/imagenes/pdf.png"></a></td>
    <td><a href="<?=site_url();?>/Cliente/Eliminarpedido/<?=$pedido['id'];?>"><image src="<?=base_url();?>/assets/imagenes/eliminar.png"></a></td>
    <?php
    echo"</tr>";
    echo $count;
}
if($count==0) $error="No Tienes Pedidos";
?>
</table>

<h3><?=@$error;?></h3>
