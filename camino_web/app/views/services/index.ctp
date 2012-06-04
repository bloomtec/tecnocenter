<div class="services index">
	<h2><?php __('Services');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('contenido');?></th>
			<th><?php echo $this->Paginator->sort('order');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($services as $service):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $service['Service']['id']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['nombre']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['contenido']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['order']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['created']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $service['Service']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $service['Service']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $service['Service']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $service['Service']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service', true), array('action' => 'add')); ?></li>
	</ul>
</div>