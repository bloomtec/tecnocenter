<div class="images">	
	<?php foreach(	$productosDestacados as $product):?> 
	<div class="producto_destacado">
			<?php echo $this->Html->tag('span',$product["Product"]["nombre"],"destacado color") ?>
			<div class="descripcion_producto">
			<?php 
			if(strlen($product["Product"]["descripcion"])>150){
		    	echo $this->Html->para("",substr($product["Product"]["descripcion"],0,150)."...");
			}else{
				echo $this->Html->para("",$product["Product"]["descripcion"]);
			}
			?>
			</div>
			
			<div class="compra_producto">
				<div class=" boton_comprar color">
					<span class="compra"><?php echo $html->link($html->image("detalle.png"),array("controller"=>"products","action"=>"view",$product["Product"]["id"]),array('escape' => false));?></span>
				</div>
			</div>
			<?php echo $this->Html->image($product["Product"]["imagen_destacar"]) ?>
	</div>
	<?php endforeach;?>
	
</div>	
<div class="slidetabs">
    <?php foreach(	$productosDestacados as $product):?> 
	<a href="#"></a>
	<?php endforeach;?>
    
</div>

<script language="JavaScript">
		// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready

		$(function() {
		
			$(".slidetabs").tabs(".images > div", {
			
			// enable "cross-fading" effect
			effect: 'fade',
			fadeOutSpeed: "slow",
			
			// start from the beginning after the last tab
			rotate: true,
			
			
			// use the slideshow plugin. It accepts its own configuration
			}).slideshow({clickable:false,autoplay:true});
		});
</script>