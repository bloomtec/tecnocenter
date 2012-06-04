<div class="services">
	<h2><?php __('Servicios');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="services">
	<tr class='ui-state-disabled'>	
			<th><?php echo $this->Paginator->sort('Orden','order');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('Descripción','descripcion');?></th>
			<th><?php echo $this->Paginator->sort('Creado','created');?></th>
			<th><?php echo $this->Paginator->sort('Modificado','updated');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($services as $service):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id="<?php echo $service['Service']['id'];?>">
		<td class="order"><?php echo $service['Service']['order']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['nombre']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['created']; ?>&nbsp;</td>
		<td><?php echo $service['Service']['updated']; ?>&nbsp;</td>
		<td class="actions_icons">
			<?php //echo $this->Html->image(("ver.gif"),array("alt"=>'ver',"url"=>array('action' => 'view',$service['Service']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("mostrar.png"),array("alt"=>'visualizar',"title"=>'visualizar', "target"=>"_blank" )),array('action' => 'view',"admin"=>false, $service['Service']['id']), array('escape'=>false,"alt"=>'ver', "target"=>"_blank")); ?>
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'editar',"url"=>array('action' => 'edit', $service['Service']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')),array('action' => 'delete', $service['Service']['id']), array('escape'=>false), sprintf(__('Está seguro que quiere eliminar el servicio?', true), $service['Service']['id'])); ?>
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