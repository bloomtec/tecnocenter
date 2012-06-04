<div class="photoAlbums index">
	<h2><?php __('Photo Albums');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($photoAlbums as $photoAlbum):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $photoAlbum['PhotoAlbum']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($photoAlbum['Product']['nombre'], array('controller' => 'products', 'action' => 'view', $photoAlbum['Product']['id'])); ?>
		</td>
		<td><?php echo $photoAlbum['PhotoAlbum']['nombre']; ?>&nbsp;</td>
		<td><?php echo $photoAlbum['PhotoAlbum']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $photoAlbum['PhotoAlbum']['updated']; ?>&nbsp;</td>
		<td><?php echo $photoAlbum['PhotoAlbum']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $photoAlbum['PhotoAlbum']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $photoAlbum['PhotoAlbum']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $photoAlbum['PhotoAlbum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $photoAlbum['PhotoAlbum']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Photo Album', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>