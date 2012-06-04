<div class="onlineSales form">
<?php echo $this->Form->create('OnlineSale');?>
	<fieldset>
 		<legend><?php __('Edit Online Sale'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('id_cuenta');
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('porcentaje_iva');
		echo $this->Form->input('valor_unit');
		echo $this->Form->input('subtotal');
		echo $this->Form->input('valor_iva');
		echo $this->Form->input('valor_total');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('OnlineSale.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('OnlineSale.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Online Sales', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>