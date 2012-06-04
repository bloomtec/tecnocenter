<div class="onlineSales index">
	<h2><?php __('Online Sales');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('id_cuenta');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('cantidad');?></th>
			<th><?php echo $this->Paginator->sort('porcentaje_iva');?></th>
			<th><?php echo $this->Paginator->sort('valor_unit');?></th>
			<th><?php echo $this->Paginator->sort('subtotal');?></th>
			<th><?php echo $this->Paginator->sort('valor_iva');?></th>
			<th><?php echo $this->Paginator->sort('valor_total');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onlineSales as $onlineSale):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $onlineSale['OnlineSale']['id']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['id_cuenta']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($onlineSale['User']['username'], array('controller' => 'users', 'action' => 'view', $onlineSale['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($onlineSale['Product']['nombre'], array('controller' => 'products', 'action' => 'view', $onlineSale['Product']['id'])); ?>
		</td>
		<td><?php echo $onlineSale['OnlineSale']['cantidad']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['porcentaje_iva']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['valor_unit']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['subtotal']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['valor_iva']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['valor_total']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['created']; ?>&nbsp;</td>
		<td><?php echo $onlineSale['OnlineSale']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $onlineSale['OnlineSale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $onlineSale['OnlineSale']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $onlineSale['OnlineSale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onlineSale['OnlineSale']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de %count% total, empezando en el registro %start%, terminando en %end%', true)
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
		<li><?php echo $this->Html->link(__('New Online Sale', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>