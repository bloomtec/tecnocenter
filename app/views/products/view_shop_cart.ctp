<div id="content_wrap" class="view-shop-cart">
<script type="text/javascript">
 var checkout=true;
</script>
<?php
$userId=$session->read("Auth.User.id"); 
	if(!$userId): 

?>
<script type="text/javascript">
 var checkout=false;
</script>
<p class="fondeado"> 
	Debes registrarte para poder realizar compras online, recuerda que una vez registrado tambien tendras otros beneficios como: Acceso al Chat On-Line para que despejes tus dudas con un aseso y productos en promoción 
	<?php echo $html->link("registrate ya!",array("controller"=>"users","action"=>"register"));?>
</p>
<?php endif;?>
<?php if(isset($shopCart["items"])):?>
<?php echo $form->create("OnlineSales",array("action"=>"checkout")); ?>
<table cellpadding="0" cellspacing="0">
	<tr>
	
			<th>Nombre</th>
			<th>Imagen</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Valor</th>
			<th></th>
			
	</tr>

<?php $totalVenta=0;
      $totalIva=0;
	  $total=0;
	  $cantidad=0;
	foreach($shopCart["items"] as $item): 
		$cantidad+=$item["cantidad"];
		$total+=$item["valor_venta"];
		
	?>
	
	<tr rel="<?php echo $item["id"];?>">
		
		<td> <?php echo $item["nombre"]; ?></td>
		<td> <?php echo $html->image($item["imagen_listado"]); ?></td>
		<td> <?php echo "$".number_format($item["valor_venta"], 0, ' ', '.');?></td>
		<td class="datos">
			 <?php echo $form->input("OnlineSale.".$item["id"].".cantidad",array("type"=>"number","max"=>$item["inventario"],"label"=>false,"value"=>$item["cantidad"],"class"=>"cantidadDetallecompra","div"=>false)); ?>
			<?php echo $form->input("Control.".$item["id"].".precio",array("type"=>"hidden","value"=>$item["valor_venta"],"class"=>"valorDetallecompra")); ?>
		</td>
		<td> <?php echo "$".number_format($item["cantidad"]*$item["valor_venta"], 0, ' ', '.'); ?></td>
		<td> <div class="eliminar">eliminar</div></td>
	</tr>		
<?php endforeach;?>

	<tr class="last">
			<th>Valor Total</th>
			<th></th>
			<th></th>
			<th class="cantidad">
				<?php echo $cantidad;?>
			</th>

			<th class="valor"> 
				<?php echo number_format($total, 0, ' ', '.');?>
			</th>
			<th> </th>
			
			
	</tr>
</table>
<?php echo $form->end("checkout"); ?>
<?php endif; ?>
</div>
<script type="text/javascript">
$(function(){
	$("#OnlineSalesCheckoutForm").validator({lang: 'es', "position":"bottom right"});
});
</script>