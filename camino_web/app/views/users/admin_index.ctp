<div class="users">
	<h2><?php __('Usuarios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('role_id');?></th>
			<th><?php echo $this->Paginator->sort('P-Nombre','primer_nombre');?></th>
			<th><?php echo $this->Paginator->sort('S-Nombre','segundo_nombre');?></th>
			<th><?php echo $this->Paginator->sort('P-Apellido','primer_apellido');?></th>
			<th><?php echo $this->Paginator->sort('S-Apellido','segundo_apellido');?></th>	

			<th><?php echo $this->Paginator->sort('email');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td>
			<?php echo $user['Role']['name']; ?>
			<?php //echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</td>
		<td><?php echo $user['User']['primer_nombre']; ?>&nbsp;</td>
		<td><?php echo $user['User']['segundo_nombre']; ?>&nbsp;</td>
		<td><?php echo $user['User']['primer_apellido']; ?>&nbsp;</td>
		<td><?php echo $user['User']['segundo_apellido']; ?>&nbsp;</td>

		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td class="actions_icons">
			<?php echo $this->Html->image(("ver.gif"),array("alt"=>'ver',"title"=>'Ver Detalle',"url"=>array('action' => 'view', $user['User']['id'])) ); ?>
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'editar',"url"=>array('action' => 'edit', $user['User']['id'])) ); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')),array('action' => 'delete', $user['User']['id']), array('escape'=>false), sprintf(__('Está seguro que desea eliminar el usuario ?', true), $user['User']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% datos de %count% en total, empezando por el dato %start%, terminando en %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
