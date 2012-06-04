<div class="products">
<h2><?php  __('Producto'); 

	//debug($product) ?></h2>
	
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoría'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($product['Category']['nombre'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fabricante'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($product['Manufacturer']['nombre'], array('controller' => 'manufacturers', 'action' => 'view', $product['Manufacturer']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Código'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cod Barras'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['cod_barras']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Promocionar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['promocionar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Destacar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['destacar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ficha Producto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if(isset($product['Product']['ficha_producto']) && !empty($product['Product']['ficha_producto']) ) {
			echo $html->link("Ficha", "/img/".$product['Product']['ficha_producto'],array('target' => '_blank')); 
			}else {
				echo "No tiene ficha de producto";
			}
			
			?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imagenes '); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div class="view_image">
			<h2>Imagen Listado</h2>
			<?php echo $html->image($product['Product']['imagen_listado'], array("width"=>150)); ?>
			</div>
			<div class="view_image">
			<h2>Imagen Principal</h2>
			<?php echo $html->image($product['Product']['imagen_principal'], array("width"=>150)); ?>
			</div>
			<div class="view_image">
			<h2>Imagen destacar</h2>	
			<?php 
				if(!empty($product['Product']['imagen_destacar'])){
					echo $html->image($product['Product']['imagen_destacar'], array("width"=>150));		
				}else{
					echo $html->image("no_image.png", array("width"=>150));
				}  
			?>
			</div>
			<div class="view_image">
			<h2>Imagen Ficha tecnica</h2>
			<?php 
				if(!empty($product['Product']['imagen_ficha_tecnica'])){
					echo $html->image($product['Product']['imagen_ficha_tecnica'], array("width"=>200, "height"=>200));		
				}else{
					echo $html->image("no_image.png", array("width"=>150));
				}  
			?>
			</div>
			&nbsp;
			<div style="clear:both"></div>
		</dd>
		
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inventario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php $inventories= $this->requestAction("inventories/getInventory/".$product["Product"]["id"]); ?>
			<?php 
				$count=0;
				foreach($inventories as $inventory){
				 $count+=$inventory["Inventory"]["stock"];
				}
				echo $count;
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inventario Detallado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<table cellpadding="0" cellspacing="0">
		<tr>
	
				
				<th><?php echo ('Proveedor');?></th>
				<th><?php echo ('stock');?></th>
		</tr>
		<?php
		$j = 0;
		foreach ($inventories as $inventory):
			$class2 = null;
			if ($j++ % 2 == 0) {
				$class2 = ' class="altrow"';
			}
		?>
		<tr<?php echo $class2;?>>
		
			<td>
				<?php echo $inventory['Provider']['nit_proveedor']; ?>
			</td>
			<td><?php echo $inventory['Inventory']['stock']; ?>&nbsp;</td>
			
		</tr>
	<?php endforeach; ?>
		</table>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Mínimo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_minimo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Máximo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['stock_maximo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Costo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['costo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Costo Promedio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['costo_promedio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tarifa Iva'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['tarifa_iva']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor Iva'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['valor_iva']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('% Utilidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['porc_utilidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor Venta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['valor_venta']; ?>
			&nbsp;
		</dd>
	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rotación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['rotacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiempo Reposición'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['tiempo_reposicion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actualizado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
</div>