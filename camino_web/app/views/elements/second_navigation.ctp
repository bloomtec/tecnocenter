<div id="second-navigation">
  <div id="left-header">
  <div class="separ sprite separador_nav color">
    <div class="icon sprite carrito_compras"></div><div class="separ_tittle">Canasta de compras</div>
    
  </div>
  <?php $shopCart=$session->read("shopCart");?>
  	<div id="items"> Items : <span> <?php if(isset($shopCart["count_items"]))echo $shopCart["count_items"]; else echo "0";?></span></div>
    <div id="valor"> Valor: <span> <?php if(isset($shopCart["total"]))echo $shopCart["total"]; else echo "0";?></span></div>
 	<div id="detalle"><?php echo $html->link("Ver canasta",array("controller"=>"products","action"=>"viewShopCart")); ?></div>
  </div>   
  <div id="left-content">
  	<div class="separ sprite separador_nav color">
    	<div class="separ_tittle">Productos</div>
    </div>
    <div class="button_wrap_productos">
	  	<ul class="second_nav">
		    <?php foreach($menuCategories as $menuCategory):?> 
		    <li> <?php echo $this->Html->link($menuCategory["Category"]["nombre"],array("controller"=>"categories","action"=>"view",$menuCategory["Category"]["id"])) ?></li>
		    <?php endforeach;?>
		    <?php if(count($otherCategories)>0):?>
		    <li><a>Otros</a>
		    	<div class="sprite triangulo_tooltip punta_tooltip"></div>
		    	
		    	<div class="punta_tooltip tooltip">
		    		<div class="tooltip_menu">
		    			<ul class="tooltip_nav">
		    				<?php foreach($otherCategories as $menuCategory):?> 
		    				<li> <?php echo $this->Html->link($menuCategory["Category"]["nombre"],array("controller"=>"categories","action"=>"view",$menuCategory["Category"]["id"])) ?></li>
		    				<?php endforeach;?>
		    			</ul>
		    		</div>
		    	</div>
		    </li>
		   <?php endif; ?>
	    </ul>
   </div>
   <div class="separ sprite separador_nav color">
    	<div class="separ_tittle">Servicios</div>
   </div>
   <div class="button_wrap_servicios">
	  	<ul class="second_nav">
	  		<?php foreach($menuServices as $menuService):?> 
		    <li> <?php echo $this->Html->link($menuService["Service"]["nombre"],array("controller"=>"services","action"=>"view",$menuService["Service"]["id"])) ?></li>
		    <?php endforeach;		    ?>
		    <?php if(isset($otherServices)&&count($otherServices)>0):?>
		    <li><a>Otros</a>
		    	<div class=" sprite triangulo_tooltip punta_tooltip"></div>
		    	<div class="punta_tooltip tooltip">
		    		<div class="tooltip_menu">
		    			<ul class="tooltip_nav">
		    				<?php foreach($otherServices as $menuService):?> 
		    				<li> <?php echo $this->Html->link($menuService["Service"]["nombre"],array("controller"=>"services","action"=>"view",$menuService["Service"]["id"])) ?></li>
		    				<?php endforeach;?>
		    			</ul>
		    		</div>
		    	</div>
		    </li>
		    <?php endif; ?>
	    </ul>
   </div>
  <div class="separ sprite separador_nav color">
    	<div class="separ_tittle">Promociones</div>
   </div>  
   <ul class="promocion_nav">	
		<?php $productosPromocionados=$this->requestAction("/products/promocionados");?>
    	<?php foreach(	$productosPromocionados as $product):?> 
			<li> <?php echo  $html->link($this->Html->image($product["Product"]["imagen_listado"]),array("controller"=>"products","action"=>"view",$product["Product"]["id"]),array('escape' => false));?> </li>
		<?php endforeach;?>
    </ul>
     
    <div class="separ sprite separador_nav color">
    	<div class="separ_tittle">Encuestas</div>
   </div>  
	<?php echo $this->element("encuesta");?>
	<div style="clear:both"></div>
  </div>
  
</div>