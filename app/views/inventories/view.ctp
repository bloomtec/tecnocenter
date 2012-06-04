<div class="inventories view">
<h2><?php  __('Inventory');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inventory['Product']['nombre'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provider'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inventory['Provider']['nit_proveedor'], array('controller' => 'providers', 'action' => 'view', $inventory['Provider']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inventory['Inventory']['stock']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory', true), array('action' => 'edit', $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Inventory', true), array('action' => 'delete', $inventory['Inventory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers', true), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider', true), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventory Movements', true), array('controller' => 'inventory_movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('controller' => 'inventory_movements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Inventory Movements');?></h3>
	<?php if (!empty($inventory['InventoryMovement'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Inventory Id'); ?></th>
		<th><?php __('Tipo Documento Id'); ?></th>
		<th><?php __('Tipo Movimiento Id'); ?></th>
		<th><?php __('Detalle'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($inventory['InventoryMovement'] as $inventoryMovement):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $inventoryMovement['id'];?></td>
			<td><?php echo $inventoryMovement['inventory_id'];?></td>
			<td><?php echo $inventoryMovement['tipo_documento_id'];?></td>
			<td><?php echo $inventoryMovement['tipo_movimiento_id'];?></td>
			<td><?php echo $inventoryMovement['detalle'];?></td>
			<td><?php echo $inventoryMovement['created'];?></td>
			<td><?php echo $inventoryMovement['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'inventory_movements', 'action' => 'view', $inventoryMovement['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'inventory_movements', 'action' => 'edit', $inventoryMovement['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'inventory_movements', 'action' => 'delete', $inventoryMovement['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inventoryMovement['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('controller' => 'inventory_movements', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
