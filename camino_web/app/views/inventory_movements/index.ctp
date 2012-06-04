<div class="inventoryMovements index">
	<h2><?php __('Inventory Movements');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('inventory_id');?></th>
			<th><?php echo $this->Paginator->sort('tipo_documento_id');?></th>
			<th><?php echo $this->Paginator->sort('tipo_movimiento');?></th>
			<th><?php echo $this->Paginator->sort('detalle');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inventoryMovements as $inventoryMovement):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $inventoryMovement['InventoryMovement']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inventoryMovement['Inventory']['id'], array('controller' => 'inventories', 'action' => 'view', $inventoryMovement['Inventory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inventoryMovement['TipoDocumento']['nombre'], array('controller' => 'tipo_documentos', 'action' => 'view', $inventoryMovement['TipoDocumento']['id'])); ?>
		</td>
		<td><?php echo $inventoryMovement['InventoryMovement']['tipo_movimiento']; ?>&nbsp;</td>
		<td><?php echo $inventoryMovement['InventoryMovement']['detalle']; ?>&nbsp;</td>
		<td><?php echo $inventoryMovement['InventoryMovement']['created']; ?>&nbsp;</td>
		<td><?php echo $inventoryMovement['InventoryMovement']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inventoryMovement['InventoryMovement']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inventoryMovement['InventoryMovement']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inventoryMovement['InventoryMovement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inventoryMovement['InventoryMovement']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inventories', true), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory', true), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Documentos', true), array('controller' => 'tipo_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Documento', true), array('controller' => 'tipo_documentos', 'action' => 'add')); ?> </li>
	</ul>
</div>