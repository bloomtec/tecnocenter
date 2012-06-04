<div class="manufacturers view">
<h2><?php  __('Manufacturer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $manufacturer['Manufacturer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $manufacturer['Manufacturer']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $manufacturer['Manufacturer']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $manufacturer['Manufacturer']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manufacturer', true), array('action' => 'edit', $manufacturer['Manufacturer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Manufacturer', true), array('action' => 'delete', $manufacturer['Manufacturer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $manufacturer['Manufacturer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Manufacturers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manufacturer', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Products');?></h3>
	<?php if (!empty($manufacturer['Product'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Category Id'); ?></th>
		<th><?php __('Manufacturer Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Codigo'); ?></th>
		<th><?php __('Cod Barras'); ?></th>
		<th><?php __('Clasificacion'); ?></th>
		<th><?php __('Promocionar'); ?></th>
		<th><?php __('Destacar'); ?></th>
		<th><?php __('Ficha Producto'); ?></th>
		<th><?php __('Image Producto'); ?></th>
		<th><?php __('Inventario'); ?></th>
		<th><?php __('Stock Minimo'); ?></th>
		<th><?php __('Stock Maximo'); ?></th>
		<th><?php __('Costo'); ?></th>
		<th><?php __('Costo Promedio'); ?></th>
		<th><?php __('Tarifa Iva'); ?></th>
		<th><?php __('Valor Iva'); ?></th>
		<th><?php __('Porc Utilidad'); ?></th>
		<th><?php __('Valor Venta'); ?></th>
		<th><?php __('Estado Prod'); ?></th>
		<th><?php __('Rotacion'); ?></th>
		<th><?php __('Nit Proveedor'); ?></th>
		<th><?php __('Tiempo Reposicion'); ?></th>
		<th><?php __('Control Invent'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($manufacturer['Product'] as $product):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $product['id'];?></td>
			<td><?php echo $product['category_id'];?></td>
			<td><?php echo $product['manufacturer_id'];?></td>
			<td><?php echo $product['nombre'];?></td>
			<td><?php echo $product['codigo'];?></td>
			<td><?php echo $product['cod_barras'];?></td>
			<td><?php echo $product['clasificacion'];?></td>
			<td><?php echo $product['promocionar'];?></td>
			<td><?php echo $product['destacar'];?></td>
			<td><?php echo $product['ficha_producto'];?></td>
			<td><?php echo $product['image_producto'];?></td>
			<td><?php echo $product['inventario'];?></td>
			<td><?php echo $product['stock_minimo'];?></td>
			<td><?php echo $product['stock_maximo'];?></td>
			<td><?php echo $product['costo'];?></td>
			<td><?php echo $product['costo_promedio'];?></td>
			<td><?php echo $product['tarifa_iva'];?></td>
			<td><?php echo $product['valor_iva'];?></td>
			<td><?php echo $product['porc_utilidad'];?></td>
			<td><?php echo $product['valor_venta'];?></td>
			<td><?php echo $product['estado_prod'];?></td>
			<td><?php echo $product['rotacion'];?></td>
			<td><?php echo $product['nit_proveedor'];?></td>
			<td><?php echo $product['tiempo_reposicion'];?></td>
			<td><?php echo $product['control_invent'];?></td>
			<td><?php echo $product['created'];?></td>
			<td><?php echo $product['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products', 'action' => 'delete', $product['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
