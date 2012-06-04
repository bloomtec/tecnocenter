<div class="inventories">
	<h2><?php __('Inventarios');?></h2>
	<table cellpadding="0" cellspacing="0" class="inventario">
	<thead>
		<tr>
			<th><?php echo ('Código Producto');?></th>
			<th><?php echo $this->Paginator->sort('Producto','product_id');?></th>
			<th><?php echo $this->Paginator->sort('Proveedor','provider_id');?></th>
			<th><?php echo $this->Paginator->sort('stock');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($inventories as $inventory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $inventory['Product']['codigo']; ?>
		</td>
		<td>
			<?php echo $inventory['Product']['nombre']; ?>
		</td>
		<td>
			<?php echo $inventory['Provider']['nit_proveedor']; ?>
		</td>
		<td><?php echo $inventory['Inventory']['stock']; ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</tbody>
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
