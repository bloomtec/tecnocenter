<div class="manufacturers">
	<h2><?php __('Fabricantes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('Creado','created');?></th>
			<th><?php echo $this->Paginator->sort('Modificado','updated');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($manufacturers as $manufacturer):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	
		<td><?php echo $manufacturer['Manufacturer']['nombre']; ?>&nbsp;</td>
		<td><?php echo $manufacturer['Manufacturer']['created']; ?>&nbsp;</td>
		<td><?php echo $manufacturer['Manufacturer']['updated']; ?>&nbsp;</td>
		<td class="actions_icons">
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'editar',"url"=>array('action' => 'edit', $manufacturer['Manufacturer']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')),array('action' => 'delete', $manufacturer['Manufacturer']['id']), array('escape'=>false), sprintf(__('Está seguro que desea eliminar el fabricante ?', true), $manufacturer['Manufacturer']['id'])); ?>
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