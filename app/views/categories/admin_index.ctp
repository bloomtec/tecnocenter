<div class="categories ">
	<h2><?php __('Categorías');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="categories">
	<tr class='ui-state-disabled'>	
			<th><?php echo $this->Paginator->sort('Orden','order');?></th>	
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('Creado','created');?></th>
			<th><?php echo $this->Paginator->sort('Modificado','updated');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($categories as $category):
			$class =  ' class="ui-state-default "';
		if ($i++ % 2 == 0) {
			$class = ' class="altrow ui-state-default"';
		}
	?>
	<tr<?php echo $class;?> id="<?php echo $category['Category']['id'];?>">
	<td class="order"><?php echo $category['Category']['order']; ?>&nbsp;</td>
		<td><?php echo $category['Category']['nombre']; ?>&nbsp;</td>
		<td><?php echo $category['Category']['created']; ?>&nbsp;</td>
		<td><?php echo $category['Category']['updated']; ?>&nbsp;</td>
		<td class="actions_icons">
		
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'editar',"url"=>array('action' => 'edit', $category['Category']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')), array('action' => 'delete', $category['Category']['id']),array('escape'=>false), sprintf(__('Está seguro que desea eliminar la categoría?', true), $category['Category']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>