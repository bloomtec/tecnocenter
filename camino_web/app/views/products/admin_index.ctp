<div class="products">
	<h2><?php __('Productos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('Categoría','category_id');?></th>
			<th><?php echo $this->Paginator->sort("Fabricante",'manufacturer_id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('Código','codigo');?></th>
			<th><?php echo $this->Paginator->sort('Stock','inventario');?></th>
		
	

			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($products as $product):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td>
			<?php echo $product['Category']['nombre']; ?>
		</td>
		<td>
			<?php echo $product['Manufacturer']['nombre']; ?>
		</td>
		<td><?php echo $product['Product']['nombre']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['codigo']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['inventario']; ?>&nbsp;</td>

		<td class="actions_icons">
			
		
			
		
			<?php echo $this->Html->image(("ver.gif"),array("title"=>'Ver detalle',"title"=>'Ver detalle',"url"=>array('action' => 'view', $product['Product']['id']))); ?>


			<?php echo $this->Html->image(("mostrar.png"),array("alt"=>'mostrar',"title"=>'Visualizar',"url"=>array('action' => 'visualizar', $product['Product']['id']))); ?>
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'Editar',"url"=>array('action' => 'edit', $product['Product']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')), array('action' => 'delete', $product['Product']['id']),array('escape'=>false), sprintf(__('Esta seguro que desea eliminar el producto?', true), $product['Product']['id'])); ?>
			<?php //echo $this->Html->link(__('Desactivar', true), array('action' => 'desactivar', $product['Product']['id']), null, sprintf(__('En realidad quiere desactivar el producto # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% datos de %count% en total, empezando por el dato %start%, terminando en %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
