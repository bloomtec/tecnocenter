<div class="providers index">
	<h2><?php __('Providers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tipo_prov');?></th>
			<th><?php echo $this->Paginator->sort('tipo_iden_pro');?></th>
			<th><?php echo $this->Paginator->sort('nit_proveedor');?></th>
			<th><?php echo $this->Paginator->sort('digito_ver');?></th>
			<th><?php echo $this->Paginator->sort('clasificacion');?></th>
			<th><?php echo $this->Paginator->sort('p_nom_prov');?></th>
			<th><?php echo $this->Paginator->sort('s_nom_prov');?></th>
			<th><?php echo $this->Paginator->sort('p_ape_prov');?></th>
			<th><?php echo $this->Paginator->sort('s_ape_prov');?></th>
			<th><?php echo $this->Paginator->sort('representante_legal');?></th>
			<th><?php echo $this->Paginator->sort('pais');?></th>
			<th><?php echo $this->Paginator->sort('departamento');?></th>
			<th><?php echo $this->Paginator->sort('ciudad');?></th>
			<th><?php echo $this->Paginator->sort('direccion');?></th>
			<th><?php echo $this->Paginator->sort('telefono_1');?></th>
			<th><?php echo $this->Paginator->sort('telefono_2');?></th>
			<th><?php echo $this->Paginator->sort('celular');?></th>
			<th><?php echo $this->Paginator->sort('e_mail');?></th>
			<th><?php echo $this->Paginator->sort('estado_proveedor');?></th>
			<th><?php echo $this->Paginator->sort('tipo_regimen');?></th>
			<th><?php echo $this->Paginator->sort('notas_proveedor');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
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
		<td><?php echo $provider['Provider']['id']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['tipo_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['tipo_iden_pro']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['nit_proveedor']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['digito_ver']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['clasificacion']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['p_nom_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['s_nom_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['p_ape_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['s_ape_prov']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['representante_legal']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['pais']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['departamento']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['ciudad']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['direccion']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['telefono_1']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['telefono_2']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['celular']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['e_mail']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['estado_proveedor']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['tipo_regimen']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['notas_proveedor']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['created']; ?>&nbsp;</td>
		<td><?php echo $provider['Provider']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $provider['Provider']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $provider['Provider']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $provider['Provider']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $provider['Provider']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Provider', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inventories', true), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory', true), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
	</ul>
</div>