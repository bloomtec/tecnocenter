<div class="content_wrap">
	<div id="product_showcase">
		<h1><?php echo $product['Product']['nombre']; ?></h1>
		<span class="separador_horizontal"></span>
		<div class="product_photo">
			<?php echo $this->Html->image($product["Product"]['imagen_principal']) ?>
		</div>
	</div>
	<span class="detail_tittle">Detalles del producto</span>
	<div class="detail">
		<p><?php echo $product['Product']['descripcion']; ?></p>
		<?php echo $this->Html->para("precio color","$".number_format($product["Product"]["valor_venta"], 0, ' ', '.')) ?>
		<?php if ($product['Product']['inventario']){
				echo $this->Html->para("boton-compra".$product["Product"]["id"],"comprar") ;
				}else{
					echo "<span class='agotado'> Producto Agotado </span>";
				}
			?>
	</div>
	
</div>
