<div class="tipoDocumentos view">
<h2><?php  __('Tipo Documento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDocumento['TipoDocumento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDocumento['TipoDocumento']['nombre']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipo Documento', true), array('action' => 'edit', $tipoDocumento['TipoDocumento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipo Documento', true), array('action' => 'delete', $tipoDocumento['TipoDocumento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoDocumento['TipoDocumento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Documentos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Documento', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventory Movements', true), array('controller' => 'inventory_movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('controller' => 'inventory_movements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Inventory Movements');?></h3>
	<?php if (!empty($tipoDocumento['InventoryMovement'])):?>
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
		foreach ($tipoDocumento['InventoryMovement'] as $inventoryMovement):
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
