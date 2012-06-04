<div class="providers">
	<h2><?php __('Proveedores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort("Tipo de Proveedor",'tipo_prov');?></th>
			<th><?php echo $this->Paginator->sort('nit_proveedor');?></th>
			<th><?php echo $this->Paginator->sort('Razón Social','p_nom_prov');?></th>
			<th><?php echo $this->Paginator->sort('representante_legal');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($providers as $provider):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $provider['Provider']['tipo_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['nit_proveedor']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['razon_social']; ?>&nbsp;</td>

		<td><?php echo $provider['Provider']['representante_legal']; ?>&nbsp;</td>
		
		<td class="actions_icons">
			<?php echo $this->Html->image(("ver.gif"),array("alt"=>'ver',"title"=>'ver detalle',"url"=>array('action' => 'view', $provider['Provider']['id']))); ?>
			<?php echo $this->Html->image(("editar.gif"),array("alt"=>'editar',"title"=>'editar',"url"=>array('action' => 'edit', $provider['Provider']['id']))); ?>
			<?php echo $this->Html->link($this->Html->image(("borrar.gif"),array("alt"=>'borrar',"title"=>'borrar')), array('action' => 'delete', $provider['Provider']['id']),array('escape'=>false), sprintf(__('Está seguro que desea borrar el proveedor ?', true), $provider['Provider']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% datos de %count% en total, empezando por el dato %start%, terminando en %end%', true)	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>