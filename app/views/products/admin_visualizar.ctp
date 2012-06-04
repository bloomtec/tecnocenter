<div id="productos" class="products visualizar">
<div class="destacados">
	<h1>En slide</h1>
	<div class="images">	
		
		<div class="producto_destacado">
				<?php echo $this->Html->tag('span',$product["Product"]["nombre"],"destacado color") ?>
				<div class="descripcion_producto">
				<?php echo $this->Html->para("",$product["Product"]["descripcion"]);?>
				</div>
				<div class="compra_producto">
					<div class="sprite boton_comprar color">
						<span class="compra"><?php echo $html->link("DETALLE",array("controller"=>"products","action"=>"view",$product["Product"]["id"]));?></span>
					</div>
				</div>
				<?php echo $this->Html->image($product["Product"]["imagen_listado"]) ?>
		</div>
	
		
	</div>	

	
</div>
<div class="listado">
	<h1>En listado</h1>
	<ul class="productos_nav">
	<?php  $i=0;?> 
	    <li>
	    	<div class="producto <?php if($i%3==0) echo "inicio"?>">
		    	<?php echo $this->Html->image($product["Product"]["imagen_listado"]) ?>
		    	<?php echo $this->Html->para("producto_titulo color",$product["Product"]["nombre"]) ?>
		    	<?php
		    		if(strlen($product["Product"]["descripcion"])>90){
		    			echo $this->Html->para("descripcion",substr($product["Product"]["descripcion"],0,90)."...");
					}else{
						echo $this->Html->para("descripcion",$product["Product"]["descripcion"]);
					}
		     	 ?>
		    	<?php echo $this->Html->para("precio color","$".number_format($product["Product"]["valor_venta"], 0, ' ', '.')) ?>
		    	<?php echo $this->Html->para("boton-compra".$product["Product"]["id"],"comprar") ?>		
	    	</div> 
	    </li>		
	</ul>	
</div>
<div style="clear:both;"></div>	
</div>

<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
</div>
