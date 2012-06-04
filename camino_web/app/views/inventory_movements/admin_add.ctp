<div class="inventoryMovements form">
<?php echo $this->Form->create('InventoryMovement');?>
	<fieldset>
 		<legend><?php __('Admin Add Inventory Movement'); ?></legend>
	<?php
		echo $this->Form->input('inventory_id');
		echo $this->Form->input('tipo_documento_id');
		echo $this->Form->input('tipo_movimiento');
		echo $this->Form->input('detalle');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Inventory Movements', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inventories', true), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory', true), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Documentos', true), array('controller' => 'tipo_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Documento', true), array('controller' => 'tipo_documentos', 'action' => 'add')); ?> </li>
	</ul>
</div>