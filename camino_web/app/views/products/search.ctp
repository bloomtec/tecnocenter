<div id="content_wrap">
	<?php echo $this->element("slides");?>
	<div id="buscar_producto">
		<?php echo $form->create("Product",array("action"=>"search","controller"=>"searchs"));?>
            <fieldset>
              <?php echo $form->input("search",array("label"=>"Buscar productos:"), array('div' => false));?>
              <?php echo $form->submit(__('Buscar', true), array('div' => false));?>   
            </fieldset>
        <?php echo $form->end();?>
	</div>	
	<div id="productos">
		        <span class="separador_horizontal top"></span>
	    		<span class="separador_horizontal middle"></span>
	    		<span class="separador_horizontal bottom"></span>
			<ul class="productos_nav">
	    		<?php  			
	    			$i=0;
	    			foreach($products as $product):?> 
	    		<li>
	    			<div class="producto <?php if($i%3==0) echo "inicio"?>">
		    			<?php echo $this->Html->image($product["Product"]["imagen_listado"],array('url' => array('controller' => 'products', 'action' => 'view', $product["Product"]["id"]))) ?>
		    			<p class="producto_ficha color"><?php  if(!empty($product["Product"]["ficha_producto"])) echo $html->link("ver ficha tecnica","/app/webroot/img/".$product["Product"]["ficha_producto"]); ?></p>
		    			<?php echo $this->Html->para("producto_titulo color",$html->link($product["Product"]["nombre"],array('controller' => 'products', 'action' => 'view', $product["Product"]["id"]))) ?>
						<?php
		    				if(strlen($product["Product"]["descripcion"])>90){
		    					echo $this->Html->para("descripcion",substr($product["Product"]["descripcion"],0,90)."...");
							}else{
								echo $this->Html->para("descripcion",$product["Product"]["descripcion"]);
							}
		    			 	 ?>
		    			<?php echo $this->Html->para("precio color","$".number_format($product["Product"]["valor_venta"], 0, ' ', '.')) ?>
		    			<p class='boton-compra<?php echo$product["Product"]["id"] ?>'>Comprar</p>
		    			
	    			</div> 
	    		</li>
	    		<?php 
	    			$i++;
	    			endforeach;?>
    		</ul>
    	<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
			 | 	<?php echo $this->Paginator->numbers();?>
	 		 |
			<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>  
	</div>
	
</div>



